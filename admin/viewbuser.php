<?php
session_start();
include("../connection.php");
?>
<html>
<head>
<title>
Administrator page
</title>
<link rel="stylesheet" type="text/css" href="../setting.css">


<script type="text/javascript" src="../javascript\date_time.js"></script>
<script src="js/validation.js" type="text/javascript"></script>
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
    require("menu.php");
?>
</td></tr>
<tr><td>
<?php
	 require("sidemenu.php");
?>
	
</td><td>
	<div id="contentindex5">
	<p align="center" style="color: blue;"><b>Blocked User in the organization</b></p>
<p align="center" style="color: #2773d8;font-family: time new romans;font-size: 17;">Number of record:<?php include '../connection.php';
 $count_item=mysql_query("select * from account WHERE status='no'" ) or die(mysql_error());
$count=mysql_num_rows($count_item);
//$a=count($sql2);
echo"<font color='red'>".($count)."</font>"; ?></p>
<?php
include '../connection.php';
$con= mysql_connect('localhost','root','');
$result=mysql_query("SELECT * FROM account WHERE status='no'",$con);
?>

<table cellpadding="1" cellspacing="1" id="resultTable" style="margin-left: -20px;">

<tr>
<th>UID</th>
<th>First<br>Name</th>
<th>Last<br>Name</th>
<th>User<br>Type</th>
<th>Sex</th>
<th>Email</th>
<th>Phone</th>
<th>Location</th>
<th>Action</th>
</tr>
<?php
while($myrow=mysql_fetch_array($result))
{
	$id=$myrow['UID'];
$result1=mysql_query("SELECT * FROM user WHERE UID='$id'");
$myrow1=mysql_fetch_array($result1);	
echo "<tr>";
echo "<td>" . $myrow['UID']. "</td>";
echo "<td>" . $myrow1['fname']. "</td>";
echo "<td>" . $myrow1['lname']. "</td>";
echo "<td>" . $myrow['Role']. "</td>";
echo "<td>" . $myrow1['sex']. "</td>";
echo "<td>" . $myrow1['Email']. "</td>";
echo "<td>" . $myrow1['phone_No']. "</td>";
echo "<td>" . $myrow1['location']. "</td>";



$data5=$myrow['status'];
$data3='yes';?>
<td><a href="ACTIONVBU.php?status=<?php echo $myrow['UID'];?>" 
 id="btn" onchange="Block" onclick="return confirm('Are you sure <?php echo $id?>');">
 <?php
 $select=mysql_query("select * from account WHERE UID='$id' ");
$row=mysql_fetch_object($select);
$status_var=$row->status;
IF($status_var=='yes'){
	?>
<input type="button" value="Block" style="background-color: #243cdb;color: #fffbfb;height: 25px;width: 100px; text-decoration: none;"/> 
	 <?php
}
else
{
 ?>
<input type="button" value="UNBlock" style="background-color: red;color: #ffffff;height: 25px;width: 100px; text-decoration: none;" /></a></td>

<?php
}
}
?>
</tr>
</table>
<?php
mysql_close($con);
?>
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
 <li><a href="updateprofilephoto.php">Change Photo</a></li>
	<li><a href="changepass.php">Change password</a></li>
	 </ul>
</div>
	 </div>
	 <div id="siderightindexadational">
	 <div id="siderightindexadational1">
	 Social link 
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


