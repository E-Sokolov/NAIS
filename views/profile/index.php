<?php include HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include HOME.'/views/elements/global/pageHeader.php'; ?>
<div id='content'>
		<div class='row'>
			<a href='/profile/add'>
				<button class='btn btn-warning'>Додати</button>
			</a>
			
			<div class="table-responsive"> 
			<table id='callstable' class='table table-bordered table-condensed' border="1">
				<tr id='tablerow'>
					<th colspan='2' id='tablecol'> Адміністрація </th>
				</tr>
			<?php 
			foreach($profileListAdm as $item){ ?>
				<tr onclick="location.href='/profile/user/<?php echo $item['id']; ?>' " id='tablerow'>
			    	<td id='tablecol'><?php echo $item['full_name']; ?></td>
			    	<td id='tablecol'>
			    	<div align='left' class="col-xs-10"><?php echo $item['position']; ?></div>
			    	<div align='right' class="col-xs-2"><?php if($item['id'] == $birthday['month'][$item['id']]['id']){ echo date("d.m", strtotime($birthday['month'][$item['id']]['birthday'])); } ?> </div></td>
			    </tr>
			<?php } ?>
			<tr id='tablerow'>
					<th colspan='2' id='tablecol'> Відділ супроводження інформаційних систем</th>
				</tr>
			<?php 
			foreach($profileListInf as $item){ ?>
				<tr onclick="location.href='/profile/user/<?php echo $item['id']; ?>' " id='tablerow'>
			    	<td id='tablecol'><?php echo $item['full_name']; ?></td>
			    	<td id='tablecol'>
			    	<div align='left' class="col-xs-10"><?php echo $item['position']; ?></div>
			    	<div align='right' class="col-xs-2"><?php if($item['id'] == $birthday['month'][$item['id']]['id']){  echo date("d.m", strtotime($birthday['month'][$item['id']]['birthday'])); } ?> </div></td>
			    </tr>
			<?php } ?>
				<tr id='tablerow'>
					<th colspan='2' id='tablecol'> Відділ технічної підтримки інформаційних систем </th>
				</tr>
			<?php 
			foreach($profileListEcp as $item){ ?>
				<tr onclick="location.href='/profile/user/<?php echo $item['id']; ?>' " id='tablerow'>
			    	<td id='tablecol'><?php echo $item['full_name']; ?></td>
			    	<td id='tablecol'><div align='left' class="col-xs-10"><?php echo $item['position']; ?></div>
			    	<div align='right' class="col-xs-2"><?php if($item['id'] == $birthday['month'][$item['id']]['id']){ echo date("d.m", strtotime($birthday['month'][$item['id']]['birthday'])); } ?> </div></td>
			    </tr>
			<?php } ?>
			<?php 
			foreach($profileListIng as $item){ ?>
				<tr onclick="location.href='/profile/user/<?php echo $item['id']; ?>' " id='tablerow'>
			    	<td id='tablecol'><?php echo $item['full_name']; ?></td>
			    	<td id='tablecol'><div align='left' class="col-xs-10"><?php echo $item['position']; ?></div>
			    	<div align='right' class="col-xs-2"><?php if($item['id'] == $birthday['month'][$item['id']]['id']){ echo date("d.m", strtotime($birthday['month'][$item['id']]['birthday'])); } ?> </div></td>
			    </tr>
			<?php } ?>
			</table>
			</div>
			</div>
	</div>
<?php include HOME.'/views/elements/global/footer.php'; ?>