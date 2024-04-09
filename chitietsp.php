<?php
$sth = $dbh->prepare("select * from sanpham where idsp=:idsp");
$sth->bindParam(':idsp', $_GET['idsp']);
$sth->execute();
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	?>

	<div class="chitietsp">
		<div class="chitietsp-in">
			<div class="content">
				<div class="zoom-small-image">
					<a href='img/uploads/<?php echo $row['hinhanh'] ?>' width="300" height="300" class='cloud-zoom'
						id='zoom1' rel="adjustX: 10, adjustY:-4">
						<img src="img/uploads/<?php echo $row['hinhanh'] ?>" style="object-fit: cover;" width="250"
							height="250" alt='' title="Optional title display" />
					</a>
				</div>
				<div class="giasp">
					<ul>
						<p>
							<?php echo $row['tensp'] ?>
						</p>
						<li><span><b>Giá: <font color="red">
										<?php echo number_format(($row['gia'] * ((100 - $row['khuyenmai1']) / 100)), 0, ",", "."); ?></b>
								</font></span></li>
						<li>Tình trạng:
							<?php
							$dem = $row['soluong'] - $row['daban'];
							if ($dem > 0)
								echo "Số sản phẩm còn (" . $dem . ")";
							else
								echo "Hết hàng";
							?>
						</li>
						<form action="index.php?content=cart&action=add&idsp=<?php echo $row['idsp'] ?>" method="post">
							<li>Số lượng mua : <input type="number" name="soluongmua" <?php if(!($dem > 0)) { echo "readonly";} ?> onkeyup="maxLengthCheck(this)"
									value="1" min="1" max="<?php echo $dem; ?>" /></li>
							<li>
								<?php
								if ($dem <= 0)
									echo "<a href='index.php?content=hethang'><button>Cho vào giỏ</button></a>
							";
								else { ?>
									<input type="submit" value="Cho vào giỏ" name="chovaogio" class="inputmuahang" />
								<?php } ?>
							</li>
						</form>
					</ul>
				</div>
			</div>
			<div class="tinhnang">
				<div class="tieudetinhnang">
					<ul class="tabs">
						<li><a href="#tab1">Tính năng</a></li>
						<li><a href="#tab2">Bình luận </a></li>
					</ul>
				</div>

				<div id="tab1">
					<?php echo $row['chitiet'] ?>
				</div>
				<div id="tab2">
					<div id="fb-root"></div>
					<script>
						(function (d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));
						function maxLengthCheck(object) {
							if(object.value><?php echo $dem; ?>){object.value=<?php echo $dem; ?>}else if(object.value<0){object.value='0';}
						}
					</script>
					<div class="fb-comments"
						data-href=""
						data-width="560" data-numposts="10" data-colorscheme="light"></div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>