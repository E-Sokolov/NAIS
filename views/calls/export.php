<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>

	<div id='content'>
		<div class='row'>
			
			<form method='post' action=''>
				<input type="date" class="form-control" id="date" name="first_date" placeholder="Начальная дата" required>
				<input type="date" class="form-control" id="date" name="last_date" placeholder="Конечная дата" required>
				<input type="submit" class="btn btn-warning" id="button" name="submit" value="Сгенерировать">
			</form>
				
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php';?>