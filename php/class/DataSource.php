<!-- db.php -->
<?php
class DataSource
{
  private $conn;

  function __construct()
  {
    $servername = "localhost"; // or your server name
    $username = "task_user";
    $password = "task_password";
    $dbname = "task_management_db";
    // Create connection
    $this->conn = new mysqli($servername, $username, $password, $dbname);

    // 检查连接是否成功
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  function getConnection()
  {
    return $this->conn;
  }

  function closeConnection()
  {
    $this->conn->close();
  }

  function query($sql)
  {
    return $this->conn->query($sql);
  }
}

?>