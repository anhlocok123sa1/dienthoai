<?php
include("include/connect.php");
include("admin/function/function.php");
if (isset($_POST['submit'])) {
	$chude = $_POST['chude'];
	$hoten = $_POST['hoten'];
	$email = $_POST['email'];
	$dienthoai = $_POST['dienthoai'];
	$noidung = $_POST['noidung'];
	$ngay = date("Y") . ":" . date("m") . ":" . date("d") . ":" . date("H") . ":" . date("i") . ":" . date("s");
	$insert = $dbh->prepare("insert into hotro values('',':chude',':noidung',':hoten',':dienthoai',':email',':ngay')");
	$query->bindParam(':chude', $chude);
	$query->bindParam(':noidung', $noidung);
	$query->bindParam(':hoten', $hoten);
	$query->bindParam(':dienthoai', $dienthoai);
	$query->bindParam(':email', $email);
	$query->bindParam(':ngay', $ngay);
	$query->execute();
	if ($insert)
		redirect("index.php", "Cảm ơn bạn đã góp ý. Chúng tôi sẽ trả lời bạn sớm nhất có thể", 2);
	else
		echo "<script language='javascript'>
								alert('Lỗi');
								history.back(); 
     history.go(-1);
							</script>";
}
?>