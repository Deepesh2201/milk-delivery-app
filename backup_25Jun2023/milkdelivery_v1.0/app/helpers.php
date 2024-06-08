<?php
use Illuminate\Support\Facades\Request;
use App\Models\EmployeeAttendance;
use App\Models\Product;
use App\Models\Onloading;
use App\Models\Offloading;

function isActiveRoute($route, $output = "active")
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}
function mypagination()
{
    return 10;
}

function officeWorkingDay($month, $year, $total_holidays, $holiday_dates, $weekends, $leaves){
    
    //change weekday in sub str
    $weekend = [];
    if( isset($weekends) && count($weekends)>0 )
    foreach($weekends as $val){
        $weekend[] = substr($val, 0, 3);
    }
    
    $dt = "1-$month-$year";
    
    $myTime = strtotime($dt);  // Use whatever date format you want
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
    $workDays = 0;
    $days_in_month = $daysInMonth;
    $i = 0;
    $holiday_overlapped = 0;
    $sk ='';
    // dd($holiday_dates);
    while($daysInMonth > 0)
    {
        $day = date("D", $myTime); // Sun - Sat
        $day_as_date = date("Y-m-d", $myTime); 
        if(in_array($day, $weekend)){
            $i++;
        }
        
        if(in_array($day, $weekend) && in_array($day_as_date, $holiday_dates)){
            $holiday_overlapped++;
        }                
        
        if(!in_array($day, $weekend) && !in_array($day_as_date, $holiday_dates))
            $workDays++;

        $daysInMonth--;
        $myTime += 86400; // 86,400 seconds = 24 hrs.
        /* if($month == '3'){
            $sk .=' '. $day_as_date ;
        } */
     
    }
    // if($month == '2'){
        $month = '0'.$month;
        $diffInDays1 = $diffInDays2 = $diffInDays3 = 0;
       foreach($leaves as $key => $value){
        // dd(date('m', strtotime($value->from_date)));
           if(date('m', strtotime($value->from_date)) == $month && date('m', strtotime($value->to_date)) == $month){
            $d1 = new DateTime("$value->from_date 00:00:00");
            $d2 = new DateTime("$value->to_date 00:00:00");
            $interval1 = $d1->diff($d2);
            $diffInDays1 += ($interval1->d > 0) || ($value->from_date == $value->to_date) ? $interval1->d + 1 : $interval1->d; //21
            // dd($diffInDays1);          
            }
        //    dd($value->from_date ." ".$value->to_date);
           if(date('m', strtotime($value->from_date)) == $month && (date('m', strtotime($value->to_date)) > $month) ){
            $e3 = new DateTime("$value->from_date 00:00:00");
            $month_lastDate = $year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $e4 = new DateTime("$month_lastDate 00:00:00");
            // $d4 = new DateTime("$value->to_date 00:00:00");
            $interval2 =  $e3->diff($e4);
            if($value->from_date == $month_lastDate){
                $diffInDays2 += $interval2->d + 1; 
            }else{
                $diffInDays2 += $interval2->d ; 
            }
            // echo $month_lastDate; 
           }
           if(date('m', strtotime($value->from_date)) != $month && (date('m', strtotime($value->to_date)) == $month) ){
            $month_startDate = $year.'-'.$month.'-'.'01';
            $f1 = new DateTime("$month_startDate 00:00:00");
            $f2 = new DateTime("$value->to_date 00:00:00");

            // $d4 = new DateTime("$value->to_date 00:00:00");
            $interval3 =  $f1->diff($f2);
            $diffInDays3 += ($interval3->d > 0) || ($value->from_date == $value->to_date)  ? $interval3->d + 1 : $interval3->d; //21
           
           }                  
       }        
       $leaves_res = $diffInDays3 +$diffInDays2 + $diffInDays1;
    // }
    
    return $data = ['workdays' => $workDays , 'weekdays' =>$i, 'holiday_overlapped' => $holiday_overlapped, 'total_leaves' => $leaves_res ];
    // return $data = ['workdays' => $days_in_month, 'weekdays' =>$i];

}
function my_presents($month, $year, $user_id){    
    $present = EmployeeAttendance::where('user_id', $user_id)->whereMonth('present_at', $month)
    ->whereYear('present_at', $year)->where('status', 1)->count();    	  
    return $present;
}
function Salesmans(){
    $contents = \App\Models\User::where('role_id', 2)->where('status', 1)->get();
     return $contents;
}
function Products(){
    $contents = Product::get(['id', 'name']);	  
  return $contents;
}
function Onloadings(){
    $contents = Onloading::get(['id', 'salesman_id']);	  
  return $contents;
}
function CountryCodes(){
    $contents = file_get_contents(storage_path('app/data/country_code_json.json'));
  $allcodes = json_decode($contents);		  
  return $allcodes;
}

