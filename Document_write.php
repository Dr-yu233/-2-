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
					session_start(); 
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
            <nav class="horizontal-nav">
                <a href="Document_mine.php" class="nav-link">我的&nbsp&nbsp&nbsp&nbsp</a>
                <a href="Document_exam.php" class="nav-link">审批&nbsp&nbsp&nbsp&nbsp</a>
                <a href="Document_write.php" class="nav-link">草拟&nbsp&nbsp&nbsp&nbsp</a>
                <a href="#" class="nav-link">归档</a>
            </nav>
        </div>
    </div>
    <nav class="under-horizontal-nav">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="to">发送给：</label>
            <select name="to[]" id="to" multiple>
                <?php
                error_reporting(E_ALL & ~E_NOTICE);
                // Establish a database connection (Replace these variables with your actual database credentials)
                $servername = "127.0.0.1";
                $username = "root";
                $password = "liu12345";
                $dbname = "csv_db";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                mysqli_set_charset($conn, "utf8");
                // Fetch realname values from t_user
                $sql = "SELECT realname FROM t_user";
                $result = $conn->query($sql);
                session_start();
                if (isset($_SESSION['realname'])) {
                    $realname = $_SESSION['realname'];
                    $role = $_SESSION['role'];
                }

                // Populate options for the "to" field
                while ($row = $result->fetch_assoc()) {
                    if ($row["realname"] <> $realname) {
                        echo "<option value='" . $row["realname"] . "'>" . $row["realname"] . "</option>";
                    }
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>
            <br>

            <label for="file">选择文件：</label>
            <input type="file" name="file" id="file">
            <br>

            <label for="level">选择文件密级：</label>
            <select name="level" id="level">
                <option value="绝密">绝密</option>
                <option value="机密">机密</option>
                <option value="秘密">秘密</option>
                <option value="普通">普通</option>
            </select><br>

            <input type="submit" value="发送">


        </form>
    </nav>
</body>

</html>

