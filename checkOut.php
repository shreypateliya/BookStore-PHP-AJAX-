<?php
  include "header.php";
  $con = mysqli_connect("localhost", "root", "", "project");
  if(isset($_POST['submit'])){
    foreach ($_SESSION['cart'] as $c) {
      $sql = "insert into ordertbl values(null, $c[id], $_SESSION[id], $c[qty])";
      if(mysqli_query($con, $sql)){
        echo "<script>alert(\"order places sucessfully\");</script>";
        header("Location: clearCart.php");
      }
      else{
        die($con->error);
      }
    }
  }
?>

<html>
  <body>
    <center>
      <h1>Checkout</h1>
      <hr>
      <table style="text-align: center;">
        <tr>
          <td>Title</td>
          <td>Quantity</td>
          <td>Price</td>
          <td>Total</td>
        </tr>

        <?php
        if(isset($_SESSION['cart'])){
          foreach ($_SESSION['cart'] as $c) {

              $sql = "select * from product where ProductId='$c[id]'";
              $res = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($res);
              echo "<tr><td>$row[Title]</td><td>$c[qty]</td>";
              echo "<td>$row[Price]</td><td>". ($c['qty']*$row["Price"]) ."</td></tr>";
            }

        }
        ?>
      </table><br><br>
      <form method="post">
        <input type="submit" name="submit" value="Confirm">
      </form>
    </center>
  </body>
</html>
