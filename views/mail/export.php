
<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>

	<div id='content'>
		<div class='row'>
			
			<form method='post' action=''>
					<div class='form-group' >
						<label class='control-label'> Тип организации: </label>
						<select name='id' class='form-control'>
							<?php foreach($MailTypeList as $type){
							          echo '<option value='.$type['id'].'>'.$type['alias'].'</option>';
							}?>
						</select>
					</div>
				<input type="submit" class="btn btn-warning" id="button" name="submit" value="Сгенерировать">
			</form>
				
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php';?>