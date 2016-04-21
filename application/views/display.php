      <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["gauge"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', 80],
          ['CPU', 55],
          ['Network', 68]
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        setInterval(function() {
          data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 13000);
        setInterval(function() {
          data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 5000);
        setInterval(function() {
          data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          chart.draw(data, options);
        }, 26000);
      }
    </script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["table"]});
      google.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('number', 'Salary');
        data.addColumn('boolean', 'Full Time Employee');
        data.addRows([
          ['Mike',  {v: 10000, f: '$10,000'}, true],
          ['Jim',   {v:8000,   f: '$8,000'},  false],
          ['Alice', {v: 12500, f: '$12,500'}, true],
          ['Bob',   {v: 7000,  f: '$7,000'},  true]
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
<!-- table style -->
<style>
body {
	margin-left: 10px;
}

table {
	border: 2px single black;
	padding-left: 10px;
	margin-left: 10px;
	vertical-align: center;
}

td {
	border: thin solid black;
	padding: 10px;
	margin-top: 5px
}
button{
	margin: 10px;
}

</style>

<!-- chart style -->
<style>
/*.chart{
	margin: 50px;
}
canvas, h4{
	position: center;
	margin: 75px;
}*/
</style>
<?php //echo ($data[1]['data_2'][0]['d5']);
 //echo $result[2];
//$result = array(
	//'username' => 'warwick1',
	//'companyname' => 'Tharsis',
//	'd0' => 'Button 1',
//	'd1' => 'Button 2',
//		'd2' => 'Button 3',
//	'd3' => 'Button 4',
//		'd4' => 'Button 5',
//	'd5' => 'Button 6',
//		'd6' => 'Button 7',
//	'd7' => 'Button 8',
//			'c0' => 'Count 1',
//	'c1' => 'Count 2',
//		'c2' => 'Count 3',
//	'c3' => 'Count 4',
//	); ?>
<div class="dashboard-header">
	<div class="Welcome">
	<h1> <?php  // echo $username; ?> Warwick Wireless GPRS Log </h1> <img id ="logo" border="1" src="<?php echo base_url();?>Uploads/logo.jpg" width ="133" height="133"> </p>
	<ul class="nav navbar-nav">
<!-- 		<li> <a href="<?php echo base_url('index.php/datatable'); ?>"> Table of Historical Data </a></li>
		<li> <a href="<?php echo base_url('index.php/rawdata2'); ?>"> Dashboard 2 </a></li>
		<li> <a href="<?php echo base_url('index.php/rawdata3'); ?>"> Dashboard 3 </a></li>
		<li> <a href="<?php echo base_url('index.php/mapview'); ?>"> Map View </a></li> -->
<!-- 		<li> <a href="<?php echo base_url('index.php/sendreport'); ?>"> Send User Report or Email </a></li>
 -->		<li> <a href="<?php echo base_url('index.php/About'); ?>"> About Us </a></li>
<!-- 		<li> <a href="<?php echo base_url('index.php/configuration'); ?>"> New User </a></li>
 -->		</ul>
				<p> <form action="<?php echo base_url('index.php/User/login'); ?>" method="get">
		<button id="logout" padding="150px"> Logout </button>
		<p class="testp"></p>
	</form> 
	</div>
	
</div>

<div class="container">
  <div class="row">
    <div class="datalogger_information">
     <h3>DataLogger Information</h3>
     <h6>Location: Los Angeles</h6>
     <h6>Phone number: 07804672808 </h6>
     <h6>DataLogger Id: CSGDGDGSF</h6>
     <h6>Last Sender ID: DS5243</h6>
   </div>
<!-- interactive buttons -->
<?php //  print_r($data_1[1]); ?>
<?php // echo sizeof($data[1]['data_2']); ?>
<!-- <div class="buttons">


<!--<button onclick="window.alert(5 + 6)">Try It</button>

	<!-- <form action="<?php echo base_url('index.php/rawdata/configure_digital_inputs')?>" method="POST">
	<!--<button onclick="button_click()">On/Off</button> 
	<div id="button-1">
		<h5><?php  echo ($data_1[1]['d0']); ?></h5> <div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"> <?php if ($data_2[1]['d0'] == "HI") {echo print_r($data_1[1]['d0_highstate']); } else {echo print_r($data_1[1]['d0_lowstate']);  } ?></a></div></div>
	</div>
	<div id="button-2">
		<h5><?php  echo ($data_1[1]['d1']);?></h5><div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"><?php if ($data_2[1]['d1'] == "HI") {echo print_r($data_1[1]['d1_highstate']); } else {echo print_r($data_1[1]['d1_lowstate']);  } ?></a></div></div>
	</div>

	<div id="button-3">
		<h5><?php  echo ($data_1[1]['d2']); ?></h5><div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Hi"><?php if ($data_2[1]['d2'] == "HI") {echo print_r($data_1[1]['d2_highstate']); } else {echo print_r($data_1[1]['d2_lowstate']);  } ?></a></div></div>
	</div>
		<div id="button-4">
		<h5><?php  echo ($data_1[1]['d3']); ?></h5><div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Lo"><?php if ($data_2[1]['d3'] == "HI") {echo print_r($data_1[1]['d3_highstate']); } else {echo print_r($data_1[1]['d3_lowstate']);  } ?></a></div></div>
	</div>
		<div id="button-5">
		<h5><?php  echo ($data_1[1]['d4']); ?></h5><div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"><?php if ($data_2[1]['d4'] == "HI") {echo print_r($data_1[1]['d4_highstate']); } else {echo print_r($data_1[1]['d4_lowstate']);  } ?></a></div></div>
	</div>
		<div id="button-6">
		<h5><?php  echo ($data_1[1]['d5']); ?></h5><div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"><?php if ($data_2[1]['d5'] == "HI") {echo print_r($data_1[1]['d5_highstate']); } else {echo print_r($data_1[1]['d5_lowstate']);  } ?></a></div></div>
	</div> 
		<div id="button-7">
		<h5><?php  echo ($data_1[1]['d6']); ?></h5><div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"><?php if ($data_2[1]['d6'] == "HI") {echo print_r($data_1[1]['d6_highstate']); } else {echo print_r($data_1[1]['d6_lowstate']);  } ?></a></div></div>
	</div>
		<div id="button-8">
		<h5><?php  echo ($data_1[1]['d7']); ?></h5><div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"><?php if ($data_2[1]['d7'] == "HI") {echo print_r($data_1[1]['d7_highstate']); } else {echo print_r($data_1[1]['d7_lowstate']);  } ?></a></div></div>
	</div>  -->
	<input type="submit" name="configure_digitial_inputs" value="Configure" onclick='configure_digitals()'>
	</form> 

	<script>
	//var d0_display = <?php print_r($data_1); ?>;
	d0_display = "<?php echo $data_1[1]['d0_IsDisplay']; ?>";
	d1_display = "<?php echo $data_1[1]['d1_IsDisplay']; ?>";
	d2_display = "<?php echo $data_1[1]['d2_IsDisplay']; ?>";
	d3_display = "<?php echo $data_1[1]['d3_IsDisplay']; ?>";
	d4_display = "<?php echo $data_1[1]['d4_IsDisplay']; ?>";
	d5_display = "<?php echo $data_1[1]['d5_IsDisplay']; ?>";
	d6_display = "<?php echo $data_1[1]['d6_IsDisplay']; ?>";
	d7_display = "<?php echo $data_1[1]['d7_IsDisplay']; ?>";
	//document.write(data);
	if (d0_display == TRUE){
		document.getElementById("button-1").style.display = "none";
	}
		if (d1_display == TRUE){
		document.getElementById("button-2").style.display = "none";
	}
		if (d2_display == TRUE){
		document.getElementById("button-3").style.display = "none";
	}
		if (d3_display == TRUE){
		document.getElementById("button-4").style.display = "none";
	}
		if (d4_display == TRUE){
		document.getElementById("button-5").style.display = "none";
	}
		if (d5_display == TRUE){
		document.getElementById("button-6").style.display = "none";
	}
		if (d6_display == TRUE){
		document.getElementById("button-7").style.display = "none";
	}
		if (d7_display == TRUE){
		document.getElementById("button-8").style.display = "none";
	}
	document.getElementById("button-1").style.display = "none";
	document.getElementById("button-4").style.display = "none";
	//console.log(5 + 6);
	</script>
</div> 

 <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
    
          <div id="ex0" position="relative" margin-top="4000px"></div>

          <script>

          google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Dogs');

      data.addRows([
        [0, 0],   [1, 10],  [2, 23],
        [3, 17],  [4, 18],  [5, 9],
        [6, 11],  [7, 27],  [8, 33],
        [9, 40],  [10, 32], [11, 35],
        [12, 30], [13, 40], [14, 42],
        [15, 47], [16, 44], [17, 48],
        [18, 52], [19, 54], [20, 42],
        [21, 55], [22, 56], [23, 57],
        [24, 60], [25, 50], [26, 52],
        [27, 51], [28, 49], [29, 53],
        [30, 55], [31, 60], [32, 61],
        [33, 59], [34, 62], [35, 65],
        [36, 62], [37, 58], [38, 55],
        [39, 61], [40, 64], [41, 65],
        [42, 63], [43, 66], [44, 67],
        [45, 69], [46, 69], [47, 70],
        [48, 72], [49, 68], [50, 66],
        [51, 65], [52, 67], [53, 70],
        [54, 71], [55, 72], [56, 73],
        [57, 75], [58, 70], [59, 68],
        [60, 64], [61, 60], [62, 65],
        [63, 67], [64, 68], [65, 69],
        [66, 70], [67, 72], [68, 75],
        [69, 80]
      ]);

      var options = {
        width: 1000,
        height: 563,
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Popularity'
        }
      };

      var chart = new google.visualization.LineChart(
        document.getElementById('ex0'));

      chart.draw(data, options);

    }

    </script>
    

 <div id="curve_chart" style="width: 900px; height: 500px"></div>

 <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'a0', 'a1', 'a2', 'a3'],
          ['2004-01-01 00:00:00',  <?php echo ($data_2[1]['a0']*$data_1[1]['a0_max']/1024); ?>, <?php echo ($data_2[1]['a1']*$data_1[1]['a1_max']/1024); ?>,<?php echo ($data_2[1]['a2']*$data_1[1]['a2_max']/1024); ?>,<?php echo ($data_2[1]['a3']*$data_1[1]['a3_max']/1024); ?>],
          ['2005-01-01 00:00:00',  <?php echo ($data_2[2]['a0']*$data_1[2]['a0_max']/1024); ?>, <?php echo ($data_2[2]['a1']*$data_1[2]['a1_max']/1024); ?>],<?php echo ($data_2[2]['a2']*$data_1[2]['a2_max']/1024); ?>,<?php echo ($data_2[2]['a3']*$data_1[2]['a3max']/1024); ?>],
          ['2006-01-01 00:00:00',  <?php echo ($data_2[3]['a0']*$data_1[3]['a0_max']/1024); ?>, <?php echo ($data_2[3]['a0']*$data_1[3]['a0_max']/1024); ?>],<?php echo ($data_2[3]['a2']*$data_1[3]['a2_max']/1024); ?>,<?php echo ($data_2[3]['a3']*$data_1[3]['a3_max']/1024); ?>
          ['2007-01-01 00:00:00',  1030,      540,1030,      540]
        ]);

        var options = {
          title: 'Plotted Quantities',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        var formatter = new google.visualization.DateFormat({pattern: "yyyy-dd-mm hh:mm:ss"});

        chart.draw(data, options);
      }
    </script>

