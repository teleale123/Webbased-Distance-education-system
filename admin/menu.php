<style>


#aa li ul
{
    display: none;
}

#aa ul li a 
{
    display: block;
    text-decoration: none;
    color: #ffffff;
    border-top: 1px solid #ffffff;
    padding: 5px 15px 5px 15px;
    background: #2C5463;
    margin-left: 23px;
    white-space: nowrap;
}

#aa ul li a:hover 
{
    background: #336699;
    
}
#aa li:hover ul 
{
	margin-left: 120px;
    display: block;
    position: absolute;
}

#aa li:hover li
{
    float: none;
    font-size: 11px;
}

#aa li:hover a 
{
    background:#336699;
}

#aa li:hover li a:hover 
{
    background: #4d6168;
}
</style>

<table>
<tr><td>
  <div id="menubar1">
  
  <ul>
  <div id="aa">
        <li><a href="">Manage Account<span><font size="1px">&#x25BC;</font></span></a>
        <ul>
			<li>
<a href="adduser.php"><span>Register User</span></a>
					</li>
					<li><a href="addaccount.php"><span>Create Account</span></a>
					</li>
        <li><a href="addaccountb.php">Block Account</a></li>
        </ul>
      </li>
		</div>		

					<?php
$query = mysql_query("select * from student where unread='no' ORDER BY Department ASC")or die(mysql_error());
$coun = mysql_num_rows($query);

$query1 = mysql_query("select * from entrance_exam where status='unsatisfactory' and (account=' ' or account='seen')")or die(mysql_error());
$coun1 = mysql_num_rows($query1);
if($coun>='1')
{
?>									
<li><a href="studentlist.php"><font size="4px" color="#d0eb3d">New Request For Account Creation(<?php echo $coun?>)</font></a></li>
		<?php
		}
		else if($coun1>='1')
		{
			?>
<li><a href="studentlist.php"><font size="4px" color="#d0eb3d">Request For Block Account(<?php echo $coun1?>)</font></a></li>
			<?php
		}
		else
		echo'<li><a href="studentlist.php">Request For  Account</a></li>';
		?>			
					<li>
						<a href="viewfeedback.php">
							<span>View feedback (<?php include '../connection.php'; $count_item=mysql_query("select * from feed_back" ) or die(mysql_error());
 $count=mysql_num_rows($count_item);
echo"<font color='yellow'>".($count)."</font>"; ?>)</span>
							
						</a>
					</li>
					
					
					<li>
						<a href="../logout.php">
							
							<span>Log out</span>
						</a>
					</li>
					
					
					<div class="clearfix"></div>
				</ul>             
	</div>					
</td></tr></table>