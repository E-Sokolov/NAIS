<?php include HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include HOME.'/views/elements/global/pageHeader.php'; ?>

<div id='content' class='container'>
	
<div id="main">


 <div class="row" id="real-estates-detail">
 	<div class="col-lg-4 col-md-4 col-xs-12">
 		<div class="panel panel-default">
 			<div class="panel-heading">
				 <header class="panel-title">
 					<div class="text-center">
 						<strong></strong>
 					</div>
 				 </header>
			</div>
 			<div class="panel-body">
 				<div class="text-center" id="author">
 					<img src="/views/elements/img/profile/<?php if($user['avatar']){ echo $user['avatar'];}else{echo "profile.png";} ?>">
 					<h3><?php echo $user['full_name']; ?></h3>
 					<small class="label label-warning"><?php echo $user['position']; ?></small>
 					<p></p>
 					<p class="sosmed-author">
 					</p>
 				</div>
 			</div>
 		</div>
 	</div>
 	<div class="col-lg-8 col-md-8 col-xs-12">
 		<div class="panel">
 			<div class="panel-body">
 				<!--
 			<ul id="myTab" class="nav nav-pills">
 				<li class="active"><a href="#detail" data-toggle="tab">О пользователе</a></li>
 				<li class=""><a href="#contact" data-toggle="tab">Отправить сообщение</a></li>
 			</ul>
 		-->
 			<a href='/profile/edit/<?php echo $user['id']; ?>'>
				<button class='btn btn-warning'>Редагувати</button>
			</a>
 		<div id="myTabContent" class="tab-content">
			<hr>
 				<div class="tab-pane fade active in" id="detail">
 					<h4>Загальна інформація</h4>
 						<table class="table table-th-block">
 							<tbody>
 								<tr><td >Дата народження:</td><td><?php echo date("d.m.Y", strtotime($user['birthday'])); ?></td></tr>
 								<tr><td >Дата прийому на роботу:</td><td><?php echo date("d.m.Y", strtotime($user['jobday'])); ?></td></tr>
 								<tr><td>Email:</td><td><?php echo $user['email']; ?></td></tr>
 								<tr><td>Телефон:</td><td><?php echo $user['phone']; ?></td></tr>
 								<tr><td>Внутрішній телефон:</td><td><?php echo $user['vphone']; ?></td></tr>
							</tbody>
 						</table>
				</div>
 				
 			</div>
 		</div>
	 </div>
 </div>
 </div>
</div>

</div>

</div>

<?php include HOME.'/views/elements/global/footer.php'; ?>