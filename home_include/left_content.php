<div id="danhmucsp">
	<div class="center">
		<h4>SẢN PHẨM</h4>
		<?php
		$sql = "select * from danhmuc where dequi=1";
		// $sth = $dbh->prepare($sql);
		// $sth->execute();
		
		// $result = $sth->fetchAll();
		// print_r($result);
		//
		$stm = $dbh->query($sql);
		$rows2 = $stm->fetchAll(PDO::FETCH_OBJ);
		//print_r($rows2);
		//
		?>
		<ul>
			<?php
			foreach ($rows2 as $row) {
				?>
				<li><a href="index.php?madm=<?php echo $row->madm ?>">
						<?php echo $row->tendm; ?>
					</a></li>
			<?php } ?>


		</ul>
	</div><!-- End .center -->
</div> <!-- End .menu-left -->

<div id="phukien">
	<div class="center">
		<h4> PHỤ KIỆN</h4>
		<?php
		$sql = "select * from danhmuc where dequi=2";
		$stm = $dbh->query($sql);
		$rows2 = $stm->fetchAll(PDO::FETCH_OBJ);
		?>
		<ul>
			<?php
			foreach ($rows2 as $row) {
				?>
				<li><a href="index.php?madm=<?php echo $row->madm ?>">
						<?php echo $row->tendm; ?>
					</a></li>
			<?php } ?>

		</ul>
	</div><!-- End .center -->
</div><!-- End .phukien -->

<!-- <div id="quangcao1">
	<div class="center">
		<a href="#"> <img src="img/quangcao.png" alt="quangcao" title="quangcao"> </a>

		<a href="#"> <img src="img/quangcao2.png" alt="quangcao2" title="quangcao2"> </a>
	</div>
</div> -->