<!-- CuFon ends -->
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
   <script src="lib/jquery.js" type="text/javascript"></script>
  <script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
      })
    })
  </script> 

<table>
<tr><td>
  <div id="menubar1">
  
  <ul>
					<li>
						<a  href="uploadmoduleto.php">
							
							<span>Upload Prepared Module</span>
						</a>
					</li>
					<li>
						<a href="assignmentdownload.php">
							
							<span >Download submited asignment</span>
						</a>
					
</li>	
<li>
					<?php
					
					$user_id=$_SESSION['suid'];
	$sql="SELECT * FROM message WHERE M_reciever='$user_id' and status='no' ORDER BY date_sended DESC";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	if($count>='1')
	{
					?>
						<a href="usernotification.php">
							
							<span style="color: yellow">Notification[<?php echo $count; ?>] </span>
						</a>
						<?php
						}
						else
						{
						?>
						<a href="usernotification.php">
							
							<span >Notification[<?php echo $count; ?>] </span>
						</a>
						<?php
						}
						?>
</li>
					<li>
						<a href="../logout.php">
							
							<span>Log out</span>
						</a>
					</li>
					
					
					<div class="clearfix"></div>
				</ul>             
	</div>					
</td></tr></table>