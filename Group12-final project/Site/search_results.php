
<html>
<head>

<title>Search-results.html</title>
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
	if(isset($_POST["from_city"])){
		$fromcity = $_POST["from_city"];
	}
	if(isset($_POST["to_city"])){
		$tocity = $_POST["to_city"];
	}
	if($_POST["date"]){
		$date = $_POST["date"];
	}
	if(isset($_POST["s_time"])){
		$s_time = $_POST["s_time"];
	}
	if(isset($_POST["end_time"])){
		$end_time = $_POST["end_time"];
	}
	if(isset($_POST["condition"])){
		$condition = $_POST["condition"];
	}
	$sql="select TSID,Time,TS.RouteID,StartCity,EndCity,(select Conditions from BUS as B where B.RegNO = TS.RegNo) as Conditions from TIMESLOT as TS,ROUTE as R
where TS.RouteID in 
	(select RouteID from SUBROUTE where SubrouteID in 
		(select RouteID from ROUTE where StartCity = '$fromcity' and EndCity = '$tocity')) 
and TS.RouteID=R.RouteID and TS.Date = '$date' ";

	if($s_time != 'default' && $end_time != 'default'){
			$sql = $sql . "and (((select hour(Time))+(select minute(Time))/60)>='$s_time' and ((select hour(Time))+(select minute(Time))/60)<='$end_time') ";
	}else if($s_time != 'default' && $end_time == 'default'){
		$sql = $sql . "and (((select hour(Time))+(select minute(Time))/60)>='$s_time') ";
	}else if($end_time != 'default'){
		$sql = $sql . "and (((select hour(Time))+(select minute(Time))/60)<='$end_time') ";
	}
	
	if($condition == 'default'){
		$sql = $sql . ';';	
	}else{
		$sql = $sql . "and TS.RegNO in (select RegNO from BUS where Conditions = '$condition');";
	}
?>

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
	
    <form action="reservation.php" method="post" style="width:800px;height:500px;border-width:2px">
     <div id="table_container" style="width:800px;height:330px;padding-top:5px;padding-left:200px;padding-right:200px">
     <table width="700" border="1" cellspacing="1" cellpadding="2">
  <caption>
    info
  </caption>
  <tr>
    <th scope="col">&nbsp;TSID</th>
    <th scope="col">&nbsp;RouteID</th>
    <th scope="col">&nbsp;Time</th>
    <th scope="col">&nbsp;Start</th>
    <th scope="col">&nbsp;End</th>
    <th scope="col">&nbsp;Condition</th>
  </tr>
  <?php
			
            $rs=$conn->query($sql);
			
			if($rs === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
                $rows_returned = $rs->num_rows;
            }
            while($row = $rs->fetch_assoc()){
            	echo "<tr>";
				echo "<td>" . $row['TSID'] . "</td>";
				echo "<td>" . $row['RouteID'] . "</td>";
 				echo "<td>" . $row['Time'] . "</td>";
				echo "<td>" . $row['StartCity'] . "</td>";
				echo "<td>" . $row['EndCity'] . "</td>";
				echo "<td>" . $row['Conditions'] . "</td>";				
  				echo "</tr>";
			}
	?>
  
</table>

     </div> 
     <form action="reservation.php" method="post">
    <div id="search_button" style="width:800px;height:50px;padding-bottom:5px;padding-top:5px;padding-left:200px;padding-right:
200px">
	<label style="font-size:20px" > You Selected:</label>
    <input type="text" name="fromcity" value="<?php echo htmlentities($fromcity); ?>" style="width:200px">
    <input type="text" name="tocity" value="<?php echo htmlentities($tocity); ?>" style="width:200px"><br>
	<label style="font-size:20px" >TSID you want to reserve: </label>
    <input type="text" name="tsid" value="" style="width:200px">
     
    <input type="submit" name="search-bus" value="Reserve NOW" style="background-color:#C00;border-radius:6px;color:#FFF;width:250px;height:40px;font-size:27px;font-family:Tahoma, Geneva, sans-serif;cursor:pointer;-moz-border-radius:5px;-webkit-border-radius: 5px;box-shadow: -0px 0px 30px #999999">
    </div>
    </form>
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
	<div id="font_container" style="height:20px;width:1200px;font-size:12px;color:#FFF"> ticketing.lk 2014 All Right Reserved	 <div>
	</div>

</body>
</html>
