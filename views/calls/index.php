<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript">
	function insertDate(){
		var date1 = $('#date1').val();
		var date2 = $('#date2').val();
		if(date1 != ''){
			var date = date1+'//'+date2;
		}
		$('input[name="date"]').val(date);
	}
	$(document).on('click','#go', function(){
		insertDate();
		$('#go').submit();
	});
	$(document).on('keypress',function(e) {
    	if(e.which == 13) {
    		alert(date);
       		insertDate();
    	}
	});
</script>
	<div id='content'>
		<div class='row'>
			<?php include_once HOME.'/views/elements/global/sideBar.php'; ?>
			<a href='/calls/add'>
				<button class='btn btn-warning'>Створити записи</button>
			</a>
			<a href='/calls/export'>
				<button class='btn btn-warning'>Експортувати в Excel</button>
			</a>
			<div class="table-responsive">
				<table id='stattab' border='0'>
					<tr>
						<td> Всього записів: <?php echo $statData['all'];?> </td>
						<td> За поточний місяць: <?php echo $statData['month'] ?> </td>
					</tr>
				</table>
			</div>
			<div class="table-responsive"> 
			<table id='callstable' class='table table-bordered table-condensed' border="1">
				<form role='form' action='/calls/filter' method='post'>
					<tr id='tablerow'>   
						<th id='tablecol'>Дата звернення 
							<input type="date" style="width: 150px !important" id='date1' value="<?php echo $date1; ?>" class='form-control' />
							<input type="date" style="width: 150px !important" id='date2' onblur="insertDate()" value="<?php echo $date2; ?>" class='form-control' />
							<input type="hidden" name='date' />
						</th>
						<th id='tablecol'>Тип 
							<select class='form-control' name='client_type'>
								<option value='' selected>  --- </option>
								<?php foreach($clientTypeList as $list){ 
									$select = '';
									if($list['id'] == $data['client_type']){ $select = 'selected';}
								    echo '<option value='.$list['id'].' '.$select.'>'.$list['type'].'</option>';
								}?>
							</select>
						</th>
						<th id='tablecol'>Заявник 
							<input type="text" name="client" class="form-control" value='<?php echo $data['client']; ?>' />
						</th>
						<th id='tablecol'>ПІБ Заявника 
							<input type="text" name="fio" class="form-control" <?php echo $data['fio']; ?> />
						</th>
						<th id='tablecol'>Реєстр
							<select class='form-control' name='resource'>
								<option value='' selected>  --- </option>
								<?php foreach($resource as $list){ 
									$select = '';
									if($data['resource'] == $list['id']){ $select = 'selected';}
								    echo '<option value='.$list['id'].' '.$select.'>'.$list['resource'].'</option>';
								}?>
							</select>
						</th>
						<th id='tablecol'>Опис
							<input type="text" name="description" class="form-control" value='<?php echo $data['description']; ?>' />
						</th>
						<th id='tablecol'>Що зроблено
							<input type="text" name="what_to_do" class="form-control" value='<?php echo $data['what_to_do']; ?>' />
						</th>
						<th id='tablecol'>Виконавець 
							<select class='form-control' name='ingeneer'>
								<option value='' selected>  --- </option>
								<?php foreach($user as $list){ 
									$select = '';
									if($data['ingeneer'] == $list['id']){ $select = 'selected';}
								    echo '<option value='.$list['id'].' '.$select.'>'.$list['short_name'].'</option>';
								}?>
							</select>
						</th>
						<th id='tablecol'>Виклик
							<select class='form-control' name='service'>
								<option value='' selected>  --- </option>
								<option <?php if($data['service'] == 'Так'){ echo "selected"; } ?>>Так</option>
								<option <?php if($data['service'] == 'Ні'){ echo "selected"; } ?>>Ні</option>
							</select>
						</th>
						<th id='tablecol'>Відр.
							<select class='form-control' name='trip'>
								<option value='' selected>  --- </option>
								<option <?php if($data['trip'] == 'Так'){ echo "selected"; } ?>>Так</option>
								<option <?php if($data['trip'] == 'Ні'){ echo "selected"; } ?>>Ні</option>
							</select>
						</th>
						<th id='tablecol'>Дата вирішення </th>
						<th id='tablecol'>Додатково
							<input type="text" name="etc_data" class="form-control" value="<?php echo $data['etc_data']; ?>" />
						</th>
						<th>
							<input type='checkbox' name='status' value="0" title="только актуальные" /> 
							<input class='form-control' type='submit' id='go' value='Go' /> </th>
					</tr>
				</form>
			<?php 
			foreach($callsList as $callItem){ ?>
				<tr id='tablerow' <?php if($callItem['status'] == 0){?> style="color: yellow; text-shadow: #FF0000 1px -2px 2px;" <?php } ?>  >
			    	<td id='tablecol'><?php echo $callItem['date']; ?>(<?php echo date('H:i', strtotime($callItem['time'])); ?>)</td>
			    	<td id='tablecol'><?php echo $clientTypeList[$callItem['client_type']]['type']; ?></td>
			    	<td id='tablecol'><?php echo $callItem['client']; ?></td>
			    	<td id='tablecol'><?php echo $callItem['fio']; ?></td>
			    	<td id='tablecol'><?php echo $resource[$callItem['resource']]['resource']; ?></td>
			    	<td id='tablecol'><?php echo $callItem['description']; ?></td>
			    	<td id='tablecol'><?php echo $callItem['what_to_do']; ?></td>
			    	<td id='tablecol'><?php echo $user[$callItem['ingeneer']]['short_name']; ?></td>
			    	<td id='tablecol'><?php echo $callItem['service']; ?></td>
			    	<td id='tablecol'><?php echo $callItem['trip']; ?></td>
			    	<td id='tablecol'><?php if($callItem['date_success'] != Null){ echo date("d.m.Y (H:i)", strtotime($callItem['date_success']));} ?></td>
			    	<td id='tablecol'><?php echo $callItem['etc_data']; ?></td>
			    	<td id='tablecol'>
			    		<div id='oneline'>
			    			<a href='/calls/edit/<?php echo $callItem['id']; ?>' title='Редагувати'>
			    				<img src='/views/elements/img/edit.png' />
			    			</a>
			    			<a href='/calls/add/<?php echo $callItem['id']; ?>' title='Копіювати'>
			    				<img src='/views/elements/img/copy.png' />
			    			</a>
			    			<a onclick="if(confirm('Ви впевнені?'))location.href='/calls/delete/<?php echo $callItem['id']; ?>';" title='Видалити'>
			    				<img src='/views/elements/img/delete.png' />
			    			</a>
			    		</div>
			    	</td>
			    </tr>
			<?php } ?>
			
			</table>
			</div>
			</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>