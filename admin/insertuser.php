<?php
include '../connection.php';
$con= mysql_connect('localhost','root','');
$uid=$_POST['uid'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$sex=$_POST['sex'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$loc=$_POST['loc'];
$role=$_POST['ct'];
     $ptmploc=$_FILES["photo"]["tmp_name"];
	$pname=$_FILES["photo"]["name"];
	$psize=$_FILES["photo"]["size"];
	$ptype=$_FILES["photo"]["type"];

				
				
					
						if($psize<=2000000&&$ptype=="image/jpeg")
						{
							if(!file_exists("userphoto"))
								mkdir("userphoto");
							$photopath="userphoto/$pname";
							if(copy($ptmploc,$photopath))
							{
							if($role=='collage_dean'){
								$co=$_POST['ac'];
$sql="insert into user(UID,fname,lname,sex,Email,phone_No,location,photo,c_code) values('$uid','$fname','$lname','$sex','$email','$phone','$loc','$photopath','$co')";
							$inserted=mysql_query($sql)or die(mysql_error());
							}
							else if($role=='department_head' || $role=='instructor'){
								$co=$_POST['ac'];
								$dd=$_POST['dc'];
$sql="insert into user(UID,fname,lname,sex,Email,phone_No,location,photo,d_code,c_code) values('$uid','$fname','$lname','$sex','$email','$phone','$loc','$photopath','$dd','$co')";
							$inserted=mysql_query($sql)or die(mysql_error());
							}
					else {
$sql="insert into user(UID,fname,lname,sex,Email,phone_No,location,photo) values('$uid','$fname','$lname','$sex','$email','$phone','$loc','$photopath')";
							$inserted=mysql_query($sql)or die(mysql_error());
							}
							
								if($inserted)
								{
									
if(!empty($_SERVER["HTTP_CLIENT_IP"]))
{
$ipaddress=$http_client_ip;
}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
$ipaddress=$http_x_forwarded_for;	
}else{
	$ipaddress=$_SERVER['REMOTE_ADDR'];
}
session_start();
	$time = time();
	$actual_time = date('d M Y @ H:i:s', $time);
	$user=$_SESSION['suid'];
	$status='yes';
	$da=date('y-m-d');
	mysql_query("INSERT INTO logfile (logid,username,role,status,start_time,activity_type,activity_performed,date,ip_address,end)  VALUES(' ','Admin','system admin','$status','$actual_time','add user',concat('uid[','$uid','] ','name[','$fname','] ','father name[','$lname','] ','sex[','$sex','] ','user id[','$uid','] ','phone[','$phone','] '),'$da','$ipaddress','')") or die (mysql_error());	
echo'<script type="text/javascript">alert("Your Information Is Successfully Registered !!!");window.location=\'adduser.php\';</script>';
mysql_close($con);

								}
								else
								{
									header("location: adduser.php");
									echo "Unable to register the user";
								}
							}else
							{
								header("location: adduser.php");
								echo "Unable to upload the photo!";
							}
						}else
						{
							if($psize>20000)
							{header("location: adduser.php");
								echo "Photo size should not be greater than 2Kb!";
							}
							else{header("location: adduser.php");
								echo "Photo should be in jpeg format";
							}
						}
?>
