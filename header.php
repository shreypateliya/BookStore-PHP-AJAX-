<?php
  session_start();
?>

<html>
  <head>
    <style>
      .header{
        background-color: lightGray;
      }
    </style>
  </head>
  <body class="header" alink="black" vlink="black"><center>
    <table>
      <tr>
        <td>
          <a href="index.php"> <img src="images/logo.png" height="30" width="90"> </a>
        </td>
        <td>
          <a href="authors.php">Authors</a>
        </td>
        <td>
          <a href="publishers.php">Publisher</a>
        </td>
        <td>
          <a href="search.php">Search</a>
        </td>
        <?php
        if(isset($_SESSION['type'])){
          if($_SESSION['type'] == "customer"){ ?>
            <td>
              <a href="cart.php">Your Cart</a>
            </td>
          <?php }
          else{ ?>
            <td>
              <a href="addProduct.php">Add Book</a>
            </td>
            <td>
              <a href="addAuthor.php"> Add Author </a>
            </td>
            <td>
              <a href="addPublisher.php"> Add Publisher </a>
            </td>
          <?php }
        }?>
        <?php
          if(isset($_SESSION['uname'])){ ?>
              <td>
                <a href="logout.php"> <button> Logout </button></a>
              </td>
          <?php }else{ ?>
              <td>
                <a href="login.php"> <button> Login </button></a>
                <a href="register.php"> <button> Signin </buton></a>
              </td>
          <?php }
        ?>
      </tr>
    </table></center>
  </body>
</html>
