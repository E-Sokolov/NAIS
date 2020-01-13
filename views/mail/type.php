<?php include_once HOME.'/views/elements/global/htmlHeader.php'; ?>
<?php include_once HOME.'/views/elements/global/pageHeader.php'; ?>

	<div id='content'>
		<div class='row'>
			<a href='/mail/add'>
				<button class='btn btn-warning'>Додати запис</button>
			</a>
			<a href='/mail/export'>
				<button class='btn btn-warning'>Експортувати в Excel</button>
			</a>
			<div id='nametable'> 
			<?php echo $mailTypeList[$mailList[1]['type']]['fullname']; ?>

			<div><?php if($mailStat){?> Записів: <?php echo $mailStat; } ?> </div>
			<div class="table-responsive"> 
			<table class='table table-bordered table-condensed' id='callstable' width='95%'>
				<tr id='tablerow'>
                    <form role='form' action='/mail/filter' method='post'>
					   <th id='tablecol'>№ </th>
					   <th id='tablecol'>Організація 
                            <select class='form-control' name='orgtype'>
								<option value='' selected>  --- </option>
								<?php foreach($mailTypeList as $list){ 
									$select ='';
									if($data['orgtype'] == $list['id']){$select = 'selected';}
								    echo '<option value='.$list['id'].' '.$select.'>'.$list['alias'].'</option>';
								}?>
							</select>
                       </th>
					   <th id='tablecol'>ПІБ
                                <input class='form-control' name='fio' type='text'  value="<?php echo $data['fio']; ?>" />
                        </th>
					   <th id='tablecol'>Посада
                                <input class='form-control' name='position' type='text' value="<?php echo $data['position']; ?>" />
                        </th>
					   <th id='tablecol'>E-mail
                            <input type='text' name='email' class='form-control' value="<?php echo $data['email']; ?>" />
                       </th>
					   <th id='tablecol'>Статус
                            <select name='status' class='form-control'>
								<option value=''>---</option>
								<option <?php if($data['status'] == 'Відкрита'){ echo "selected"; } ?>>Відкрита</option>
								<option <?php if($data['status'] == 'Закрита'){ echo "selected"; } ?>>Закрита</option>
								<option <?php if($data['status'] == 'Заблокована'){ echo "selected"; } ?>>Заблокована</option>
							</select>
                       </th>
					   <th id='tablecol'>Тип
                            <select name='email_type' class='form-control'>
                                <option value=''>---</option>
                                <option <?php if($data['email_type'] == 'Персональна'){ echo "selected"; } ?>>Персональна</option>
                                <option <?php if($data['email_type'] == 'Офіційна'){ echo "selected"; } ?>>Офіційна</option>
                            </select>
                       </th>
					   <th id='tablecol'>ЄРК
                            <select name='erk' class='form-control'>
								<option value=''>---</option>
								<option <?php if($data['erk'] == 'Діє'){ echo "selected"; } ?>>Діє</option>
								<option <?php if($data['erk'] == 'Не Діє'){ echo "selected"; } ?>>Не Діє</option>
								<option <?php if($data['erk'] == 'Відсутній'){ echo "selected"; } ?>>Відсутній</option>
							</select>
                       </th>
					   <th id='tablecol'>Внесення 							
                            <select class='form-control' name='date1'>
								<option value='0' <?php if($data['date1'] == 0){ echo "selected"; } ?>> Спочатку старі</option>
								<option value='1' <?php if($data['date1'] == 1){ echo "selected"; } ?>> Спочатку нові </option>
							</select>
                        </th>
					   <th id='tablecol'>Коментар 
                            <input class='form-control' name='coment1' type='text' value="<?php echo $data['coment1']; ?>" />
                       </th>
                       <th id='tablecol'>Відключення 
                            <select class='form-control' name='date2'>
								<option value='0' <?php if($data['date2'] == 0){ echo "selected"; } ?>> Спочатку старі</option>
								<option value='1' <?php if($data['date2'] == 1){ echo "selected"; } ?>> Спочатку нові </option>
							</select>
                       </th>
			           <th id='tablecol'>Коментар 
                            <input class='form-control' name='coment2' type='text' value="<?php echo $data['coment2']; ?>"/>
                        </th>
                        <th id='tablecol'>Примітки
                        	<input class='form-control' name='note' type='text' value="<?php echo $data['note']; ?>"/>
                        </th>
					   <th id='tablecol'><br><input class='form-control' type='submit' value='Пошук' /> </th>
                    </form>
				</tr>
			<?php 
			$i = 1;
			foreach($mailList as $mailItem){ ?>
				<tr <?php if($mailItem['date2'] != '0000-00-00' AND $mailItem['date2'] != ''){ echo 'style="color: yellow; text-shadow: #FF0000 1px -2px 2px;"'; } ?>  id='tablerow mailid<?php echo $mailItem['id']; ?>'>
			    	<td id='tablecol'><?php echo $i; ?></td>
			    	<td id='tablecol'><?php echo $mailItem['client']; ?></td>
			    	<td id='tablecol'><?php echo $mailItem['fio']; ?></td>
			    	<td id='tablecol'><?php echo $mailItem['position']; ?></td>
			    	<td id='tablecol'><?php echo $mailItem['email']; ?></td>
			    	<td id='tablecol'><?php echo $mailItem['status']; ?></td>
			    	<td id='tablecol'><?php echo $mailItem['email_type']; ?></td>
			    	<td id='tablecol'><?php echo $mailItem['erk']; ?></td>
			    	<td id='tablecol'><?php if($mailItem['date1'] != '0000-00-00'){ echo date("d.m.Y", strtotime($mailItem['date1'])); } ?></td>
			    	<td id='tablecol'><?php echo $mailItem['coment1']; ?></td>
			    	<td id='tablecol'><?php if($mailItem['date2'] != '0000-00-00' AND $mailItem['date2'] != ''){ echo date("d.m.Y", strtotime($mailItem['date2'])); } ?></td>
			    	<td id='tablecol'><?php echo $mailItem['coment2']; ?></td>	
			    	<td id='tablecol'>
			    		
			    		<?php echo $mailItem['note']; ?>
			    		<div id='mailnote<?php echo $mailItem['id'];?>' class='modal_div'> 
			    			<div id='notes' class='container'>
			    		<?php 
			    		$k=0;
			    		foreach($mailItem['notes'] as $notes)
			    		{  if(!empty($notes['nid']))
			    			{ ?>
			    				<div id='nid'>
			    					<div class="row">
			    						<div class='date col-xs-2'>
			    							<?php echo $notes['date']; ?>
			    							<a href='#' onclick="if(confirm('Ви впевнені?'))location.href='/mail/deleteNote/<?php echo $notes['nid']; ?>';">
			    								<img src="/views/elements/img/delete.png" />
			    							</a> <br> <br> <br>
			    						</div>

			    						<div class='note' class='col-xs-10'>
			    							<?php echo $notes['note']; ?>
			    					
			    						</div>
			    						<div class="col-xs-2"> </div>
			    					</div>
			    			</div>
			    			<?php 
			    				}
			    				$k++;
			    			} ?>
			    			</div>
			    		<form id='addNote' role='form' method='post' action='/mail/addNote/<?php echo $mailItem['id']; ?>'>
			    			<div class='form-group'>
			    				<textarea rows='12' cols='6' name='note' id='coment2' autocomplete="off" class='form-control'></textarea>
			    			</div>
			    			<div class='form-group'>
								<button type='submit' class='btn btn-warning'>Додати</button>
							</div>
			    		</form>
			    		</div>
			    		<div id='overlay'> </div>
			    	</td>
			    	<td id='tablecol'>
			    		<div id='tablelink'>
			    				<?php if(!empty($mailItem['notes'][0]['nid']))
			    				{ ?>
			    				<div class="tablelink">
			    					<a class='open_modal' href='#mailnote<?php echo $mailItem['id'];?>' title='Усі примітки'>
			    						<img src='/views/elements/img/info.png' />
			    					</a>
			    				</div>
			    			<?php }else{ ?>
			    				<div class="tablelink">
			    					<a class='open_modal' href='#mailnote<?php echo $mailItem['id'];?>' title='Додати примітку'>
			    						<img src='/views/elements/img/add.png' />
			    					</a>
			    				</div>
			    			<?php } ?>
			    				<div class='tablelink'>
			    					<a href='/mail/edit/<?php echo $mailItem['id']; ?>' title='Редагувати'><img src='/views/elements/img/edit.png' /></a>
			    				</div>
			    				<div class='tablelink'>
			    					<a href='#' onclick="if(confirm('Ви впевнені?'))location.href='/mail/delete/<?php echo $mailItem['id']; ?>';"><img src="/views/elements/img/delete.png" /></a>
			    				</div>
			    		</div>
			    	</td>
			    	
			 <?php
				$i++;
				} ?>
				</tr>
			</table>
			</div>
			</div>
	</div>
	<?php include_once HOME.'/views/elements/global/footer.php'; ?>