     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
<!--     <?php $last = count($user_messages) -1; ?>
    <?php for($i=0; $i=$last; $i++){
      echo($user_messages[$i]['datetime']);
      echo($user_messages[$i]['a_1']);
    }  ?>
    <?php // echo $last; ?> -->
     <script type="text/javascript">
    //gauge


      google.load("visualization", "1", {packages:["gauge"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['a_0', <?php echo $user_messages[$last]['a_0'];?>],
          ['a_1', <?php echo $user_messages[$last]['a_1'];?>],
          ['a_2', <?php echo $user_messages[$last]['a_2'];?>],
          ['a_3', <?php echo $user_messages[$last]['a_3'];?>],
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

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
          ['Jim',   {v: 8000,   f: '$8,000'},  false],
          ['Alice', {v: 12500, f: '$12,500'}, true],
          ['Bob',   {v: 7000,  f: '$7,000'},  true]
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>

<div class="dashboard-header">
	<div class="Welcome">
	<h1> <?php echo $user[0]['username']?> Data Dashboard </h1> 
  <p> 
  <img id ="logo" border="1" src="<?php echo base_url();?>Uploads/logo.jpg" width ="75" height="75"> </p>
	<ul class="nav navbar-nav">
 	<li> <a href="<?php echo base_url('send_signal_x91000'); ?>"> Send Signal to X91000 </a></li>
  <li> <a href="<?php echo base_url('configure_dashboard'); ?>">  Configure your inputs </a></li>
	</ul>

	<p> <form action="<?php echo base_url('User/login'); ?>" method="get">
	<button id="logout" padding="150px"> Logout </button>
	<p class="testp"></p>
	</form> 

	</div>
	
  <div class="datalogger_information">
    <h3>DataLogger Information</h3>
    <table>
      <tr>
        <td>Phone number: <?php echo $datalogger[0]['phone'] ?></td>
      </tr>
      <tr>
    <td>Location: <?php echo $datalogger[0]['location'] ?></td>
     </tr>
      <tr>
    <td>Last Sender ID: <?php echo $datalogger[0]['sender_id']?></td>
      </tr>
    </table>
  </div>

</div>

<!--   <div class="buttons">
    <h2> Buttons </h2>
	   <form action="<?php echo base_url('rawdata/configure_digital_inputs')?>" method="POST">
	   <div id="button-1">
		  <h5><?php echo ($user_messages[0]['d_0']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_0'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
	</div> -->
	<!-- <div id="button-2">
		<h5><?php  echo ($data_1[1]['d1']);?></h5>
    <div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"><?php if ($data_2[1]['d1'] == "HI") {echo print_r($data_1[1]['d1_highstate']); } else {echo print_r($data_1[1]['d1_lowstate']);  } ?></a></div></div>
	</div>
	<div id="button-3">
		<h5><?php  echo ($data_1[1]['d2']); ?></h5>
    <div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Hi"><?php if ($data_2[1]['d2'] == "HI") {echo print_r($data_1[1]['d2_highstate']); } else {echo print_r($data_1[1]['d2_lowstate']);  } ?></a></div></div>
	</div>
		<div id="button-4">
		<h5><?php  echo ($data_1[1]['d3']); ?></h5>
    <div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Lo"><?php if ($data_2[1]['d3'] == "HI") {echo print_r($data_1[1]['d3_highstate']); } else {echo print_r($data_1[1]['d3_lowstate']);  } ?></a></div></div>
	</div>
		<div id="button-5">
		<h5><?php  echo ($data_1[1]['d4']); ?></h5>
    <div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"><?php if ($data_2[1]['d4'] == "HI") {echo print_r($data_1[1]['d4_highstate']); } else {echo print_r($data_1[1]['d4_lowstate']);  } ?></a></div></div>
	</div>
		<div id="button-6">
		<h5><?php  echo ($data_1[1]['d5']); ?></h5>
    <div class="round-button"><div class="round-button-circle"><a onclick="button_click()" href="#" class="round-button" value="Off"><?php if ($data_2[1]['d5'] == "HI") {echo print_r($data_1[1]['d5_highstate']); } else {echo print_r($data_1[1]['d5_lowstate']);  } ?></a></div></div>
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
	</script>
</div> 


<!--   <h2> Line Chart </h2>
 -->
 <div class="chart">
 <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
<!--           <div id="ex0" position="relative" margin-top="4000px"></div>
 -->
          <script>
          // google.load('visualization', '1', {packages: ['corechart', 'line']});
          // google.setOnLoadCallback(drawBackgroundColor);

          // function drawBackgroundColor() {
          //       var data = new google.visualization.DataTable();
          //       data.addColumn('number', 'X');
          //       data.addColumn('number', 'a1');
          //       data.addColumn('number', 'a2');

          //       data.addRows([
          //         [<?php echo $user_messages[0]['a_1']; ?>, <?php echo $user_messages[0]['datetime']; ?>],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
          //         [6, 11],  [7, 27],  [8, 33],  [9, 40],  [10, 32], [11, 35],
          //         [12, 30], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
          //         [18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
          //         [24, 60], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
          //         [30, 55], [31, 60], [32, 61], [33, 59], [34, 62], [35, 65],
          //         [36, 62], [37, 58], [38, 55], [39, 61], [40, 64], [41, 65],
          //         [42, 63], [43, 66], [44, 67], [45, 69], [46, 69], [47, 70],
          //         [48, 72], [49, 68], [50, 66], [51, 65], [52, 67], [53, 70],
          //         [54, 71], [55, 72], [56, 73], [57, 75], [58, 70], [59, 68],
          //         [60, 64], [61, 60], [62, 65], [63, 67], [64, 68], [65, 69],
          //         [66, 70], [67, 72], [68, 75], [69, 80]
          //       ]);

          //       var options = {
          //         hAxis: {
          //           title: 'Time'
          //         },
          //         vAxis: {
          //           title: 'Input 1'
          //         },
          //         backgroundColor: '#f1f8e9'
          //       };

          //       var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
          //       chart.draw(data, options);
          //     }
    </script>
    
      <script type="text/javascript" src="https://www.google.com/jsapi"></script>
      <div id="chart_div"></div>
      
  <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>
          <?php print_r($user_messages);?>
     <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Input 1', 'Input 2'],
          ['<?php echo $user_messages[0]['datetime'];?>'], 
           <?php echo $user_messages[0]['a_0'];?>, 
           <?php echo $user_messages[0]['a_1'];?>],
           
          ['12 Dec 2015',  1170, 460, 123, 345],
          ['01 Jan 2016',  235, 1120, 234, 2345],
          ['05 Feb 2016',  123, 540, 123, 123]
        ]);

        var options = {
          title: 'Here is a chart showing your data!',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

    <h2> Curve Chart </h2>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>

</div>

<!-- 
    <div class="dropdown_box" style="text-align:center">
        <select name="configuration_dropdown" onchange="showchart(this.value)">
        <?php print_r($input); ?>
         <option value =""> Select an Input To Plot</option>
        <?php for ($i = 0; $i = count($input); $i++){ ?>
        <option value=""> <?php echo $input[$i]['name']; ?> </option>
        <?php } ?>
        </select>
        <br>
        <div id="txtHint"></div>
    </div> -->


     <script type="text/javascript">
          google.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Year', 'a0', 'a1', 'a2', 'a3'],
              ['2004-01-01 00:00:00',  <?php echo ($data_2[1]['a0']*$data_1[1]['a0_max']/1024); ?>, 
              <?php echo ($data_2[1]['a1']*$data_1[1]['a1_max']/1024); ?>,
              <?php echo ($data_2[1]['a2']*$data_1[1]['a2_max']/1024); ?>,
              <?php echo ($data_2[1]['a3']*$data_1[1]['a3_max']/1024); ?>],
              ['2005-01-01 00:00:00',  <?php echo ($data_2[2]['a0']*$data_1[2]['a0_max']/1024); ?>,
               <?php echo ($data_2[2]['a1']*$data_1[2]['a1_max']/1024); ?>],
               <?php echo ($data_2[2]['a2']*$data_1[2]['a2_max']/1024); ?>,
               <?php echo ($data_2[2]['a3']*$data_1[2]['a3max']/1024); ?>],
              ['2006-01-01 00:00:00',  <?php echo ($data_2[3]['a0']*$data_1[3]['a0_max']/1024); ?>, 
              <?php echo ($data_2[3]['a0']*$data_1[3]['a0_max']/1024); ?>],
              <?php echo ($data_2[3]['a2']*$data_1[3]['a2_max']/1024); ?>,
              <?php echo ($data_2[3]['a3']*$data_1[3]['a3_max']/1024); ?>
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

    
<!--
<div id="counters">
	<h2> Count </h2>
    <div id="shiva">
    <h4> 
      <?php if ($input['type'] = "counter"){ ?>
        <p><b><?php echo $input[0]['name']; ?> </b></p>
        <p><b> Units: <?php echo $input[0]['units']; ?> </b></p> 
      </h4>
        <p><b> Value: <?php echo $user_messages[0]['c_0']; ?> </b> </p>
        
      </div>

    <!--     <div id="shiva"><h4> <b> c1 label<?php echo $data_1[1]['c1'] ?> Units: <?php echo $data_1[1]['c1_xaxis']; ?> </b> 
        </h4>
        <span class="count-2"><b><?php echo $data_2[1]['c1']; ?></b></span></div>

        <div id="shiva"><h4> <b> c2 label<?php echo $data_1[1]['c2'] ?> Units: <?php echo $data_1[1]['c2_xaxis']; ?> </b> 
        </h4>
        <span class="count-3"><b><?php echo $data_2[1]['c2']; ?></b></span></div>

        <div id="shiva"><h4> <b> c3 label<?php echo $data_1[1]['c3'] ?> Units: <?php echo $data_1[1]['c3_xaxis']; ?> </b> 
        </h4>
        <span class="count-4"><b><?php echo $data_2[1]['c3']; ?></b></span></div> 

      <?php } ?>

</div>
       <script>
      c0_IsChart ="<?php echo $data_1[1]['c0_IsGauge']; ?>"
      c1_IsChart ="<?php echo $data_1[1]['c1_IsGauge']; ?>"
      c2_IsChart ="<?php echo $data_1[1]['c2_IsGauge']; ?>"
      c3_IsChart ="<?php echo $data_1[1]['c3_IsGauge']; ?>"
      if (c0_IsChart == TRUE){
       	document.getElementById("count-1").style.display = "none";
      }
       if (c1_IsChart == TRUE){
       	document.getElementById("count-2").style.display = "none";
      }
       if (c2_IsChart == TRUE){
      	document.getElementById("count-3").style.display = "none";
       }
       if (c3_IsChart == TRUE){
      	document.getElementById("count-4").style.display = "none";
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

  <h2> Gauge </h2>

<div class="gauge">

<div id="chart_div" style="margin-left: 400px; width: 500px; height: 130px; padding: 5px"></div>

<script src="assets/gauge.js"></script>

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
					<svg width="400" height="300">
  						<rect x="100" y="100" height="100" width="200"></rect>
					</svg>
				</div
				canvas id="canvas" ></canvas
			</div>
		</div>
	</div> 

<script src="assets/datachart.js"></script>

	<div id="chart_div" style="width: 400px; height: 120px;"></div>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script src="assets/visualisation.js"></script>

  <h2> Doughnut </h2>

<!-- <div class="third-widget-doughnut">
    <h4><?php echo ($input[0]['display_type']); ?></h4>
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
		<h4> <?php echo $user_messages[0]['a_0']; ?></h4>
			<div class="canvas-container">
				<canvas id="canvas_3" height="900" width="1800"></canvas>
			</div>
	</div> 

	<div class="chart4" style="width:50%">
		<h4> <?php echo $user_messages[0]['a_3']; ?> </h4>
			<div class="canvas-container">
				<canvas id="canvas_2" height="900" width="1800"></canvas>
			</div>
	</div> 




<div class="raw_data">

	<h2> Table View</h2>
	<button type = 'submit' name='Refresh'>Refresh</button>
	<?php  // echo print_r($data[1]['data_2'][0]); ?>
	<?php // echo count($data[0]['data'][0]); ?>

	<table id="raw-data-table" align="center">
	<tr><th> DateTime </th><th> <?php echo $input[0]['name']; ?></th><th> <?php echo $input[1]['name']; ?> </th><th> <?php echo $input[2]['name']; ?> </th><th> <?php echo $input[3]['name'] ?> </th></tr> 
	<?php $number = 4; ?>
  <?php for ($i=0; $i < $number; $i = $i + 1){ ?>
	<tr><td class="date"> <?php echo $user_messages[0]['datetime'];?></td>
	<td class="a0"> <?php  echo $user_messages[0]['a_0'];?> </td>
	<td class="a1"> <?php  echo $user_messages[0]['a_1'];?> </td>
	<td class="a2"> <?php  echo $user_messages[0]['a_2'];?></td>
	<td class="a3"> <?php  echo $user_messages[0]['a_3'];?></td></tr>
	<?php } ?>
	</table>

	<button name='clear all' onclick="clear_all()">Clear All</button>

</div> -->

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
$( document ).ready(function() {
	var d0_display = <?php echo $data[1]['d0_isButton']; ?>;
	console.log("ready!");
	console.log(d0_display);

	if (d0_display == TRUE){
		console.log("a0 is to be displayed");
		document.getElementById('#button-1').style.visibility = hidden;
	}


});

window.onload = function(){
	console.log('window loaded');
	document.getElementById("button-1").style.visibility = hidden;
}

$().ready(function(){
	console.log('hello');
	window.alert(5 + 6);
});

function display_widgets(){
	if (data[1]['a0_display'] == TRUE){
		document.getElementById('#button-1').style.visibility = hidden;
	}

}

</script>

