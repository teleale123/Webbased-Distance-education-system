
	<?php
session_start();
include("../connection.php");
?>
	  <style type="text/css">
.ed{
border-style:solid;
border-width:thin;
border-color:#00CCFF;
padding:5px;
margin-bottom: 4px;
}
#button1{
text-align:center;
font-family:Arial, Helvetica, sans-serif;
border-style:solid;
border-width:thin;
border-color:#00CCFF;
padding:5px;
background-color:#508abb;
color: white;
height: 34px;
width: 100px;
}

</style>

<form action="insertpexam.php"method="POST" >
<br><fieldset><legend><b>List of Instructors Who Have Participated in Preparing Exams</b></legend>
<table  cellpadding="5" border="0">

<tr><td>User ID:</td><td><input type="text" name="uid" id="uid" class="ed" readonly value="<?php echo $_SESSION['suid'] ?>" style="height: 30px;width: 200px;" required="required"/>	
</td></tr>
<?php
$id=$_SESSION['suid'];
$sql=mysql_query("select*from user where UID='$id'");
$r=mysql_fetch_array($sql);
$cc=$r['c_code'];
$dc=$r['d_code'];
?>
<tr><td></td><td><input type="hidden" name="cid" id="cid" readonly class="ed" value="<?php echo $cc ?>" style="height: 30px;width: 200px;" required="required"/>	
</td></tr>
<tr><td>Instructor's Name:</td><td>
                  <select name="in" id="in"  class="ed" style="height:30px; width:200px;" required>
                        <option selected="selected" value="">Select Instructor</option>
                        <?php
						mysql_connect("localhost","root","");
						mysql_select_db("cde");
					
						
						$d_program11 = mysql_query("SELECT * FROM account where Role='instructor'");
						while($getDprog11 = mysql_fetch_array($d_program11))
						{
						$role=$getDprog11['UID'];
						$d_program1 = mysql_query("SELECT * FROM user where d_code='$dc' and UID='$role'");
						if($getDprog1 = mysql_fetch_array($d_program1))
						{
							$uidd=$getDprog1['UID'];
						$name = $getDprog1['fname'].'  '.$getDprog1['lname'];
				 ?>
					<option value="<?php echo $uidd; ?>"><?php echo $name; ?></option>
				<?php }} ?>
                    </select>	
</td></tr>
<tr><td>Rank:</td><td><input type="text" name="rk" id="rk" style="height: 30px;width: 200px;"class="ed" required="required"  placeholder="Please enter rank" />
<script type="text/javascript">
				    var f1 = new LiveValidation('rk');
				    f1.add(Validate.Presence,{failureMessage: " Please enter rank "});
				     f1.add(Validate.Format,{pattern: /^[a-zA-Z]+$/ ,failureMessage: " It allows only String"});
				 </script> 	
</td></tr>
<tr><td>Course for w/c he/she prepared exam:</td><td><input type="text" name="icc" id="icc"class="ed" style="height: 30px;width: 200px;" required="required"  placeholder="Please enter Course he/she prepared" />
<script type="text/javascript">
				    var f1 = new LiveValidation('icc');
				    f1.add(Validate.Presence,{failureMessage: " Please enter Course he/she prepared "});
				     f1.add(Validate.Format,{pattern: /^[a-zA-Z0-9  ]+$/ ,failureMessage: " It allows only Number and String"});
				 </script> 	
</td></tr>
<tr><td>CrHr:</td><td><input type="text" name="cr" id="cr" style="height: 30px;width: 200px;"class="ed" required="required" placeholder="Please enter CrHr" />
 	<script type="text/javascript">
				    var f1 = new LiveValidation('cr');
				    f1.add(Validate.Presence,{failureMessage: " Please enter CrHr"});
				     f1.add(Validate.Format,{pattern: /^[0-9]+$/ ,failureMessage: " It allows only Number"});
				 </script> 
</td></tr>
<tr><td>No.of Exams prepared:</td><td><input type="text" name="ns" id="ns" style="height: 30px;width: 200px;"class="ed" required="required"  placeholder="Please enter No.of exmas prepared" />
<script type="text/javascript">
				    var f1 = new LiveValidation('ns');
				    f1.add(Validate.Presence,{failureMessage: " Please enter No.of exmas prepared "});
				     f1.add(Validate.Format,{pattern: /^[0-9]+$/ ,failureMessage: " It allows only Number"});
				 </script> 	
</td></tr>

<tr><td></td>
<td><input type="submit"  name="submit" value="Send to collage" style="height: 40px;width: 100px;"id="button1">
<input type="reset"  name="clear" value="Clear" style="height: 40px;width: 100px;"id="button1"> </td>

</tr>
</table></fieldset>
</form>
	