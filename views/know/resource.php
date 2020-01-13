<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<?php 
	$i = 1;
	foreach($imgbig as $imgbig){ ?>
			<div id='big_img<?php echo $i; ?>' style="position: fixed; border: 0px solid rgb(0, 0, 0); top: 0px; margin: 0; display: none;z-index: +1;">
				<img onclick="document.getElementById('big_img<?php echo $i; ?>').style.display = 'none'" src='<?php echo $imgbig['screen']; ?>' /> 
			</div>
			<?php 
			$i++;
				} ?>
	  <div id='content'>
		<div id='index-text' class='row'>

			<div class="table-responsive"> 
			<table class='table table-bordered table-condensed' id='callstable' width='65%'>
				<tr id='tablerow'>
					
					<th id='tablecol'>Пошуковий запит:</th>
					<th id='tablecol'> </th>
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
			<table class='table table-bordered table-condensed' id='callstable' width='95%'>
				<tr id='tablerow' scope="row">
					<th id='tablecol'>№ </th>
					<th id='tablecol'>Помилка</th>
					<th id='tablecol'>Опис</th>
					<th id='tablecol'>Шляхи вирішення </th>
					<th id='tablecol'>Скрін</th>
					<th id='tablecol'>Дата внесення</th>
					<th id='tablecol'></th>
				</tr>
			<?php 
			$k = 1;
			foreach($knows as $knows){ ?>
				<tr id='tablerow' scope="row">
			    	<td id='tablecol'><?php echo $k; ?></td>
			    	<td id='tablecol'><?php echo $knows['title']; ?></td>
			    	<td id='tablecol'><?php echo $knows['full']; ?> </td>
			    	<td id='tablecol'><?php echo $knows['solution']; ?> </td>
			    	<td id='screencol'>
			    		
			    		<a href='#' onClick="document.getElementById('big_img<?php echo $k; ?>').style.display = 'block'"><img width='300px' src='<?php echo $knows['screen']; ?>' /> </a></td>
			    	<td id='tablecol'><?php echo date("d.m.Y",strtotime($knows['date'])); ?></td>	
			    	
			    	<td id='tablecol'>
			    		<a href='/know/edit/<?php echo $knows['id']; ?>' title='Редактировать'><img src='/views/elements/img/edit.png' /></a>
			    		<?php if($knows['zip'] != ''){ ?>
			    		<a href='<?php echo $knows['zip']; ?>' title='Архив'><img src='/views/elements/img/doc.png' /></a>
			    		<?php } ?>
			    	 </td>
			    	
			 	<?php
				$k++;
				} ?>
				</tr>
			</table>
			</div>
		</div>
	  </div>		
	
<?php include_once HOME.'/views/elements/global/footer.php'; ?>