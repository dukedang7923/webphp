<?php
require_once('../database/dbhelper.php');

$title = $price = $number = $content = $id_category = '';
$thumbnails = array_fill(0, 6, ''); // Mảng chứa 6 ảnh

if (!empty($_POST)) {
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
        }
    }

    // Thêm mới sản phẩm
    $sql = "INSERT INTO product (title, price, number, content, id_category";
    foreach ($thumbnails as $i => $thumbnail) {
        $sql .= ", thumbnail" . ($i ? "_$i" : '') . " ";
    }
    $sql .= ") VALUES ('$title', '$price', '$number', '$content', '$id_category'";

    foreach ($thumbnails as $thumbnail) {
        $sql .= ", '$thumbnail'";
    }

    $sql .= ")";
    
    execute($sql); // Thực thi câu lệnh SQL thêm mới sản phẩm
    header('Location: index.php'); // Chuyển hướng về trang danh sách
    die();
}

// Lấy danh sách danh mục từ bảng category
$categories = executeResult("SELECT * FROM category");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm Sản Phẩm</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Tên Sản Phẩm:</label>
                        <input required type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="price">Giá:</label>
                        <input required type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="number">Số lượng:</label>
                        <input required type="number" class="form-control" id="number" name="number">
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung:</label>
                        <textarea class="form-control" id="content" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_category">Danh Mục:</label>
                        <select class="form-control" id="id_category" name="id_category" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Thêm input để upload 6 ảnh -->
                    <?php for ($i = 0; $i < 6; $i++): ?>
                        <?php $key = $i == 0 ? 'thumbnail' : 'thumbnail_' . $i; ?>
                        <div class="form-group">
                            <label for="<?= $key ?>">Ảnh <?= $i + 1 ?>:</label>
                            <input type="file" class="form-control" id="<?= $key ?>" name="<?= $key ?>" />
                        </div>
                    <?php endfor; ?>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
