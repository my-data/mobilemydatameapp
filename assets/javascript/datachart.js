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