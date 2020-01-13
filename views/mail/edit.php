<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>
<script type="text/javascript" src="/views/mail/autocomplete.js"></script>
	<div id='content'>
		<div class='row'>
			
				<form role='form' method='post' action='/mail/editScript'>
					<input type='hidden' value='<?php echo $mail[0]['id']; ?>' name='id' />
					<div class='form-group'>
						<label class='control-label'> Организація: </label>
						<input type='text' value='<?php echo $mail[0]['client']; ?>' name='client' id='client' autocomplete="off" class='form-control' />
					</div>
					<div class='form-group'>
						<label class='control-label'> ПІБ: </label>
						<input type='text' name='fio' id='fio' autocomplete="off" class='form-control' value='<?php echo $mail[0]['fio']; ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Посада: </label>
						<input type='text' name='position' id='position' autocomplete="off" class='form-control' value='<?php echo $mail[0]['position']; ?>' />
					</div>
					<div class='form-group' >
						<label class='control-label'> Електронна скринька: </label>
						<select name='status' class='form-control'>
							          <option>Відкрита</option>
							          <option <?php if($mail[0]['status'] == 'Закрита'){ echo 'selected'; } ?>>Закрита</option>
							          <option <?php if($mail[0]['status'] == 'Заблокована'){ echo 'selected'; } ?>>Заблокована</option>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Тип скриньки: </label>
						<select name='email_type' class='form-control'>
							          <option>Персональна</option>
							          <?php if($mail[0]['email_type'] == 'Офіційна'){ ?><option selected>Офіційна</option> <?php }else{ ?>
							          <option>Офіційна</option> <?php } ?>
						</select>
					</div>
					<div class='form-group' >
						<label class='control-label'> Згідно ЕРК: </label>
						<select name='erk' class='form-control'>
							          <option <?php if($mail[0]['erk'] == 'Діє'){ echo 'selected'; } ?>>Діє</option>
							          <option <?php if($mail[0]['erk'] == 'Не діє'){ echo 'selected'; } ?>>Не діє</option>
							          <option <?php if($mail[0]['erk'] == 'Відсутній'){ echo 'selected'; } ?>>Відсутній</option>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> E-Mail: </label>
						<input type='email' name='email' class='form-control' value='<?php echo $mail[0]['email']; ?>' />
					</div>
					<div class='form-group' >
						<label class='control-label'> Тип организації: </label>
						<select name='orgtype' class='form-control'>
							<?php foreach($mailTypeList as $mailType){

							          echo '<option value='.$mailType['id'];
							          if($mailType['id'] == $mail[0]['orgtype']){ 
							              echo ' selected';
							          }
							          echo '>'.$mailType['alias'].'</option>';
							}?>
						</select>
					</div>
					<div class='form-group'>
						<label class='control-label'> Дата внесення: </label>
						<input type='text' name='date1' class='form-control' value='<?php if($mail[0]['date1'] !='0000-00-00'){ echo date("d.m.Y", strtotime($mail[0]['date1'])); } ?>'  />
					</div>
					<div class='form-group'>
						<label class='control-label'> Коментар: </label>
						<textarea rows='12' cols='12' name='coment1' id='coment1' autocomplete="off" class='form-control'> <?php echo $mail[0]['coment1']; ?></textarea>
					</div>
										<div class='form-group'>
						<label class='control-label'> Дата закрыття: </label>
						<input type='text' name='date2' class='form-control' value= '<?php if($mail[0]['date2'] !='0000-00-00'){ echo date("d.m.Y", strtotime($mail[0]['date2'])); } ?>' />
					</div>
					<div class='form-group'>
						<label class='control-label'> Коментар: </label>
						<textarea rows='12' cols='12' name='coment2' id='coment2' autocomplete="off" class='form-control'> <?php echo $mail[0]['coment2']; ?></textarea>
					</div>
					<div class='form-group'>
						<button type='submit' class='btn btn-warning'>Записати</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>