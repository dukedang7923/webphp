<?php
require_once('../database/dbhelper.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Quản lý sản phẩm</title>
</head>

<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="../index.php">Thống kê</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../category/">Quản lý Danh Mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="../product/">Quản lý sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../dashboard.php">Quản lý giỏ hàng</a>
        </li>
    </ul>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Quản lý Sản Phẩm</h2>
            </div>
            <div class="panel-body"></div>
            <a href="add.php">
                <button class="btn btn-success" style="margin-bottom:20px">Thêm Sản Phẩm</button>
            </a>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="font-weight: 500;">
                        <td width="70px">STT</td>
                        <td>Thumbnails</td>
                        <td>Tên Sản Phẩm</td>
                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Nội dung</td>
                        <td>ID</td>
                        <td width="50px"></td>
                        <td width="50px"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Lấy danh sách Sản Phẩm
                    if (!isset($_GET['page'])) {
                        $pg = 1;
                        echo 'Bạn đang ở trang: 1';
                    } else {
                        $pg = $_GET['page'];
                        echo 'Bạn đang ở trang: ' . $pg;
                    }

                    try {
                        $limit = 5;
                        $start = ($pg - 1) * $limit;
                        $sql = "SELECT * FROM product LIMIT $start, $limit";
                        $productList = executeResult($sql);

                        $index = 1;
                        foreach ($productList as $item) {
                            echo '<tr>
                                <td>' . ($index++) . '</td>
                                <td style="text-align:center">';
                            for ($i = 0; $i < 6; $i++) {
                                $column = $i == 0 ? 'thumbnail' : 'thumbnail_' . $i;
                                if (!empty($item[$column])) {
                                    echo '<img src="' . $item[$column] . '" alt="Ảnh ' . $i . '" style="width: 50px; margin-right: 5px;">';
                                }
                            }
                            echo '</td>
                                <td>' . $item['title'] . '</td>
                                <td>' . number_format($item['price'], 0, ',', '.') . ' VNĐ</td>
                                <td>' . $item['number'] . '</td>
                                <td>' . $item['content'] . '</td>
                                <td>' . $item['id_category'] . '</td>
                                <td>
                                    <a href="update.php?id=' . $item['id'] . '">
                                        <button class="btn btn-warning">Sửa</button>
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="deleteProduct(' . $item['id'] . ')">Xoá</button>
                                </td>
                            </tr>';
                        }
                    } catch (Exception $e) {
                        die("Lỗi thực thi sql: " . $e->getMessage());
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <ul class="pagination">
            <?php
            $sql = "SELECT COUNT(*) AS total FROM product";
            $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $total = $data['total'];
            $total_pages = ceil($total / $limit);

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $pg) {
                    echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
            }
            ?>
        </ul>
    </div>
    <script type="text/javascript">
        function deleteProduct(id) {
            var option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?');
            if (!option) {
                return;
            }

            $.post('ajax.php', {
                'id': id,
                'action': 'delete'
            }, function(data) {
                location.reload();
            });
        }
    </script>
</body>

</html>