<div id="counters">
<?php //print_r($data_2); ?>
<?php // print_r($data_2[1]); ?>

	
    <div id="shiva"><h4> <b>c0 label <?php echo $data_1[1]['c0']; ?> Units: <?php echo $data_1[1]['c0_xaxis']; ?> </b> </h4>
    <span class="count-1"> <b> <?php echo $data_2[1]['c0']; ?> </b> </span></div>

    <div id="shiva"><h4> <b> c1 label<?php echo $data_1[1]['c1'] ?> Units: <?php echo $data_1[1]['c1_xaxis']; ?> </b> </h4>
    <span class="count-2"><b><?php echo $data_2[1]['c1']; ?></b></span></div>

    <div id="shiva"><h4> <b> c2 label<?php echo $data_1[1]['c2'] ?> Units: <?php echo $data_1[1]['c2_xaxis']; ?> </b> </h4>
    <span class="count-3"><b><?php echo $data_2[1]['c2']; ?></b></span></div>

    <div id="shiva"><h4> <b> c3 label<?php echo $data_1[1]['c3'] ?> Units: <?php echo $data_1[1]['c3_xaxis']; ?> </b> </h4>
    <span class="count-4"><b><?php echo $data_2[1]['c3']; ?></b></span></div>

</div> 
       <script>
       // DISPLAY COUNTER IF DISPLAY IS SET 
   //    c0_IsChart ="<?php echo $data_1[1]['c0_IsGauge']; ?>"
   //    c1_IsChart ="<?php echo $data_1[1]['c1_IsGauge']; ?>"
   //    c2_IsChart ="<?php echo $data_1[1]['c2_IsGauge']; ?>"
   //    c3_IsChart ="<?php echo $data_1[1]['c3_IsGauge']; ?>"
     //  if (c0_IsChart == TRUE){
       //	document.getElementById("count-1").style.display = "none";
   //    }
     //   if (c1_IsChart == TRUE){
       //	document.getElementById("count-2").style.display = "none";
 //      }
   //     if (c2_IsChart == TRUE){
     //  	document.getElementById("count-3").style.display = "none";
       //}
 //       if (c3_IsChart == TRUE){
   //    	document.getElementById("count-4").style.display = "none";
       }
       		$('.count').each(function () {
       			$(this).prop('Counter',0).animate({
       				Counter: $(this).text()
       			}, {
       				duration: 4000,
       				easing: 'swing',
       				step: function (now) {
       					$(this).text(Math.ceil(now));
       				}
       		});
       	});
       </script>

    <div id="curve_chart" style="width: 900px; height: 500px"></div>

    <div id="chart_div" style="width: 400px; height: 120px;"></div>

    <div id="table_div"></div>

