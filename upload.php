<?php
error_reporting(E_ALL & ~E_NOTICE);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 连接数据库（用实际的数据库凭证替换这些变量）
    $servername = "127.0.0.1";
    $username = "root";
    $password = "liu12345";
    $dbname = "csv_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // 设置字符集为utf8
    mysqli_set_charset($conn, "utf8");
    
    // 检查连接
    if ($conn->connect_error) {
        die("连接失败：" . $conn->connect_error);
    }

    // 处理发送者和接受者的realname
    session_start(); 
    if (isset($_SESSION['realname'])) {
        $senderRealname = $_SESSION['realname'];
    }
    // 你需要根据实际情况获取发送者的realname
    $receiverRealname = implode(", ", $_POST["to"]);

    // 处理文件上传
    $uploadDir = 'upload/';  // 上传目录
    $fileName = $_FILES['file']['name'];
    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // 获取文件扩展名
    $uploadedFile = $uploadDir . uniqid() . '.' . $fileExtension; // 使用唯一的文件名确保文件不会被覆盖
    // 处理文件密级
    $level = $_POST['level'];

    // 将文件从临时位置移动到上传目录
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
        // 文件移动成功，插入文件信息到数据库
        $uploadTime = date("Y-m-d H:i:s"); // 获取当前时间

        // 将信息插入数据库表 t_files
        $sql = "INSERT INTO t_files (发送者, 接受者, 文件名, 时间, 文件状态, 密级) 
                VALUES ('$senderRealname', '$receiverRealname', '$fileName', '$uploadTime', '未读', '$level')";

        if ($conn->query($sql) === TRUE) {
            echo "文件上传成功，文件信息已插入数据库。";
            // 添加重定向
            echo "<script>alert('文件上传成功，发送成功！');</script>";
            header("Location: Document_write.php");
            // 添加成功提示
            
        } else {
            echo "文件上传成功，但文件信息插入数据库时发生错误：" . $conn->error;
        }
    } else {
        // 文件移动失败
        echo "文件上传失败。";
    }

    // 关闭数据库连接
    $conn->close();
}
?>

