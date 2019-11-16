<?php
include "header.php";
  $id = $_GET['id'];
  $qty = $_GET['qty'];

  session_start();
  $flag = 0;
  if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $c){
      foreach ($c as $key => $value) {
        if($key == 'id'){
          if($value == $id){
            $flag = 1;
          }
        }
      }
    }
    if($flag == 0){
      $_SESSION['cart'][] = array('id' => $id, 'qty' => $qty);
      $_SESSION['error'] = "";
    }
    else{
      $_SESSION['error'] = "product already in cart";
    }
  }
  else{
    $_SESSION['cart'] = array();
    $_SESSION['cart'][] = array('id' => $id, 'qty' => $qty);
  }

  header("Location: details.php?id=$id");

?>
