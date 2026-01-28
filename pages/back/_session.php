<?php
   if(!isset($_SESSION)) {
      session_start();
   }

   require_once(__DIR__."/config.php");

   if(!isset($_SESSION['usuario'])) {
      header("location".BASE_URL);
      exit();
   }
?> 