<?php
session_start();
include("../connection.php");
?>
<html>
<head>
<title>
Finance Staff page
</title>
<link rel="stylesheet" type="text/css" href="../setting.css">
<script type="text/javascript" src="../javascript\date_time.js"></script>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
<?php
if(isset($_SESSION['sun'])&& isset($_SESSION['spw'])&& isset($_SESSION['sfn'])&& isset($_SESSION['sln'])&& isset($_SESSION['srole']))
{
?>
<div id="container">
<table><tr><td>
<?php
    require("header.php");
?>
</td></tr><tr><td colspan="3">
<?php
    require("menufstaf.php");
?>
</td></tr>
<tr><td>
<?php
	 require("sidemenufstaf.php");
?>
	
</td><td>
	<div id="contentindex5">
	
	<?php
	//Include the PS_Pagination id
		include('ps_pagination.php');
	
	//Connect to mysql db
	$conn = mysql_connect('localhost','root','');
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db('cde', $conn);
	if(!$status) die("Failed to select database!");
?>
<form action="" method="post">
<?php
$query = mysql_query("select * from payment_table where status='yes' and unread='yes' and payment='check' and type='mexam'")
or die(mysql_error());
$coun = mysql_num_rows($query);
?>											
<a href="unreaddmexam.php"><i class="icon-check"></i><font size="4px"> UNPaid Request [&nbsp;<?php echo $coun?>&nbsp;]</font></a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="messageddmexam.php"><i class="icon-envelope-alt"></i><font size="4px"> All Paid Request</font></a>
<p align="center" style="color: #2773d8;font-family: time new romans;font-size: 17;">Number of record:<?php 
$count_item=mysql_query("select * from payment_table where status='yes' and unread='yes' and payment='checked' and type='mexam'" ) or die(mysql_error());
$count=mysql_num_rows($count_item);	
echo"<font color='red'>".($count)."</font>"; ?></p>							
									<?php
$query1 = mysql_query("select * from payment_table where status='yes' and unread='yes' and payment='checked' and type='mexam'")
or die(mysql_error());
?>

<?php	
							
$sql = "SELECT * FROM payment_table where status='yes' and unread='yes' and payment='checked' and type='mexam'";
	 
	//Create a PS_Pagination object
	$pager = new PS_Pagination($conn, $sql, 5, 1);
 	//The paginate() function returns a mysql result set for the current page
	$rs = $pager->paginate();
							
							
	$count_my_message = mysql_num_rows($query1);	
	if ($count_my_message != '0'){
?>
<table  id="resultTable" cellspacing="0" width="100%">
<tr bgcolor="#CAE8EA">
<th >No</th>
<th>Sender<br>UID</th>
<th>Name<br>Of<br>Marking</th>
<th>No_of<br>Exams<br>Marked</th>
<th>Payment<br>Per_Exam</th>
<th>Total<br>Payment<br>for_Exams</th>
</tr>
        <?php
while($row = mysql_fetch_array($rs)){	
$id=$row["no"]; 							 
	?>
<tr>
<div class="post"  id="del<?php echo $id; ?>">
<td><?php echo $row["no"]; ?></td>
<td><?php echo 'CDEO';?></td>
<td><?php echo $row["Instructors_Name"]; ?></td>
<td><?php echo $row["No_of_Exams_Marked"]; ?></td>
<td><?php echo $row["Payment_per"]; ?></td>
<td><?php echo $row["Total_Payment"]; ?></td>
</div>
											
											
	<?php }
	?>
	</tr></table>		
								</form>	
								<?php
								

	//Display the navigation
	//echo $pager->renderFullNav();
	echo '<div style="text-align:center">'.$pager->renderFullNav().'</div>';

								
								
								}else{ ?>
								<div class="alert alert-info"><i class="icon-info-sign"></i> <font size="3px">No New Request found!</div>
								<?php } ?>
									
                        <!-- /block -->
                

 

 </div></td>
	 	 <td>
	 <div id="siderightindexphoto">
	 <div id="siderightindexphoto1">
	 User Profile
	 </div>
	 
		
	 <?php
echo "<b><br><font color=blue>Welcome:</font><font color=#f9160b>(".$_SESSION['sfn']."&nbsp;&nbsp;&nbsp;".$_SESSION['sln'].")</font></b><b><br><img src='".$_SESSION['sphoto']."'width=180px height=160px></b>";
?>
<div id="sidebarr">
<ul>
 <li><a href="#.html">Change Photo</a></li>
	<li><a href="#.html">Change password</a></li>
	 </ul>
</div>
	 </div>
	 <div id="siderightindexadational">
	 <div id="siderightindexadational1">
	 Another link 
	 </div>
	 <div id="siderightindexadational12">
	 <table>
	 <tr><td><div id="facebook"></div></td><td>
	<p><a href="https://www.facebook.com/" style="text-decoration: none;">&nbsp;&nbsp;&nbsp;Facebook</a><p></td></tr>
	<tr><td><div id="twitter"></div></td><td><p><a href="https://www.twitter.com/" style="text-decoration: none;">&nbsp;&nbsp;&nbsp;Twitter</a></p></td></tr>
	<tr><td><div id="you"></div></td><td><p><a href="https://www.youtube.com/" style="text-decoration: none;">&nbsp;&nbsp;&nbsp;Youtube</a></p></td></tr>
	<tr><td><div id="googleplus"></div></td><td><p><a href="https://plus.google.com/" style="text-decoration: none;">&nbsp;&nbsp;&nbsp;Google++</a></p></td></tr></table>
	</div>
	 </div>
	  </td>
	 </tr>
	 <tr><td>
<?php
include("../footer.php");
?>
</td></tr>

</div>
</table>
<?php
}
else
header("location:../index.php");
?>
</body>
</html>