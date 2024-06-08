@extends('admin.layouts.master')
@section('content')
<?php

$servername = "localhost";
$username = "nextecki_milk_delivery";
$password = "milk_delivery";
$dbname = "nextecki_milk_delivery";
// $conn = mysqli_connect($servername, $username, $password);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql = "SELECT * FROM returns";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
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
                <h4 class="mt-0 header-title m-b-30">Sales Return Report</h4>
                
                <div class="table-responsive table-full-width">
                    <div style="overflow: auto;">
                        <form action="{{route('salesreturnsearchsearch')}}" method="GET">       
                                             
                            <div class="col-md-12">
                                <!-- Customer list in dropdown -->
                                <div class="col-md-2" style="float:left;">
                                    <div class="form-group">
                                        <label>Customer</label>
                                    <select class="form-control" id="customerselectid" name="customerselectid">
                                        <option value="">All</option>
                                       <?php
                                        $sql = "SELECT * FROM users where role_id=1";
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
                                    <th>Customer</th>
                                    <th>Salesman</th>
                                    <th>Amount</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php 
                              if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                              }
                              
                              $sql = "SELECT * FROM returns";
                              $result = mysqli_query($conn, $sql);
                              
                              if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                $p = 0;
                                while($row = mysqli_fetch_assoc($result)) {
                                    // $custqry = ;
                                    $p++;
                                    $custid = $row['customer_id'];
                                    $salesmid = $row['salesman_id'];
                                    $customer = mysqli_query($conn, "SELECT name from users where id= $custid");
                                    $salesman = mysqli_query($conn, "SELECT name from users where id= $salesmid");
                                    $cust = mysqli_fetch_assoc($customer);
                                    $smid = mysqli_fetch_assoc($salesman);
                                    
                                    
                                //   echo "id: " . $row["id"]. " - Sales Man Id: " . $row["salesman_id"]. " - Is Approved ? " . $row["is_approved"]. "<br>";
                            echo 
                            "<tr>
                            <td>".$p."</td>
                            <td>".$cust['name']."</td>
                            <td>".$smid['name']."</td>
                            <td>".$row['total_amount']."</td>
                            <td>".$row['created_at']."</td>
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

@endsection
