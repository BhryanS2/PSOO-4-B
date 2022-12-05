<?php
class RegisterService
{
  private Database $conn;
  private Response $response;

  public function __construct()
  {
    require "connection.php";
    require "utils/responsePattern.php";
    $this->conn = new Database();
    $this->response = new Response(false, "Register aluno failed");
  }

  private function existeVaga($quartoId)
  {
    $sql = "SELECT * FROM alunos 
      inner join quartos on alunos.quartoId = quartos.id
      where quartos.id = :quartoId
    ";
    $params = array(
      ":quartoId" => $quartoId
    );
    $result = $this->conn->select($sql, $params);

    if (count($result) < 1) {
      return true;
    }

    $vagas = $result[0]["leitos"];
    $alunos = count($result);

    if ($alunos < $vagas) {
      return true;
    }
    return false;
  }

  private function leitoEstaOcupado($leito, $quartoId)
  {
    $sql = "SELECT * FROM alunos 
      inner join quartos on alunos.quartoId = quartos.id
      where quartos.id = :quartoId and alunos.leito = :leito
    ";
    $params = array(
      ":quartoId" => $quartoId,
      ":leito" => $leito
    );
    $result = $this->conn->select($sql, $params);
    $tem_vaga = count($result) < 1;
    return !$tem_vaga;
  }

  private function leitoValido($leito, $quartoId)
  {
    $sql = "SELECT * FROM quartos where id = :quartoId";
    $params = array(
      ":quartoId" => $quartoId
    );
    $result = $this->conn->select($sql, $params);
    $leitos = $result[0]["leitos"];
    return $leito <= $leitos;
  }

  public function execute($name, $leitoOcupado, $blocoId, $quartoId)
  {

    if (!$this->existeVaga($quartoId)) {
      http_response_code(409);
      $this->response->setAll(false, "Não existe vaga no quarto");
      return $this->response->getResponse();
    }

    if ($this->leitoEstaOcupado($leitoOcupado, $quartoId)) {
      http_response_code(409);
      $this->response->setAll(false, "Leito já está ocupado");
      return $this->response->getResponse();
    }

    if (!$this->leitoValido($leitoOcupado, $quartoId)) {
      http_response_code(400);
      $this->response->setAll(false, "Leito inválido");
      return $this->response->getResponse();
    }

    $sql = "INSERT INTO alunos (name, leito, blocoId, quartoId) VALUES (:name, :leitoOcupado, :blocoId, :quartoId)";
    $params = array(
      ":name" => $name,
      ":leitoOcupado" => $leitoOcupado,
      ":blocoId" => $blocoId,
      ":quartoId" => $quartoId
    );
    $result = $this->conn->insert($sql, $params);

    $this->response->setSqlError($this->conn->getErrorInfo());

    if ($result) {
      $this->response->setAll(true, "Register aluno success");
    }

    return $this->response->getResponse();
  }
}
