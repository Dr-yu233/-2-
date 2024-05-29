<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>欢迎！</title>
    <!-- 引入字体图标 -->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="navbar">
        <input type="checkbox" id="checkbox">
        <label for="checkbox">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </label>
        <ul>
            <li>
                <img src="login.jpg" alt="">
                <span>欢迎您！<?php
                    error_reporting(E_ALL & ~E_NOTICE);
		error_reporting(E_ALL & ~E_WARNING);
                    session_start(); 
                    //mysqli_set_charset($conn, "utf8");
                    if (isset($_SESSION['realname'])) {
                        $realname = $_SESSION['realname'];
                        $role=$_SESSION['role'];
                        echo  $realname;
                    } else {
                        echo "请先登录";
                    }
                ?></span>
            </li>
            <li>
                <a href="welcome.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>后台首页</span>
                </a>
            </li>
            <li>
                <a href="Department_management.php">
                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                    <span>部门管理</span>
                </a>
            </li>
            <li>
                <a href="user_management.php">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <span>用户管理</span>
                </a>
            </li>
            <li>
                <a href="Document_mine.php">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <span>公文处理</span>
                </a>
            </li>
            <li>
                <a href="index.php">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <span>退出登录</span>
                </a>
            </li>
        </ul>
        <div class="main">
            <?php
                error_reporting(E_ALL & ~E_NOTICE);
                session_start();
                if (isset($_SESSION['role'])) {
                    $role = $_SESSION['role'];
                    if ($role !== "管理员") {
                        // 如果不是管理员，重定向到另一个网页
                        header("Location: lose.html");
                        exit();
                    }
                } else {
                    // 如果未设置角色，也重定向到另一个网页
                    header("Location: lose.php");
                    exit();
                }
            ?>
            
            <?php
                //创建连接
                $conn = new mysqli('127.0.0.1','root','liu12345','csv_db');

                //检测连接
                if($conn->connect_error){
                    die('连接失败：'.$conn->connect_error);
                }
		mysqli_set_charset($conn, "utf8");
                // 查询数据
                $sql = "SELECT * FROM `t_user` ";
                $result = $conn->query($sql);

                // 显示数据
                if ($result->num_rows > 0) {
                    echo "<table><tr><th>realname&nbsp&nbsp</th><th>role&nbsp&nbsp</th><th>username&nbsp&nbsp</th><th>password&nbsp&nbsp</th></tr>";
                    // 输出每行数据
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["realname"]."</td><td>".$row["role"]."</td><td>".$row["username"]."</td><td>".$row["password"]."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 结果";
                }

                // 关闭连接
                $conn->close();
            ?>
            
            <?php
                error_reporting(E_ALL & ~E_NOTICE);
                //处理表单提交
                if(isset($_POST['submit'])) { //检查是否有submit参数传递
                    //获取表单数据
                    $username = $_POST['username'];
                    $password=$_POST['password'];
                    $realname=$_POST['realname'];
                    $role = $_POST['role'];
                    $salt=bin2hex(random_bytes(16));//随机生成16字节的盐值
                    $hashedPassword = sha1($password . $salt); 
                    //插入数据到数据库
                    $conn = mysqli_connect("127.0.0.1", "root", "liu12345", "csv_db");
                    $sql = "INSERT INTO t_user (username,password,realname,role,salt) VALUES ('$username', '$hashedPassword','$realname','$role','$salt')";
                    $result = mysqli_query($conn, $sql);
                    mysqli_close($conn);

                    if($result) {
                        echo "添加成功";
                    } else {
                        echo "添加失败";
                    }
                }
            ?>

            <button onclick="openForm()">添加用户</button>

            <div id="formPopup" style="display:none">
                <form method="post" action="">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required placeholder="请输入您的用户名"><br>
                    <label for="role">Role:</label>
                    <input type="text" id="role" name="role" required placeholder="请输入您的权限"><br>
                    <label for="role">password:</label>
                    <input type="text" id="password" name="password" required placeholder="请输入您的密码"><br>
                    <label for="role">realname:</label>
                    <input type="text" id="realname" name="realname" required placeholder="请输入您的真实姓名"><br>
                    <input type="submit" name="submit" value="添加">
                </form>
            </div>

            <script>
                function openForm() {
                    document.getElementById("formPopup").style.display = "block";
                }
            </script>
        </div>
    </div>
</body>

</html>

