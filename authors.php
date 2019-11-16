<?php
  include "header.php";
 ?>

<html>
  <head>
    <style>
      .link{
        text-decoration: none;
        font-size: 20px;
      }
    </style>
  </head>
  <body link="black">
    <center>
    <h1> Authors </h1>
    <hr>
    <?php
      $con = mysqli_connect("localhost", "root", "", "project");
      $sql = "select * from author";
      $res = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_assoc($res)){
        echo "<a href=\"authordetails.php?id=$row[AuthorID]\" class=\"link\"> $row[Name] </a><br><br>";
      }

    ?>
  </center>
  </body>
</html>
