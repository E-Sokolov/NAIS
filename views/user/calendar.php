 <?php //include HOME.'/views/elements/global/htmlHeder.php'; ?>
 <div id='jqdownload'>
  <div class="container">
    <table class="cal">
      <caption>
        <span class="prev"><a href="#" onclick="showCalendar('<?php echo $calendar['month_prev']; ?>')"><</a></span>
        <span class="next"><a href="#" onclick="showCalendar('<?php echo $calendar['month_next']; ?>')">></a></span>
        <?php 
        $months = array(1 => $lang[29],$lang[30],$lang[31],$lang[32],$lang[33],$lang[34],$lang[35],$lang[36],$lang[37],$lang[38],$lang[39],$lang[40]);
        echo $months[$calendar['month_now']];  ?>
      </caption>
      <thead>
        <tr>
          <th>ПН</th>
          <th>ВТ</th>
          <th>СР</th>
          <th>ЧТ</th>
          <th>ПТ</th>
          <th>СБ</th>
          <th>НД</th>
        </tr>
      </thead>
      <tbody>
      	<?php 
      	for($i=0;$i<=4;$i++)
      	{?> 
      		<tr>
      			<?php
      			for ($k=1; $k<=7; $k++) 
      				{ ?>
      					<td>
      					<?php if(isset($calendar['birthday'][$calendar[$i][$k]]))
      						{ ?>
      							<a href="#modal<?php echo $calendar[$i][$k]; ?>" class="open_modal birthdate"
      						<?php }else{ ?>
      								<a href="#"
      						<?php } ?>
      						 <?php if($calendar[$i][$k] == '_')
      						 { echo "class='off'"; }
      							
      					if($calendar[$i][$k] == date('d', time()) AND $calendar['month_now'] == date('m',time())){ echo "class='current'";} ?>>
      					<?php echo $calendar[$i][$k]; ?> </a>
      				</td>
      			<?php } ?>
      		</tr>
      	<?php }
      	?>                
      </tbody>
    </table>
  </div>

        <div id='cal_modal'>
  	     <?php 
  	     for($i=0;$i<=4;$i++)
  	     {
  	     	for ($k=1; $k<=7; $k++) 
  	     	{
  	     		if (isset($calendar['birthday'][$calendar[$i][$k]]))
      				{ ?>
      						<div id='modal<?php echo $calendar[$i][$k]; ?>' class='modal_div'>
      							<div id='birthtitle'>В цей день народились: </div>
      							<?php for($a=0;$a<count($calendar['birthday'][$calendar[$i][$k]]);$a++){ ?>
      								<span class='modal_close'>X</span>
      								<div class='name'>
      								<a href='/profile/user/<?php echo $calendar['birthday'][$calendar[$i][$k]][$a][0]; ?>'>
      									<?php echo $calendar['birthday'][$calendar[$i][$k]][$a][1]; ?></a>
      								
                      <?php 
                         $birthdayrArr = explode(',',date("m,j,Y",strtotime($calendar['birthday'][$calendar[$i][$k]][$a][2])));
                         $birthdayr = mktime(0,0,0,$birthdayrArr[0],$birthdayrArr[1],$birthdayrArr[2]);
                         $thisday = mktime(0,0,0,$calendar['month_now'],$calendar[$i][$k],date('Y'));
                         $yold = round(($thisday - $birthdayr)/31536000);
                      ?>
                      (<?php echo $yold; ?> років(-и) )
                      </div>
                      <div class='yold'>
                          
                      </div>
      								<div class='position'> 
      									<?php echo $calendar['birthday'][$calendar[$i][$k]][$a][3]; ?>
      								</div>
      							<?php }  ?>
      							
      						</div>
      			<?php } 
      		}
      	 } ?>
        </div>
  <div id='overlay'> </div>
</div>