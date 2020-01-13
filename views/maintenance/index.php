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
        insertDate();
    	}
	});
</script>
<div id='content'>
		<div class='row'>
			<?php include_once HOME.'/views/elements/global/sideBar.php'; ?>
			<a href='/maintenance/add'>
				<button class='btn btn-warning'>Створити записи</button>
			</a>
			<a href='/maintenance/export'>
				<button class='btn btn-warning'>Експортувати в Excel</button>
			</a>
			
			<div class="table-responsive">
				<table id='stattab' border='0'>
					<tr>
						<td> Всього виїздів: <?php echo $statData['year_mntn'];?> </td>
						<td> Всього годин: <?php echo $statData['year_hours']; ?> </td>
						<td> Сумма : <?php echo $statData['year_money']; ?> </td>
						<td rowspan="2" style='text-align: center;'> Залишок згідно договору з ГТУЮ: <?php echo $statData['g_money']; ?> </td>

					</tr>
					<tr>
						<td> Всього за місяць: <?php echo $statData['month_mntn']; ?> </td>
						<td> Всього годин: <?php echo $statData['month_hours']; ?> </td>
						<td> Сумма за місяць: <?php echo $statData['month_money']; ?> </td>
						<td> </td>

					</tr>
				</table>
			</div>
			<div class="table-responsive"> 
			<table id='callstable' class='table table-bordered table-condensed' border="1">
				<form role='form' action='/maintenance/filter' method='post'>
				<tr id='tablerow'>
					<th id='tablecol'>Дата 							
							<input type="date" id='date1' value="<?php echo $date1; ?>" class='form-control' />
							<input type="date" id='date2' onblur="insertDate()" value="<?php echo $date2; ?>" class='form-control' />
							<input type="hidden" name='date' />
					</th>
					<th id='tablecol'>Тип <br> <br>
							<select class='form-control' name='client_type'>
								<option value='' selected>  --- </option>
								<option value='6,7,8,9'>за договором з ГТУЮ</option>
								<option value='3,4,5,10,11,12,13'>Платні</option>
								<option value='14,15,16,17,18'>Безкоштовні</option>
								<?php foreach($clientTypeList as $list){
									$select = '';
									if($list['id'] == $data['client_type']){ $select = 'selected'; }
								    echo '<option value='.$list['id'].' '.$select.'>'.$list['type'].'</option>';
								}?>
							</select>
						</th>
					<th id='tablecol'>Заявник <br><br>
						<input type="text" name="client" class="form-control" value='<?php echo $data['client']; ?>' />
					</th>
					<th id='tablecol'>Тип заяви</th>
					<th id='tablecol'>Виконавець <br><br>
						<select id='ingeneer' name="ingeneer" class="form-control">
							<option value='' selected>  --- </option>
								<?php foreach($user as $list){
									$select = '';
									if($list['id'] == $data['ingeneer']){ $select = 'selected'; } 
								    echo '<option value='.$list['id'].' '.$select.'>'.$list['short_name'].'</option>';
								}?>
						</select>
					</th>
					<th id='tablecol'>Місце вст. <br> <br>
						<select name="place" id='place' class="form-control">
							<option value=''> --- </option>
							<option <?php if($data['place'] == 'користувач'){echo ' selected';} ?>>користувач</option>
							<option <?php if($data['place'] == 'філія'){echo ' selected';} ?>>філія</option>
						</select>
					</th>
					<th id='tablecol'>Час згідно актів ТО</th>
					<th id='tablecol'>Сумма</th>
					<th id='tablecol'>Додатково <br><br>
						<input type="text" name="note" class="form-control" value='<?php echo $data['note']; ?>' />
					</th>
					<th id='tablecol'><br><br><input class='form-control' id='go' type='submit' value='Go' /> </th>
				</tr>
				</form>
			<?php 
			foreach($MaintenanceList as $item){ ?>
				<tr id='tablerow'>
			    	<td id='tablecol'><?php echo date("d.m.Y", strtotime($item['date'])); ?></td>
			    	<td id='tablecol'><?php echo $clientTypeList[$item['client_type']]['type']; ?></td>
			    	<td id='tablecol'><?php echo $item['client']; ?></td>
			    	<td id='tablecol'><?php echo $item['type']; ?></td>
			    	<td id='tablecol'><?php echo $user[$item['ingeneer']]['short_name']; ?></td>
			    	<td id='tablecol'><?php echo $item['place']; ?></td>
			    	<td id='tablecol'><?php echo $item['time']; ?></td>
			    	<td id='tablecol'><?php echo $item['price']; ?></td>
			    	<td id='tablecol'><?php echo $item['note']; ?></td>
			    	<td id='tablecol'>
			    		<div id='tablelink'>
			    			<div class="tablelink">
			    				<a href='/maintenance/edit/<?php echo $item['id']; ?>'>
			    					<img src="/views/elements/img/edit.png" />
			    				</a>
			    			</div>
			    			<div class="tablelink">
			    					<a href='#' onclick="if(confirm('Ви впевнені?'))location.href='/maintenance/delete/<?php echo $item['id']; ?>';"><img src="/views/elements/img/delete.png" /></a>
			    			</div>
			    		</div>
			    	</td>
			    </tr>

			<?php } ?>
			
			</table>
			</div>
			</div>
	</div>

<?php include_once HOME.'/views/elements/global/footer.php'; ?>