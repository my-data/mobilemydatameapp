<?php 
// process incoming vars
	$owner = 'ww';
 	$db = mysql_connect("localhost", "igris_gprs", "");
	mysql_select_db("igris_gprs",$db);
  	// delete all journal records
 	if (isset($_REQUEST['ClearJournal']))
 	{
 		$result = mysql_query("DELETE from Incoming where owner='" . $owner . "'",$db);
	}
// end of process incoming vars
 	$result = mysql_query("SELECT * from Incoming where owner='" . $owner . "' order by datetime",$db);
?> 

<html>
<head>
<title>GPRS Test Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>

<body>
<table align="center"><tr><td>
<form name="form2" method="post" action="">
        <h1> 
          <input type="submit" name="Refresh" value="Refresh">
        </h1>
        
      <h1>Warwick Wireless GPRS Logging Record</h1>
<table border="1" width="800">
<th width="120">Device ID</th>
<th width="120">IP Address</th>
<th width="200">DateTime</th>
<th width="600">Message</th>

<?php
	for ($i=0; $i < mysql_num_rows($result); $i++)
	{
 		$cr = mysql_fetch_row($result);   
		echo "<tr><td>" . $cr[6] . "</td><td>" . $cr[1] . "</td><td>" . $cr[3] . "</td><td>" . $cr[4] . "</td></tr>";
		$message = $cr[4];
	}


</table>
  <input type="submit" name="ClearJournal" value="Clear All"><br>&nbsp;
</form>

</table>
</body>

<script>
var data = [
  {
    x: ["2013-10-04 22:23:00", "2013-11-04 22:23:00", "2013-12-04 22:23:00"], 
    y: [1, 3, 6], 
    type: "scatter"
  }
];

Plotly.plot(divid, data);
</script>

</html>


