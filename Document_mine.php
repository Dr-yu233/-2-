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
           <nav class="horizontal-nav">
			<a href="Document_mine.php" class="nav-link">我的&nbsp&nbsp&nbsp&nbsp</a>
			<a href="Document_exam.php" class="nav-link">审批&nbsp&nbsp&nbsp&nbsp</a>
			<a href="Document_write.php" class="nav-link">草拟&nbsp&nbsp&nbsp&nbsp</a>
			<a href="#" class="nav-link">归档</a>
		</nav>
        </div>
    </div>
	<nav class="under-horizontal-nav">
			<?php
error_reporting(E_ALL & ~E_NOTICE);

session_start(); // 启动会话

// 替换以下变量为你的数据库连接信息
$servername = "127.0.0.1";
$username = "root";
$password = "liu12345";
$dbname = "csv_db";

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
// 获取当前用户
if (isset($_SESSION['realname'])) {
    $currentUser = $_SESSION['realname'];

    // 查询数据库以获取接收者为当前用户、文件状态为未读的文件
    $sql = "SELECT * FROM t_files WHERE 发送者 = '$currentUser' AND 文件状态 = '未读'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // 输出表头
        echo "<table border='1'>
                <tr>
                    <th>文件名</th>
                    <th>发给</th>
                    <th>状态</th>
					<th>密级</th>
                    <th>发送时间</th>
                </tr>";

        // 输出数据
        while ($row = $result->fetch_assoc()) {
			$file=$row["文件名"];
            echo "<tr>
                    <td>" . $row["文件名"] . "</td>
                    <td>" . $row["接受者"] . "</td>
                    <td>" . $row["文件状态"] . "</td>
					<td>" . $row["密级"] . "</td>
					<td>" . $row["时间"] . "</td>
                    
					
                  </tr>";
        }
        // 输出表尾
        echo "</table>";
    } else {
        echo "没有未读文件";
    }
echo"<br>&nbsp";
	
	$sql = "SELECT * FROM t_files WHERE 发送者 = '$currentUser' AND 文件状态 = '退回'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // 输出表头
        echo "<table border='1'>
                <tr>
                    <th>文件名</th>
                    <th>发给</th>
                    <th>状态</th>
					<th>密级</th>
                    <th>发送时间</th>
                </tr>";

        // 输出数据
        while ($row = $result->fetch_assoc()) {
			$file=$row["文件名"];
            echo "<tr>
                    <td>" . $row["文件名"] . "</td>
                    <td>" . $row["接受者"] . "</td>
                    <td>" . $row["文件状态"] . "</td>
					<td>" . $row["密级"] . "</td>
					<td>" . $row["时间"] . "</td>
                    
					
                  </tr>";
        }
        // 输出表尾
        echo "</table>";
    } else {
        echo "没有退回文件.";
    }
	
echo"<br>&nbsp";

	$sql = "SELECT * FROM t_files WHERE 发送者 = '$currentUser' AND 文件状态 = '已读'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // 输出表头
        echo "<table border='1'>
                <tr>
                    <th>文件名</th>
                    <th>发给</th>
                    <th>状态</th>
					<th>密级</th>
                    <th>发送时间</th>
                </tr>";

        // 输出数据
        while ($row = $result->fetch_assoc()) {
			$file=$row["文件名"];
            echo "<tr>
                    <td>" . $row["文件名"] . "</td>
                    <td>" . $row["接受者"] . "</td>
                    <td>" . $row["文件状态"] . "</td>
					<td>" . $row["密级"] . "</td>
					<td>" . $row["时间"] . "</td>
                    
					
                  </tr>";
        }
        // 输出表尾
        echo "</table>";
    } else {
        echo "没有已读文件.";
    }
	
} else {
    echo "请先登录.";
}

// 关闭数据库连接
$conn->close();
?>

		</nav>
</body>

</html>
