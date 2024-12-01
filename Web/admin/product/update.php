<?php
require_once('../database/dbhelper.php');

$id = $title = $price = $number = $content = $id_category = '';
$thumbnails = array_fill(0, 6, ''); // Mảng chứa 6 ảnh

if (!empty($_POST)) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';

    // Kiểm tra và tạo thư mục uploads nếu chưa tồn tại
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Tạo thư mục với quyền ghi cho tất cả
    }

    // Xử lý upload và lưu đường dẫn ảnh
    for ($i = 0; $i < 6; $i++) {
        $key = $i == 0 ? 'thumbnail' : 'thumbnail_' . $i;

        // Kiểm tra nếu có ảnh mới được upload
        if (isset($_FILES[$key]) && $_FILES[$key]['size'] > 0) {
            $target_file = $target_dir . basename($_FILES[$key]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Chỉ chấp nhận file ảnh
            $allowed_types = ["jpg", "jpeg", "png", "gif"];
            if (in_array($imageFileType, $allowed_types)) {
                // Nếu có ảnh cũ, xóa ảnh cũ trước khi upload ảnh mới
                if (!empty($_POST[$key . '_old']) && file_exists($_POST[$key . '_old'])) {
                    unlink($_POST[$key . '_old']); // Xóa ảnh cũ
                }

                // Di chuyển ảnh vào thư mục upload
                if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
                    $thumbnails[$i] = $target_file; // Lưu đường dẫn ảnh vào mảng
                } else {
                    // Nếu không thể upload ảnh, giữ lại ảnh cũ
                    echo "Lỗi khi upload ảnh $key!";
                }
            } else {
                // Nếu ảnh không đúng định dạng
                echo "Chỉ chấp nhận định dạng ảnh JPG, JPEG, PNG, GIF!";
            }
        } else {
            // Nếu không upload ảnh mới, giữ lại ảnh cũ
            if (!empty($_POST[$key . '_old'])) {
                $thumbnails[$i] = $_POST[$key . '_old'];
            }
        }
    }

    // Cập nhật thông tin sản phẩm
    if ($id != '') {
        // Cập nhật sản phẩm
        $sql = "UPDATE product SET 
            title = '$title', 
            price = '$price', 
            number = '$number', 
            content = '$content', 
            id_category = '$id_category'";

        // Cập nhật các ảnh
        for ($i = 0; $i < 6; $i++) {
            $key = $i == 0 ? 'thumbnail' : 'thumbnail_' . $i;
            $sql .= ", $key = '" . $thumbnails[$i] . "'";
        }

        $sql .= " WHERE id = '$id'";  // Cập nhật theo id của sản phẩm hiện tại
    }

    execute($sql); // Thực thi câu lệnh SQL
    header('Location: index.php'); // Chuyển hướng về trang danh sách
    die();
}

// Lấy dữ liệu sản phẩm để chỉnh sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id = $id";
    $product = executeResult($sql, true);
    if ($product != null) {
        $title = $product['title'];
        $price = $product['price'];
        $number = $product['number'];
        $content = $product['content'];
        $id_category = $product['id_category'];
        for ($i = 0; $i < 6; $i++) {
            $key = $i == 0 ? 'thumbnail' : 'thumbnail_' . $i;
            $thumbnails[$i] = $product[$key];
        }
    }
}

// Lấy danh sách danh mục từ bảng category
$categories = executeResult("SELECT * FROM category");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm/Sửa Sản Phẩm</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Sửa Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id ?>" /> <!-- Ẩn trường ID để gửi qua POST -->

                    <div class="form-group">
                        <label for="title">Tên Sản Phẩm:</label>
                        <input required type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Giá:</label>
                        <input required type="number" class="form-control" id="price" name="price" value="<?= $price ?>">
                    </div>
                    <div class="form-group">
                        <label for="number">Số lượng:</label>
                        <input required type="number" class="form-control" id="number" name="number" value="<?= $number ?>">
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung:</label>
                        <textarea class="form-control" id="content" name="content"><?= $content ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_category">Danh Mục:</label>
                        <select class="form-control" id="id_category" name="id_category" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= $category['id'] == $id_category ? 'selected' : '' ?>>
                                    <?= $category['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Thêm input để upload 6 ảnh -->
                    <?php for ($i = 0; $i < 6; $i++): ?>
                        <?php $key = $i == 0 ? 'thumbnail' : 'thumbnail_' . $i; ?>
                        <div class="form-group">
                            <label for="<?= $key ?>">Ảnh <?= $i + 1 ?>:</label>
                            <input type="file" class="form-control" id="<?= $key ?>" name="<?= $key ?>" />
                            <?php if (!empty($thumbnails[$i])): ?>
                                <p>Ảnh hiện tại: <img src="<?= $thumbnails[$i] ?>" width="100px" /></p>
                                <input type="hidden" name="<?= $key ?>_old" value="<?= $thumbnails[$i] ?>" />
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>

                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
