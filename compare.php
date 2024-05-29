<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>check</title>
</head>

<body>

<meta charset="utf-8">
	
<?php
error_reporting(E_ALL & ~E_NOTICE); // 添加屏蔽Notice语句

//创建连接
$conn = new mysqli('127.0.0.1','root','liu12345','csv_db');
//检测连接
if($conn->connect_error){
    die('连接失败：'.$conn->connect_error);
}
mysqli_set_charset($conn, "utf8"); // 添加强制使用UTF-8编码语句
	
 $username = $_POST["username"];
 $password = $_POST["password"];
 $query = "SELECT salt, password, realname, role FROM `t_user` WHERE username = '$username'";
 $result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $salt = $row["salt"];
    $hash_password = $password.$salt;
    $hashed_password_1=hash('sha256', $hash_password);
    $hashed_password= strtoupper($hashed_password_1);


    // 检查哈希值是否匹配
    if ($row["password"] == $hashed_password) {
        // 密码匹配
        $realname = $row["realname"];
        $role = $row["role"];
		echo $row["password"];
        // 将真实姓名和角色存储到 $_SESSION 变量中
        session_start();
        $_SESSION['realname'] = $realname;
        $_SESSION['role'] = $role;
		
        // 跳转到欢迎页面
        header('Location: welcome.php');
        exit (1);
    } else {
        // 密码不匹配
        echo "密码错误";
    }
} else {
    // 用户不存在
    echo "该用户不存在，请联系管理员注册";
}

mysqli_close($conn);
	   
?>
</body>
</html>

