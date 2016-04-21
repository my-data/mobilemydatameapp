

	<<div id="chart_div" style="width: 400px; height: 120px;"></div>

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
    </script> -->

	<<div class="third-widget-doughnut">
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
</div> -->
<<div class="chart3" style="width:50%">
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
</div>-->