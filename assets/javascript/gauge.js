// google.load('visualization', '1', {packages: ['corechart']});
//     google.setOnLoadCallback(drawChart);

//     function drawChart() {

//     	varjsonData = $.ajax({
//     		url: "<?php base_url('rawdata/getData')?>",
//     		dataType:"json",
//     		async:false
//     	}).responseText;
    	

//       var data = new google.visualization.DataTable(<?php echo json_encode($data);?>);
//       data.addColumn('number', 'date');
//       data.addColumn('number', 'Mile Traveled');
//       data.addColumn('number', 'Speedometer');
//       data.addColumn('number', 'Wind speed');
//       data.addColumn('number', 'Tire Pressure');

//       data.addRows([
      	
//        [1, <?php echo $data[0]['data'][0]['a0'] ?>, <?php echo $data[0]['data'][0]['a1'] ?>, <?php echo $data[0]['data'][0]['a2'] ?>,<?php echo $data[0]['data'][0]['a3'] ?>],   
//        [2, <?php echo $data[0]['data'][1]['a0'] ?>, <?php echo $data[0]['data'][0]['a1'] ?>, <?php echo $data[0]['data'][0]['a2'] ?>,<?php echo $data[0]['data'][0]['a3'] ?>], 
//        [3, <?php echo $data[0]['data'][2]['a0'] ?>, <?php echo $data[0]['data'][0]['a1'] ?>, <?php echo $data[0]['data'][0]['a2'] ?>,<?php echo $data[0]['data'][0]['a3'] ?>]

//      ]);

//       var formatter = new google.visualization.DateFormat({pattern: 'yyyy-MM-dd}'});

//       var options = {
//         width: 1000,
//         height: 563,
//         backgroundColor: '#FFFFD3',
//         hAxis: {
//           title: 'Time'
//         },
//         vAxis: {
//           title: 'Analogue variable'
//         },
//         curveType: 'function'
//       };

//       var chart = new google.visualization.LineChart(
//         document.getElementById('ex0'));

//       chart.draw(data, options);

//     }
//       