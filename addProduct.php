
<?php
include "header.php";
  if(isset($_POST['add'])){
    $flag = 0;
    $con = mysqli_connect("localhost", "root", "", "project");
    if(!$con){
      die("unable to connect");
    }
    $publisher = mysqli_real_escape_string($con, $_POST['publisher']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $isbn = mysqli_real_escape_string($con, $_POST['isbn']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $descrition = mysqli_real_escape_string($con, $_POST['description']);
    $file = $_FILES['image'];
    if(empty($_POST['title']) || empty($_POST['isbn']) || empty($_POST['price']) || empty($_POST['year']) || empty($_POST['description'])){
      $error = "All Fields are Reqired";
    }
    if(!isset($error)){
      if(!preg_match('/^[0-9]*$/',$_POST['isbn'])){
        $isbnerr = "Enter Valid ISBN";
        $flag = 1;
      }
      if(!preg_match('/^[0-9]{1,5}$/',$_POST['price'])){
        $priceerr = "Enter Valid Price";
        $falg = 1;
      }
      if(!preg_match('/^[0-9]{4}$/',$_POST['year'])){
        $yearerr = "Enter Valid year";
        $flag = 1;
      }
      if(empty($_FILES['image']['name'])){
        $fileerr = "please choose a file";
        $flag = 1;
      }
      if($flag == 0){
        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $fileerror  = $file['error'];
        $ext = explode(".",$filename);
        $fileext = end($ext);
        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileext, $allowed)){
          if($fileerror === 0){
            $filenamenew = uniqid('', true).".".$fileext;
            $desti = "images/".$filenamenew;
            if(move_uploaded_file($filetmpname, $desti)){
              $desti = mysqli_real_escape_string($con ,$desti);
            }
            else{
              $fileerr = "error while uploading file";
            }
          }
          else{
            $fileerr = "Error while Retriving file";
          }
        }
        else{
          $fileerr = "File type not allow, only jpeg and png allowed";
        }

        if(!isset($fileerr)){


          $sql = "insert into product(ProductId, PublisherId, AuthorId, Title, Isbn, Price, Year, Description, Image) values(null, $publisher, $author, '$title', '$isbn', $price, $year, '$descrition', '$desti')";
          if(mysqli_query($con, $sql)){
            echo "<script> alert(\"Product Added Suceesfully\"); </script>";
          }
          else{
            die($con->error);
          }
        }
      }
    }
  }
?>


<html>

  <head>
    <title> Admin|AddProduct </title>
    <style>
    </style>
    <script>
    </script>
  </head>

  <body>

    <div>
      <form method="post" action="addProduct.php" enctype="multipart/form-data">
      <h1> Add Product </h1>
      <br>
      Title<br>
      <input type="text" name="title" value="<?php if(isset($title)) echo $title; ?>"><br><br>

      ISBN<br>
      <input type="text" name="isbn" value="<?php if(isset($isbn)) echo $isbn; ?>">
      <span class="error"> <?php if(isset($isbnerr)) echo $isbnerr; ?> </span><br><br>

      Price<br>
      <input type="text" name="price" value="<?php if(isset($price)) echo $price; ?>">
      <span class="error"> <?php if(isset($priceerr)) echo $priceerr; ?> </span><br><br>

      Year published<br>
      <input type="text" name="year" value="<?php if(isset($year)) echo $year; ?>">
      <span class="error"> <?php if(isset($yearerr)) echo $yearerr; ?> </span><br><br>

      Publisher<br>
      <select name="publisher">
        <option value=''> ---Select Publisher--- </option>
        <?php
          $con = mysqli_connect("localhost", "root", "", "project");
          $sql = "select * from publisher";
          $res = mysqli_query($con, $sql);
          while($row = mysqli_fetch_assoc($res)){
            echo "<option value='$row[PublisherID]'> $row[Name] </option>";
          }
          mysqli_close($con);
        ?>
      </select> Cannot find your publisher? <a href="addPublisher.php">Click here</a><br><br>

      Author<br>
      <select name="author">
        <option value=''> ---Select Author--- </option>
        <?php
          $con = mysqli_connect("localhost", "root", "", "project");
          $sql = "select * from author";
          $res = mysqli_query($con, $sql);
          while($row = mysqli_fetch_assoc($res)){
            echo "<option value='$row[AuthorID]'> $row[Name] </option>";
          }
          mysqli_close($con);
        ?>
      </select> Cannot find your author? <a href="addAuthor.php">Click here</a><br><br>

      upload a Image<br>
      <input type="file" name="image">
      <span class="error"> <?php if(isset($fileerr)) echo $fileerr; ?> </span><br><br>

      Description<br>
      <textarea name="description" rows="10"  cols="30"></textarea><br><br>

      <span class="error"> <?php if(isset($error)) echo $error."<br><br>"; ?> </span>

      <input type="submit" name="add" value="Add Product">
    </form>
    </div>

  </body>

</html>
