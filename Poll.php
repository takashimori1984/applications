<?php

namespace MyApp;

class Poll {
  private $_db;

  public function __construct() {
    $this->_connectDB();
    $this->_createToken();
  }

  private function _createToken() {
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
  }

  private function _validateToken() {
    if (
      !isset($_SESSION['token']) ||
      !isset($_POST['token']) ||
      $_SESSION['token'] !== $_POST['token']
    ) {
      throw new \Exception('invalid token!');
    }
  }

  public function post() {
    try {
      $this->_validateToken();
      $this->_validateAnswer();
      $this->_save();
      // redirect to result.php
      header('Location: http://' . $_SERVER['HTTP_HOST'] . '/result.php');
    } catch (\Exception $e) {
      // set error
      $_SESSION['err'] = $e->getMessage();
      // redirect to index.php
      header('Location: http://' . $_SERVER['HTTP_HOST']);
    }
    exit;
  }
  
  public function getResults() {
    $data = array_fill(0, 3, 0);

    $sql = "select count(id) as c from poll_results";

    foreach ($this->_db->query($sql) as $row) {
      $data[$row['answer']] = (int)$row['c'];
    }
    return $data;
  }

  public function getError() {
    $err = null;
    if (isset($_SESSION['err'])) {
      $err = $_SESSION['err'];
      unset($_SESSION['err']);
    }
    return $err;
  }

  private function _validateAnswer() {
    // var_dump($_POST);
    // exit;
    if (
      !isset($_POST['answer']) ||
      !in_array($_POST['answer'], [0, 1, 2])
    ) {
      throw new \Exception('invalid answer!');
    }
  }

  private function _save() {
    $sql = "insert into answers
            (answer, created, remote_addr, user_agent, answer_date)
            values (:answer, now(), :remote_addr, :user_agent, now())";
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':answer', (int)$_POST['answer'], \PDO::PARAM_INT);
    $stmt->bindValue(':remote_addr', $_SERVER['REMOTE_ADDR'], \PDO::PARAM_STR);
    $stmt->bindValue(':user_agent', $_SERVER['HTTP_USER_AGENT'], \PDO::PARAM_STR);

    try {
      $stmt->execute();
    } catch (\PDOException $e) {
      throw new \Exception('投票は1回限りです');
    }
    // exit;
  }
  
  private function _connectDB() {
    try {
      $host = getenv(HOST_NAME);
      $dbname = getenv(DB_NAME);
      $charset = "utf8mb4";
      $password = getenv(PASSWORD);
      $user = getenv(USER_NAME);
      $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
      $this->_db = new PDO($dsn, $user, $password);
      
      // $this->_db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      throw new \Exception('Failed to connect DB');
    }
  }
}