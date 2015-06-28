<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>view_reservation</title>
</head>

<body>
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
?>
<div id="container" style="height:auto;width:1350px;background-color:#DFDFDF" >
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

	<div id="form_container" style="width:1350px;height:auto;border-width:3px;overflow:hidden">
	
    <div  style="width:800px;height:500px;border-width:2px">
    <div id="delete_info" style="width:800px;height:100px;padding-bottom:5px;padding-top:15px;padding-left:400px;padding-right:
200px">
    <form action = "view.php" method = "get">
     <label>NIC</label>
     <input type="text" name="nic" value="" style="width:200px"> 
     
         <div id="search_button" style="width:800px;height:50px;padding-bottom:5px;padding-top:5px;padding-left:10px;padding-right:
		200px">
	   
    <input type="submit" name="search" value="Search" style="background-color:#C00;border-radius:6px;color:#FFF;width:250px;height:40px;font-size:27px;font-family:Tahoma, Geneva, sans-serif;cursor:pointer;-moz-border-radius:5px;-webkit-border-radius: 5px;box-shadow: -0px 0px 30px #999999">
    </div>
    </div>
    </form>
     <div id="table_container" style="width:800px;height:auto;padding-top:5px;padding-left:200px;padding-right:200px">
     <table width="700" border="1" cellspacing="1" cellpadding="2">
  <caption>
    Your Reservations
  </caption>
  <tr>
    <th scope="col">&nbsp;TSID</th>
    <th scope="col">&nbsp;CustNIC</th>
    <th scope="col">&nbsp;SeatNO</th>
    <th scope="col">&nbsp;Date</th>
    <th scope="col">&nbsp;Amount</th>
    <th scope="col">&nbsp;CreditCardNO</th>
  </tr>
   <?php
			if(isset($_GET["nic"])){
				$nic = $_GET["nic"];
				$sql = "select * from RESERVATION where CustNIC = '$nic';";
				$rs=$conn->query($sql);
				
				if($rs === false) {
					trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
					$rows_returned = $rs->num_rows;
				}
				while($row = $rs->fetch_assoc()){
					echo "<tr>";
					echo "<td>" . $row['TSID'] . "</td>";
					echo "<td>" . $row['CustNIC'] . "</td>";
					echo "<td>" . $row['SeatNO'] . "</td>";
					echo "<td>" . $row['Date'] . "</td>";	
					echo "<td>" . $row['Amount'] . "</td>";		
					echo "<td>" . $row['CreditCardNO'] . "</td>";
					echo "</tr>";
				}
			}
	?>
</table>

     </div>
     <form action = "view.php">
     <div id="delete_info" style="width:800px;height:100px;padding-bottom:5px;padding-top:0px;padding-left:300px;padding-right:
200px">
     <label>Do you want to cancel the reservation?</label><br>
     <label>Then please fill the folowing.</label><br><br>
    <div id="delete_info" style="width:800px;height:100px;padding-bottom:5px;padding-top:0px;padding-left:0px;padding-right:
200px">
     <label>TSID</label>
     <input type="text" name="tsid" value="" style="width:200px">
         <label>Seat No you have booked</label>
     <input type="text" name="seat" value="" style="width:200px">
     </div>
    </div>
    <div id="search_button" style="width:800px;height:50px;padding-bottom:5px;padding-top:5px;padding-left:400px;padding-right:
200px">
	   
    <input type="submit" name="Cancel-reserv" value="Cancel Reservation" style="background-color:#C00;border-radius:6px;color:#FFF;width:250px;height:40px;font-size:27px;font-family:Tahoma, Geneva, sans-serif;cursor:pointer;-moz-border-radius:5px;-webkit-border-radius: 5px;box-shadow: -0px 0px 30px #999999">
    </div>
    </div>
    
    
    
    
	</div>
    </form>
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
<div id="footer2"  style="height:20px;width:1350px;background-color:#333;padding-left:0px;padding-top:2px">
	<div id="font_container" style="height:20px;width:1350px;font-size:12px;color:#FFF;padding-left:550px"> ticketing.lk 2014 All Right Reserved	 </div>
	</div>
     
     <?php
			if(isset($_GET["tsid"]) && isset($_GET["seat"])){
				$tsid = $_GET["tsid"];
				$seat = $_GET["seat"];
				$sql = "delete from RESERVATION where TSID='$tsid' and SeatNO='$seat';";
				$rs=$conn->query($sql);
				
				if($rs === false) {
					trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				}
				
			}
	?>
</body>
</html>
