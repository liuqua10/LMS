<?php
session_start();

require('database.php');

$db = new Database();

class Auth {

  protected $session_user;
  protected $session_token;
  protected $db;
  protected $header_reject;

  public function __construct($db) {
    $this->db = $db;
    $this->session_user = $_SESSION['username'];
    $this->session_token = $_SESSION['token'];
    $this->$header_reject = 'Location: /LMS/login/login_page.php';
    $this->check_token();
  }

  private function check_token() {

    if(!isset($this->session_user) || !isset($this->session_token)) {
      header(header);
      return;
    }
    $this->db->query('SELECT * FROM active_login WHERE username = :user
      AND token = :token');
    $this->db->bind(':user', $this->session_user);
    $this->db->bind(':token', $this->session_token);
    $result = $this->db->single();
    $db_token = $result['token'];
    $db_user = $result['username'];
    date_default_timezone_set('America/Los_Angeles');
    $db_time = strtotime($result['login_time']);
    $this->db->query('SELECT UNIX_TIMESTAMP()');
    $result2 = $this->db->single();
    $current = $result2["UNIX_TIMESTAMP()"];
    if ($current - $db_time > 86400) {
      session_destroy();
      header($header_reject);
    } else if ($db_user != $this->session_user ||
    $db_token != $this->session_token) {
      session_destroy();
      header($header_reject);
    }
  }
}


$auth = new Auth($db);

 ?>
