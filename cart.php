<?php
  include "header.php";
  if(!isset($_SESSION['uname'])){
    //header("Location: login.php");
  }
?>

<html>
  <head>
  </head>
  <body>
    <div>
      <strong><big> Heres Your Cart <?php //echo $_SESSION['uname']; ?></big></strong>
      <a href="clearCart.php"> <button name="clear"> Clear Cart </button></a>
      <a href="checkOut.php"> <button name="out"> Proceed to Checkout </button></a>
      <hr><center>
      <table>
      <?php
        if(!empty($_SESSION['cart'])){
          $con = mysqli_connect("localhost", "root", "", "project");
          foreach ($_SESSION['cart'] as $c) {
            foreach ($c as $key => $value) {
              if($key == 'id'){
                $sql = "select * from Product where ProductId='$value'";
                $res = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($res);
                $id = $row['ProductId'];
                $title = $row['Title'];
                $price = $row['Price'];
                $image = $row['Image'];
                $isbn = $row['Isbn'];
                echo "<tr> <td> <a href=\"details.php?id=$id\"><img src=\"$image\"  height=280 width=160> </a></td>";
                echo "<td><h3>$title</h3>";
                echo "<h4>ISBN: $isbn</h4>";
                echo "<h4> Price: $price$ </h4> </td></tr>";
              }
            }
          }
        }else{
          echo "<strong> start Shoping </strong>";
        }
      ?>
    </table></center>
    </div>
  </body>
</html>
