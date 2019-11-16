<?php
  include "header.php";
  $con = mysqli_connect("localhost", "root", "", "project");
  if(isset($_POST['search'])){
    $ser_str = mysqli_real_escape_string($con, $_POST['Search_String']);
    $sql = "select * from product where Title like '%$ser_str%'";
    $res = mysqli_query($con, $sql);


  }
?>


<html>
  <head>
    <style>
    .text{
      font-size: 20px;
    }
    .btn{
      font-size: 20px;
    }
    </style>
  </head>
  <body>
    <center>
      <div class="search_bar">
        <form method="post">
          <input type="text" name="Search_String" placeholder="search">
          <input type="submit" name="search" value="Search">
        </form>
      </div><br><br>
      <div class="search_result">
        <h2> <?php if(isset($ser_str)) echo "Showing Result For: ".$ser_str; ?> </h1>
        <table border=1>
        <?php
          if(isset($res)){
            while($row = mysqli_fetch_assoc($res)){
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
        ?>
      </table>
      </div>
    </center>
  </body>
</html>
