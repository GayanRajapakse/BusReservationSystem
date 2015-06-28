<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>update</title>
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
<div id="container" style="height:600px;width:1350px;background-color:#DFDFDF" >
		<div id="Upper_Container" style="height:40px;width:auto;background-color:#FFF;border-width:1px;border-bottom:2px;		border-bottom-color:#00F;border-bottom-style:ridge">
    		<div>
				<div id="login" style="float:right;padding-right:50px">  
					<table >
        			<td style="border-right-width:3px;border-right-color:#03F"><a href="home.html"><img src="logout.jpg" alt="Logout" style="width:auto;height:auto"></a></td>
            		
        		</table>
				</div>
    		</div>
		</div>
     
    
	<div id="cover" style="width:auto;height:auto;border-bottom:10px;border-bottom-color:#FFF;"><img src="cover.jpg" alt="over" style="width:1350px;height:110px">
	</div>

	<div id="spacer1" style="width:auto;height:3px ;background-color:#FFF">
	</div>
	<div id="menus" style="width:auto;height:30px"> 
	<table width="1350px;height:30px" border="0px" cellspacing="0" cellpadding="0px">
 	 <caption></caption>
 		 <tr style="padding-left:300px">
    		<td width="270px" height="30px" style="padding-left:400px"><a href="home.html"><img src="back-home.jpg"></a></td>
   		 <td width="0px" height="30px" style="padding-left:0px"><a href><img src="admin-bt.jpg"></a></td>
   		 
 		 </tr>
	</table>
	</div>
	
	<div id="spacer2" style="width:auto;height:10px ;"></div>

	<div id="form_container" style="width:1350px;height:250px;border-width:3px;overflow:hidden">
	<form action="update.php" method="get" style="width:800px;height:200px;border-width:2px;padding-left:300px;padding-top:20px;">
    <div id="view_container" style="width:800px;height:25px;border:none;padding-left:100px"> 
    <label>From</label><select name="from_city" style="width:175px">
        	 <option value="default">---select a City---</option>
        	<option value="kandy">Kandy</option>
        	</select>
     <label>To</label><select name="to_city" style="width:175px">
         <option value="default">---select a City---</option>
        <option value="colombo">Colombo</option>
        <option value="kegalle">Kegalle</option>
        <option value="gampaha">Gampaha</option><option value="kurunegala">Kurunegala</option>
        <option value="kadawatha">Kadawatha</option><option value="kelaniya">Kelaniya</option>
        </select>
     <input type="submit" name="search" value="Search" style="cursor:pointer" />
    
    </div>
    <div id="table_container" style="width:800px;height:200px;padding-top:5px;padding-left:0px;padding-right:200px">
     	<table width="700" border="1" cellspacing="1" cellpadding="2">
  		<caption>
  		  Search Results
 		 </caption>
  		<tr>
  			<th scope="col">&nbsp;RouteID</th>
            <th scope="col">&nbsp;StartCity</th>
            <th scope="col">&nbsp;EndCity</th>
            <th scope="col">&nbsp;Fare</th>
            <th scope="col">&nbsp;Distance</th>
            <th scope="col">&nbsp;Duration</th>
 		 </tr>
   <?php
			if(isset($_GET["from_city"]) && isset($_GET["to_city"])){
				$fromcity = $_GET["from_city"];
				$tocity = $_GET["to_city"];
				$sql = "select * from ROUTE where StartCity = '$fromcity' and EndCity='$tocity';";
				$rs=$conn->query($sql);
				
				if($rs === false) {
					trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
					$rows_returned = $rs->num_rows;
				}
				while($row = $rs->fetch_assoc()){
					echo "<tr>";
					echo "<td>" . $row['RouteID'] . "</td>";
					echo "<td>" . $row['StartCity'] . "</td>";
					echo "<td>" . $row['EndCity'] . "</td>";
					echo "<td>" . $row['Fare'] . "</td>";	
					echo "<td>" . $row['Distance'] . "</td>";		
					echo "<td>" . $row['Duration'] . "</td>";
					echo "</tr>";
				}
			}
	?>
		</table>

    	 </div> 
    
	</div>
         
	
	</form>
    
    <form id="update_info" style="width:600px;height:100px;padding-left:320px">
    <div id="newinfo" style="width:400px;height:100px;padding-top:0px;padding-left:50px;padding-right:220px;border:dashed">
     <label style="padding-left:250px;font-size:18px"><strong>Update</strong></label><br><br>
    <div id="update_info" style="width:600px;height:40px;padding-bottom:0px;padding-top:0px;padding-left:0px;padding-right:
	200px">
   		<label>Route ID</label>
     <input type="text" name="rid" value="" style="width:200px">
     <label>New Fare</label>
     <input type="text" name="fare" value="" style="width:200px"><br><br>
    </div>
    <div id="search_button" style="width:400px;height:50px;padding-bottom:5px;padding-top:0px;padding-left:150px;padding-right:
	0px">
	   
    <input type="submit" name="update" value="update" style="background-color:#C00;border-radius:6px;color:#FFF;width:250px;height:40px;font-size:27px;font-family:Tahoma, Geneva, sans-serif;cursor:pointer;-moz-border-radius:5px;-webkit-border-radius: 5px;box-shadow: -0px 0px 30px #999999">
    </div>
    </form>
	</div>
    </div>
<div id="footer2"  style="height:20px;width:1350px;background-color:#333;padding-left:0px;padding-top:2px">
	<div id="font_container" style="height:20px;width:1350px;font-size:12px;color:#FFF;padding-left:550px"> ticketing.lk 2014 All Right Reserved	 </div>
	</div>
<?php
			if(isset($_GET["rid"]) && isset($_GET["fare"])){
				$rid = $_GET["rid"];
				$fare = $_GET["fare"];
				$sql = "update ROUTE set Fare='$fare' where RouteID = '$rid';";
				$rs=$conn->query($sql);
				
				if($rs === false) {
					trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
					$rows_returned = $rs->num_rows;
				}
			}
?>
</body>
</html>
