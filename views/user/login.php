<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
	
	  <div id='content'>
		<div class='row'>
			<?php include_once HOME.'/views/elements/global/sideBar.php'; ?>
			<form role='form' action='/user/loginScript' method='post'> 
				<?php print_r($_SESSION); ?>
				<div class='form-group'> 
					<label class='control-label'> Логин: </label>
					<input class='form-control' name='login' type='text' /> 
					<label class='control-label'>Пароль: </label>
					<input class='form-control' name='pass' type='password' />
					<br>
					<input class='form-control btn btn-warning' type='submit' value='Войти' /> 
				</div>
			</form>
		</div>
	</div>
	
<?php include_once HOME.'/views/elements/global/footer.php'; ?>