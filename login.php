<?php
include "header.php";
  $con = mysqli_connect("localhost", "root", "", "project") or die("Unable to connect");
  if (isset($_POST['login'])) {
    if(empty($_POST['mail']) || empty($_POST['pass'])){
      $err = "*All Fields are Required <br>";
    }
    else{
      $mail = mysqli_real_escape_string($con, $_POST['mail']);
      $pass = mysqli_real_escape_string($con, $_POST['pass']);
      $sql = "select * from login where Email='$mail' and Password='$pass'";
      $res = mysqli_query($con, $sql);
      $row = mysqli_fetch_assoc($res);
      if(isset($row)){
        session_start();
        $_SESSION['type'] = $row['Type'];
        $sql = "select * from customer where CustomerId='$row[CustomerId]'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);
        $_SESSION['uname'] = $row['Name'];
        $_SESSION['id'] = $row['CustomerId'];
        header("Location: index.php");
      }
      else{
        $err = "Invalid Email Or Password<br>";
      }
    }
  }
  mysqli_close($con);
?>

<html>
  <head>
    <title> BookStore|Login </title>
    <style>
      .main{
        border:1px solid black;
        width: 250px;
        margin: 50px auto;
      }
    </style>
  </head>
  <body>
    <form method="post">
    <div class="main"><center>
      <h1>Login</h1>
      <br>
      Email<br>
      <input type="text" name="mail" value="<?php if(isset($mail)) echo $mail; ?>"><br><br>

      Password<br>
      <input type="password" name="pass"><br><br>

      <span class="error"> <?php if(isset($err)) echo $err; ?> </span>

      <input type="submit" name="login" Value="Login">
    </center></div>
   </form>
  </body>
</html>
