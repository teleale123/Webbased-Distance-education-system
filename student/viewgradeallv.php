<?php
session_start();
include("../connection.php");
?>
<html>
<head>
<title>
Student page
</title>
<link rel="stylesheet" type="text/css" href="../setting.css">
<script type="text/javascript" src="../javascript\date_time.js"></script>
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
    require("menustud.php");
?>
</td></tr>
<tr><td>
<?php
	 require("sidemenustud.php");
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
<?php
$dept=$_SESSION['sdcode'];
$sec=$_SESSION['ssection'];
$year=$_SESSION['syear'];
$sem=$_SESSION['ssemister'];
$uid=$_SESSION['suid'];
$co=mysql_query("SELECT * FROM grade where department='$dept' and year='$year' and section='$sec' and status='approved' and checking='pending' and sid='$uid'" ) or die(mysql_error());
$c=mysql_num_rows($co);
if($c>='1'){



?>
<fieldset><legend><b>Your Grade report</b></legend>
<form action="" method="post">					
<?php	
							
$sql = "SELECT * FROM grade where department='$dept' and year='$year' and section='$sec'  and status='approved' and checking='pending' and sid='$uid'";
	$pager = new PS_Pagination($conn, $sql, 1, 1);
	$rs = $pager->paginate();											
$stcr=0;
$stgp=0;
$scgpa=0;
$ncgpa=0;
while($row1=mysql_fetch_array($rs))
	{
$id=$row1['sid'];
$ss=mysql_query("SELECT * FROM student where S_ID='$id'" ) or die(mysql_error());
if($row=mysql_fetch_array($ss))
{
$fn=$row['FName'];
$mn=$row['mname'];
$ln=$row['LName'];
$name=$fn.'  '.$mn.'  '.$ln;
$sex=$row['Sex'];
$dept=$row['Department'];
$yea=$row['year'];
$sem=$row['semister'];
$sec=$row['section'];
}
			
?>
<table border="1"  cellspacing="0" width="100%" >
<tr>

<th bgcolor="#CAE8EA">Name</th>
<th><?php echo $name;?> </th>
<th bgcolor="#CAE8EA">ID_No</th>
<th><?php echo $id;?></th>
</tr>
<tr >
<th bgcolor="#CAE8EA">Sex</th>
<th colspan="3" align="left"><?php echo $sex;?></th>	
	
</tr>
<tr>
<th bgcolor="#CAE8EA">
Department:<br/>
Year:<br/>
Semister:<br/>
Section:
</th>
<th colspan="3" align="left">
<?php echo $dept;?><br/>
<?php echo $yea;?><br/>
<?php echo $sem;?><br/>
<?php echo $sec;?>
</th>	
</tr>
</table>
<br/>
<table border="1"  cellspacing="0" width="100%">
<tr bgcolor="#CAE8EA">
<th>Ctitle</th>
<th>Chour</th>
<th>Grade</th>
<th>Grade point</th>
</tr>
<?php


$sql0 = "SELECT * FROM course_result where department='$dept' and year='$yea' and section='$sec' and S_ID='$id' and status='approved' and status2='pending'" ;
$re=mysql_query($sql0);	
while($row11=mysql_fetch_array($re))
	{
$cc=$row11['C_Code'];
$g=$row11['Grade'];
$query1 = "select * from course where course_code='$cc'";
$result1 = mysql_query($query1);
$rr=mysql_fetch_array($result1);
$ch1=$rr['chour'];

?>
<tr>
<td><center><?php echo $cc;?></center></td>
<td><center><?php echo $ch1;?></center></td>
<td><center><?php echo $g;?></center></td>
<td>
<center><?php 

 if($g=='A+'|| $g=='a+')
$gp=$ch1*4;
else if($g=='A' || $g=='a')
$gp=$ch1*4;
else if($g=='A-'|| $g=='a-')
$gp=$ch1*3.75;
else if($g=='B+'|| $g=='b+')
$gp=$ch1*3.5;
else if($g=='B'|| $g=='b')
$gp=$ch1*3;
else if($g=='B-'|| $g=='b-')
$gp=$ch1*2.75;
else if($g=='C+'|| $g=='c+')
$gp=$ch1*2.5;
else if($g=='C'|| $g=='c')
$gp=$ch1*2;
else if($g=='C-'|| $g=='c-')
$gp=$ch1*1.75;
else if($g=='D'|| $g=='d')
$gp=$ch1*1;
else
$gp=$ch1*0;
echo $gp;?></center>
</td>
</tr>	
<?php
$stcr=$ch1+$stcr;
$stgp=$gp+$stgp;
$scgpa=$stgp/$stcr;

}


$ptch=$row1['ptcrh'];
$ptgp=$row1['ptgpoint'];
$pcgpa=$row1['pgpa'];

?>
<tr>
	<th bgcolor="#CAE8EA">Total</th>
	<td><center><?php echo $stcr;?></center></td>
	<td></td>
	<td><center><?php echo $stgp;?></center></td>
</tr>
<tr>
	<th bgcolor="#CAE8EA">Semister AVG</th>
	
	<td colspan="3" bgcolor="blue" style="color: white;"><center><?php echo round($scgpa,2);?></center></td>
	
</tr>	
</table>
<br/>
<table border="1" id="resultTable" cellspacing="0" width="100%">
<tr bgcolor="#CAE8EA">
<td></td>	
<td>Chours</td>
<td>Grade point</td>
<td>GPA</td>
</tr>
<tr>
<td bgcolor="#CAE8EA">Previous Total</td>	
<td><center><?php echo $ptch;?></center></td>
<td><center><?php echo $ptgp;?></center></td>
<td><center><?php echo $pcgpa;?></center></td>
</tr>	

<tr>
<td bgcolor="#CAE8EA">Semister Total</td>	
<td><center><?php echo $stcr;?></center></td>
<td><center><?php echo $stgp;?></center></td>
<td><center><?php 
$s=round($scgpa,2);
 echo $s;?></center></td>
</tr>
<tr>
<td bgcolor="#CAE8EA">Comulative</td>	
<td><center><?php echo $ptch+$stcr;?></center></td>
<td><center><?php echo $ptgp+$stgp;?></center></td>
<?php
$ncgpa=($ptgp+$stgp)/($ptch+$stcr);
$n=round($ncgpa,2);
?>
<td bgcolor="blue" style="color: white;"><center><?php echo $n;?></center></td>
</tr>
</table>
</form>
<?php
	echo '<div style="text-align:center">'.$pager->renderFullNav().'</div>';

								}
		echo'</fieldset>';		
}
else
echo "Not posted";
?>
</fieldset>	

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
