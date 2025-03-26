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
}
else 
{
$status_state='no';
}
$update=mysql_query("update account set status='$status_state' where UID='$status1' ");
$count=mysql_num_rows($update);
if($count>='1')
{
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
	$user=$_SESSION['user'];
	$status='yes';
	$da=date('y-m-d');
mysql_query("INSERT INTO logfile (logid,username,role,status,start_time,activity_type,activity_performed,date,ip_address,end)  VALUES(' ','$user','system admin','$status','$actual_time','unblock user',concat('uid[','$status1','] ',' status[','$status_state','] '),'$da','$ipaddress','')") or die (mysql_error());
header("Location:addaccountb.php");
}
else
{
header("Location:viewbuser.php");
echo mysql_error();
}
}
?>
<?php
}
?>