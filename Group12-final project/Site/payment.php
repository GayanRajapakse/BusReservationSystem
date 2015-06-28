<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
	$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
	$DBUser   = 'root';
	$DBPass   = 'wtf1486837';
	$DBName   = 'busreservation';

	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName); 
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
	$nic = $_POST["nic"];
	if(isset($_POST["msex"])) $sex = $_POST["msex"];
	if(isset($_POST["fsex"])) $sex = $_POST["fsex"];
	$name = $_POST["name"];
	$address = $_POST["address"];
	$bd = $_POST["bd"];
	$mob_no = $_POST["mob_no"];
	$ccn = $_POST["ccn"];
	$fare = $_POST["fare"];
	$tsid = $_POST["tsid"];
	$sql1 = 'select curdate();';
	$rs=$conn->query($sql1);
	$row = $rs->fetch_assoc();
	$date = $row['curdate()'];
	
	$sql1 = "select CustNIC from CUSTOMER where CustNIC = '$nic';";
	
	$rs=$conn->query($sql1);
			
	if($rs === false) {
		trigger_error('Wrong SQL: ' . $sql1 . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
		$rows_returned = $rs->num_rows;
	}
	$sql2 = "insert into CUSTOMER values($nic,'$name','$address',$mob_no,'$sex','$bd');";
	if($row = $rs->fetch_assoc()){
		
	}else{

		if($conn->query($sql2)){}else{
			trigger_error('Wrong SQL: ' . $sql2 . ' Error: ' . $conn->error, E_USER_ERROR);
			
			}
	}


$count = 1;
while($count<49){
	if(isset($_POST["".$count])){
		$seatno = $_POST["".$count];
		$sql3 = "insert into RESERVATION values('$tsid',$nic,$seatno,'$date',$fare,$ccn);";
		$rs=$conn->query($sql3);
			
		if($rs === false) {
			trigger_error('Wrong SQL: ' . $sql3 . ' Error: ' . $conn->error, E_USER_ERROR);
		}
	}
	$count = $count + 1;
}
	
?>
<body>

<div id="container" style="height:720px;width:1350px;background-color:#DFDFDF" >
		<div id="Upper_Container" style="height:40px;width:auto;background-color:#FFF;border-width:1px;border-bottom:2px;		border-bottom-color:#00F;border-bottom-style:ridge">
    		<div>
				<div id="login" style="float:right;padding-right:50px">  
					<table >
        			<td style="border-right-width:3px;border-right-color:#03F"><a href= "login.php"><img src="login-button-blue.png" alt="Login" style="width:auto;height:auto"></a></td>
            		<td bgcolor="#FFFFFF" style="border-left-width: thin; border-color: #CCC;">Dont have A account?<a href> Sign Up Now</a></td>
        		</table>
				</div>
    		</div>
		</div>
     
    
	<div id="cover" style="width:auto;height:auto;border-bottom:10px;border-bottom-color:#FFF;"><img src="cover.jpg" alt="over" style="width:1350px;height:110px">
	</div>

	<div id="spacer1" style="width:auto;height:3px ;background-color:#FFF">
	</div>

	<div id="menus" style="width:auto;height:30px"> 
	<table width="1350px;height:30px" border="1px" cellspacing="0" cellpadding="0px">
 	 <caption></caption>
 		 <tr>
   		 <td width="270px" height="30px"><a href="home.html"><img src="home-bt.jpg"><a></td>
   		 <td width="270px" height="30px"><a href="view.php"><img src="view-reser-bt.jpg"><a></td>
   		 <td width="270px" height="30px"><a href="buses.html"><img src="bus-bt.jpg"><a></td>
   		 <td width="270px" height="30px"><a href="company.html"><img src="company-bt.jpg"><a></td>
   		 <td width="270px" height="30px"><a href="contact.html"><img src="contact-bt.jpg"><a></td>
 		 </tr>
	</table>
	</div>
	<div id="spacer2" style="width:auto;height:10px ;"></div>

	<div id="form_container" style="width:1350px;height:420px;border-width:3px;overflow:hidden">
	
    <form action="reservation.html" style="width:800px;height:500px;border-width:2px">
     <div id="table_container" style="width:800px;height:200px;padding-top:50px;padding-left:500px;padding-right:200px">
				<img src="Success.jpg"><br>
                
     </div> 
     <div style = "padding-left:250px; width:1000px;">
                <h1>Your Booking and Transactions are Successfully Done..!</h1>
				</div>
    
    </form>
    
    
    
    
	</div>
<div id="footer1" style="height:97px;width:1350px;background-color:#CCC;box-shadow:-0px 0px 30px #999999">
<table width="1350" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="font-size:12px;width:450px;border-right:1px"><u>Top Bus Operators</u><br>
    								Janadhi Travels<br>
                                    PG Martin<br>
    </td>
    <td style="font-size:12px;width:450px">FAQ<br>
    										Terms Of Use<br>
                                            Privacy Policy<br>
                                            Offers
    </td>
    <td style="font-size:12px;width:450px">Hotel Offers<br>
    										Contact Us<br>
                                            Payment Methods<br>
                                            Customer Care						
    </td>
    <td style="font-size:12px;width:450px">
    <u>Connect With us<br></u>
    <a href="https://www.facebook.com/"><img src="fb.jpg"></a>
    <a href="https://www.twitter.com/"><img src="twitter.jpg"></a>
    </td>
  </tr>
</table>

</div>
<div id="footer2"  style="height:20px;width:1350px;background-color:#333;padding-left:550px;padding-top:2px">
	<div id="font_container" style="height:20px;width:1200px;font-size:12px;color:#FFF"> ticketing.lk 2014 All Right Reserved	 </div>
	</div>
</body>
</html>
