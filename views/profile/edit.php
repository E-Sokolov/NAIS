<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script>
	function insertValue(){
		var defaultVal = '<?php echo $user['level_access']; ?>';
		var defaultArr = defaultVal.split('');
		$('input:radio[name="radio0"][value="'+defaultArr[0]+'"]').attr('checked','checked');
		$('input:radio[name="radio2"][value="'+defaultArr[2]+'"]').attr('checked','checked');
		$('input:radio[name="radio3"][value="'+defaultArr[3]+'"]').attr('checked','checked');
		$('input:radio[name="radio4"][value="'+defaultArr[4]+'"]').attr('checked','checked');
		$('input:radio[name="radio5"][value="'+defaultArr[5]+'"]').attr('checked','checked');
		$('input:radio[name="radio6"][value="'+defaultArr[6]+'"]').attr('checked','checked');
		//alert(rad);
	}
	function displayVal(){
		var callsVal = $('input[name="radio0"]:checked').val();
		var contractVal = '2';
		var mailVal = $('input[name="radio2"]:checked').val();
		var knowVal = $('input[name="radio3"]:checked').val();
		var maintenanceVal = $('input[name="radio4"]:checked').val();
		var profileVal = $('input[name="radio5"]:checked').val();
		var gauthVal = $('input[name="radio6"]:checked').val();
		var strVal = callsVal+contractVal+mailVal+knowVal+maintenanceVal+profileVal+gauthVal;
		$('#level_access').val(strVal);
	}
	$(function() {
    $('input:radio').on('click', displayVal);
	})
	setTimeout(insertValue, 1000);
</script>
	<div id='content'>
		<div class='row'>
			
				<form role='form' method='post' action='/profile/editScript'>
					<input type='hidden' name='id' value='<?php echo $user['id']; ?>' />
					<div class='form-group'>
						<label class='control-label'> Ім`я та ініціали: </label>
						<input type='text' name='short_name' id='short_name' autocomplete="off" class='form-control' value='<?php echo $user['short_name']; ?>' required />
					</div>
					<div class='form-group'>
						<label class='control-label'> ПІБ: </label>
						<input type='text' name='full_name' id='full_name' autocomplete="off" class='form-control' value='<?php echo $user['full_name']; ?>' required/>
					</div>
					<div class='form-group'>
						<label class='control-label'> Дата народження: </label>
						<input type='date' name='birthday' class='form-control' value='<?php echo $user['birthday'];?>' >
					</div>
					<div class='form-group'>
						<label class='control-label'> Дата прийому на роботу: </label>
						<input type='date' name='jobday' value='<?php echo $user['jobday']; ?>' class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Доступ: </label>
						<input type='text' name='level_access' id='level_access' autocomplete="off" class='form-control' value='<?php echo $user['level_access']; ?>'  required/>
					</div>
					<div id='radio1'>
						<table width="100%">
							<th> </th>
							<th> Звернення </th>
							<th> Пошта </th>
							<th> FAQ</th>
							<th> Виклики </th>
							<th> Співробітники </th>
							<th> Ідентифікація</th>
							<tr>
								<th> Admin </th>
								<td><input type="radio" name="radio0" value='0'></td>
								<td><input type="radio" name="radio2" value='0'></td>	
								<td><input type="radio" name="radio3" value='0'></td>
								<td><input type="radio" name="radio4" value='0'></td>
								<td><input type="radio" name="radio5" value='0'></td>
								<td><input type="radio" name="radio6" value='0'></td>
							</tr>
							<tr>
								<th> Read</th>
								<td><input type="radio" name="radio0" value='1'></td>
								<td><input type="radio" name="radio2" value='1'></td>	
								<td><input type="radio" name="radio3" value='1'></td>
								<td><input type="radio" name="radio4" value='1'></td>
								<td><input type="radio" name="radio5" value='1'></td>
								<td><input type="radio" name="radio6" value='1'></td>
							</tr>
							<tr>
								<th> Denied </th>
								<td><input type="radio" name="radio0" value='2' checked></td>
								<td><input type="radio" name="radio2" value='2' checked></td>	
								<td><input type="radio" name="radio3" value='2' checked></td>
								<td><input type="radio" name="radio4" value='2' checked></td>
								<td><input type="radio" name="radio5" value='2' checked></td>
								<td><input type="radio" name="radio6" value='2' checked></td>
							</tr>
						</table>
					</div>
					<div class='form-group'>
						<label class='control-label'> Посада: </label>
						<input type='text' name='position' id='position' autocomplete="off" class='form-control' value='<?php echo $user['position']; ?>' required/>
					</div>
					<div class='form-group'>
						<label class='control-label'> E-mail: </label>
						<input type='email' name='email' id='email' autocomplete="off" class='form-control' value='<?php echo $user['email']; ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Телефон: </label>
						<input type='tel' name='phone' id='phone' autocomplete="off" class='form-control' value='<?php echo $user['phone']; ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Внутрішній телефон: </label>
						<input type='number' name='vphone' id='vphone' autocomplete="off" class='form-control' value='<?php echo $user['vphone']; ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Тип посади: </label>
						<select class='form-control' name="dep">
							<option value='ing' <?php if($user['dep'] == 'ing'){ echo 'selected';} ?>>Інженер</option>
							<option value='adm' <?php if($user['dep'] == 'adm'){ echo 'selected';} ?>>Адміністрація</option>
							<option value='ecp' <?php if($user['dep'] == 'ecp'){ echo 'selected';} ?>>Інженер ЕЦП</option>
							<option value='inf' <?php if($user['dep'] == 'inf'){ echo 'selected';} ?>>Адміністратор</option>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Логін: </label>
						<input type='text' name='login' id='login' autocomplete="off" class='form-control'  value='<?php echo $user['login']; ?>' required/>
					</div>
					<div class='form-group'>
						<label class='control-label'> Пароль: </label>
						<input type='password' name='pass' id='pass' autocomplete="off" class='form-control'/>
					</div>
					<div class='form-group'>
						<label class='control-label'> Мова: </label>
						<select class='form-control' name="lang">
							<option value='RU' <?php if($user['lang'] == 'RU'){ echo 'selected';} ?>>Русский</option>
							<option value='UA' <?php if($user['lang'] == 'UA'){ echo 'selected';} ?>>Українська</option>	
						</select>
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записати</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>