<?php
require_once('../database/dbhelper.php');

// Lấy danh sách các danh mục
$sql = 'SELECT * FROM category ORDER BY id ASC';
$categories = executeResult($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Quản Lý Danh Mục</h2>
        <a href="add.php" class="btn btn-primary">Thêm Danh Mục</a>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Tên Danh Mục</th>
                    <th>Ngày Tạo</th>
                    <th>Ngày Cập Nhật</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['created_at'] ?></td>
                        <td><?= $category['updated_at'] ?></td>
                        <td>
                            <form method="POST" action="delete.php" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
