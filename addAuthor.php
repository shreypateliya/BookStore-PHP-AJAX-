<?php
  include "header.php";
  if(isset($_POST['add'])){
    if(!empty($_POST['nm']) && !empty($_POST['description'])){
      if(!preg_match("/^[a-zA-Z ]*$/", $_POST['nm'])){
        $err = "Name can only contain Alphabets.";
      }
      else{
        $con = mysqli_connect("localhost", "root", "", "project");
        if(!$con){
          die("unable to connect");
        }
        $nm = mysqli_real_escape_string($con, $_POST['nm']);
        $disc = mysqli_real_escape_string($con, $_POST['description']);
        $sql = "insert into author values(null, '$nm', '$disc')";
        if(mysqli_query($con, $sql)){
          echo "<script> alert(\"Author added\"); </script>";
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
    <title> Admin|Add Author </title>
  </head>
  <body>
    <form method="post">
      <div>
        <h1>Add Author</h1>
        <br>

        Name<br>
        <input type="text" name="nm" value="<?php if(isset($nm)) echo $nm; ?>"><br><br>
        <span class="error"> <?php if(isset($err)) echo $err; ?> </span>

        Description<br>
        <textarea name="description" rows="10" cols="30"></textarea><br><br>

        <input type="submit" name="add" value="Add Author">
      </div>
    </form>
  </body>
</html>
