<?php
if (isset($_POST['id'])) {
    foreach ($_POST['id'] as $mahd) {
        $_SESSION['id'][$mahd] = 1;
    }

    if (isset($_POST['giaohang'])) {
        foreach ($_SESSION['id'] as $mahd => $value) {
            if ($value == 1) {
                $sql = "UPDATE hoadon SET trangthai = 2 WHERE mahd = :mahd";
                $query = $dbh->prepare($sql);
                $query->bindParam(':mahd', $mahd);
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
    } else if (isset($_POST['huy'])) {
        foreach ($_SESSION['id'] as $mahd => $value) {
            if ($value == 1) {
                $sql = "UPDATE hoadon SET trangthai = 3 WHERE mahd = :mahd";
                $query = $dbh->prepare($sql);
                $query->bindParam(':mahd', $mahd);
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
        foreach ($_SESSION['id'] as $mahd => $value) {
            if ($value == 1) {
                $sql = "DELETE FROM hoadon WHERE mahd = :mahd";
                $query = $dbh->prepare($sql);
                $query->bindParam(':mahd', $mahd);
                $query->execute();

                $sql1 = "DELETE FROM chitiethoadon WHERE mahd = :mahd";
                $query1 = $dbh->prepare($sql1);
                $query1->bindParam(':mahd', $mahd);
                $query1->execute();
            }
        }
        unset($_SESSION['id']);
        echo "
            <script language='javascript'>
                alert('Xóa thành công');
                window.open('admin.php?admin=hienthihd','_self', 1);
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
