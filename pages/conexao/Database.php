<?php

declare(strict_types=1);

namespace Database;

require_once __DIR__."../../vendor/autoload.php";

final class Database {
   private readonly PDO $connection;

   private function __construct(
      private readonly string $dsn,
      private readonly string $username,
      private readonly string $password
   ) {
      try {
         $this->connection = new PDO(
            $this->dsn,
            $this->username,
            $this->password,
            [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
               PDO::ATTR_EMULATE_PREPARES => false,
            ],
         );
      } catch (PDOException $erro) {
         throw new RuntimeException("Falha ao conectar ao banco");
      }
   }

   public function getConnection():PDO {
      return $this->connection;
   }
}