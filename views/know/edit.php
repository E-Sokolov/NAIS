<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<div id='big_img' style="position: fixed; border: 0px solid rgb(0, 0, 0); top: 0px; margin: 0; display: none;z-index: +1;">
	<img onclick="document.getElementById('big_img').style.display = 'none'" src='<?php echo $know['screen']; ?>' /> 
</div>
	<div id='content'>
		<div class='row'>
			
				<form role='form' method='post' action='/know/editScript' enctype='multipart/form-data'>
					<input type="hidden" name='id' value='<?php echo $know['id']; ?>' />	
					<div class='form-group'>
						<label class='control-label'> Заголовок: </label>
						<input type='text' name='title' class='form-control' value="<?php echo $know['title']; ?>" />
					</div>
					<div class='form-group'>
						<label class='control-label'> Полный текст ошибки: </label>
						<textarea name='full' class='form-control'><?php echo $know['full']; ?> </textarea>
					</div>
					<div class='form-group'>
						<label class='control-label'> Скриншот: </label>
						<?php if ($know['screen'] != ''){ ?>
						<label class='control-label'> <a href='#' onClick="document.getElementById('big_img').style.display = 'block'"><img width='300px' src='<?php echo $know['screen']; ?>' /> </a><br /></label>
						<?php } ?>
						<input type='file' name='screen' class='form-control' />
						<input type='hidden' name='bscreen' value='<?php echo $know['screen']; ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Пути решения: </label>
						<textarea name='solution' class='form-control' rows="15" cols="100"><?php echo $know['solution']; ?> </textarea>
					</div>
					<div class='form-group'>
						<label class='control-label'> Реестр: </label>
						<select name='resource' class='form-control'>
							<?php foreach ($resource as $resource) { ?>
								<?php if($resource['id'] == $know['resource']){  ?>
									<option value="<?php echo $resource['id']; ?>" selected><?php echo $resource['resource']; ?></option>
								<?php }else{ ?>
								<option value='<?php echo $resource['id']; ?>'><?php echo $resource['resource']; ?></option>
							<?php }} ?>
							

						</select>
					</div>
					  <div class='form-group'>
						<label class='control-label'> Архив: </label>
						<?php if($zip != ''){ ?>
						<?php echo $zip; ?>
						<label class='control-label'>
							<a href = '<?php echo $know['zip']; ?>'><img src='/views/elements/img/download.png' width='50px' /></a>
						</label>
						<?php } ?>
						<input type='file' name='zip' class='form-control' />
						<input type='hidden' name='bzip' value='<?php echo $know['zip']; ?>' />
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записать</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>