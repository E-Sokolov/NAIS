<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript" src="/views/maintenance/autocomplete.js"></script>
	<div id='content'>
		<div class='row'>
				<form role='form' method='post' action='/maintenance/editScript'>
					<input type="hidden" name='id' value="<?php echo $MaintenanceList[0]['id']; ?>">
					<div class='form-group'>
						<label class='control-label'> Дата: </label>
						<input type='date' value='<?php echo $MaintenanceList[0]['date']; ?>' name='date' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Тип заявки: </label>
						<select class='form-control' name='type'>
							<option value='усне' <?php if($MaintenanceList[0]['type'] == 'усне'){ echo 'selected'; } ?>> усне </option>
							<option value='e-mail'<?php if($MaintenanceList[0]['type'] == 'e-mail'){ echo 'selected';} ?>> e-mail </option>
							<option value='письмове' <?php if($MaintenanceList[0]['type'] == 'письмове'){ echo 'selected';} ?>>письмове</option>
							<option value='факс' <?php if($MaintenanceList[0]['type'] == 'факс'){ echo 'selected';} ?>>факс</option>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Тип заявника: </label>
						<select name='client_type' class='form-control'>
							<?php foreach($clientTypeList as $clientType){
									if($clientType['id'] == $MaintenanceList[0]['client_type']){
							          echo '<option value='.$clientType['id'].' selected>'.$clientType['type'].'</option>';
									}else{
									  echo '<option value='.$clientType['id'].'>'.$clientType['type'].'</option>';
									}
							}?>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Заявник: </label>
						<input type='text' name='client' id='client' autocomplete="off" class='form-control' value='<?php echo $MaintenanceList[0]['client']; ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Виконавець: </label>
						<select name='ingeneer' class='form-control'>
							<?php foreach($user as $user){
							    echo '<option value='.$user['id'];
							    if($user['id'] == $MaintenanceList[0]['ingeneer']){
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
							<option <?php if($MaintenanceList[0]['place'] == 'філія'){ echo 'selected'; } ?>>філія</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Час згідно акту ТО:</label>
						<input type="text" name="time" class="form-control" value='<?php echo $MaintenanceList[0]['time']; ?>'/>
					</div>
					<div class="form-group">
						<label class="control-label">Сумма:</label>
						<input type="text" name="price" class="form-control" autocomplete="off" value='<?php echo $MaintenanceList[0]['price']; ?>'/>
					</div>
				   <div class='form-group'>
				   <label class='control-label'> Інші данні: </label>
						<textarea name='note' id='note' autocomplete="off" class='form-control'> <?php echo $MaintenanceList[0]['note']; ?></textarea>
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записати</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>