//Date Format or time formatings
function date_in_mytimezone($date, $time_zone) {
    $serverBokingToDate = new DateTime($date); 
    $serverBokingToDate->setTimezone(new DateTimeZone($time_zone));            
    $newdate = $serverBokingToDate->format('d-M-Y');
    if($newdate){
        return $newdate;
    }else{
        return $newdate = false;
    }
}
function time_in_mytimezone($date, $time_zone) {
    $serverBokingToDate = new DateTime($date); 
    $serverBokingToDate->setTimezone(new DateTimeZone($time_zone));            
    $newdate = $serverBokingToDate->format('h:i A');
    if($newdate){
        return $newdate;
    }else{
        return $newdate = false;
    }
}

function getCurrentTimezoneTime($date)
{
    if(!\Session::has('my_timezone')){
        \Session::put('my_timezone', 'Asia/Kolkata');
    }
    $timezone = \Session::get('my_timezone');

    return time_in_mytimezone($date, $timezone);
    /* $date = Carbon::createFromFormat('Y-m-d H:i:s', $date, 'UTC')
    ->setTimezone($timezone);
    return date("jS M Y g:i A", strtotime($date)); */
}
function getCurrentTimezoneDate($date)
{
    if(!\Session::has('my_timezone')){
        \Session::put('my_timezone', 'Asia/Kolkata');
    }
    $timezone = \Session::get('my_timezone');

    return date_in_mytimezone($date, $timezone);
    /* $date = Carbon::createFromFormat('Y-m-d H:i:s', $date, 'UTC')
    ->setTimezone($timezone);
    return date("jS M Y g:i A", strtotime($date)); */
}

function getCurrentTimezoneDateTime($date)
{
    if(!\Session::has('my_timezone')){
        \Session::put('my_timezone', 'Asia/Kolkata');
    }
    $timezone = \Session::get('my_timezone');
    
    $serverBokingToDate = new DateTime($date); 
    $serverBokingToDate->setTimezone(new DateTimeZone($timezone));            
    $newdate = $serverBokingToDate->format('d-M-Y h:i A');
    if($newdate){
        return $newdate;
    }else{
        return $newdate = false;
    }
    
}

function getUTCTimezoneTime($date)
{  
    if(!\Session::has('my_timezone')){
        \Session::put('my_timezone', 'Asia/Kolkata');
    }
    $timezone = \Session::get('my_timezone');
    date_default_timezone_set($timezone);
     
    $time_zone = 'UTC';
    $serverBokingToDate = new DateTime($date); 
    $serverBokingToDate->setTimezone(new DateTimeZone($time_zone));            
    $newdate = $serverBokingToDate->format('H:i:s');
    if($newdate){
        return $newdate;
    }else{
        return $newdate = false;
    }
  
}
function getUTCTimezoneDate($date)
{  
    $time_zone = 'UTC';
    $serverBokingToDate = new DateTime($date); 
    $serverBokingToDate->setTimezone(new DateTimeZone($time_zone));            
    $newdate = $serverBokingToDate->format('Y-m-d');
    if($newdate){
        return $newdate;
    }else{
        return $newdate = false;
    }  
}
function getUTCTimezoneDateTime($date)
{

    if(!\Session::has('my_timezone')){
        \Session::put('my_timezone', 'Asia/Kolkata');
    }
    $timezone = \Session::get('my_timezone');
    date_default_timezone_set($timezone);
    $time_zone = 'UTC';
    $serverBokingToDate = new DateTime($date); 
    $serverBokingToDate->setTimezone(new DateTimeZone($time_zone));            
    $newdate = $serverBokingToDate->format('Y-m-d H:i:s');
    if($newdate){
        return $newdate;
    }else{
        return $newdate = false;
    }
    
}

?>