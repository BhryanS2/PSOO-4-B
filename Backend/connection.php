<?php
$server = "localhost";
$user = "root";
$password = "";
$dbName = "PSOO_alojamento";

$conn = new PDO("mysql:host=$server;dbname=$dbName", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

class Database
{
  public PDO $conn;
  private function serverIsLocalhost()
  {
    return $_SERVER['SERVER_NAME'] === 'localhost';
  }
  public function __construct(
    string $server = "localhost",
    string $user = "root",
    string $password = "",
    string $dbName = "PSOO_alojamento"
  ) {
    if (!$this->serverIsLocalhost()) {
      $server = "sql204.epizy.com";
      $user = "epiz_33012967";
      $password = "jfpTccmh79nO9";
      $dbName = "epiz_33012967_alojamento";
    }
    $this->conn = new PDO("mysql:host=$server;dbname=$dbName", $user, $password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }

  public function query(string $query, array $params = array()): PDOStatement | false
  {
    $stmt = $this->conn->prepare($query);
    $stmt->execute($params);
    return $stmt;
  }

  public function select(string $query, array $params = array()): array
  {
    $stmt = $this->query($query, $params);
    return $stmt->fetchAll();
  }

  public function selectOne(string $query, array $params = array()): array
  {
    $stmt = $this->query($query, $params);
    return $stmt->fetch();
  }

  public function insert(string $query, array $params = array()): bool | int
  {
    $stmt = $this->query($query, $params);
    if ($stmt->rowCount() > 0) {
      return $this->conn->lastInsertId();
    }
    return false;
  }

  public function update(string $query, array $params = array()): bool
  {
    $stmt = $this->query($query, $params);
    if ($stmt->rowCount() > 0) {
      return true;
    }
    return false;
  }

  public function delete(string $query, array $params = array()): bool
  {
    $stmt = $this->query($query, $params);
    if ($stmt->rowCount() > 0) {
      return true;
    }
    return false;
  }

  public function closeConnection(): void
  {
    $this->conn = null;
  }

  public function getErrorInfo(): array
  {
    return $this->conn->errorInfo();
  }

  public function getErrorCode(): string
  {
    return $this->conn->errorCode();
  }
}
