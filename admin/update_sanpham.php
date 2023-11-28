<?php
include('../include/connect.php');
include('function/function.php');

$tensp = $_POST['tensp'];
$gia = $_POST['gia'];
$mau = $_POST['mau'];
$chitiet = $_POST['chitiet'];
$khuyenmai1 = $_POST['khuyenmai1'];
$khuyenmai2 = $_POST['khuyenmai2'];
$soluong = $_POST['soluong'];
$daban = $_POST['daban'];
$madm = $_POST['danhmuc'];
$idsp = $_GET['idsp'];

$upload_image = "../img/uploads/";
$file_tmp = isset($_FILES['hinhanh']['tmp_name']) ? $_FILES['hinhanh']['tmp_name'] : "";
$file_name = isset($_FILES['hinhanh']['name']) ? $_FILES['hinhanh']['name'] : "";
$file_type = isset($_FILES['hinhanh']['type']) ? $_FILES['hinhanh']['type'] : "";
$file_size = isset($_FILES['hinhanh']['size']) ? $_FILES['hinhanh']['size'] : "";
$file_error = isset($_FILES['hinhanh']['error']) ? $_FILES['hinhanh']['error'] : "";

// Get current date and time
$dmyhis = date("Y") . date("m") . date("d") . date("H") . date("i") . date("s");
$ngay = date("Y") . ":" . date("m") . ":" . date("d") . ":" . date("H") . ":" . date("i") . ":" . date("s");
$file__name__ = $dmyhis . $file_name;

if ($_FILES['hinhanh']['name'] != "") {
    move_uploaded_file($file_tmp, $upload_image . $file__name__);
    $sql_update = "
        UPDATE sanpham SET 
			idsp = :idsp,
            tensp = :tensp,
            soluong = :soluong,
            daban = :daban,
            hinhanh = :hinhanh,
            mau = :mau,
            chitiet = :chitiet,
            gia = :gia,
            khuyenmai1 = :khuyenmai1,
            khuyenmai2 = :khuyenmai2,
            madm = :madm,
			ngaycapnhat = CURRENT_TIMESTAMP
        WHERE idsp = :idsp";
} else {
    $sql_update = "
        UPDATE sanpham SET 
			idsp = :idsp,
            tensp = :tensp,
            mau = :mau,
            soluong = :soluong,
            daban = :daban,
            chitiet = :chitiet,
            gia = :gia,
            khuyenmai1 = :khuyenmai1,
            khuyenmai2 = :khuyenmai2,
            madm = :madm,
			ngaycapnhat = CURRENT_TIMESTAMP
        WHERE idsp = :idsp";
}

$query_update = $dbh->prepare($sql_update);
$query_update->bindParam(':tensp', $tensp);
$query_update->bindParam(':soluong', $soluong);
$query_update->bindParam(':daban', $daban);
$query_update->bindParam(':hinhanh', $file__name__);
$query_update->bindParam(':mau', $mau);
$query_update->bindParam(':chitiet', $chitiet);
$query_update->bindParam(':gia', $gia);
$query_update->bindParam(':khuyenmai1', $khuyenmai1);
$query_update->bindParam(':khuyenmai2', $khuyenmai2);
$query_update->bindParam(':madm', $madm);
$query_update->bindParam(':idsp', $idsp);
$query_update->execute();

if ($query_update) {
    redirect("admin.php?admin=hienthisp", "Bạn đã sửa thành công sản phẩm.", 2);
} else {
    redirect("admin.php?admin=suasp&idsp=$idsp", "Sửa thất bại", 2);
}
?>
