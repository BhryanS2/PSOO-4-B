<?php
class Response
{
  private $status = false;
  private $message = "Get all users failed";
  private array | null $sqlerror = null;
  private array | null $data = null;

  public function __construct(bool $status, string $message, array $data = null,  array $sqlerror = null)
  {
    $this->status = $status;
    $this->message = $message;
    if (!is_null($data)) {
      $this->data = $data;
    }
    if (!is_null($sqlerror)) {
      $this->sqlerror = $sqlerror;
    }
  }

  public function __toString()
  {
    return json_encode($this);
  }

  public function __invoke()
  {
    return json_encode($this);
  }

  public function __debugInfo()
  {
    return array(
      "status" => $this->status,
      "message" => $this->message,
      "sqlerror" => $this->sqlerror,
      "data" => $this->data
    );
  }

  public function __set($name, $value)
  {
    $this->$name = $value;
  }

  public function __get($name)
  {
    return $this->$name;
  }

  public function __isset($name)
  {
    return isset($this->$name);
  }

  public function __unset($name)
  {
    unset($this->$name);
  }

  public function __sleep()
  {
    return array(
      "status",
      "message",
      "sqlerror",
      "data"
    );
  }

  public function setSqlError(array $sqlerror)
  {
    $this->sqlerror = $sqlerror;
  }

  public function getSqlError()
  {
    return $this->sqlerror;
  }

  public function setAll(bool $status, string $message, array $data = null,  array $sqlerror = null)
  {
    $this->status = $status;
    $this->message = $message;
    $this->data = $data;
    $this->sqlerror = $sqlerror;
  }

  public function setStatus(bool $status)
  {
    $this->status = $status;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setMessage(string $message)
  {
    $this->message = $message;
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function setData(array $data)
  {
    $this->data = $data;
  }

  public function getData()
  {
    return $this->data;
  }

  public function __destruct()
  {
    unset($this->status);
    unset($this->message);
    unset($this->sqlerror);
    unset($this->data);
  }

  public function getResponse()
  {
    $response = array(
      "status" => $this->status,
      "message" => $this->message,
      "sqlerror" => $this->sqlerror,
      "data" => $this->data
    );
    $filtered_array_is_not_null = array_filter($response, function ($value) {
      return !is_null($value);
    });
    return $filtered_array_is_not_null;
  }
}
