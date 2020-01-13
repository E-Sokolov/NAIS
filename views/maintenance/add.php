<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript" src="/views/maintenance/autocomplete.js"></script>
	<div id='content'>
		<div class='row'>
				<form role='form' method='post' action='/maintenance/addScript'>
					<div class='form-group'>
						<label class='control-label'> Дата: </label>
						<input type='date' value='<?php echo date("d.m.Y",time()); ?>' name='date' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Тип заявки: </label>
						<select class='form-control' name='type'>
							<option value='усне' selected> Усно </option>
							<option value='e-mail'> e-mail </option>
							<option value='письмове'>Письмово</option>
							<option value='факс'>факс</option>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Тип заявника: </label>
						<select name='client_type' class='form-control'>
							<?php foreach($clientTypeList as $clientType){
							          echo '<option value='.$clientType['id'].'>'.$clientType['type'].'</option>';
							}?>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Заявник: </label>
						<input type='text' name='client' id='client' autocomplete="off" class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Виконавець: </label>
						<select name='ingeneer' class='form-control'>
							<?php foreach($user as $user){
							    echo '<option value='.$user['id'];
							    if($user['id'] == $call[0]['ingeneer']){
							        echo ' selected';
							    }
							    echo '>'.$user['short_name'].'</option>';
							}?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Місце обслуговування:</label>
						<select name="place" class="form-control" autocomplete="off">
							<option>користувач</option>
							<option>філія</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Час згідно акту ТО:</label>
						<input type="text" name="time" class="form-control" />
					</div>
					<div class="form-group">
						<label class="control-label">Сумма:</label>
						<input type="text" name="price" class="form-control" autocomplete="off"/>
					</div>
				   <div class='form-group'>
				   <label class='control-label'> Інші данні: </label>
						<textarea name='note' id='note' autocomplete="off" class='form-control'> </textarea>
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записати</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>
