<?php
include("config.php");

$query = "SELECT * FROM public.ritesh where id=".$_GET['id'];
echo $query;

$result = pg_query($db, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <style>
    input{
      margin: 0 0 0.3rem 0 !important;
    }
  </style>
</head>
<body>
​
<div class="container">
  <h2>Edit Person Details</h2>
  <?php while($row = pg_fetch_assoc($result)){?>
  <form action="operations.php" method="post" enctype="multipart/form-row" onsubmit = "return validateForm()">
      <input type="text" value="<?=  $row["id"] ?>" style="display:none" name="id" id="">
      <input type="hidden" name="op" value="update">
    <div class="form-group">
      <label for="">First Name:</label>
      <input type="text" class="form-control" id="f_name" placeholder="" value="<?= $row['first_name'] ;?>" name="first_name">
      <span id="fnameerror" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
      <label for="">Middle Name:</label>
      <input type="text" class="form-control" id="m_name" placeholder="" value="<?= $row["middle_name"]?>" name="middle_name">
      <span id="mnameerror" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
      <label for="">Last Name:</label>
      <input type="text" class="form-control" id="l_name" placeholder="" value="<?= $row["last_name"]?>" name="last_name">
      <span id="lnameerror" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
      <label for="">Email Id:</label>
      <input type="text" class="form-control" id="email" placeholder="" value="<?= $row["email"]?>" name="email">
      <span id="emailerror" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
      <label for="">Mobile No :</label>
      <input type="text" class="form-control" id="mobno" placeholder="" value="<?= $row["mobileno"]?>" name="mobileno">
      <span id="mobnoerror" class="text-danger font-weight-bold"></span>
    </div>

    <div class="form-group">
      <label for=""> DOB :</label>
      <input type="text" class="form-control" id="dob" placeholder="" value="<?= $row["dob"]?>" name="dob">
      <span id="doberror" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
      <label for=""> Gender :</label>
      <!-- <input type="text" class="form-control" id="pwd" placeholder="" name="gender"> -->
      <select class="form-control" id="gender" name="gender">
          <option value="">------</option>
          <option <?php if($row["gender"]=="male"){echo "selected";}?> value="male">male</option>
          <option <?php if($row["gender"]=="female"){echo "selected";}?> value="female">female</option>
      </select>
      <span id="gendererror" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
      <label for="">Designation :</label>
      <select class="form-control" name="designation" id="designation">
          <option value="">------</option>
          <option  <?php if($row["designation"]=="Java Developer"){echo "selected";}?> value="Java Developer">Java Developer</option>
          <option  <?php if($row["designation"]=="Php Developer"){echo "selected";}?> value="Php Developer">Php Developer</option>
          <option  <?php if($row["designation"]=="Android Developer"){echo "selected";}?> value="Android Developer">Android Developer</option>
      </select>
      <span id="designationerror" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
      <label for=""> Address :</label>
      <input type="text" class="form-control" id="address" value="<?= $row["address"]?>" placeholder="" name="address">
      <span id="addresserror" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
      <label for=""> Photo :</label>
      <input type="file" class="form-control" id="photo" placeholder="" name="photo">
      <span id="photoerror" class="text-danger font-weight-bold"></span><br>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <?php }?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
​<script>
    $(document).ready(function(){
      $("#dob").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "-60:+0",
      dateFormat:"dd-mm-yy"
    });
  });
  //   $(document).ready(function(){
  //     $("#state").selectstate({
    
  //   });
  // });
  function validateForm(){
      debugger
    var count = 0;
  // for getting value of input controller
   var f_name = document.getElementById('f_name').value;
   var m_name = document.getElementById('m_name').value;
   var l_name = document.getElementById('l_name').value;
   var mobno = document.getElementById('mobno').value;
   var dob = document.getElementById('dob').value;
   var gender = document.getElementById('gender').value;
   var address = document.getElementById('address').value;
   var email = document.getElementById('email').value;
   var designation = document.getElementById('designation').value;
   var photo = document.getElementById('photo').value;

   // validation regex
   var fnameCheck = /^[A-Za-z. ]{3,15}$/ ;
   var mnameCheck = /^[A-Za-z ]{3,15}$/;
   var lnameCheck =/^[A-Za-z ]{3,15}$/;
   var mobnoCheck = /^[0-9]{10}$/;
   var addressCheck = /^[A-Za-z0-9. ()-]{3,100}$/;
   var emailCheck = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;

   function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
    }

   // for display error message
   var fnameerror = document.getElementById('fnameerror');
   var mnameerror = document.getElementById('mnameerror');
   var lnameerror = document.getElementById('lnameerror');
   var mobnoerror = document.getElementById('mobnoerror');
   var addresserror = document.getElementById('addresserror');
   var doberror = document.getElementById('doberror');
   var gendererror = document.getElementById('gendererror');
   var photoerror = document.getElementById('photoerror');
   var emailerror = document.getElementById('emailerror');
   var designationerror = document.getElementById('designationerror');

   fnameerror.innerHTML = "";
   if(f_name == ""){
        fnameerror.innerHTML = "please fill first name";
        count=1;
   }else if(fnameCheck.test(f_name)==false){
        fnameerror.innerHTML = "** only character dot and space are allowed";
        count=1;
   }

   mnameerror.innerHTML = "";
   if(m_name == ""){
        mnameerror.innerHTML = "please fill middle name";
        count=1;
   }else if(mnameCheck.test(m_name)==false){
        mnameerror.innerHTML = "** only character are allowed";
        count=1;
   }

   lnameerror.innerHTML = "";
   if(l_name == ""){
        lnameerror.innerHTML = "please fill last name";
        count=1;
   }else if(lnameCheck.test(l_name)==false){
        lnameerror.innerHTML = "** only character  are allowed";
        count=1;
   }

   emailerror.innerHTML = "";
   if(email == ""){
        emailerror.innerHTML = "please fill emailid";
        count=1;
   }else if(emailCheck.test(email)==false){
        emailerror.innerHTML = "**Invalid email id ";
        count=1;
   }

   mobnoerror.innerHTML = "";
   if(mobno == ""){
        mobnoerror.innerHTML = "please fill mobile number";
        count=1;
   }else if(mobnoCheck.test(mobno)==false){
        mobnoerror.innerHTML = "**only number are allowed";
        count=1;
   }

   addresserror.innerHTML = "";
   if(address == ""){
        addresserror.innerHTML = "please fill address";
        count=1;
   }else if(addressCheck.test(address)==false){
        addresserror.innerHTML = "** please enter valid address speacial character are not allowed except ()-.";
        count=1;
   }

  doberror.innerHTML = "";
   if(dob == ""){
    doberror.innerHTML = "please fill date of birth";
    count=1;
   }else if(getAge(dob) < 18){
    doberror.innerHTML = "**your age is less than 18 years";
    count=1;
   }

   gendererror.innerHTML = "";
   if(gender == ""){
    gendererror.innerHTML = "please select gender";
    count=1;
   }

   photoerror.innerHTML = "";
   if(photo == ""){
    photoerror.innerHTML = "please upload any photo";
    count=1;
   }

   designationerror.innerHTML = "";
   if(designation == ""){
    designationerror.innerHTML = "please select designation";
    count=1;
   }

   if(count > 0){
    return false;
   }

  }
</script>
</body>
</html>
