<?php
session_start();
include("../connection.php");
$idd=$_SESSION['suid'];
?>
<html>
<head>
<title>
Instructor page
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
    require("menuins.php");
?>
</td></tr>
<tr><td>
<?php
	 require("sidemenuins.php");
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
                 if(isset($_POST['search']))
                 {
	 				$dpt=$_POST['dpt'];
	 				$_SESSION['sdpt']=$dpt;
				    $scy=$_POST['scy'];
				    $_SESSION['sscy']=$scy;
					$sec=$_POST['sec'];
					$_SESSION['ssec']=$sec;
					$sem=$_POST['sem'];
					$_SESSION['ssem']=$sem;
					
					$cc=$_POST['cc'];
					$_SESSION['scc']=$cc;
					
					$dc=$_POST['uu'];
					$_SESSION['sddc']=$dc;
					}
					 $dpt=$_SESSION['sdpt'];
				    $scy=$_SESSION['sscy'];
					$sec=$_SESSION['ssec'];
					$sem=$_SESSION['ssem'];	
					$co=$_SESSION['scc'];	
					$dcc=$_SESSION['sddc'];
$query = "select * from course_result where status='post' and Department='$dpt' and year='$scy' and semister='$sem' and section='$sec' and C_Code='$co'";
	$pager = new PS_Pagination($conn, $query, 5, 1);
	$rs = $pager->paginate();

$result = mysql_query($query);
$c=mysql_num_rows($result);
if ($c=='0') 
{
echo"No Result";
}
else
{
	?>
		<table width="100%">
<td bgcolor="003366" width="100px" align="center"><a href="viewgrade.php"  style="color: #ffffff;font-size: 30px;text-decoration: none;">Back</a></td>
<td></td><td></td>
<td  bgcolor="#003366" width="120px" align="center"><a href="sendall.php"  style="color: #ffffff;font-size: 20px;text-decoration: none;">Send All</a></td></table>
<?php
	$i = 0;
	echo '<form action=" " method=post><table cellpadding="1" cellspacing="1" id="resultTable"><tr>';	
	while ($i < mysql_num_fields($result))
	{
		$meta = mysql_fetch_field($result, $i);
		if($meta->name=='status')
		break;
		echo '<th>' . $meta->name . '</th>';
		$i = $i + 1;
	}
	echo '<th>Action </th></tr>';
	
	$i = 1;
	while ($row = mysql_fetch_row($result)) 
	{	
		echo '<tr>';
		$count = count($row);
		$y = 1;
		while ($y < $count)
		{
			$c_row = current($row);
			if($c_row=='approved' || $c_row=='post'|| $c_row=='posted')
			break;
			echo '<td>' . $c_row . '</td>';
			next($row);
			$y = $y + 1;
		}
	if($row1 = mysql_fetch_array($rs))
		echo '<td><a rel="facebox" href="calculategrade.php?id='.$row1["no"].'">Update</a></td></tr>';
		$i = $i + 1;
	}
	echo '</table></form>';
	
}
						
?>
							 
	<?php
		//echo '<div style="text-align:center">'.$pager->renderFullNav().'</div>';
				 

                 ?>
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
