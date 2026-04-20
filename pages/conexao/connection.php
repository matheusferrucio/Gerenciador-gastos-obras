<?php

$dsn = "mysql:host=localhost;dbname=mkengenharia;charset=utf8";
$user = "root";
$pass = "";

try {
   $conn = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
   ]);
} catch (PDOException $erro) {
   echo "Não foi possível conectar-se ao banco";
   exit();
}