<?php
session_start();
include("../connection.php");
?>
<html>
<head>
<title>
Director page
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
    require("menudir.php");
?>
</td></tr>
<tr><td>
<?php
	 require("sidemenudir.php");
?>
	
</td><td>
	<div id="contentindex5">
	<form action=" " method="post"> 
					<table><tr>				    			  
				  <td>Semister:</td>
                  <td>
					<select name="sem"  class="login-form2"  style="height:30px; width:180px;" required>
                        <option value="">--select Semister--</option>
                        <?php
						
					$d_program2 = mysql_query("SELECT DISTINCT semister FROM course");
			
					while($getDprog2 = mysql_fetch_array($d_program2)){
						$sem = $getDprog2['semister'];
				 ?>
					<option value="<?php echo $sem;  ?>"><?php echo $sem; ?></option>
				<?php } ?>
                    </select>
                    </td>
 <td>
					<input type="submit" value="Search"  name="search" style="font-size: 25;background-color: #003366;color: white"/></td>
 						</tr></table>
 						 </form>
 						 <?php
 						 if(isset($_POST['search']))
 						 {
						 	$sem=$_POST['sem'];
							$result = mysql_query("SELECT * FROM course where status='yes' and semister='$sem'");
							$co=mysql_num_rows($result);
							echo'Total Number of records:   '.$co.'';
						 	?>
						 	<table cellpadding="0" cellspacing="0" id="resultTable" style="margin-left: -20px">
          <thead>
         
            	<tr >
            					<th  style="border-left: 1px solid #C1DAD7">Sender Name</th>
								<th  style="border-left: 1px solid #C1DAD7">Module<br>Code </th>
								<th  style="border-left: 1px solid #C1DAD7">Module<br>Name </th>
								<th  style="border-left: 1px solid #C1DAD7">Credit Hour</th>
								<th>Year</th>
								<th  style="border-left: 1px solid #C1DAD7">department</th> 
								<th>file name </th>
            </tr>
          </thead>
          <tbody>
        <?php
			
							while($row = mysql_fetch_array($result))
								{
							$iname=$row['Sender_name'];
							$result1 = mysql_query("SELECT * FROM user where UID='$iname'");
							$r=mysql_fetch_array($result1);
							$fn=$r['fname'];
							$ln=$r['lname'];
							$fna=$fn.'    '.$ln;
						 $files=$row['FileName'];
									echo '<tr class="record">';
									echo '<td style="border-left: 1px solid #C1DAD7;">'.$fna.'</td>';
									echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['course_code'].'</td>';
									echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['cname'].'</td>';
									echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['chour'].'</td>';
									echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['ayear'].'</td>';
									echo '<td><div align="right">'.$row['department'].'</div></td>';
								    echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['FileName'].'</td>';

					echo '</tr>';
					
					
				  }
				
				?> 
          </tbody>
       </table>  
       <?php
       }
       ?>  
      
 </div>
  </td>
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