<div class="gauge">
<?php //  $jsondata = json_encode($data); ?>
<?php  // echo print_r($jsondata); ?>
<div id="chart_div" style="margin-left: 400px; width: 500px; height: 130px; padding: 5px"></div>

<script>
google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

    	varjsonData = $.ajax({
    		url: "<?php base_url('rawdata/getData')?>",
    		dataType:"json",
    		async:false
    	}).responseText;
    	

      var data = new google.visualization.DataTable(<?php echo json_encode($data);?>);
      data.addColumn('number', 'date');
      data.addColumn('number', 'Mile Traveled');
      data.addColumn('number', 'Speedometer');
      data.addColumn('number', 'Wind speed');
      data.addColumn('number', 'Tire Pressure');

      data.addRows([
      	
       [1, <?php echo $data[0]['data'][0]['a0'] ?>, <?php echo $data[0]['data'][0]['a1'] ?>, <?php echo $data[0]['data'][0]['a2'] ?>,<?php echo $data[0]['data'][0]['a3'] ?>],   
       [2, <?php echo $data[0]['data'][1]['a0'] ?>, <?php echo $data[0]['data'][0]['a1'] ?>, <?php echo $data[0]['data'][0]['a2'] ?>,<?php echo $data[0]['data'][0]['a3'] ?>], 
       [3, <?php echo $data[0]['data'][2]['a0'] ?>, <?php echo $data[0]['data'][0]['a1'] ?>, <?php echo $data[0]['data'][0]['a2'] ?>,<?php echo $data[0]['data'][0]['a3'] ?>]

     ]);

      var formatter = new google.visualization.DateFormat({pattern: 'yyyy-MM-dd}'});

      var options = {
        width: 1000,
        height: 563,
        backgroundColor: '#FFFFD3',
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Analogue variable'
        },
        curveType: 'function'
      };

      var chart = new google.visualization.LineChart(
        document.getElementById('ex0'));

      chart.draw(data, options);

    }
      
