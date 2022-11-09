<?php
class RegisterService
{
  public function __construct()
  {
    require "connection.php";
    $this->conn = $conn;
  }

  private function existeVaga($quartoId)
  {
    $sql = "SELECT * FROM alunos WHERE quartoId = :quartoId
    inner join quartos on quartos.id = alunos.quartoId";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":quartoId", $quartoId);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $vagas = $result[0]['leitos'];
    $alunos = count($result);
    if ($alunos < $vagas) {
      return true;
    }
    return false;
  }

  private function leitoEstaOcupado($leito)
  {
    $sql = "SELECT * FROM alunos WHERE leito = :leito";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":leito", $leito);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
      return true;
    }
    return false;
  }

  public function execute($name, $leitoOcupado, $blocoId, $quartoId)
  {
    if (!$this->existeVaga($quartoId)) {
      http_response_code(409);
      return array("status" => false, "message" => "Não existe vaga no quarto");
    }

    if ($this->leitoEstaOcupado($leitoOcupado)) {
      http_response_code(409);
      return array("status" => false, "message" => "Leito já está ocupado");
    }

    $sql = "INSERT INTO alunos (name, leito, blocoId, quartoId) VALUES (:name, :leitoOcupado, :blocoId, :quartoId)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":leitoOcupado", $leitoOcupado);
    $stmt->bindParam(":blocoId", $blocoId);
    $stmt->bindParam(":quartoId", $quartoId);
    $stmt->execute();

    return array("status" => true, "message" => "Aluno cadastrado com sucesso");
  }
}
