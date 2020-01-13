<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript" src="/views/gauth/autocomplete.js"></script>
	<div id='content'>
		<div class='row'>
				<form role='form' method='post' action='/gauth/addScript'>
					<div class='form-group'>
						<label class='control-label'> Дата заявки: </label>
						<input type='datetime-local' value='<?php echo date("Y-m-d\TH:i",time()); ?>' name='date1' class='form-control' />
					</div>
					<div class='form-group' >
						<label class='control-label'> Заявник: </label>
						<input type='text' name='client' id='client' autocomplete="off" class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Ім'я: </label>
						<input type='text' name='name' id='name' autocomplete="off" class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Виконавець: </label>
						<select name='ingeneer' class='form-control'>
							<?php foreach($user as $user){
							    echo '<option value='.$user['id'];
							    if($user['id'] == $gauth[0]['ingeneer']){
							        echo ' selected';
							    }
							    echo '>'.$user['short_name'].'</option>';
							}?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Дата видачі:</label>
						<input type="datetime-local" name="date2" class="form-control" value='<?php echo date("Y-m-d\TH:i",time()); ?>' />
					</div>
				   <div class='form-group'>
				   <label class='control-label'> Інші данні: </label>
						<textarea name='coment' id='coment' autocomplete="off" class='form-control'></textarea>
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записати</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>
