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
$con=mysql_connect("localhost","root","");	
$result = mysql_query("SELECT * FROM acadamic_calender WHERE semister='Semister one'");
$result1 = mysql_query("SELECT * FROM acadamic_calender WHERE semister='Semister two'");
echo "<table border='1' style='width:590px;' align='center'><font color=white>
<tr>
<th bgcolor='#408c70' colspan='3'><font color='white' size='5'>Semister One</th></tr>
<tr>
<th bgcolor='#336699'><font color='white' size='5'>No</th>
<th bgcolor='#336699'><font color=white size='5'>Dates</th>
<th bgcolor='#336699'><font color=white size='5'>Activities</th>
</tr>";
echo'</font>';
while($row = mysql_fetch_array($result))
  {
  print ("<tr>");
  print ("<td><font size='2'>" . $row['no'] . "</td>");
 print ("<td><font size='2'>" . $row['dates'] . "</td>");
 print ("<td><font size='2'>" . $row['activities'] . "</td>");
  
print ("</tr>");
  }
echo"<tr>
<th bgcolor='#408c70' colspan='3'><font color='white' size='5'>Semister Two</th></tr>";
while($row1 = mysql_fetch_array($result1))
  {
  print ("<tr>");
  print ("<td><font size='2'>" . $row1['no'] . "</td>");
 print ("<td><font size='2'>" . $row1['dates'] . "</td>");
 print ("<td><font size='2'>" . $row1['activities'] . "</td>");
  
print ("</tr>");
  }
print( "</table>");

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