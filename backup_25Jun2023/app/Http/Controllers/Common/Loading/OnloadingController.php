<?php

namespace App\Http\Controllers\Common\Loading;
use App\Http\Controllers\Controller;
use App\Models\Onloading;
use App\Models\ProductOnloadingRelation;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnloadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $from = date('Y:m:d'); $to = date('Y:m:d 23:59:59');
        $items = Onloading::where('salesman_id', Auth::id())->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
            return view('user.modules.loading.on-loading.tbody', compact('items'));
        }

        return view('user.modules.loading.on-loading.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $from = date('Y:m:d'); 
        $to = date('Y:m:d 23:59:59'); 
        // $salesmans = Onloading::whereBetween('created_at', [$from, $to])->pluck('salesman_id');
        
        $item = Onloading::query();
        $item->where('salesman_id', Auth::id())->whereBetween('created_at', [$from, $to]);
        if ($request->name != null && $request->name != '') {            
            $item->whereHas('lines', function ($query1) use ($request) {
                $query1->orWhere('batch_no', $request->name);
                $query1->orWhereHas('onloadingProducts', function ($q) use ($request) {
                    $q->whereRaw("name like '$request->name%' ")
                    ->orWhere('group', 'like', $request->name . '%')
                    ->orWhere('sap_id', 'like', $request->name . '%');
                });
            });
        }

        $newitem = $item->orderBy('id', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
           return view('user.modules.loading.on-loading.tbody', ['items' => $newitem]);
        }
        
        return view('user.modules.loading.on-loading.list', [
            'items' => $newitem,
            'name'  => $request->name,                 
        ]);
    }    
}
