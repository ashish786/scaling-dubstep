
<?php //by Ashish Kumar Singh IDD CSI Computer Science IIT Roorkee 10211006
echo"<div id = \"wrapper\">";
?>

<html>
<head>
<title>Search for Designation</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<div id="wrapper1">
<center><h2 class="search">Search for a particular designation</h3></center>
<form action="query.php" method="post" autocomplete="on">
Search*: <input type="text"  name="dquery" required placeholder="Enter designation (Eg: PHP Developer)" autofocus >
<input type="submit" value="Submit" name="submit">
</form>

</div>
</body>
</html>



<?php
$con = mysqli_connect("127.0.0.1", "localhost user", "password");

if(mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_error();
}
/*
$sql="CREATE DATABASE jobprofiles";
if (mysqli_query($con,$sql))
  {
  echo "Database jobprofiles created successfully";
  }
else
  {
  echo "Error creating database: " . mysqli_error($con);
  }*/

$select_db = mysqli_select_db( $con, "jobprofiles");
if(isset($_POST['submit'])){
//$dquery = mysql_real_escape_string($_POST['dquery']);
$dquery = strtoupper($_POST['dquery']);
$dquery = strip_tags($dquery);
$dquery = trim ($dquery);

if(!empty($dquery)) {
$query = mysqli_query($con, "SELECT * FROM mainsubject WHERE trim(upper(designation)) LIKE '%$dquery%'");
$query_rows = mysqli_num_rows($query);
$a=0;
//echo "<h2>Main Subjects</h2>";
echo"<strong>Search Result:</strong>";
echo"<div id=\"res\">";
if($query_rows>0) {
	$a++;
	
	//echo "<strong>Main Subjects</strong>";
	
	echo "<table id=\"tdesign\" border='1' cellpadding=\"10\">
	<caption>Main Subjects</caption>
	<tr>
	<th>Subject Name</th>
	<th>Skill factor</th>
	</tr>";
while($row = mysqli_fetch_array($query))
  {
  	echo "<tr>";
  	echo "<td>" . $row['msubject'] . "</td>";
  	echo "<td>" . $row['skillfactor'] . "</td>";
  	echo "</tr>";                           
  	
  }
echo"<br><br>";   
  }
echo"</div>";
//for skill subject

$query1 = mysqli_query($con, "SELECT * FROM skillsubject WHERE  designation='$dquery'");
$query_rows1 = mysqli_num_rows($query1);

if($query_rows1>0 ) {	
	//echo "<strong></strong>";
	$a++;
	echo"<table id=\"tdesign\" border='1' cellpadding=\"10\">
	<caption>Skill Subjects</caption>
	<tr>
	<th>Subject Name</th>
	<th>Skill factor</th>
	<th>Group</th>
	</tr>";
while($row1 = mysqli_fetch_array($query1))
  {
  	echo "<tr>";
  	echo "<td>" . $row1['ssubject'] . "</td>";
  	echo "<td>" . $row1['skillfactor'] . "</td>";
  	echo "<td>" . $row1['grpn'] . "</td>";
  	echo "</tr>";                           
  	
  }
  
  echo"<br><br>"; }

$query2 = mysqli_query($con, "SELECT * FROM toolsid WHERE  designation='$dquery'");
$query_rows2 = mysqli_num_rows($query2);

if($query_rows2>0) {
	$a++;	
	echo "<strong>Tools and IDE</strong>";
	echo "<br>";
	echo "<table border='1' cellpadding=\"10\">
	<caption>Tools and IDE</caption>
	<tr>
	<th>Tools Name</th>
	<th>Skill factor</th>
	<th>Group</th>
	</tr>";
while($row2 = mysqli_fetch_array($query2))
  {
  	echo "<tr>";
  	echo "<td>" . $row2['toolsides'] . "</td>";
  	echo "<td>" . $row2['skillfactor'] . "</td>";
  	echo "<td>" . $row2['grpn'] . "</td>";
  	echo "</tr>";                           
  	//echo "<br>";
  }
  echo"<br><br>";  }
 //else {echo"No entry found for Tools and IDE for designation: ".$dquery;} 
  
  
  //for groups  

$query3= mysqli_query($con, "SELECT * FROM grp WHERE  designation='$dquery'");
$query_rows3 = mysqli_num_rows($query3);

if($query_rows3>0) {
		
	$a++;
	echo "<table border='1' cellpadding=\"10\">
	<caption>Groups Details</caption>
	<tr>
	<th>Group </th>
	<th>Min Exam</th>
	<th>Min Skill factor</th>
	</tr>";
while($row3 = mysqli_fetch_array($query3))
  {
  	echo "<tr>";
  	echo "<td>" . $row3['grpno'] . "</td>";
  	echo "<td>" . $row3['minsubject'] . "</td>";
  	echo "<td>" . $row3['minskill'] . "</td>";
  	echo "</tr>";                           
  	
  }
  echo"<br><br>";  }

if($query_rows==0 && $query_rows1==0 && $query_rows2==0 && $query_rows3==0) {echo"No Results Found";
}  
  }
  }
  mysqli_close($con);  
?>

<?php
echo"</div>";
?>
