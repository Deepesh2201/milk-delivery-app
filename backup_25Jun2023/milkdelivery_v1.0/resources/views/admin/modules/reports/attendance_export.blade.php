<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>
<body>
    <table>
        <thead>
        <tr><th colspan="4">Report  :- </th>
        </tr>
        <tr><th colspan="4">From  :- @if($startDate != ' '){{$startDate ." to"}} @endif @if($endDate != ' '){{$endDate}} @endif</th>
        </tr>
            <tr>
            <!-- <th style="background-color:#32CD32;">User Name</th> -->
            <th style="background-color:#32CD32;">Sr.No.</th>
            <th style="background-color:#32CD32;">Month</th>
            <th style="background-color:#32CD32;">Year</th>
            <th style="background-color:#32CD32;">Holidays</th>
            <th style="background-color:#32CD32;">Total Weekends</th>
            <th style="background-color:#32CD32;">Total Working days</th>
            <th style="background-color:#32CD32;">Presents</th>
              {{-- <!--  <th style="background-color:#32CD32;">Product id</th>
                <th style="background-color:#32CD32;">Division id</th>
                <th style="background-color:#32CD32;">Company id</th>
                <th style="background-color:#32CD32;">Type_id id</th>
                <th style="background-color:#32CD32;">Name</th>
                <th style="background-color:#32CD32;">Image</th>
                <th style="background-color:#32CD32;">Division Name</th>
                <th style="background-color:#32CD32;">Type</th>
                <th style="background-color:#32CD32;">Style</th>
                <th style="background-color:#32CD32;">Attribute</th>
                <th style="background-color:#32CD32;">Brand</th>
                <th style="background-color:#32CD32;">Classification</th>
                <th style="background-color:#32CD32;">Rating</th>
                <th style="background-color:#32CD32;">Size</th>
                <th style="background-color:#32CD32;">Varietie</th>
                <th style="background-color:#32CD32;">Vintage</th>
                <th style="background-color:#32CD32;">Month</th>
                <th style="background-color:#32CD32;">Year</th>
                <th style="background-color:#32CD32;">Quantity</th> -->--}}
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ getWorkingMonth($item->month) }}</td>
                <td>{{$item->year}}</td>     
                <td>{{$item->monthly_holiday}}</td>
                <?php $newdata = officeWorkingDay($item->month, $item->year, $item->monthly_holiday, $holiday_dates, $user->calendar->weekly_holiday, $leaves);
                ?>
                <td>{{ isset($newdata['weekdays']) ? $newdata['weekdays'] : ''}}</td>
                <td>{{ isset($newdata['workdays']) ? $newdata['workdays'] : '' }}</td>
                <?php $newdata =[]; ?>
                <td>{{ my_presents($item->month, $item->year, $item->id) }}</td>               
            </tr>
            @empty
            No User Found with Experience.
            @endforelse
        </tbody>
    </table>
</body>

</html>