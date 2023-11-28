<?php
if(isset($_POST['id'])) {
    foreach($_POST['id'] as $matt) {
        $_SESSION['id'][$matt] = 1;
    }

    if(isset($_POST['giaohang'])) {
        foreach($_SESSION['id'] as $matt => $value) {
            if ($value == 1) {
                $sql = "UPDATE hoadon SET trangthai = 2 WHERE matt = :matt";
                $query = $dbh->prepare($sql);
                $query->bindParam(':matt', $matt);
                $query->execute();
            }
        }
        unset($_SESSION['id']);
        echo "
            <script language='javascript'>
                alert('Đã giao hàng');
                window.open('admin.php?admin=hienthihd','_self', 1);
            </script>
        ";
    } else if(isset($_POST['huy'])) { 
        foreach($_SESSION['id'] as $matt => $value) {
            if ($value == 1) {
                $sql = "UPDATE hoadon SET trangthai = 3 WHERE matt = :matt";
                $query = $dbh->prepare($sql);
                $query->bindParam(':matt', $matt);
                $query->execute();
            }
        }
        unset($_SESSION['id']);
        echo "
            <script language='javascript'>
                alert('Đã huỷ đơn hàng');
                window.open('admin.php?admin=hienthihd','_self', 1);
            </script>
        ";
    } else {
        foreach($_SESSION['id'] as $matt => $value) {
            if ($value == 1) {
                $sql = "DELETE FROM tintuc WHERE matt = :matt";
                $query = $dbh->prepare($sql);
                $query->bindParam(':matt', $matt);
                $query->execute();
            }
        }
        unset($_SESSION['id']);
        echo "
            <script language='javascript'>
                alert('Xóa tin tức đã chọn thành công');
                window.open('admin.php?admin=hienthitt','_self', 1);
            </script>
        ";
    }
} else {
    echo "
        <script language='javascript'>
            alert('Bạn chưa chọn hóa đơn cần xử lý');
            window.open('admin.php?admin=hienthihd','_self', 1);
        </script>
    ";
}
?>
