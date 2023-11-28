<?php

$select = $dbh->prepare("select * from tintuc where matt=:matt");
$select->bindParam(':matt', $_GET['matt']);
$select->execute();
while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
	?>
	<div class="chitiettintuc">
		<h3>
			<?php echo $row['tieude'] ?>
		</h3>
		<div class="noidungchitiettintuc">
			<img src="img/tintuc/<?php echo $row['hinhanh'] ?>" width="200" height="200">
			<p>
				<?php echo $row['ndngan'] ?>
			</p>
		</div>
		<div class="noidungfull">
			<p>
				<?php echo $row['noidung'] ?>
			</p>
			<span>Tác giả:
				<?php echo $row['tacgia'] ?>
			</span>
		</div>
	</div>
<?php } ?>