<?php
	include('../connection.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM payment_table where no='$id'");
		while($row = mysql_fetch_array($result))
			{ 
			     $in=$row['Instructors_Name'];
				$cp=$row['Course_Code'];
				$r=$row["Rank"]; 
				$cr=$row["CrHr"]; 
				$nep=$row['No_of_Sections'];
			}
?>
<script type="text/javascript">
function calculateTotal(n1,n2) {
var a=parseFloat(n1)
var b=parseFloat(n2)
var c=a*b
if(c>=0){
addem.total.value=c	
}
	}
</script>
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
<form name="addem" action="updateifexam.php" method="post">
<input type="hidden" name="roomid" value="<?php echo $id=$_GET['id'] ?>">
<br><fieldset><legend><b>List of Instructors Who Have Participated in Invigilating Final Exams</b></legend>
<table  cellpadding="5" border="0">

<tr><td>Instructor's Name:</td><td><input type="text" class="ed" name="in" id="in"readonly value="<?php echo $in ?>" style="height: 30px;width: 200px;" />
	
</td></tr>
<tr><td>Rank:</td><td><input type="text" name="rk"class="ed" value="<?php echo $r ?>" style="height: 30px;width: 200px;" readonly/>	
</td></tr>
<tr><td>Invigilating Course Code:</td><td><input type="text"class="ed" name="icc" id="icc"readonly value="<?php echo $cp ?>" style="height: 30px;width: 200px;" />
	
</td></tr>
<tr><td>CrHr:</td><td><input type="text" name="cr"class="ed" value="<?php echo $cr ?>" style="height: 30px;width: 200px;" readonly/>

</td></tr>
<tr><td>No.of Sections:</td><td><input type="text" name="ns"class="ed" id="ns" readonly value="<?php echo $nep ?>" style="height: 30px;width: 200px;" />
	
</td></tr>

<tr><td>Payment Per Exam(Birr):</td><td><input type="text" name="ppe" id="ppe"class="ed"  style="height: 30px;width: 200px;" 
onkeyup="calculateTotal(ns.value,ppe.value)"  required="required"/>
 <script type="text/javascript">
				    var f1 = new LiveValidation('ppe');
				    f1.add(Validate.Presence,{failureMessage: " Please enter No.of Sections "});
				     f1.add(Validate.Format,{pattern: /^[0-9]+$/ ,failureMessage: " It allows only Number"});
				 </script> 
</td></tr>
<tr><td>Total Payment:</td><td><input type="text"class="ed" name="total" id="total" value="0" readonly style="height: 30px;width: 200px;" required="required"/>
	
</td></tr>
<tr><td></td>
<td><input type="submit"  name="submit" value="Save" style="height: 40px;width: 100px;"id="button1">
<input type="reset"  name="clear" value="Clear" style="height: 40px;width: 100px;"id="button1"> </td>

</tr>
</table></fieldset>
</form>