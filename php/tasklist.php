<?php
require('class/UsersDao.php');
// require('fetching_tasklist.php');

$user = new Users();

// 获取用户数据
$result = $user->getAllUsers();

if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo "USERNAME: " . $row["Username"]. " - PASSWORD: " . $row["Password"]. " - EMAIL: " . $row["Email"]. "<br>";
    }
} else {
    echo "0 results";
}

// 关闭连接
$user->closeConnection();
?>
