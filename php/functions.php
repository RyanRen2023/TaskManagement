<!-- fetching tasks -->
<?php
function getTasks($conn) {
  $sql = "SELECT * FROM tasks";
  $result = $conn->query($sql);
  $tasks = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $tasks[] = $row;
    }
  }

  return $tasks;
}
?>

