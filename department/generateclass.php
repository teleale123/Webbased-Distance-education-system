<?php
session_start();
include("../connection.php");
?>
<html>
<head>
<title>
Department head page
</title>
<link rel="stylesheet" type="text/css" href="../setting.css">
<script type="text/javascript" src="../javascript\date_time.js"></script>
<style>
a.two:link {color:#0b3ff2;text-decoration: none;}
a.two:visited {color:#0000ff;}
a.two:hover {font-size:100%;text-decoration: underline;color: #ed1c16;background-color: cyana;font-size: 20px;}
</style>
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
    require("menudepthead.php");
?>
</td></tr>
<tr><td>
<?php
	 require("sidemenudepthead.php");
?>
	
</td><td>
	<div id="contentindex5">
<?php
$dept=$_SESSION['sdc'];
$result1 = mysql_query("SELECT * FROM department where Dcode='$dept'");
$row = mysql_fetch_array($result1);
$dcode=$row['DName'];
$uid=$_SESSION['suid'];
?>
<?php
		include('ps_pagination.php');
	$conn = mysql_connect('localhost','root','');
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db('cde', $conn);
	if(!$status) die("Failed to select database!");
?>
<form action="" method="post">
<table><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="auto" align="center"><?php
echo'<a class="two" href="sectiongenerate.php?id='.$dcode.'">Arrange Class For All Student</a><br>';
?></td><td>

</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td></tr></table>
<p align="left" style="color: #2773d8;font-family: time new romans;font-size: 17;">Total Number of record:<?php 
$count_item=mysql_query("select * from student where Department='$dcode' and year='1st' and semister='I'") or die(mysql_error());
$i=0;
while($row1 = mysql_fetch_array($count_item)){
$id=$row1["S_ID"]; 
$qu1 = mysql_query("select * from entrance_exam where S_ID='$id' and status='satisfactory'")or die(mysql_error());
$row12 = mysql_fetch_array($qu1);
$idd=$row12["S_ID"];
if($id==$idd){
	$i++;
} 		
}
echo"<font color='red'>".($i)."</font>"; ?></p>					
								<?php
						
$query1 = mysql_query("select * from student where Department='$dcode' and year='1st' and semister='I'");
?>

<?php	
				
$sql = "SELECT * FROM student where Department='$dcode' and year='1st' and semister='I' ORDER BY section,S_ID ASC";
	$pager = new PS_Pagination($conn, $sql, 10, 1);
	$rs = $pager->paginate();					
	$count_my_message = mysql_num_rows($query1);	
if ($count_my_message != '0'){
?>

<table border="1" id="resultTable" width="100%" cellspacing="0" style="margin-left: -20px">
<tr>
<th>S_ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Sex</th>
<th>College</th>
<th>Department</th>
<th>Year</th>
<th>Section</th>
<th>Semister</th>
</tr>
<?php
while($row = mysql_fetch_array($rs)){	
$id=$row["S_ID"]; 
$qu = mysql_query("select * from entrance_exam where S_ID='$id' and status='satisfactory'");
$co=mysql_num_rows($qu);					
if($co>='1')	
{			
?>
<tr>
<div class="post"  id="del<?php echo $id; ?>">
<td><?php echo $row["S_ID"]; ?></td>
<td><?php echo $row["FName"]; ?></td>
<td><?php echo $row["LName"]; ?></td>
<td><?php echo $row["Sex"]; ?></td>
<td><?php echo $row["College"]; ?></td>
<td><?php echo $row["Department"]; ?></td>
<td><?php echo $row["year"]; ?></td> 
<td><?php echo $row["section"]; ?></td>  
<td><?php echo $row["semister"]; ?></td> 
</div>		
<?php 
}
}
?>
</tr></table>		
</form>	
								<?php
	echo '<div style="text-align:center">'.$pager->renderFullNav().'</div>';
								
								}else{ ?>
								<div class="alert alert-info"><i class="icon-info-sign"></i> <font size="3px">No New Request found!</div>
								<?php } ?>

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
	<li><a href="changepass.php">Change password</a></li>
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
	