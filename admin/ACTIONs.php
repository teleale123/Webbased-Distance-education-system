<?php
include('../connection.php');
if(isset($_GET['status']))
{
$status1=$_GET['status'];
$select=mysql_query("select * from account where UID='$status1'");
while($row=mysql_fetch_object($select))
{
$status_var=$row->status;
if($status_var=='no')
{
$status_state='yes';
$ac='unblock user';
}
else 
{
$status_state='no';
$ac='block user';
}
$update=mysql_query("update account set status='$status_state' where UID='$status1'");
if($update)
{
	mysql_query("update entrance_exam set account='block' where S_ID='$status1'");
	$select1=mysql_query("select * from student where S_ID='$status1'");
	$row1 = mysql_fetch_array($select1);	
$id=$row1["S_ID"]; 
$fname=$row1["FName"]; 
$lname=$row1["LName"]; 
$sex=$row1["Sex"]; 
$email=$row1["Email"]; 
$pno=$row1["Phone_No"]; 
$coll=$row1["College"]; 
$dept=$row1["Department"]; 
$program=$row1["program"]; 
$sql="insert into rejected_stud(S_ID,FName,LName,Sex,Email,Phone_No,College,Department,program) values('$id','$fname','$lname','$sex','$email','$pno','$coll','$dept','$program')";
				$result=mysql_query($sql);
	mysql_query("delete from student where S_ID='$status1'");
		if(!empty($_SERVER["HTTP_CLIENT_IP"])){
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
			$logid=2;
			$da=date('y-m-d');
mysql_query("INSERT INTO logfile (logid,username,role,status,start_time,activity_type,activity_performed,date,ip_address,end)  VALUES(' ','Admin','system admin','$status','$actual_time','$ac',concat('uid[','$status1','] ',' status[','$status_state','] '),'$da','$ipaddress','')") or die (mysql_error());
		header("Location:studentlist.php");
}
else
{
echo mysql_error();
}
}
?>
<?php
}
?>