<?php
include("config.php");

if($_REQUEST['op']=='insert'){
    // print_r($_REQUEST['techno']);
 $tech=implode(',',$_REQUEST['techno']);

    $query = "INSERT INTO public.student (first_name,middle_name,last_name,email,mobileno,gender,
    address,state,district,tech) VALUES ('".$_REQUEST['first_name']."', '".$_REQUEST['middle_name']."', '".$_REQUEST['last_name']."',
    '".$_REQUEST['email']."', '".$_REQUEST['mobileno']."','".$_REQUEST['gender']."',
    '".$_REQUEST['address']."','".$_REQUEST['state']."','".$_REQUEST['district']."','$tech')";
    
    $result = pg_query($db, $query);
    echo "inserted";
    header("location:index.php");
  }

if($_REQUEST['op']=='update'){
    $query = "UPDATE public.student set first_name='".$_REQUEST['first_name']."',middle_name='".$_REQUEST['middle_name']."',
    last_name='".$_REQUEST['last_name']."',email='".$_REQUEST['email']."',mobileno='".$_REQUEST['mobileno']."',
    dob='".$_REQUEST['dob']."',gender='".$_REQUEST['gender']."',designation='".$_REQUEST['designation']."',
    address='".$_REQUEST['address']."' where ID='".$_REQUEST['id']."'";
    $result = pg_query($db, $query);
    echo "updated";
    header("location:index.php");
}

if($_REQUEST['op']=='delete'){
    echo "deleted";
    $query = "DELETE from public.student where ID=".$_REQUEST['id'];
    echo $query;
    // $result = pg_query($db, $query);
    // echo "deleted";
    // header("location:index.php");
}

if($_REQUEST['op']='getDistrict'){
    $host        = "host = localhost";
    $port        = "port = 5432";
    $dbname      = "dbname = test1";
    $credentials = "user = postgres password=12345";
 
    $db1 = pg_connect( "$host $port $dbname $credentials"  );

    $query = "SELECT * FROM district where state_name = '".$_REQUEST['id']."'";
    //echo $query;
    $result = pg_query($db1,$query);
    $division=array();
    while($row=pg_fetch_assoc($result)){
        array_push($division,$row);
    }
     echo json_encode($division);
}
?>
