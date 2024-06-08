<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\CardDetails;
use App\Models\UserAddresses;
use App\Models\Cart;
use App\Models\IceCart;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Mail\OrderRecievedCustomer;
use App\Mail\OrderRecievedCustomerCollection;
use App\Mail\OrderRecievedVendor;
use App\Mail\RegistrationSuccessfull;
use Session;
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('front.modules.checkout.index', [
            'countries' => Countries::whereStatus('1')->orderBy('name', 'ASC')->get(),
        ]);
    }

    public function listCheckoutDetails(Request $request)
    {
        $shipping_amount = false;
        $grand_total = allCartGrandTotalWithGst();
        if($request->collection == 'NO'){
            $shipping_amount = getShippingFee(allCartGrandTotalWithGst(), $request->pincode);
            if($shipping_amount && $shipping_amount != 'NONE')
            $grand_total += $shipping_amount;
        }
        $items = allCartItems();
        $data = [
            'rows' => view('front.modules.checkout._summary_details',
                [
                    'items' => $items,
                ]
            )->render(),
            'shipping_amount' => $shipping_amount,
            'grand_total' => $grand_total,
            'redirect' => count($items) ? false : route('cart')
        ];

        return response()->json($data, 200);
    }

    public function checkoutProceed(Request $request)
    {
        $this->validate($request, $this->checkoutValidationRule($request->member, $request->collection), $this->customMsg());

        if($request->member == 'YES' && !User::where('email', $request->email)->first()){
            $user = new User();
            $user->title = $request->billing_title;
            $user->name = $request->billing_first_name;
            $user->last_name = $request->billing_last_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->postcode = $request->billing_postcode;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->password = bcrypt($request->password);
            $user->save();
            $user
            ->roles()
            ->attach(Role::where('name', 'user')->first()); 
            \Mail::to($request->email)->send(new RegistrationSuccessfull($user));           
        }

        if(User::where('email', $request->email)->first() && !UserAddresses::where('user_id', User::where('email', $request->email)->first()->id)->first()){
            $address = new UserAddresses();
                $address->user_id = $user->id;
                $address->billing_title = $request->billing_title;
                $address->billing_first_name = $request->billing_first_name;
                $address->billing_last_name = $request->billing_last_name;
                $address->billing_address1 = $request->billing_address1;
                $address->billing_address2 = $request->billing_address2;
                $address->billing_postcode = $request->billing_postcode;
                $address->billing_country_id = $request->billing_country_id;
                $address->billing_city = $request->billing_city;
                $address->delivery_title = $request->delivery_title;
                $address->delivery_first_name = $request->delivery_first_name;
                $address->delivery_last_name = $request->delivery_last_name;
                $address->delivery_address1 = $request->delivery_address1;
                $address->delivery_address2 = $request->delivery_address2;
                $address->delivery_postcode = $request->delivery_postcode;
                $address->delivery_country_id = $request->delivery_country_id;
                $address->delivery_city = $request->delivery_city;
                $address->save();
            }
            
        $shipping_amount = getShippingFee(allCartGrandTotal(), $request->delivery_postcode);
        $grand_total = allCartGrandTotal() + $shipping_amount + ((allCartGrandTotal() + $shipping_amount)*10)/100;
        
        $booking_id = 'LLZ' . date('Y') . mt_rand();
        $order = new Orders();
        if($user = User::where('email', $request->email)->first())
        $order->user_id = $user->id;
        $order->booking_id = $booking_id;

        if($request->ice == 'YES'){
            //$grand_total = $grand_total + ($request->ice_qty * 4);
            $order->ice_amount = iceCartGrandTotal();
        }

        $order->grand_total = $grand_total;
        $order->paid_amount = $grand_total;
        //$order->promocode = '';
        //$order->promocode_discount_amount = '';
        $order->total_amount = allCartGrandTotal();

        if($request->collection == 'NO' ){
        if($shipping_amount && $shipping_amount != "NONE"){
        $order->shipping_amount = $shipping_amount;
        }else if($shipping_amount && $shipping_amount == "NONE"){
            $order->shipping_amount = 0;
        }else{
            return response()->json([
                'success' => false,
                'heading' => 'Ohh!',
                'message' => 'Address not deliverable',
                'redirect' => 'javascript:void(0)',
            ]);
        }
    }
        $order->tax_amount = ((allCartGrandTotal() + $shipping_amount)*10)/100;
        //$order->promo_discounted_amount = '';
        
        $order->payment_gateway = 'NAB Transact';
        if ($request->member == 'NO') {
            $order->subscribe = '1';
        }

        $order->save();

        $detail = new OrderDetails();
        $detail->order_id = $order->id;
        $detail->billing_title = $request->billing_title;
        $detail->billing_first_name = $request->billing_first_name;
        $detail->billing_last_name = $request->billing_last_name;
        $detail->email = $request->email;
        $detail->mobile = $request->mobile;
        $detail->billing_address1 = $request->billing_address1;
        $detail->billing_address2 = $request->billing_address2;
        $detail->billing_postcode = $request->billing_postcode;
        $detail->billing_city = $request->billing_city;
        $detail->billing_country_id = $request->billing_country_id;
        $detail->dob = date('Y-m-d',strtotime($request->dob));
        $detail->delivery_title = $request->billing_title;
        $detail->delivery_first_name = $request->billing_first_name;
        $detail->delivery_last_name = $request->billing_last_name;
        $detail->delivery_address1 = $request->delivery_address1;
        $detail->delivery_address2 = $request->delivery_address2;
        $detail->delivery_postcode = $request->delivery_postcode;
        $detail->delivery_city = $request->delivery_city;
        $detail->delivery_country_id = $request->delivery_country_id;
        if($request->collection == 'YES'){
        $detail->collection = '1';
        $detail->collection_date = date('Y-m-d',strtotime($request->collection_date));
        $detail->collection_time = $request->collection_time;
        }
        if($request->chilled == 'YES')
        $detail->chilled = '1';
        if($request->ice == 'YES'){
        $detail->ice = '1';
        $detail->ice_qty = iceCartTotalQty();
        }
        //$detail->card_no = $request->card_no;
        $detail->save();
        
        foreach(allCartItems() as $item){
        $items = new OrderItems();
        $items->order_id = $order->id;
        $items->product_id = $item->product_id;
        $items->price = $item->individual_price;
        $items->past_price = $item->product->price->past_price ? $item->product->price->past_price : 0;
        $items->qty = $item->qty;
        $items->total_price = $item->total_individual;
        $items->save();
        }
       
        $gateway = Omnipay::create('NABTransact_SecureXML');
        $gateway->setMerchantId('XYZ0010');
        $gateway->setTransactionPassword('abcd1234');
        $gateway->setTestMode(true);
    
        $card = new CreditCard([
                'firstName' => $request->billing_first_name,
                'lastName' => $request->billing_last_name,
                'number'      => $request->card_no,
                'expiryMonth' => $request->expiry_month,
                'expiryYear'  => $request->expiry_year,
                'cvv'         => $request->cvv,
            ]
        );
        
        $transaction = $gateway->purchase([
            'amount'        => $grand_total,
            'currency'      => 'AUD',
            'transactionId' => $booking_id,
            'card'          => $card,
        ]
    );
    
        $response = $transaction->send();
        
        if ($response->isSuccessful()) {
            $response_data = json_decode(str_replace('\\u0000*\\u0000', '', json_encode(collect($response))), TRUE)['data']['Payment']['TxnList']['Txn'];
            $order->order_status = 1;
            $order->bank_reference_id = $response_data['txnID'];
            $order->transaction_id = $response_data['purchaseOrderNo'];
            $order->pg_auth_id = $response_data['authID'];
            $order->card_no = $response_data['CreditCardInfo']['pan'];
            $order->exp_date = $response_data['CreditCardInfo']['expiryDate'];
            $order->card_type = $response_data['CreditCardInfo']['cardDescription'];
            $order->save();
            Session::forget('llz_cart');
            Session::forget('llz_ice_cart');
            Cart::where('user_id', User::where('email', $request->email)->first()->id)->delete(); 
            IceCart::where('user_id', User::where('email', $request->email)->first()->id)->delete(); 

            if($request->collection == 'YES'){
            \Mail::to($request->email)->send(new OrderRecievedCustomerCollection($order));
            }else{
                \Mail::to($request->email)->send(new OrderRecievedCustomer($order));
            }
            \Mail::to('arvindkumar.ldots@gmail.com')->send(new OrderRecievedVendor($order));
            return response()->json([
                'success' => true,
                'heading' => 'Success',
                'message' => 'Ordered Successfull',
                'redirect' => route('payment.status', $order->booking_id),
            ]);
        } else {
            $order->order_status = 2;
            $order->save();
            return response()->json([
                'success' => false,
                'heading' => 'Payment Failed',
                'message' => $response->getMessage(), //'We are having some problem with payment. Please try again later',   
                'redirect' => route('payment.status', $order->booking_id),
            ], 400);
        }

    }

    public function checkoutValidationRule($member, $collection)
    {
        if($member == 'YES'){
            if($collection == 'YES'){
        return [
            'billing_title' => 'required',
            'billing_first_name' => 'required|min:2|max:255',
            'billing_last_name' => 'nullable|max:255',
            'email' => 'required|email|min:2|max:255',
            'mobile' => 'required|digits:10',
            'billing_address1' => 'required|max:255',
            'billing_address2' => 'nullable|max:255',
            'billing_postcode' => 'required|min:2|max:255',
            'billing_city' => 'required|min:2|max:255',
            'billing_country_id' => 'required',
            'dob' => 'required|date|before:18 years ago',
            'member' => 'required',
            'password' => 'required_if:member,==,YES|min:6|max:12|confirmed',
            'delivery_address1' => 'required_if:collection,==,NO|max:255',
            'delivery_address2' => 'nullable|max:255',
            'delivery_postcode' => 'required_if:collection,==,NO|max:255',
            'delivery_city' => 'required_if:collection,==,NO|max:255',
            'delivery_country_id' => 'required_if:collection,==,NO',
            'collection_date' => 'required_if:collection,==,YES|date|after:yesterday',
            'collection_time' => 'required_if:collection,==,YES',
            'ice_qty' => 'required_if:ice,==,YES|numeric',
            'card_name' => 'required|min:2|max:255',
            'card_no' => 'required|digits:16',
            'expiry_year' => 'required|digits:4',
            'expiry_month' => 'required|numeric|min:01|max:12',
            'cvv' => 'required|digits:3',
        ];
    }else{
        return [
            'billing_title' => 'required',
            'billing_first_name' => 'required|min:2|max:255',
            'billing_last_name' => 'nullable|max:255',
            'email' => 'required|email|min:2|max:255',
            'mobile' => 'required|digits:10',
            'billing_address1' => 'required|max:255',
            'billing_address2' => 'nullable|max:255',
            'billing_postcode' => 'required|min:2|max:255',
            'billing_city' => 'required|min:2|max:255',
            'billing_country_id' => 'required',
            'dob' => 'required|date|before:18 years ago',
            'member' => 'required',
            'password' => 'required_if:member,==,YES|min:6|max:12|confirmed',
            'delivery_address1' => 'required_if:collection,==,NO|max:255',
            'delivery_address2' => 'nullable|max:255',
            'delivery_postcode' => 'required_if:collection,==,NO|max:255',
            'delivery_city' => 'required_if:collection,==,NO|max:255',
            'delivery_country_id' => 'required_if:collection,==,NO',
            'collection_date' => 'required_if:collection,==,YES',
            'collection_time' => 'required_if:collection,==,YES',
            'ice_qty' => 'required_if:ice,==,YES|numeric',
            'card_name' => 'required|min:2|max:255',
            'card_no' => 'required|digits:16',
            'expiry_year' => 'required|digits:4',
            'expiry_month' => 'required|numeric|min:01|max:12',
            'cvv' => 'required|digits:3',
        ];
    }
        }else{
            if($collection == 'YES'){
            return [
                'billing_title' => 'required',
                'billing_first_name' => 'required|min:2|max:255',
                'billing_last_name' => 'nullable|max:255',
                'email' => 'required|email|min:2|max:255',
                'mobile' => 'required|digits:10',
                'billing_address1' => 'required|max:255',
                'billing_address2' => 'nullable|max:255',
                'billing_postcode' => 'required|min:2|max:255',
                'billing_city' => 'required|min:2|max:255',
                'billing_country_id' => 'required',
                'dob' => 'required|date|before:18 years ago',
                'member' => 'required',
                'delivery_address1' => 'required_if:collection,==,NO|max:255',
                'delivery_address2' => 'nullable|max:255',
                'delivery_postcode' => 'required_if:collection,==,NO|max:255',
                'delivery_city' => 'required_if:collection,==,NO|max:255',
                'delivery_country_id' => 'required_if:collection,==,NO',
                'collection_date' => 'required_if:collection,==,YES|date|after:yesterday',
                'collection_time' => 'required_if:collection,==,YES',
                'ice_qty' => 'required_if:ice,==,YES|numeric',
                'card_name' => 'required|min:2|max:255',
                'card_no' => 'required|digits:16',
                'expiry_year' => 'required|digits:4',
                'expiry_month' => 'required|numeric|min:01|max:12',
                'cvv' => 'required|digits:3',
            ];
        }else{
            return [
                'billing_title' => 'required',
                'billing_first_name' => 'required|min:2|max:255',
                'billing_last_name' => 'nullable|max:255',
                'email' => 'required|email|min:2|max:255',
                'mobile' => 'required|digits:10',
                'billing_address1' => 'required|max:255',
                'billing_address2' => 'nullable|max:255',
                'billing_postcode' => 'required|min:2|max:255',
                'billing_city' => 'required|min:2|max:255',
                'billing_country_id' => 'required',
                'dob' => 'required|date|before:18 years ago',
                'member' => 'required',
                'delivery_address1' => 'required_if:collection,==,NO|max:255',
                'delivery_address2' => 'nullable|max:255',
                'delivery_postcode' => 'required_if:collection,==,NO|max:255',
                'delivery_city' => 'required_if:collection,==,NO|max:255',
                'delivery_country_id' => 'required_if:collection,==,NO',
                'collection_date' => 'required_if:collection,==,YES',
                'collection_time' => 'required_if:collection,==,YES',
                'ice_qty' => 'required_if:ice,==,YES|numeric',
                'card_name' => 'required|min:2|max:255',
                'card_no' => 'required|digits:16',
                'expiry_year' => 'required|digits:4',
                'expiry_month' => 'required|numeric|min:01|max:12',
                'cvv' => 'required|digits:3',
            ];
        }
        }
    }

    public function customMsg()
    {
        return [
            'billing_title.required'=>'Select billing title',
            'billing_first_name.required'=>'Enter billing first name',
            'billing_first_name.min'=>'Invalid billing first name',
            'billing_first_name.max'=>'Invalid billing first name',
            'billing_last_name.max'=>'Invalid billing last name',
            'mobile.required'=>'Enter mobile no',
            'mobile.digits'=>'Invalid mobile no',
            'email.required'=>'Enter email id',
            'email.min'=>'Invalid email id',
            'email.max'=>'Invalid email id',
            'email.email'=>'Invalid email id',
            'billing_address1.required'=>'Enter billing address line 1',
            'billing_address1.max'=>'Invalid billing address line 1',
            'billing_address2.max'=>'Enter billing address line 2',
            'billing_postcode.required'=>'Enter billing postcode',
            'billing_postcode.min'=>'Invalid billing postcode',
            'billing_postcode.max'=>'Invalid billing postcode',
            'billing_city.required'=>'Enter billing city name',
            'billing_city.min'=>'Invalid billing city name',
            'billing_city.max'=>'Invalid billing city name',
            'billing_country_id.required'=>'Select billing country',
            'password.required_if'=>'Enter password',
            'password.min'=>'Invalid password',
            'password.max'=>'Invalid password',
            'password.confirmed'=>"Confirm password dosen't match",
            'dob.required'=>'Enter your date of birth',
            'dob.date'=>'Invalid your date of birth',
            'dob.before'=>'You must be over 18 years old',
            'delivery_address1.required_if'=>'Enter delivery address line 1',
            'delivery_address1.max'=>'Invalid delivery address line 1',
            'delivery_address2.max'=>'Enter delivery address line 2',
            'delivery_postcode.required_if'=>'Enter delivery postcode',
            'delivery_postcode.min'=>'Invalid delivery postcode',
            'delivery_postcode.max'=>'Invalid delivery postcode',
            'delivery_city.required_if'=>'Enter delivery city name',
            'delivery_city.min'=>'Invalid delivery city name',
            'delivery_city.max'=>'Invalid delivery city name',
            'delivery_country_id.required_if'=>'Select delivery country',
            'collection_date.required_if'=>'Enter collection date',
            'collection_date.date'=>'Invalid collection date',
            'collection_date.after'=>'Invalid collection date',
            'collection_time.required_if'=>'Select collection time',
            'ice_qty.required_if'=>'Enter Ice quantity',
            'card_name.required'=>'Enter cardholder name',
            'card_name.min'=>'Invalid cardholder name',
            'card_name.max'=>'Invalid cardholder name',
            'card_no.required'=>'Enter card number',
            'card_no.digits'=>'Invalid card number',
            'expiry_year.required'=>'Enter expiry year',
            'expiry_year.digits'=>'Invalid expiry year',
            'expiry_month.required'=>'Enter expiry month',
            'expiry_month.numeric'=>'Invalid expiry month',
            'expiry_month.min'=>'Invalid expiry month',
            'expiry_month.max'=>'Invalid expiry month',
            'cvv.required'=>'Enter cvv',
            'cvv.digits'=>'Invalid cvv',
            'captcha.required'=>'Enter captcha',
            'captcha.captcha'=>'Invalid Captcha code',
        ];
    }

    public function getShippingPrice(Request $request)
    {
        return response()->json([
            'shipping_amount' => getShippingFee($request->amount, $request->pincode),
        ]);
    }

    public function paymentStatus($id)
    {
        $order = Orders::where('booking_id', $id)->first();
        if($order->order_status == 1){
            return view('front.modules.checkout.success', [
                'order' => $order
            ]);
        }else{
            return view('front.modules.checkout.failure', [
                'order' => $order
            ]);
        }
    }

}