</script>

</div>

<div class="graph">
<?php // print_r($data_2); ?>
<?php // $jsondata = json_encode($data); ?>
<?php //  echo print_r($data[0]['data'][0]); ?>
	<div class="chart1" >
		<h4> <?php // echo ($data[1]['data_2'][0]['c0']); ?> </h4>
			<div class="canvas-container">		
			<div id="ex0"> 
			</div>	
				div id="ex0">
					<svg width="400" height="300">
  						<rect x="100" y="100" height="100" width="200"></rect>
					</svg>
				</div
				canvas id="canvas" ></canvas
			</div>
		</div>
	</div> 

	<script>
 google.setOnLoadCallback(drawChart);
      function drawChart() {

      	var jsondata = $.ajax({
      		type: "POST",
      		url: "<?php base_url('rawdata/get_data')?>",
      		data: { name: "Saul", location: "Leamington Spa" }
      	})
      	.done(function( msg ) {
      		alert("Data Saved" + MSG);
      	});

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Fuel Pressure', <?php echo $data[0]['data'][0]['c0'] ?>],
          ['Fuel Level', <?php echo $data[0]['data'][0]['c1'] ?>],
          ['Network', <?php echo $data[0]['data'][0]['c2'] ?>]
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        setInterval(function() {
          data.setValue(0, 1, <?php echo $data[0]['data'][0]['c0'] ?>);
          chart.draw(data, options);
        }, 13000);
        setInterval(function() {
          data.setValue(1, 1, <?php echo $data[0]['data'][0]['c0'] ?>);
          chart.draw(data, options);
        }, 5000);
        setInterval(function() {
          data.setValue(2, 1, <?php echo $data[0]['data'][0]['c0'] ?>);
          chart.draw(data, options);
        }, 26000);
      }
