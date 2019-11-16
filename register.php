<?php
include "header.php";
  $flag = 0;
  if (isset($_POST['reg'])) {
    $con = mysqli_connect("localhost", "root", "", "project");
    $nm = mysqli_real_escape_string($con, $_POST['nm']);
    $mail = mysqli_real_escape_string($con, $_POST['mail']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $conpass = mysqli_real_escape_string($con, $_POST['conpass']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $add = mysqli_real_escape_string($con, $_POST['add']);
    $country = mysqli_real_escape_string($con, $_POST['country']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    if(!$_POST['terms'] == 'aggree'){
      $termerr = "*You Must Agree to the Terms and conditions.";
    }
    else{
      if(empty($_POST['nm']) || empty($_POST['mail']) || empty($_POST['pass']) || empty($_POST['conpass']) || empty($_POST['contact']) || empty($_POST['add']) || $_POST['country'] == "" || $_POST['state'] == "" || $_POST['city'] == ""){
        $error = "All Fields are Required";
      }
      else{
        if(!preg_match("/^[A-Z][A-Za-z ]*$/",$_POST['nm'])){
          $nameerr = "name cannot contain number and must begin with uppercase character";
          $flag = 1;
        }
        if(!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
          $mailerr = "Enter Valid Email Id";
          $flag = 1;
        }
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])[a-zA-Z0-9!@#\$%\^&\*]{8,}$/",$_POST['pass'])){
          $passerr = "Password must contain atleast 1 lowercase, 1 uppercase, 1 number, 1 special character and must be atleast 8 characters long";
          $flag = 1;
        }
        if(!($pass === $conpass)){
          $conpasserr = "Confirm password do not match";
          $flag = 1;
        }
        if(!preg_match("/^[0-9]{10}$/", $_POST['contact'])){
          $contacterr = "Enter valid contact number";
          $flag = 1;
        }
        if($flag == 0){
          $sql = "insert into customer(CustomerId, Name, Email, Contact, Gender, Address, Country, State, City) values(null, '$nm', '$mail', $contact, '$gender', '$address', '$country', '$state', '$city')";
          if(mysqli_query($con, $sql)){
            $sql = "Select * from customer where Email='$mail'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($res);
            $cusid = $row['CustomerId'];
            $sql = "insert into login values('$cusid', '$mail', '$pass', 'customer')";
            if(mysqli_query($con, $sql)){
              header("Location: login.php");
            }else {
              die("Cannot Register:". $con->error);
            }
          }
          else{
            die("Cannot Register: ". $con->error);
          }
        }
      }
    }
  }
?>

<html>
  <head>
    <title> BookStore|registration </title>
    <style>
    </style>
    <script>
      function getState(data, name){
        if(name == "country"){
          var id = "state";
        }
        else{
          var id = "city";
        }
        var req = new XMLHttpRequest();
        req.onreadystatechange = function(){
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById(id).innerHTML = req.responseText;
          }
        };
        req.open("get","ajax/getData.php?data=" + data +"&name=" + name,true);
        req.send();
      }

    </script>
  </head>
  <body>
    <form method="post">
    <div><center>
      <h1>Register</h1>
      <br>
      Name<br>
      <input type="text" name="nm" value="<?php if(isset($nm)) echo $nm; ?>"><br>
      <span class="error"><?php if(isset($nameerr)) echo $nameerr."<br>"; ?></span><br>

      Email<br>
      <input type="text" name="mail" value="<?php if(isset($mail)) echo $mail; ?>"><br>
      <span class="error"><?php if(isset($mailerr)) echo $mailerr."<br>"; ?></span><br>

      Password<br>
      <input type="text" name="pass" value="<?php if(isset($pass)) echo $pass; ?>"><br>
      <span class="error"><?php if(isset($passerr)) echo $passerr."<br>"; ?></span><br>

      Confirm Password<br>
      <input type="text" name="conpass" value="<?php if(isset($conpass)) echo $conpass; ?>"><br>
      <span class="error"><?php if(isset($conpasserr)) echo $conpasserr."<br>"; ?></span><br>

      Contact<br>
      <input type="text" name="contact" value="<?php if(isset($contact)) echo $contact; ?>"><br>
      <span class="error"><?php if(isset($contacterr)) echo $contacterr."<br>"; ?></span><br>

      Gender<br>
      <input type="radio" name="gender" value="male" checked> Male
      <input type="radio" name="gender" value="Female"> Female
      <input type="radio" name="gender" value="Other"> Other<br><br>

      Address<br>
      <textarea name="add" rows="9" cols="30"> </textarea><br><br>

      Country<br>
      <select name="country" onchange="getState(this.value,this.name)">
        <option value=""> ---Select Country--- </option>
        <?php
          $acon = mysqli_connect("localhost","root","","misc") or die("Cannor connect");
          $sql = "select * from countries";
          $res = mysqli_query($acon, $sql);
          while($row = mysqli_fetch_assoc($res)){
            echo "<option value='$row[id]'> $row[name] </option>";
          }
          mysqli_close($acon);
        ?>
      </select><br><br>

      State<br>
      <select name="state" id="state" onchange="getState(this.value,this.name)">
        <option value=""> ---Select State--- </option>
      </select><br><br>

      City<br>
      <select name="city" id="city">
        <option value=""> ---Select Name---</option>
      </select><br><br>

      <input type="checkbox" name="terms" value="aggree"> I here by agree to all the terms and condition<br>
      <span class="error"><?php if(isset($termerr)) echo $termerr."<br>"; ?></span><br>
      <span class="error"><?php if(isset($error)) echo $error."<br>"; ?></span><br>

      <input type="submit" name="reg" value="Register">


    </center></div>
   </form>
  </body>
</html>
