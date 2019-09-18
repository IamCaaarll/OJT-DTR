<?php
  if ($_SESSION["session_page"] === "1") {
    header("Location: admin.php");
    exit();
  }
?>
