<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript" src="/views/calls/autocomplete.js"></script>
<?php if(count($call) > 0){ ?>
<script type="text/javascript">
	function Invalue(){
	var status = '<?php echo $call[0]['status']; ?>';
	var type = '<?php echo $call[0]['type']; ?>';
	var client_type = '<?php echo $call[0]['client_type']; ?>';
	var client = '<?php echo $call[0]['client']; ?>';
	var fio = '<?php echo $call[0]['fio']; ?>';
	var resource = '<?php echo $call[0]['resource']; ?>';
	var description = '<?php echo $call[0]['description']; ?>';
	var what_to_do = '<?php echo $call[0]['what_to_do']; ?>';
	var service = '<?php echo $call[0]['service']; ?>';
	var trip = '<?php echo $call[0]['trip']; ?>';
	var etc_data = '<?php echo str_replace("\r",'',str_replace("\n",'',$call[0]['etc_data'])); ?>';
	//alert(status);
		//$('#status[value="+status+"]').attr('selected','selected');
		$('#status').val(status).change();
		$('#type').val(type).change();	
		$('#client_type').val(client_type).change();
		$('#client').val(client);
		$('#fio').val(fio);
		$('#resource').val(resource).change();
		$('#description').val(description);
		$('#what_to_do').val(what_to_do);
		$('#service').val(service).change();
		$('#trip').val(trip).change();
		$('#etc_data').val(etc_data);
	}
	setTimeout(Invalue, 1000);
</script>
<?php } ?>
	<div id='content'>
		<div class='row'>
				<form role='form' method='post' action='/calls/addScript'>
					<div class='form-group'>
						<label class='control-label'> Статус заявки: </label>
						<select class='form-control' name='status' id='status'>
							<option value='0'> Актуально </option>
							<option value='1' selected> Виконано </option>
						</select>
					</div>
		
					<div class='form-group'>
						<label class='control-label'> Дата: </label>
						<input type='text' value='<?php echo date("d.m.Y",time()); ?>' name='date' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Час:</label>
						<input type='text' value='<?php echo date("H:i", time()); ?>' name='time' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Тип заявки: </label>
						<select class='form-control' name='type' id='type'>
							<option value='Усне' selected> Усно </option>
							<option value='e-mail'> e-mail </option>
							<option value='Письмове'>Письмово</option>
							<option value='Факс'>Факс</option>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Тип заявника: </label>
						<select name='client_type' id='client_type' class='form-control'>
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
						<label class='control-label'> ПІБ заявника: </label>
						<input type='text' name='fio' id='fio' autocomplete="off" class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Реєстр: </label>
						<select name='resource' id='resource' class='form-control'>
							<?php 
							foreach ($resource as $resource){
							    echo '<option value='.$resource['id'].'>'.$resource['resource'].'</option>';
							}
							?>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Опис: </label>
						<textarea name='description' id='description' autocomplete="off" class='form-control'> </textarea>
					</div>
					<div class='form-group'>
						<label class='control-label'> Що зроблено: </label>
						<textarea name='what_to_do' id='what_to_do' autocomplete="off" class='form-control'> </textarea>
					</div>
					<input type="hidden" name='ingeneer' value='<?php echo $_SESSION['uid']; ?>'>
					<div class='form-group'>
						<label class='control-label'> Виклик інженера: </label>
						<select class='form-control' name="service" id='service'>
							<option>Ні</option>
							<option>Так</option>	
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Відрядження: </label>
						<select class='form-control' name="trip" id='trip'>
							<option>Ні</option>
							<option>Так</option>	
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Дата та час вирішення: </label>
						<input type='text' value='<?php echo date("d.m.Y H:i",time()); ?>' name='date_success' class='form-control' />
					</div>
				   <div class='form-group'>
				   <label class='control-label'> Інші данні: </label>
						<textarea name='etc_data' id='etc_data' autocomplete="off" class='form-control'> </textarea>
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записати</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>
