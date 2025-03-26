<style>
#container1 {
 position: relative;
 width: 180px;
 height: 280px;
 background: lighter;
 margin-top: -15px;
 box-shadow: 5 4px 7px rgba(0, 0, 0, .1);
 background-color: #aeaeae;
}
 
.form {
 margin: 0 auto;
 margin-top: 20px;
 
} 
.label1 {
 color: #020200;
 display: inline-block;
 margin-left: 18px;
 padding-top: 10px;
 font-size: 17px;
}
.input {
 font-family: "Helvetica Neue", Helvetica, sans-serif;
 font-size: 12px;
 outline: none;
}
 
.input[type=text],
.input[type=password] {
 color: #000;
 padding-left: 10px;
 margin: 10px;
 margin-top: 12px;
 margin-left: 18px;
 width: 150px;
 height: 30px;
 border: 1px solid #41b47a;
 border-radius: 10px;

 -webkit-transition: all .4s ease;
 -moz-transition: all .4s ease;
 transition: all .4s ease;
}
 
.input[type=text]:hover,
.input[type=password]:hover {
 border: 1px solid #41b47a;
 box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .7), 0 0 0 5px #D6AE58;
}
 
.input[type=text]:focus{
 border: 1px solid #a8c9e4;
 box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #e6f2f9;
}
.input[type=password]:focus {
 border: 1px solid #a8c9e4;
 box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #e6f2f9;
}


.btn{
  background:#3594D2;

  padding-top:5px;
  padding-bottom:5px;
  color:white;
  border-radius:4px;
  border: #2980b9 1px solid;
  padding-left: 10px;
  margin-top:20px;
  margin-bottom:20px;
  float:left;
  margin-left:26px;
  font-weight:800;
  font-size:15px;
}

.btn:hover{
  background:#0b2231; 
}
</style>
<div id="container1">
        <form action="" method="post" class="form">
		<label class="label1" for="username">Username:</label>
           <input type="text" id="username" name="un" placeholder="Username" required class="input">
            <label for="password" class="label1">Password:</label>
            <input type="password" id="password" name="pass" placeholder="Password" required class="input">
<input type="submit" id="submit" class="btn" name="login" value="Login" style="height: 34px; margin-left: 15px; width: 60px; padding: 5px; border: 3px double rgb(204, 204, 204);"/>
<input type="reset" id="reset" class="btn" name="reset" value="Reset" style="height: 34px; margin-left: 15px; width: 60px; padding: 5px; border: 3px double rgb(204, 204, 204);" />
</form>
<p style="color: blue">Forgot your password? <u style="color:#fff;background-color: #336699;"><a style="color:#fff;" href="forgot.php">Click Here!</a></u></p> 
   

<?php
if(isset($_POST["login"]))
{
	$un=$_POST["un"];
	$pass=$_POST["pass"];
function encryptIt( $q ) 
{
$cryptKey='qJB0rGtIn5UB1xG03efyCp';
$qEncoded= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
return( $qEncoded );
}
$encrypted = encryptIt($pass);
$sql="select * from account where UserName='$un' and Password='$encrypted' and status='yes'";
		$matchfound=mysql_query($sql);
		$row=mysql_fetch_assoc($matchfound);
		$uid=$row["UID"];
		$username=$row['UserName'];
		$password=$row['Password'];
		$role=$row["Role"];
		$sql1="select * from user where UID='$uid'";
		$matchfound1=mysql_query($sql1);
		$row1=mysql_fetch_assoc($matchfound1);
		
		
		
		$fname=$row1["fname"];
		$lname=$row1["lname"];
		$photo=$row1["photo"];
		$ccode=$row1["c_code"];
		$dcode=$row1["d_code"];
		
		
		$sql2="select * from department where Dcode='$dcode'";
		$matchfound2=mysql_query($sql2);
		$row2=mysql_fetch_assoc($matchfound2);
		$dcod=$row2["DName"];
		
		$sql3="select * from student where S_ID='$uid'";
		$matchfound3=mysql_query($sql3);
		$row3=mysql_fetch_assoc($matchfound3);
		$sem=$row3["semister"];
		$sec=$row3["section"];
		$yea=$row3["year"];
		$dpt=$row3["Department"];
		
		$_SESSION['sdpt']=$dpt;
		$_SESSION['ssemister']=$sem;
		$_SESSION['ssection']=$sec;
		$_SESSION['syear']=$yea;		
		
		
		$_SESSION['scc']=$ccode;
		$_SESSION['sdc']=$dcode;
		
		$_SESSION['suid']=$uid;
		$_SESSION['sun']=$username;
		$_SESSION['spw']=$password;
		$_SESSION['sfn']=$fname;
		$_SESSION['sln']=$lname;
		$_SESSION['srole']=$role;
		$_SESSION['sphoto']=$photo;
		$_SESSION['sdcode']=$dcod;
		
$login_time = date("h:i:s");
$_SESSION['login_time']=$login_time;
	if($role=="registrar")
			header("location:registrar/registrarpage.php");
	else if($role=="administrator")
			header("location:admin/adminhomepage.php");
	else if($role=="department_head")
			header("location:department/deptheadpage.php");
	else if($role=="instructor")
			header("location:instructor/instructorpage.php");
	else if($role=="student")
			header("location:student/studentpage.php");
	else if($role=="cdeofficer")
			header("location:cdeofficer/cdeofficerpage.php");
	else if($role=="financestaff")
			header("location:finance/financestafpage.php");
	else if($role=="collage_dean")
			header("location:collage/financestafpage.php");
	else if($role=="acadamic_vice_presid")
			header("location:vice_presidant/vicepage.php");
	else if($role=="directorat")
			header("location:directorat/directorpage.php");
	else
	{
$sql=mysql_query("select*from attempt");
$total=mysql_num_rows($sql);
$total++;
if($total>3)
{
header("location:index1.php");
}
else
{
echo "<font color=red><font size=3px>Invalid username/password";
echo "<br>you are tries $total times,but allowed 4 times<h1></font></font>";
$insert=mysql_query("insert into attempt values(' ')");	
}
		
	}
}
?>
</div> 
  
