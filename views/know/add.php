<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>

	<div id='content'>
		<div class='row'>
			
				<form role='form' method='post' action='/know/addScript' enctype='multipart/form-data'>	
					<div class='form-group'>
						<label class='control-label'> Ошибка (коротко): </label>
						<input type='text' name='title' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Полный текст ошибки: </label>
						<textarea name='full' class='form-control'> </textarea>
					</div>
					<div class='form-group'>
						<label class='control-label'> Скриншот: </label>
						<input type='file' name='screen' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Пути решения: </label>
						<textarea name='solution' class='form-control'> </textarea>
					</div>
					<div class='form-group'>
						<label class='control-label'> Реестр: </label>
						<select name='resource' class='form-control'>
							<?php foreach ($resource as $resource) { ?>
								<option value='<?php echo $resource['id']; ?>'><?php echo $resource['resource']; ?></option>
							<?php } ?>
							

						</select>
					</div>
					  <div class='form-group'>
						<label class='control-label'> Архив: </label>
						<input type='file' name='zip' class='form-control' />
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записать</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>
