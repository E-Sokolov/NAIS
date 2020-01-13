<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript" src="/views/calls/autocomplete.js"></script>
	<div id='content'>
		<div class='row'>
			
				<form role='form' method='post' action='/calls/editCallScript'>
				<input type='hidden' value='<?php echo $call[0]['id']; ?>' name='id' />
					<div class='form-group'>
						<label class='control-label'> Статус заявки: </label>
						<select class='form-control' name='status'>
							<option value='0'<?php if($call[0]['status'] == 0){ echo 'selected'; }?>> Актуально </option>
							<option value='1' <?php if($call[0]['status'] == 1){ echo 'selected'; }?>> Виконано </option>
						</select>
					</div>
		
					<div class='form-group'>
						<label class='control-label'> Дата: </label>
						<input type='text' value='<?php echo $call[0]['date']; ?>' name='date' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Час:</label>
						<input type='text' value='<?php echo date("H:i", strtotime($call[0]['time'])); ?>' name='time' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Тип заявки: </label>
						<select class='form-control' name='type'>
							<option value='Усне' <?php  if ($call[0]['type'] == 'Усне'){ echo 'selected'; } ?>> Усно </option>
							<option value='e-mail' <?php  if ($call[0]['type'] == 'e-mail'){ echo 'selected'; } ?>> e-mail </option>
							<option value='Письмове' <?php  if ($call[0]['type'] == 'Письмове'){ echo 'selected'; } ?>>Письмово</option>
							<option value='Факс' <?php  if ($call[0]['type'] == 'Факс'){ echo 'selected'; } ?>>Факс</option>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Тип заявника: </label>
						<select name='client_type' class='form-control'>
							<?php foreach($clientTypeList as $clientType){
							    
							          echo '<option value='.$clientType['id'];
							          if($clientType['id'] == $call[0]['client_type']){ 
							              echo ' selected';
							          }
							          echo '>'.$clientType['type'].'</option>';
							}?>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Заявник: </label>
						<input type='text' name='client' id='client' autocomplete='off' class='form-control' value='<?php echo $call[0]['client']; ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> ПІБ Заявника: </label>
						<input type='text' name='fio' id='fio' autocomplete="off" class='form-control' value='<?php echo $call[0]['fio']; ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Реєстр: </label>
						<select name='resource' class='form-control'>
							<?php 
							foreach($resource as $resource){
							    echo '<option value='.$resource['id'];
							    if($resource['id'] == $call[0]['resource']){
							        echo ' selected';
							    }
							    echo '>'.$resource['resource'].'</option>';
							}
							?>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Опис: </label>
						<textarea name='description' id='description' autocomplete="off" class='form-control'> <?php echo $call[0]['description']; ?> </textarea>
					</div>
					<div class='form-group'>
						<label class='control-label'> Що зроблено: </label>
						<textarea name='what_to_do' id='what_to_do' autocomplete='off' class='form-control'><?php echo $call[0]['what_to_do']; ?> </textarea>
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
					<div class='form-group'>
						<label class='control-label'> Виклик інженера: </label>
						<select class='form-control' name="service">
							<option>Ні</option>
							<?php if($call[0]['service'] == 'Так'){?>
								<option selected>Так</option>
							<?php }else{?>
								<option>Так</option>
							<?php } ?>		
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Відрядження: </label>
						<select class='form-control' name="trip">
							<option>Ні</option>
							<?php if($call[0]['trip'] == 'Так'){?>
								<option selected>Так</option>
							<?php }else{?>
								<option>Так</option>
							<?php } ?>	
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Дата та час вирішення: </label>
						<input type='text' value='<?php 
						if($call[0]['date_success'] == NULL){
						    echo date("d.m.Y H:i",time());
						}else{
						    echo date("d.m.Y H:i", strtotime($call[0]['date_success']));
						}
						 ?>' name='date_success' class='form-control' />
					</div>
				   <div class='form-group'>
				   <label class='control-label'> Інщі данні: </label>
						<textarea name='etc_data' id='etc_data' autocomplete='off' class='form-control'> <?php echo $call[0]['etc_data']; ?></textarea>
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записати</button>
					</div>
				</form>
			</div>
		</div>
	
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>
