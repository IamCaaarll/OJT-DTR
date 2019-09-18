<?php
session_start();
if (!isset($_SESSION["session_page"]) && !isset($_SESSION["u_ID"])) {
  header("Location: index.php");
  exit();
}
 ?>
