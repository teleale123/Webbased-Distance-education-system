<?php
include("connection.php");
?>
<div id="sidebar12">
<ul>
	<div id="sidedate">
	<li><a class="active" href="#.php"> Calendar</a></li>
	 <?php
	 require("date.php");
	 ?>
	 </div>
	 <br/><br/>
  <li><a class="active" href="#.php">Announcment</a></li>
 
 	<a href="#.php" style="color: cyana;"> 
<?php
	 $date=date('Y-m-d');
	$sql=mysqli_query($con,"SELECT * from postss where status='register' ORDER BY dates DESC");
	if($row=mysqli_fetch_array($sql))
	{
            echo"<font face='monotype corsiva' size='4' ><center>"."<u>".$row['Title']."</u>"."</center>"."</p>";
			echo"<font face='monotype corsiva' size='3' ><center>".$row['types']."</center>"."</p>"."</font>";
			echo "<font  size='2'>".$row['info'];
          
         		

	}
	?></a><a style="color: blue;font-size: 20px;" href="new.php">Read More</a>
 <br/><br/><br/><br/><br/>
	 </ul>
   </div>
