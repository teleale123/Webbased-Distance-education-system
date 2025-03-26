<style>
.nav {
       width: 1096px;
	   height: 48px;
        padding: 0;
        list-style: none;
        background: #336699;
        border-radius:0px;
        margin-left:21px;
		margin-top:-3px;

}
.nav li {
    float: left;
    margin-right: 10px;
    position: relative;
}
.nav a {
    display: block;
    padding: 15px;
    color: #fff;
    background-color: #336699;
    text-decoration: none;
    margin-left:21px;
}
.nav a:hover {
    color: #fff;
    background-color: #6b0c36;
    text-decoration: underline;
}

/*--- DROPDOWN ---*/
.nav ul {
    background-color: #fff; 
    background: rgba(255,255,255,0);
    list-style: none;
    position: absolute;
    left: -9999px; 
}
.nav ul li {
    padding-top: 1px;
    float: none;
}
.nav ul a {
    white-space: nowrap; 
}
.nav li:hover ul { 
    left: 0; 
}
.nav li:hover a {
    background-color: #336699;
    text-decoration: underline;
    border-radius: 5px;
    color: #7ce7dc;
}
.nav li:hover ul a {
    text-decoration: none;
}
.nav li:hover ul li a:hover { 
    background-color: #333;
    color: white;
}
</style>

<ul class="nav">
    <li>
        <a href="index.php">Home</a>
    </li>

    <li>
        <a href="#">About</a>
        <ul>
             <li><a href="#.php">Mission</a></li>
                <li> <a href="#.php">Vision</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li> <a href="gallery.php">Photo Gallery</a></li>
        </ul>
    </li>
    <li>
        <a href="#">Rules</a>

        <ul>
               <li><a href="newstudents.php">New Applicants</a></li>
                <li><a href="seniorstudents.php">Senior Students</a></li>
        </ul>

    </li>
    <li>
        <a href="#">Academics</a>
        <ul>
            

                <li><a href="colleges.php">Colleges</a></li>
                <li><a href="#">Instituts</a></li>
                <li> <a href="fields.php">Currently Ongoing Programs</a></li>

        </ul>
    </li>
 				<li><a href="new.php">Notice</a></li>
<li><a href="appl_accept.php">Aplication</a></li>
 <li><a href="servicefees.php">Service fees</a></li>
            	<li><a href="feedback.php">Feedback</a></li>
                <li><a href="help.php">Help</a></li>
</ul>
