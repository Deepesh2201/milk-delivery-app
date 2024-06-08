@extends('admin.layouts.master')
@section('content')
<?php

$servername = "localhost";
$username = "thenexteck";
$password = "TheNexteck1!";
$dbname = "milkdelivery";
// $conn = mysqli_connect($servername, $username, $password);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM sales";
$result = mysqli_query($conn, $sql);
// Selected Sales Man
if($salesmanid){
    $salesmanid = " && sales.salesman_id = {$salesmanid}";
}
else{
    $salesmanid = "";
}
// Selected Year
if($year){
    $year = " && Year(sales.created_at) = {$year}";
}
else{
    $year = "";
}
// Selected Month
if($month){
    $month = " && Month(sales.created_at) = {$month}";
}
else{
    $month = "";
}
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        //   echo "id: " . $row["id"]. " - Sales Man Id: " . $row["salesman_id"]. " - Is Approved ? " . $row["is_approved"]. "<br>";
    }
} else {
    echo "0 results";
}

//   mysqli_close($conn);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title m-b-30">Sales Target Report</h4>

                <div class="table-responsive table-full-width">
                    <div style="overflow: auto;">
                        <form action="{{route('salestargetsearch')}}" method="GET">

                            <div class="col-md-12">
                                <!-- Customer list in dropdown -->

                                <div class="col-md-2" style="float:left;">
                                    <div class="form-group">
                                        <label>Salesman</label>
                                        <select class="form-control" id="salesmanselect" name="salesmanselect">
                                            <option value="">All</option>
                                            <?php
                                            $sql = "SELECT * FROM users where role_id=2";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    unset($id, $name);
                                                    $id = $row['id'];
                                                    $name = $row['name'];
                                                    echo '<option value="' . $id . '">' . $name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Year -->
                                <div class="col-md-3" style="float:left;">
                                    <div class="form-group">
                                        <label>Select Year</label>
                                        <select class="form-control" id="yearid" name="yearid">
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>

                                        </select>
                                    </div>
                                </div>
                                <!-- Select Month -->
                                <div class="col-md-3" style="float:left;">
                                    <div class="form-group">
                                        <label>Select Month</label>
                                        <select class="form-control" id="monthid" name="monthid">
                                            <option value="">All</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-2" style="float:left;">
                                <div class="form-group">
                                    <label></label>
                                    <button class="form-control btn btn-primary dropdown-toggle arrow-none waves-effect waves-light" type="submit"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Salesman</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Target</th>
                                    <th>No. Of Sales</th>
                                    <th>Sales Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql = "SELECT users.name,IFNULL(users.monthly_target,0) as 'monthly_target', monthname(sales.created_at) as 'month',Year(sales.created_at) as 'year',`salesman_id`,COUNT(`salesman_id`) as 'salescount',SUM(`total_amount`) as 'totalamount',case WHEN IFnull(users.monthly_target,0) <= COUNT(`salesman_id`) then '1' else '0' end 'Status'
                              from sales 
                              INNER JOIN users on users.id = sales.salesman_id
                              where sales.id>0 $salesmanid $year $month
                              GROUP by month(sales.created_at), `salesman_id`";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    $p = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // dd($row);
                                        // $custqry = ;
                                        $p++;
                                        if ($row['Status'] == 0) {
                                            $status = "<a class='text-success'>Achieved</a>";
                                        } else {
                                            $status = "<a class='text-danger'>Not Achieved</a>";
                                        }
                                        echo
                                        "<tr>
                            <td>" . $p . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['year'] . "</td>
                            <td>" . $row['month'] . "</td>
                            <td>" . $row['monthly_target'] . "</td>
                            <td>" . $row['salescount'] . "</td>
                            <td>" . $row['totalamount'] . "</td>
                            <td>" . $status . "</td>
                            </tr>";
                                    }
                                } else {
                                    echo "0 results";
                                }

                                mysqli_close($conn);

                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST["submit"])) {
    echo "erty";
    // $strKeyword = $_POST["submit"];
    // execute query here
    //    $sql = "SELECT * FROM customer_info WHERE cust_ic LIKE '%" . $strKeyword . "%' OR cust_hp_contact1 LIKE '%" . $strKeyword . "%' limit {$start} , {$perpage}";

    //    $query = mysqli_query($conn, $sql);
}
?>
@endsection