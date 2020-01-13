<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
	
	  <div id='content'>
		<div id='index-text' class='row'>

			<div class="row">
				<a href='/know/add'>
					<button class='btn btn-warning'>Добавить запись</button>
				</a>
			</div>
			<div class="table-responsive"> 
			<table class='table table-bordered table-condensed' id='callstable' width='95%'>
				<tr id='tablerow'>
					
					<th id='tablecol'>Пошуковий запит:</th>
					<th id='tablecol'></th>
				</tr>
				<tr id='tablerow'>
					<form role='form' action='/know/filter' method='post'>
						<td id='tablecol'>
							<input class='form-control' name='sq' type='text' />
						</td>		
						<td id='tablecol'> 
							<input class='form-control' type='submit' value='Go' /> 
						</td>
					</form>
				</tr>
			</table>
			</div>
			<div class="table-responsive"> 
				<table border="1" id='callstable' class='table table-bordered table-condensed' width='500px'>
				<?php  foreach($resource as $resource){ ?>
					<tr id='tablerow'>
						<td id='tablecol' onclick="document.location.href='/know/resource/<?php echo $resource['id']; ?>'"><?php echo $resource['title']; ?></td>
					</tr>
				<?php } ?>
				</table>
			</div>
	  </div>		
	
<?php include_once HOME.'/views/elements/global/footer.php'; ?>