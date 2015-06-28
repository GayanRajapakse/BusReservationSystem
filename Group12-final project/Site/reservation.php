<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>reservation</title>
<script src="jquery.js"></script>
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
	$tsid = $_POST["tsid"];
	$sql = "select SeatNO from RESERVATION where TSID = '$tsid';";
	$rs=$conn->query($sql);
			
	if($rs === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
		$rows_returned = $rs->num_rows;
	}

	$fromcity = $_POST["fromcity"];
	$tocity = $_POST["tocity"];
	$sql = "select Fare from ROUTE where StartCity = '$fromcity' and EndCity = '$tocity'; ";
	$rs0=$conn->query($sql);
	$row = $rs0->fetch_assoc();
	$fare = $row['Fare'];
	$sql = "select Conditions from BUS where RegNo = (select RegNo from TIMESLOT where TSID = '$tsid');";
	$rs0=$conn->query($sql);
	$row = $rs0->fetch_assoc();
	if('AC' == $row['Conditions']) $fare = $fare * 2;
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
	<form action="payment.php" method="post" style="width:800px;height:500px;border-width:2px">
	<div id="info_container" style="width:1350px;height:450px;border-top-width:2px;border-color:#F49513;background-color:#FFF;padding:10px;overflow:hidden;background-image:url(back.jpg)">
   			<div style="width:auto;height:60px;border-width:10px;padding:2px">
   				<div style="padding:15px;padding-left:50px"><font size="+2"><b>Please Fill this information to Continue</b> </font></div> 
   			</div>
   <table width="900"  height="200" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td style="width:400px">   
    		<label><strong>Selected TSID:<strong></label>
            <input type="text" name="tsid" value="<?php echo htmlentities($tsid); ?>"><br><br>
    		<label><strong>NIC no.<strong></label><br>
            <input type="text" name="nic" value="XXXXXXXXX">V<br><br>
     		<label><strong>Address<strong></label><br>
            <input type="text" name="address" value="#,street,city"><br><br>
            <label><strong>Gender :<strong></label>
            <input type="radio" name="msex" value="m">Male
     		<input type="radio" name="fsex" value="f">Female<br><br>
            <label><strong>Fare<strong></label><br>
            <input type="text" name="fare" value="<?php echo htmlentities($fare); ?>"><br>
     </td>
    <td style="width:200px">
    	<label><strong>Name<strong></label><br>
            <input type="text" name="name" value=""><br><br>
     		<label><strong>Contact No.<strong></label><br>
            <input type="text" name="mob_no" value=""><br><br>
            <label><strong>Birthday :<strong></label>
            <input type="text" name="bd" value="yyyy-mm-dd"><br><br>
              <label><strong>Credit Card No:<strong></label><br>
            <input type="text" name="ccn" value=""><br>
    </td>
    <td style="width:300px">
    <div style="height:20px;font-size:16px;padding:5px"><strong>Seat Setup</strong></div>
    <table width="300px" border="1" cellspacing="0" cellpadding="2">
    <tr>
  <td><input type="checkbox" value="23" name="23" id="23">23</td>
  <td><input type="checkbox" value="21" name="21" id="21">21</td>
  <td><input type="checkbox" value="19" name="19" id="19">19</td>
  <td><input type="checkbox" value="17" name="17" id="17">17</td>
  <td><input type="checkbox" value="15" name="15" id="15">15</td>
  <td><input type="checkbox" value="13" name="13" id="13">13</td>
  <td><input type="checkbox" value="11" name="11" id="11">11</td>
  <td><input type="checkbox" value="9" name="9" id="9">9</td>
  <td><input type="checkbox" value="7" name="7" id="7">7</td>
  <td><input type="checkbox" value="5" name="5" id="5">5</td>
  <td><input type="checkbox" value="3" name="3" id="3">3</td>
  <td><input type="checkbox" value="1" name="1" id="1">1</td>
  </tr>
  <tr>
  <td><input type="checkbox" value="24" name="24" id="24">24</td>
  <td><input type="checkbox" value="22" name="22" id="22">22</td>
  <td><input type="checkbox" value="20" name="20" id="20">20</td>
  <td><input type="checkbox" value="18" name="18" id="18">18</td>
  <td><input type="checkbox" value="16" name="16" id="16">16</td>
  <td><input type="checkbox" value="14" name="14" id="14">14</td>
  <td><input type="checkbox" value="12" name="12" id="12">12</td>
  <td><input type="checkbox" value="10" name="10" id="10">10</td>
  <td><input type="checkbox" value="8" name="8" id="8">8</td>
  <td><input type="checkbox" value="6" name="6" id="6">6</td>
  <td><input type="checkbox" value="4" name="4" id="4">4</td>
  <td><input type="checkbox" value="2" name="2" id="2">2</td>
  </tr>
  <tr><td><input type="checkbox" value="25" name="25" id="25">25</td></tr>
  <tr>
  <td><input type="checkbox" value="26" name="26" id="26">26</td>
  <td><input type="checkbox" value="28" name="28" id="28">28</td>
  <td><input type="checkbox" value="30" name="30" id="30">30</td>
  <td><input type="checkbox" value="32" name="32" id="32">32</td>
  <td><input type="checkbox" value="34" name="34" id="34">34</td>
  <td><input type="checkbox" value="36" name="36" id="36">36</td>
  <td><input type="checkbox" value="38" name="38" id="38">38</td>
  <td><input type="checkbox" value="40" name="40" id="40">40</td>
  <td><input type="checkbox" value="42" name="42" id="42">42</td>
  <td><input type="checkbox" value="44" name="44" id="44">44</td>
  <td><input type="checkbox" value="46" name="46" id="46">46</td>
  <td><input type="checkbox" value="48" name="48" id="48">48</td>
  </tr>
  <tr>
  <td><input type="checkbox" value="27" name="27" id="27">27</td>
  <td><input type="checkbox" value="29" name="29" id="29">29</td>
  <td><input type="checkbox" value="31" name="31" id="31">31</td>
  <td><input type="checkbox" value="33" name="33" id="33">33</td>
  <td><input type="checkbox" value="35" name="35" id="35">35</td>
  <td><input type="checkbox" value="37" name="37" id="37">37</td>
  <td><input type="checkbox" value="39" name="39" id="39">39</td>
  <td><input type="checkbox" value="41" name="41" id="41">41</td>
  <td><input type="checkbox" value="43" name="43" id="43">43</td>
  <td><input type="checkbox" value="45" name="45" id="45">45</td>
  <td><input type="checkbox" value="47" name="47" id="47">47</td>
  <td><input type="checkbox" value="49" name="49" id="49">49</td>
  </tr>
  
</table>

    </td>
  </tr>
  
</table>

<script type="text/javascript">
$(document).ready(function(e) {
	function myFun(id){
    $('#'+id).attr('disabled',true);
}
    <?php
		while($row = $rs->fetch_assoc()){
			//	echo "myFun(".$row['SeatNO'].");";
			$str = $row['SeatNO']."";
			echo "myFun($str);";
		}
?>
});
</script>

<div id="search_button" style="width:800px;height:50px;padding-bottom:5px;padding-top:15px;padding-left:300px;padding-right:
200px">
	<input type="submit" name="reserve" value="Reserve" style="background-color:#C00;border-radius:6px;color:#FFF;width:200px;height:40px;font-size:27px;font-family:Tahoma, Geneva, sans-serif;cursor:pointer;-moz-border-radius:5px;-webkit-border-radius: 5px;box-shadow: -0px 0px 30px #999999">
</div>
    </div>
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
</form>
</div>
<div id="footer2"  style="height:20px;width:1350px;background-color:#333;padding-left:550px;padding-top:2px">
	<div id="font_container" style="height:20px;width:1200px;font-size:12px;color:#FFF"> ticketing.lk 2014 All Right Reserved	 </div>
</div>



</body>
</html>
