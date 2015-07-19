<?

class create_user {

  private $first_name;
  private $last_name;
  private $username;
  private $password;
  private $email;
  private $db;

  public function __construct($first, $last, $user, $password, $email, $db) {
    $this->first_name = $first;
    $this->last_name = $last;
    $this->username = $user;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    $this->email = $email;
    $this->db = $db;

    if(!$this->check_username()) {
      $this->add_user();
    }
  }

  private function check_username() {
    $this->db->query("SELECT username FROM users WHERE username = :user");
    $this->db->bind(":user", $this->username);
    $this->db->execute();
    $exists = $this->db->rowCount();
    if ($exists > 0) {
      header('Location: signup_page.php?status=failed');
    } else {
      return false;
    }
  }

  private function add_user() {
    $this->db->query("INSERT INTO users (first_name, last_name, username,
      password, email, role) VALUES (:first, :last, :user, :pass,
        :email, :role)");
    $this->db->bind(':first', $this->first_name);
    $this->db->bind(':last', $this->last_name);
    $this->db->bind(':user', $this->username);
    $this->db->bind(':pass', $this->password);
    $this->db->bind(':email', $this->email);
    $this->db->bind(':role', '1');
    $this->db->execute();
    header('Location: login_page.php');
  }
}
