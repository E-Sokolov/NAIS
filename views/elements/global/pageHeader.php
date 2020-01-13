<body>
	<div id='header'>
			 <div class='row'> 
				<div id='logo' class='col-xs-3'>
					<img src='https://nais.gov.ua/design/css/img/logo.svg' width='100px' />
				</div> 
				<div id='logo-text' class='col-xs-6'> <?php echo $lang[1]; ?></div>	
				
				<div id='calendar' class='col-xs-2'>
<!-- calendar -->	
<script type="text/javascript"> showCalendar('<?php echo date('m',mktime(0,0,0,date('m',time())+1,0,date('Y',time()))); ?>');</script>
<div id='jqdownload'> </div>
	<!-- /calendar -->	
				</div>
				
			</div>
				<div class='row'>
					<div class='col-xs-2'>
						<div class="clock">
 							 <div id="Date"></div>
 							     <ul>
 							         <li id="hrs"></li>
  							        <li id="col">:</li>
 							         <li id="min"></li>
   							       <li id="col">:</li>
  							        <li id="sec"></li>
  							    </ul>
 							</div>
 							
 							
					</div>
					
					<div class='col-xs-10'>
						<div id='headerbar'>
							<div class='btn btn-group'>
								<div id='headerbt' class='col-xs-2'>
								</div>
								<div id='headerbt' class='col-xs-2'>
									<button id='headerbt' class='btn btn-warning button-block' onclick="document.location.href='/'"><?php echo $lang[22]; ?></button>
								</div>
								<div id='headerbt' class='col-xs-2'>
									<button id='headerbt' class='btn btn-warning button-block' onclick="document.location.href='/calls'"><?php echo $lang[23]; ?></button>
								</div>
								<div id='headerbt' class='col-xs-2'>
									<button id='headerbt' class='btn btn-warning button-block' onclick="document.location.href='/mail'"><?php echo $lang[25]; ?></button>
								</div>
								<div id='headerbt' class='col-xs-2'>
									<button id='headerbt' class='btn btn-warning button-block' onclick="document.location.href='/maintenance'"><?php echo $lang[26]; ?></button>
								</div>
								<div id='headerbt' class='col-xs-2'>
									<button id='headerbt' class='btn btn-warning button-block' onclick="document.location.href='/know'"><?php echo $lang[28]; ?></button>
								</div>

							</div>
						</div>
					</div>
			  	</div>
	</div>
	<?php 
		if($_SESSION['auth'] == '1'){ ?>
		<div id='userbar' class='row'> 
			<?php echo $lang[27]; ?> <b> <?php echo $_SESSION['full_name'];   ?> <a href='/user/logout'> [вихід]</a> </b>
		</div>
		<?php }  ?>