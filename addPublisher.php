<?php
include "header.php";
  if(isset($_POST['add'])){
    if(!empty($_POST['nm']) && !empty($_POST['country'])){
      if(!preg_match("/^[a-zA-Z ]*$/", $_POST['nm'])){
        $err = "Name can only contain Alphabets.";
      }
      else{
        $con = mysqli_connect("localhost", "root", "", "project");
        if(!$con){
          die("unable to connect");
        }
        $nm = mysqli_real_escape_string($con, $_POST['nm']);
        $country = mysqli_real_escape_string($con, $_POST['country']);
        $sql = "insert into publisher values(null, '$nm', '$country')";
        if(mysqli_query($con, $sql)){
          echo "<script> alert(\"Publisher added\"); </script>";
        }
        else{
          die("unable to run query ". $con->error);
        }
      }
    }
  }
?>


<html>
  <head>
    <title> Admin|Add Publisher </title>
  </head>
  <body>
    <form method="post">
      <div>
        <h1>Add Publisher</h1>
        <br>

        Name<br>
        <input type="text" name="nm" value="<?php if(isset($nm)) echo $nm; ?>"><br><br>

        Country<br>
        <input type="text" name="country" value="<?php if(isset($country)) echo $country; ?>"><br><br>

        <input type="submit" name="add" value="Add Publisher">
      </div>
    </form>
  </body>
</html>
