<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript">
	function insertDate(){
		var date1 = $('#date01').val();
		var date2 = $('#date02').val();
		if(date1 != ''){
					var date = date1+'//'+date2;
				}
		$('input[name="date1"]').val(date);
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
			<a href='/gauth/add'>
				<button class='btn btn-warning'>Створити записи</button>
			</a>
			
			<div class="table-responsive"> 
			<table id='callstable' class='table table-bordered table-condensed' border="1">
				<form role='form' action='/gauth/filter' method='post'>
				<tr id='tablerow'>
					<th id='tablecol'>Дата 							
							<input type="date" id='date01' value="<?php echo $date1; ?>" class='form-control' />
							<input type="date" id='date02' onblur="insertDate()" value="<?php echo $date2; ?>" class='form-control' />
							<input type="hidden" name='date1' />
					</th>
					<th id='tablecol'>Заявник <br> <br>
						<input type="text" name="client" class="form-control" value='<?php echo $data['client']; ?>' />
					</th>
					<th id='tablecol'>Ім'я<br><br>
						<input type="text" name="name" class="form-control" value='<?php echo $data['name']; ?>' />
					</th>
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
					<th id='tablecol'> Дата видачі </th>
					<th id='tablecol'>Додатково <br><br>
						<input type="text" name="coment" class="form-control" value='<?php echo $data['coment']; ?>' />
					</th>
					<th id='tablecol'><br><br><input class='form-control' id='go' type='submit' value='Go' /> </th>
				</tr>
				</form>
			<?php 
			foreach($Gautharr as $item){ ?>
				<tr id='tablerow'>
			    	<td id='tablecol'><?php echo date("d.m.Y (H:i)", strtotime($item['date1'])); ?></td>
			    	<td id='tablecol'><?php echo $item['client']; ?></td>
			    	<td id='tablecol'><?php echo $item['name']; ?></td>
			    	<td id='tablecol'><?php echo $user[$item['ingeneer']]['short_name'];?> </td>
			    	<td id='tablecol'><?php echo date("d.m.Y (H:i)", strtotime($item['date2'])); ?></td>
			    	<td id='tablecol'><?php echo $item['coment']; ?></td>
			    	<td id='tablecol'>
			    		<div id='tablelink'>
			    			<div class="tablelink">
			    				<a href='/gauth/edit/<?php echo $item['id']; ?>'>
			    					<img src="/views/elements/img/edit.png" />
			    				</a>
			    			</div>
			    			<div class="tablelink">
			    					<a href='#' onclick="if(confirm('Ви впевнені?'))location.href='/gauth/delete/<?php echo $item['id']; ?>';"><img src="/views/elements/img/delete.png" /></a>
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