	<?php
	include('../connection.php');
	$con= mysql_connect('localhost','root','');
	if(mysql_select_db('cde')){

function encryptIt( $q ) 
{
$cryptKey='qJB0rGtIn5UB1xG03efyCp';
$qEncoded= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
return( $qEncoded );
}
?>
<?php
$query3=mysql_query("select * from student where unread='no'");
while($row=mysql_fetch_assoc($query3))
{
$id=$row["S_ID"];
$fn=$row["FName"];
$ln=$row["LName"];
$sex=$row["Sex"];
$em=$row["Email"];
$pn=$row["Phone_No"];
$role='student';
$dpt=$row["Department"];
$sql=mysql_query("select * from department where DName='$dpt'");
$row2=mysql_fetch_array($sql);
$dc=$row2['Dcode'];
$cc=$row2['Ccode'];

$chars = "abcdefghijklmnopqrstuvwxyz";
$un = substr( str_shuffle( $chars ), 0,5);
$p='cde'.$fn.'123#';
$encrypted = encryptIt($p);
$st='yes';
$query2=mysql_query("select * from student where unread='no'");
$count = mysql_num_rows($query2);
if ($count >= '1')
{
$sql="insert into user(UID,fname,lname,sex,Email,phone_No,d_code,c_code) values('$id','$fn','$ln','$sex','$em','$pn','$dc','$cc')";
$inserted=mysql_query($sql);
if($inserted)
{
$query=mysql_query("select * from user where UID='$id'");
if($row1=mysql_fetch_assoc($query))
{
$uid=$row1["UID"];
$sql1="INSERT INTO account(UID,UserName,Password,Role,status) VALUES('$uid','$un','$encrypted','$role','$st')";
$result=mysql_query($sql1)or die(mysql_error());
}
}
}
}
$query1=mysql_query("UPDATE student SET unread='yes' where unread='no'");
header("location:viewstudentaccount.php");
}
?>