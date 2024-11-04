<?php
// Bao gồm file kết nối đến CSDL LTW2
require_once 'ktnoi.php';

// Xử lý khi người dùng ấn vào button Xóa sinh viên
if (isset($_GET['action']) && $_GET['action'] == 'xoa' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Xử lý xóa sinh viên ở đây, ví dụ:
    $sql = "DELETE FROM students WHERE ma_sinh_vien = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Xóa sinh viên thành công!"); window.location.href="index.php";</script>';
        exit;
    } else {
        echo '<script>alert("Lỗi khi xóa sinh viên: ' . $conn->error . '");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sinh viên</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .banner {
            background-color:#007bff;
            overflow: hidden;
            padding: 10px 20px;
            color: #FFFFFF;
        }
        .banner .thong_tin_admin {
            float: left;
        }
        .banner .chinh_sua_thong_tin {
            float: right;
        }
        .banner .chinh_sua_thong_tin img.avatar {
            height: 50px;
            width: auto;
            border-radius: 50%;
            margin-right: 10px;
        }
        .banner .chinh_sua_thong_tin a {
            color: #FFFFFF;
            text-decoration: none;
        }
        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .thanh_ben_trai {
            flex: 0 0 20%;
            padding-right: 20px;
            border-right: 1px solid #ccc;
        }
        .menu ul {
            list-style-type: none;
            padding: 0;
        }
        .menu li {
            margin-bottom: 10px;
        }
        .menu a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px;
            transition: background-color 0.3s ease;
        }
        .menu a:hover {
            background-color: #f2f2f2;
        }
        .noi_dung_chinh {
            flex: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .btn-group {
            display: inline-block;
        }
        .btn-group a {
            text-decoration: none;
            color: blue;
            margin-right: 10px;
        }
        .btn-logout {
    background-color: #f44336; /* Đổi màu nút đăng xuất sang màu đỏ */
    padding: 10px 20px;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin-left: 10px;
}

.btn-logout:hover {
    background-color: #cc0000; /* Thay đổi màu nền khi di chuột vào nút */
}

    </style>
</head>
<body>
<div class="banner">
    <div class="thong_tin_admin">
        <p>Xin chào, Admin!</p>
    </div>
    <div class="chinh_sua_thong_tin">
        <img src="admin_avatar.jpg" alt="Admin Avatar" class="avatar">
        <a href="thongtincanhan.php">Chỉnh sửa thông tin</a>
        <a href="dang_xuat.php" class="btn-logout">Đăng xuất</a>
    </div>
</div>


    <div class="container">
        <div class="thanh_ben_trai">
            <div class="menu">
                <h2>Menu</h2>
                <ul>
                    <li><a href="danh_sach_sinh_vien.php">Danh sách sinh viên</a></li>
                    <li><a href="them_sinh_vien.php?action=them_sinh_vien">Thêm sinh viên</a></li>
                    <li><a href="quanlidiem.php?action=quan_li_diem">Quản lí điểm</a></li>
                    <li><a href="quanlimon.php?action=quan_li_mon_hoc">Quản lí môn học</a></li>
                    <li><a href="quanlitaikhoan.php?action=quan_li_tai_khoan">Quản lí tài khoản</a></li>
                    <li><a href="thong_ke.php?action=thong_ke">Thống kê</a></li>
                </ul>
            </div>
        </div>

        <div class="noi_dung_chinh">
            <h2>Danh sách sinh viên</h2>
            <table>
                <thead>
                    <tr>
                        <th>Mã sinh viên</th>
                        <th>Tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Truy vấn CSDL để lấy danh sách sinh viên
                    $sql = "SELECT * FROM students";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['ma_sinh_vien']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ten']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ngay_sinh']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['gioi_tinh']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['so_dien_thoai']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['dia_chi']) . '</td>';
                            echo '<td class="btn-group">';
                            echo '<a href="chinh_sua_sinh_vien.php?id=' . $row['ma_sinh_vien'] . '">Chỉnh sửa</a>';
                            echo '<a href="?action=xoa&id=' . $row['ma_sinh_vien'] . '" onclick="return confirm(\'Bạn có chắc muốn xóa sinh viên này không?\')">Xóa</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8">Không có sinh viên nào được tìm thấy.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div> <!-- Đóng noi_dung_chinh -->
    </div> <!-- Đóng container -->

</body>
</html>

<?php
// Đóng kết nối sau khi hoàn tất các thao tác
$conn->close();
?>
