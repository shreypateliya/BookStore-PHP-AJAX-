<?php
include "header.php";
  $id = $_GET['id'];
?>
<html>
  <body>
    <center>
    <?php
      $con = mysqli_connect("localhost", "root", "", "project");
      $sql = "select * from author where AuthorId='$id'";
      $res = mysqli_query($con, $sql);
      $row = mysqli_fetch_assoc($res);
      echo "<h1> $row[Name] </h1><hr>";
      echo "<h4> $row[Description] </h4>";
      echo "Books:<br> ";
      $sql = "select * from product where AuthorId='$id'";
      $res = mysqli_query($con, $sql);
      while($row = mysqli_fetch_assoc($res)){
        echo "<a href=\"details.php?id=$row[ProductId]\"> $row[Title] </a><br>";
      }
    ?>
  </center>
  </body>
</html>
