<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Thêm Danh Mục</title>
	<link rel="stylesheet" href="css/them_sanpham.css" />
</head>

<body>
	<?php
	include '../include/connect.php';


	if (isset($_POST['btnthem'])) {

		$tendm = $_POST['tendm'];
		$dequi = $_POST['dequi'];

		$sql = "INSERT INTO danhmuc (tendm, dequi) VALUES (:tendm, :dequi)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':tendm', $tendm);
		$query->bindParam(':dequi', $dequi);
		$insertdm = $query->execute();

		if ($insertdm) {

			echo "<p align = center>Thêm danh muc <font color='red'><b> $tendm </b></font> thành công!</p>";
			echo '<meta http-equiv="refresh" content="1;url=admin.php?admin=hienthidm">';
		} else {
			echo "Thêm thất bại";
		}
	}
	?>

	<form action="" method="post">
		<table>
			<tr class="tieude_themsp">
				<td colspan=2>Thêm Danh Mục </td>
			</tr>
			<tr>
				<td>Mã danh mục</td>
				<td><input type="text" disabled="disabled" name="madm" size="5" /></td>
			</tr>
			<tr>
				<td>Tên danh mục</td>
				<td><input type="text" name="tendm" /></td>
			</tr>
			<tr>
				<td>Thuộc</td>
				<td>
					<select name="dequi">
						<option value="0">Danh mục chính</option>
						<?php
						$show = $dbh->prepare("SELECT * FROM danhmuc WHERE dequi=0");
						$show->execute();
						while ($show1 = $show->fetch(PDO::FETCH_ASSOC)) {
							$madm = $show1['madm'];
							$tendm = $show1['tendm'];
							echo "<option value='" . $madm . "'>" . $tendm . "</option>";
							$sql = "SELECT * FROM danhmuc WHERE dequi = :madm";
							$show2 = $dbh->prepare($sql);
							$show2->bindParam(':madm', $madm);
							$show2->execute();

							while ($show3 = $show2->fetch(PDO::FETCH_ASSOC)) {
								$madm1 = $show3['madm'];
								$tendm1 = $show3['tendm'];
								echo "<option value='" . $madm1 . "'> - " . $tendm1 . "</option>";
							}
						}

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan=2 class="input">
					<input type="submit" name="btnthem" value="Thêm" />
					<input type="reset" name="" value="Hủy" />
				</td>
			</tr>
		</table>
	</form>




</body>

</html>