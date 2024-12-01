<?php
// Kết nối với file config.php để lấy các thông tin cấu hình
require_once('config.php'); 

// Hàm thực thi truy vấn và trả về kết quả
function executeResult($sql, $isSingle = false) {
    // Kết nối tới cơ sở dữ liệu bằng các thông tin từ file config.php
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error()); // Nếu kết nối không thành công, in thông báo lỗi
    }

    // Thực thi truy vấn SQL
    $result = mysqli_query($conn, $sql);
    if ($result === false) {
        // Nếu có lỗi trong truy vấn, trả về false
        return false;
    }

    // Nếu yêu cầu trả về một kết quả duy nhất (1 dòng)
    if ($isSingle) {
        return mysqli_fetch_assoc($result); // Trả về 1 dòng kết quả dưới dạng mảng kết hợp
    }

    // Nếu yêu cầu trả về tất cả kết quả
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row; // Thêm mỗi dòng kết quả vào mảng
    }

    return $data; // Trả về tất cả các kết quả
}

// Hàm để thực thi các câu lệnh SQL không trả về kết quả (ví dụ INSERT, UPDATE, DELETE)
function execute($sql) {
    // Kết nối tới cơ sở dữ liệu
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Thực thi câu lệnh SQL
    mysqli_query($conn, $sql);

    // Đóng kết nối
    mysqli_close($conn);
}
?>
