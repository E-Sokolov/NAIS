<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript" src="/views/mail/autocomplete.js"></script>
	<div id='content'>
		<div class='row'>
			
<form role='form' method='post' action='/mail/addScript'>
					<div class='form-group'>
						<label class='control-label'> Организація: </label>
						<input type='text' value='' name='client' id='client' autocomplete="off" class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> ПІБ: </label>
						<input type='text' name='fio' id='fio' autocomplete="off" class='form-control' value='' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Посада: </label>
						<input type='text' name='position' id='position' autocomplete="off" class='form-control' value='' />
					</div>
					<div class='form-group'>
						<label class='control-label'> E-Mail: </label>
						<input type='email' name='email' class='form-control' value='' />
					</div>
					<div class='form-group' >
						<label class='control-label'> Електронна скринька: </label>
						<select name='status' class='form-control'>
							          <option>Відкрита</option>
							          <option>Закрита</option>
							          <option>Заблокована</option>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Тип скриньки: </label>
						<select name='email_type' class='form-control'>
							          <option>Персональна</option>
							          <option>Офіційна</option>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Згідно ЕРК: </label>
						<select name='erk' class='form-control'>
							          <option>Діє</option>
							          <option>Не діє</option>
							          <option>Відсутній</option>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Тип организації: </label>
						<select name='orgtype' class='form-control'>
							<?php foreach($mailTypeList as $mailType){
							          echo '<option value='.$mailType['id'];
							          echo '>'.$mailType['alias'].'</option>';
							}?>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Дата внесення: </label>
						<input type='text' name='date1' class='form-control' value='<?php echo date("d.m.Y",time()); ?>' /> 
					</div>
					<div class='form-group'>
						<label class='control-label'> Коментар: </label>
						<textarea rows='12' cols='12' name='coment1' id='coment1' autocomplete="off" class='form-control'></textarea>
					</div>
										<div class='form-group'>
						<label class='control-label'> Дата закриття: </label>
						<input type='text' name='date2' class='form-control' /> 
					</div>
					<div class='form-group'>
						<label class='control-label'> Коментар: </label>
						<textarea rows='12' cols='12' name='coment2' id='coment2' autocomplete="off" class='form-control'></textarea>
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записати</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>