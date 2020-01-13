<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
	
	  <div id='content'>
		<div class='row'>
			<?php include_once HOME.'/views/elements/global/sideBar.php'; ?>
			<form role='form' action='/user/loginScript' method='post'> 
				<?php print_r($_SESSION); ?>
				<div class='form-group'> 
					<div id='access' class=''> К сожалению у вас нет прав для данного действия </div>
				</div>
			</form>
		</div>
	</div>
	
<?php include_once HOME.'/views/elements/global/footer.php'; ?>