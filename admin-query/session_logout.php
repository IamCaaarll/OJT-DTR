<?php
  function logoutFunction()
  {
    session_start();
    /*Removing data in SESSION*/
    unset($_SESSION['u_ID']);
    unset($_SESSION['session_page']);
    session_destroy();
    header("Location: ../index.php");
    exit();
  }
  return logoutFunction();
?>
