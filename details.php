<?php
include "header.php";
  $id = $_GET['id'];
  $con = mysqli_connect("localhost", "root", "", "project");
  $sql = "select * from product where ProductId='$id'";
  $res = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($res);
  $title = $row['Title'];
  $isbn = $row['Isbn'];
  $author_id = $row['AuthorId'];
  $publisher_id = $row['PublisherId'];
  $year = $row['Year'];
  $image = $row['Image'];
  $price = $row['Price'];
  $descrition = $row['Description'];
  $sql = "select * from author where AuthorID='$author_id'";
  $res = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($res);
  $author = $row['Name'];

  $sql = "select * from publisher where PublisherID='$publisher_id'";
  $res = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($res);
  $publisher = $row['Name'];

  if(isset($_POST['add'])){
    $qty = $_POST['qty'];
    header("Location: addToCart.php?id=$id&qty=$qty");
  }
?>

<html>
  <head>
  </head>
  <body>
      <center>
      <div>
        <table>
          <tr>
            <td>
              <h2><?php echo "$title"; ?></h2>
              <h3> ISBN: <?php echo $isbn; ?> </h3>
              <h3> Author: <?php echo "$author"; ?> </h3>
              <h3> Publisher: <?php echo $publisher; ?> </h3>
              <h3> Year of Publication: <?php echo "$year"; ?> </h3>
            </td>
            <td>
              <img src="<?php echo $image; ?>" height=300 width=200>
            </td>
          </tr>
        </table><br><br>
        <table><tr><td>
          <Strong> Price: <?php echo $price; ?>$ </Strong></td>
          <form method="post">
          <td> Quantity: <input type="text" name="qty" value="1" size="4">
          <input type="submit" name="add" value="Add to Cart">
        </td>
      </form>
        </tr></table><br><br>
        <span class="error">
          <?php
          if(isset($_SESSION['error'])) echo $_SESSION['error'];
          $_SESSION['error'] = "";
          ?>
        </span>

        <div>Description: <?php echo $descrition; ?></div>
      </div>
    </center>
  </body>
</html>
