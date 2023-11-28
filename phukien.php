<?php
$sql = "select * from danhmuc where dequi=2 order by madm";
$result = $dbh->query($sql);



while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	?>
	<div class="sanpham">
		<?php
		$kq = $dbh->prepare("select * from sanpham where madm=:madm order by idsp  LIMIT 0,6");
		$kq->bindParam(":madm", $row["madm"], PDO::PARAM_INT);
		$kq->execute();
		$dem = $kq->rowCount();
		if ($dem > 0) {
			?>

			<h2>
				<?php echo $row["tendm"]; ?>
			</h2>
			<div id="xemthem">
				<p><a href="">Xem thêm >></a></p>
			</div>
		<?php } ?>
		<div class="sanphamcon">
			<?php while ($rows = $kq->fetch(PDO::FETCH_ASSOC)) { ?>
				<div class="dienthoai">
					<?php
					if ($rows['khuyenmai1'] > 0) {
						?>
						<div class="moi">
							<h3>-
								<?php echo $rows['khuyenmai1'] ?>%
							</h3>
						</div>
					<?php } ?>
					<a href="#"><img src="img/uploads/<?php echo $rows['hinhanh']; ?>"></a><br>
					<p><a href="#">
							<?php echo $rows['tensp']; ?>
						</a></p><br>
					<h4>
						<?php echo number_format(($rows['gia'] * ((100 - $rows['khuyenmai1']) / 100)), 0, ",", "."); ?>
					</h4>
					<div class="button">
						<ul>
							<li>
								<h1><a href="index.php?content=chitietsp&idsp=<?php echo $rows['idsp'] ?>"
										class="chitiet"><button>Chi tiết</button></a></h1>
							</li>
							<li>
								<h5><a href="index.php?content=cart&action=add&idsp=<?php echo $rows['idsp'] ?>"><button>Cho vào
											giỏ</button></a></h5>
							</li>
						</ul>
					</div><!-- End .button-->
				</div><!-- End .dienthoai-->

			<?php } ?>

		</div>
	</div><!-- end san pham-->
<?php } ?>