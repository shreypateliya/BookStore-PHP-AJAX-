<?php include "header.php"; ?>

<html>
  <head>
  </head>
  <body>
    <br>
    <div><center>
      <table border=1><tr>
      <?php
      $counter = 0;
        $con = mysqli_connect("localhost", "root", "", "project");
        if(!$con){
          die("Unable to connect");
        }
        $sql = "select * from product";
        $res = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($res)){
          $id = $row['ProductId'];
          $title = $row['Title'];
          $price = $row['Price'];
          $image = $row['Image'];
          echo "<td>";
          echo "<div><center><h3>$title</h3>";
          echo "<a href=\"details.php?id=$id\">";
          echo "<img height=280 width=160 src=\"$image\"></a>";
          echo "<h4>Price: $price$</h4>";
          echo "</div>";
          echo "</td>";
          $counter += 1;
          if($counter === 4){
            echo "</tr><tr>";
            $counter = 0;
          }
        }
      ?>
      </tr>
    </table>
  </center>
    </div>
  </body>
</html>
