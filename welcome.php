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
                <span>欢迎您！
<?php
                    session_start(); 
                    error_reporting(E_ALL & ~E_NOTICE); // 添加错误报告设置
			error_reporting(E_ALL & ~E_WARNING); 
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
            <img src="https://ts1.cn.mm.bing.net/th/id/R-C.93b69a929c69bfcc10888701799a51fd?rik=0H%2bPnZ8L%2fz3s9w&riu=http%3a%2f%2fnews.youth.cn%2fsz%2f201711%2fW020171117150547785313.jpg&ehk=0c9%2b%2fgURIlxdK1YQVzATUMc9kqp36%2b3iZjM6Vc3M7q8%3d&risl=&pid=ImgRaw&r=0" width="1280" height="700" alt=""/>
        </div>
    </div>

</body>

</html>

