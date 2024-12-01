<?php
header("Content-Type: text/html; charset=UTF-8");
require_once('../database/dbhelper.php');

// Xử lý khi form được gửi
if (!empty($_POST['name'])) {
    // Nhận giá trị từ form
    $name = $_POST['name'];
    $name = str_replace('"', '\\"', $name); // Xử lý ký tự "

    // Lấy thời gian hiện tại cho created_at và updated_at
    $created_at = $updated_at = date('Y-m-d H:i:s');

    // Thêm danh mục vào cơ sở dữ liệu
    $sqlInsert = 'INSERT INTO category (name, created_at, updated_at) VALUES ("' . $name . '", "' . $created_at . '", "' . $updated_at . '")';
    execute($sqlInsert);

    // Đặt lại AUTO_INCREMENT để đảm bảo ID liên tục
    resetAutoIncrement();

    // Chuyển hướng về trang quản lý danh mục
    header('Location: index.php');
    exit();
}

/**
 * Hàm đặt lại giá trị AUTO_INCREMENT
 */
function resetAutoIncrement() {
    $sqlMaxId = 'SELECT MAX(id) AS max_id FROM category';
    $result = executeResult($sqlMaxId, true);

    if ($result && $result['max_id']) {
        $nextId = $result['max_id'] + 1;
        $sqlResetAI = 'ALTER TABLE category AUTO_INCREMENT = ' . $nextId;
        execute($sqlResetAI);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Danh Mục</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Thêm Danh Mục Mới</h2>
        <form method="POST" action="add.php">
            <div class="form-group">
                <label for="name">Tên Danh Mục:</label>
                <input required="true" type="text" class="form-control" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="index.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>
</html>
