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

$salesman = "";
if("{$salesmanid}"){
$salesman = " && offloadings.salesman_id = {$salesmanid}";
}
$daterange = "";
// Start & End Date Qry
if ("{$startdate}" && "{$enddate}") {
    $daterange = " && offloadings.created_at between '{$startdate}' AND '{$enddate}'";
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title m-b-30">Offloading Report</h4>
                
                <div class="table-responsive table-full-width">
                    <div style="overflow: auto;">
                        <form action="{{route('offloadingsearch')}}" method="GET">       
                                             
                            <div class="col-md-12">
                                 
                                
                                <div class="col-md-2" style="float:left;">
                                    <div class="form-group">
                                        <label>Salesman</label>
                                    <select class="form-control" id="salesmanselect" name="salesmanselect">
                                        <option value="">All</option>
                                       <?php
                                        $sql = "SELECT * FROM users where role_id=2";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                        unset($id, $name);
                                        $id = $row['id'];
                                        $name = $row['name']; 
                                        echo '<option value="'.$id.'">'.$name.'</option>';
                                        }
                                    }
                                       ?>
                                       </select>
                                    </div>
                                </div> 
                                <!-- Start Date -->
                                <div class="col-md-3" style="float:left;">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                   <input type="date" class="form-control" id="startdate" name="startdate">
                                    </div>
                                </div> 
                                <div class="col-md-3" style="float:left;">
                                    <div class="form-group">
                                        <label>End Date</label>
                                   <input type="date" class="form-control" id="enddate" name="enddate">
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-md-2" style="float:left;">
                                <div class="form-group">
                                    <label></label>
                                    <button class="form-control btn btn-primary dropdown-toggle arrow-none waves-effect waves-light"
                                        type="submit"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>S.No.</th>
                                    <th>Salesman</th>
                                    <th>Warehouse</th>
                                    <th>Onloading Time</th>
                                    <th>Status</th>
                                    <th>Create Date & Time</th>
                                    <th>Updated Date & Time</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php 
                              if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                              }
                              
                              $sql = "SELECT users.name,onloadings.created_at as 'onloading_time', onloadings.warehouse, offloadings.* FROM `offloadings` 
                              INNER join onloadings on onloadings.id = offloadings.onloading_id
                              INNER join users on users.id = offloadings.salesman_id
                              WHERE offloadings.id>0 $salesman $daterange";
                              $result = mysqli_query($conn, $sql);
                              
                              if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                $p = 0;
                                while($row = mysqli_fetch_assoc($result)) {
                                    $p++;
                                    $status = "<a class='text-danger'>Not Available</a>";
                                    // if($row['is_approved'] == 1){
                                    //     $status = "<a class='text-success'>Approved</a>";
                                    // }
                                    
                            echo 
                            "<tr>
                            <td>".$p."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['warehouse']."</td>
                            <td>".$row['onloading_time']."</td>
                            <td>".$status."</td>
                            <td>".$row['created_at']."</td>
                            <td>".$row['updated_at']."</td>
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
