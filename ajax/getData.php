<?php
  //echo "<option value=''>---Select State---</option>";
  $data = $_GET['data'];
  $name = $_GET['name'];
  if($name == "country"){
    $table = "states";
    $ref = "country_id";
    echo "<option value=''> ---Select State--- </option>";
  }
  else {
    $table = "cities";
    $ref = "state_id";
    echo "<option value=''> ---Select City--- </option>";
  }
  $con = mysqli_connect("localhost", "root", "" , "misc") or die("unable to connect");
  $sql = "select * from $table where $ref='$data'";
  $res = mysqli_query($con, $sql);

  while($row = mysqli_fetch_assoc($res)){
    echo "<option value='$row[id]'> $row[name] </option>";
  }
?>
