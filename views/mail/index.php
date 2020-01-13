<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>

	<div id='content'>
		<div class='row'>
			<?php include_once HOME.'/views/elements/global/sideBar.php'; ?>
			<a href='/mail/add'>
				<button class='btn btn-warning'>Додати запис</button>
			</a>
			<a href='/mail/export'>
				<button class='btn btn-warning'>Експортувати в Excel</button>
			</a>
<div class="table-responsive"> 
			<table class='table table-bordered table-condensed' id='callstable' width='95%'>
				<tr id='tablerow'>
					
					<th id='tablecol'>Фільтр по типу организації:</th>
					<th id='tablecol'>По Прізвищу:</th>
					<th id='tablecol'>Електронна скринька:</th>
					<th id='tablecol'>По E-mail:</th>
                    <th id='tablecol'>По типу </th>
					<th id='tablecol'>Згідно ЕРК:</th>
					<th id='tablecol'>Сортування по даті: </th>
					<th id='tablecol'> </th>
				</tr>
				<tr id='tablerow'>
					<form role='form' action='/mail/filter' method='post'>
						<td id='tablecol'>
							<select class='form-control' name='orgtype'>
								<option value='' selected>  --- </option>
								<?php foreach($mailTypeList as $list){ 
								    echo '<option value='.$list['id'].'>'.$list['alias'].'</option>';
								}?>
							</select>
						</td>
						<td id='tablecol'>
							<input class='form-control' name='fio' type='text' />
						</td>
						<td id='tablecol'>
							<select name='status' class='form-control'>
								<option value=''>---</option>
								<option>Відкрита</option>
								<option>Закрита</option>
								<option>Заблокована</option>
							</select>
						</td>						
						<td id='tablecol'>
							<input type='text' name='email' class='form-control' />
						</td>
                        <td id='tablecol'>
                            <select name='email_type' class='form-control'>
                                <option value=''>---</option>
                                <option>Персональна</option>
                                <option>Офіційна</option>
                            </select>
                        </td>
						<td id='tablecol'>
							<select name='erk' class='form-control'>
								<option value=''>---</option>
								<option>Діє</option>
								<option>Не Діє</option>
								<option>Відсутній</option>
							</select>
						</td>	
						<td id='tablecol'>
							<select class='form-control' name='date1'>
								<option value='0'> Спочатку старі</option>
								<option value='1' selected> Спочатку нові </option>
							</select>
						</td>					
						<td id='tablecol'>
							<input class='form-control' type='submit' value='Пошук' /> 
						</td>
					</form>
				</tr>
			</table>
			</div>
			<div class="table-responsive"> 
			<table id='callstable' width='95%'>
				<tr id='tablerow'>
					<th id='tablecol'>№ </th>
					
					<th id='tablecol'> Тип организації</th>
				</tr>
			<?php 
			foreach($mailTypeList as $mailItem){ ?>
				<tr onclick="location.href='/mail/type/<?php echo $mailItem['id']; ?>' " id='tablerow'>
			    	<td id='tablecol'><?php echo $mailItem['id']; ?></td>
			    	<td id='tablecol'><?php echo $mailItem['fullname']; ?></td>
			<?php } ?>
			</table>
			</div>
			</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>
