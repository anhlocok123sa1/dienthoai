<?php
include'../include/connect.php';
include'function/function.php';
$delete = "DELETE FROM danhmuc WHERE madm = :madm";
$query = $dbh->prepare($delete);
$query->bindParam(':madm', $_GET['madm']);
$del = $query->execute();
if ($del)
    {
        redirect ("admin.php?admin=hienthidm", "Xoa danh mục thành công. ", 1);
    }
    else
        echo "Xóa danh mục thất bại";
?>
