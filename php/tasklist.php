<?php
    require('db.php');
    require('fetching_tasklist.php');
    $sql = "SELECT Username, Password, Email FROM Users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "USERNAME: " . $row["Username"]. " - PASSWORD: " . $row["Password"]. " - EMAIL" . $row["Email"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();

?>