<?php
include("config.php");

$query = "SELECT * FROM public.student";

$result = pg_query($db, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <style>
    th {
      background-color: #337ab7;
      color: #f9f9f9;
    }

    .panel {
      padding: 0;
    }

    .container {
      margin-top: 35px;
    }

    td {
      font-size: 14px !important;
    }

    th {
      font-size: 16px !important;
    }

    a[href="addEmployees.php"] {
      float: right;
      padding: 1px 11px;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="panel-group">
      <div class="panel panel-primary">
        <div class="panel-heading"><b>Employees List</b><a href="addEmployees.php" class="btn btn-info">Add Employees Details</a></div>
        <div class="panel-body">
          <table id="employee_data" class="table table-hover table-bordered ">
            <thead>
              <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>District</th>
                <th>Email Id</th>
                <th>Mobile No</th>
                <th>State</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = pg_fetch_assoc($result)) { ?>
                <tr>
                  <td><?= $row['first_name'] ?></td>
                  <td><?= $row['middle_name'] ?></td>
                  <td><?= $row['last_name'] ?></td>
                  <td><?= $row['district'] ?></td>
                  <td><?= $row['email'] ?></td>
                  <td><?= $row['mobileno'] ?></td>
                  <td><?= $row['state'] ?></td>
                  <td>
                    <a href="editEmployees.php?id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                    <a href="operations.php?op=delete&id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- <select name="state" id="state1"> -->

  </select>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {

      $("#employee_data").DataTable({
        // paging: false,
        // paging: false,
        // scrollY: 400
        // searching: false,
        // ordering:  false
      });
    });
    // $.post("operations.php", {
    //   op: 'getState'
    // }, function(data, status) {
    //   console.log(data);
    //   var state = JSON.parse(data);
    //   var text = "<option value=''>-------------------</option>";
    //   let temp = state.map(item => `<option value=${item.state_set}>${item.state_set}</option>`)
    //   localStorage.setItem('state_data', JSON.stringify(state.map(item => item.state_set)))
      // console.log("temp", temp);
      // state.forEach(myFunction);

      // function myFunction(item) {
      //   console.log(item);
      //   text += `<option value=${item}</option>`
      //   // "<option value=" + item + "</option>";
      // }
    //   console.log("bbb", text);
    //   $("#state1").html([text, ...temp].join(""));
    // });

    // $("#state").change(function(){
    //   console.log($('#state :selected').val());
    //   $.post("operations.php",{op:$('#state :selected').val()},function(data, status){
    //     var district = JSON.parse(data);
    //     var text = "<option value=''>-------------------</option>";
    //     state.forEach(myFunction);

    //   function myFunction(item) {
    //     text +="<option value="+item.region_name+">"+item.region_name+"</option>"; 
    //   }
    //   $("#district").html(text);
    //   })
    // })
  </script>
</body>

</html>
<?php
pg_close($db);
?>