</script> 



<div id="chart_div" style="width: 400px; height: 120px;"></div>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["gauge"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', 80],
          ['CPU', 55],
          ['Network', 68]
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        setInterval(function() {
          data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 13000);
        setInterval(function() {
          data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 5000);
        setInterval(function() {
          data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          chart.draw(data, options);
        }, 26000);
      }
    </script> 

	<div class="third-widget-doughnut">
    <h4><?php echo ($data[1]['data_2'][0]['c1']); ?></h4>
    <p><a href="" class="button">Filter By Employee</a></p>
    <div class="canvas-container">
        <canvas id="hours"></canvas>
        <span class="status"></span>
    </div>
    <div class="chart-legend">
        <ul>
            <li class="ship">Shipping &amp; Receiving</li>
            <li class="rework">Rework</li>
            <li class="admin">Administrative</li>
            <li class="prod">Production</li>
        </ul>
    </div>
</div>

<hr>
<div class="verticalLine">

</div>

<div class="third widget">
    <div class="chart-legend">
        <h3>Customer Service Assessment</h3>
        <p>based on words mentioned</p>
        <p><a href="" class="button">Track another word</a></p>
    </div>
    <div class="canvas-container">
        <canvas id="departments"></canvas>
    </div>
</div> 
<div class="chart3" style="width:50%">
		<h4> <?php echo ($data[1]['data_2'][0]['c2']); ?></h4>
			<div class="canvas-container">
				<canvas id="canvas_3" height="900" width="1800"></canvas>
			</div>
	</div> 

	<div class="chart4" style="width:50%">
		<h4> <?php echo ($data[1]['data_2'][0]['c3']); ?> </h4>
			<div class="canvas-container">
				<canvas id="canvas_2" height="900" width="1800"></canvas>
			</div>
	</div> 

<div class="dropdown_box">
		<form action="">
		<select name="configuration_dropdown" onchange="showchart(this.value)">
		<option value =""> Select a customer </option>
		<option value="<?php echo $data[1]['data_2'][0]['a0'];?>"> <?php echo $data[1]['data_2'][0]['a0']; ?> </option>
		<option value="<?php echo $data[1]['data_2'][0]['a1']; ?>"> <?php echo $data[1]['data_2'][0]['a1']; ?> </option>
		<option value="<?php echo $data[1]['data_2'][0]['a2']; ?>"> <?php echo $data[1]['data_2'][0]['a2'];?> </option>
		<option value="<?php echo $data[1]['data_2'][0]['a3']; ?>"> <?php echo $data[1]['data_2'][0]['a3'];?> </option>
		</select>
		</form>
		<br>
		<div id="txtHint"></div>
</div>



<div class="raw_data">

	<h2> Raw Data </h2>
	<button type = 'submit' name='Refresh'>Refresh</button>
	<?php  // echo print_r($data[1]['data_2'][0]); ?>
	<?php // echo count($data[0]['data'][0]); ?>

	<table id="raw-data-table" align="center">
	<tr><th> DateTime </th><th> <?php echo $data[1]['data_2'][0]['a0']; ?></th><th> <?php echo $data[1]['data_2'][0]['a1']; ?> </th><th> <?php echo $data[1]['data_2'][0]['a2']; ?> </th><th> <?php echo $data[1]['data_2'][0]['a3']; ?> </th></tr> 
	<?php for ($i=0; $i < count($data[0]['data']); $i = $i + 1){ ?>
	<tr><td class="date"> <?php echo ($data[0]['data'][$i]['DateTime']);?></td>
	<td class="a0"> <?php  echo ($data[0]['data'][$i]['a0']);?> </td>
	<td class="a1"> <?php  echo ($data[0]['data'][$i]['a1']); ?> </td>
	<td class="a2"> <?php  echo ($data[0]['data'][$i]['a2']);?></td>
	<td class="a3"> <?php  echo ($data[0]['data'][$i]['a3']); ?></td></tr>
	<?php } ?>
	</table>

	<button name='clear all' onclick="clear_all()">Clear All</button>

</div>



<script>
//interactive buttons
 function button_click(){
    console.log("button clicked");
    $(".round-button-circle").on("click", function() {
        $(this).css("background-color", "red");
        if(document.getElementById(".round-button").value = "Off"){
            document.getElementById(".round-button").value="On";
            $(this).css("background-color","green");
        } else {
            document.getElementById(".round-button").value="Off";
        }
    });
}
</script>


<script>
function show_chart(){

	$.ajax({

	});
}
</script>
<script>
//WINDOW RESIZE PROTECTION

$(window).resize(function() {     
   var wi = $(window).width();      
      if (wi <= 980){         
   $("p.testp").text('Screen width is less than or equal to 980px. Width is currently: ' + wi + 'px.');        
       }

</script>

<script>
function configure_digitals(){
	$.ajax({
		type: "POST",
      	url: "<?php base_url('rawdata/configure_digital_inputs')?>",
	})
}
</script>

<script>
//$( document ).ready(function() {
	//var d0_display = <?php echo $data[1]['d0_isButton']; ?>;
//	console.log("ready!");
	//console.log(d0_display);

//	if (d0_display == TRUE){
//		console.log("a0 is to be displayed");
//		document.getElementById('#button-1').style.visibility = hidden;
//	}


//});

//window.onload = function(){
//	console.log('window loaded');
//	document.getElementById("button-1").style.visibility = hidden;
//}

$().ready(function(){
	console.log('hello');
	window.alert(5 + 6);
});

//function display_widgets(){
//	if (data[1]['a0_display'] == TRUE){
//		document.getElementById('#button-1').style.visibility = hidden;
//	}

//}

</script>

