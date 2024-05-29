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
                        echo  htmlspecialchars($realname); // 对输出进行 HTML 转义
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
                // 创建连接
                $conn = new mysqli('127.0.0.1','root','liu12345','csv_db');
                // 检测连接
                if($conn->connect_error){
                    die('连接失败：'.$conn->connect_error);
                }
                mysqli_set_charset($conn, "utf8"); // 设置字符集为 UTF-8
                
                // 查询数据
                $sql = "SELECT * FROM t_department";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                
                // 显示数据
                if ($result->num_rows > 0) {
                    echo "<table><tr><th>部门&nbsp&nbsp</th><th>密级&nbsp&nbsp</th><th>成员数&nbsp&nbsp</th><th>管理人&nbsp&nbsp</th></tr>";
                    // 输出每行数据
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".htmlspecialchars($row['部门'])."</td><td>".htmlspecialchars($row["密级"])."</td><td>".htmlspecialchars($row["成员数"])."</td><td>".htmlspecialchars($row["管理人"])."</td></tr>"; // 对输出进行 HTML 转义
                    }
                    echo "</table>";
                } else {
                    echo "0 结果";
                }

                // 关闭连接
                $stmt->close();
                $conn->close();
            ?>
        </div>
    </div>
</body>

</html>

