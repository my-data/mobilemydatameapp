<h1> Raw Data Table</h1>
<a style='margin:10px;'class='btn btn-default' href="<?php echo base_url('rawdata');?>">Return</a>
<?php $last=count($results)-1; ?>
<?php //print_r($results); ?>
<?php //echo $last;?>
<table>
	<tr>
		<th>DATETIME</th>
		<th>SenderID</th>
		<th>A0</th>
		<th>A1</th>
		<th>A2</th>
		<th>A3</th>
<!-- 		<th>A4</th>
		<th>A5</th>
		<th>A6</th>
		<th>A7</th>
		<th>A8</th>
		<th>A9</th>
		<th>A10</th>
		<th>A11</th>
		<th>A12</th>
		<th>A13</th>
		<th>A14</th>
		<th>A15</th>
		<th>A16</th>
		<th>A17</th>
		<th>A18</th>
		<th>A19</th> -->	
		<th>D0</th>
		<th>D1</th>
		<th>D2</th>
		<th>D3</th>
		<th>D4</th>
		<th>D5</th>
		<th>D6</th>
		<th>D7</th>
		<th>C0</th>
		<th>C1</th>
		<th>C2</th>
		<th>C3</th>			
	</tr>
	<?php for ($i=0; $i < $last; $i++){ ?>
	<tr>
			<td><?php echo $results[$i]['datestring']; ?></td>
			<td><?php echo $results[$i]['sender_id']; ?></td>
			<td><?php echo $results[$i]['A0'];?></td>
			<td><?php echo $results[$i]['A1'];?></td>
			<td><?php echo $results[$i]['A2'];?></td>
			<td><?php echo $results[$i]['A3'];?></td>
<!-- 			<td><?php echo $results[$i]['A4'];?></td>
			<td><?php echo $results[$i]['A5'];?></td>
			<td><?php echo $results[$i]['A6'];?></td>
			<td><?php echo $results[$i]['A7'];?></td>
			<td><?php echo $results[$i]['A8'];?></td>
			<td><?php echo $results[$i]['A9'];?></td>
			<td><?php echo $results[$i]['A10'];?></td>
			<td><?php echo $results[$i]['A11'];?></td>
			<td><?php echo $results[$i]['A12'];?></td>
			<td><?php echo $results[$i]['A13'];?></td>
			<td><?php echo $results[$i]['A14'];?></td>
			<td><?php echo $results[$i]['A15'];?></td>
			<td><?php echo $results[$i]['A16'];?></td>
			<td><?php echo $results[$i]['A17'];?></td>
			<td><?php echo $results[$i]['A18'];?></td>
			<td><?php echo $results[$i]['A19'];?></td> -->
			<td><?php echo $results[$i]['D0'];?></td>
			<td><?php echo $results[$i]['D1'];?></td>
			<td><?php echo $results[$i]['D2'];?></td>
			<td><?php echo $results[$i]['D3'];?></td>
			<td><?php echo $results[$i]['D4'];?></td>
			<td><?php echo $results[$i]['D5'];?></td>
			<td><?php echo $results[$i]['D6'];?></td>
			<td><?php echo $results[$i]['D7'];?></td>
			<td><?php echo $results[$i]['C0'];?></td>
			<td><?php echo $results[$i]['C1'];?></td>
			<td><?php echo $results[$i]['C2'];?></td>
			<td><?php echo $results[$i]['C3'];?></td>
		</tr>
	<?php } ?>
</table>

<script>
//update table without page reload
 // setInterval(function () {
	// $.ajax({
	// 	  dataType: "json",
	// 	  url: 'http://my-data.org.uk/cloud/get_uri/get/all',
	// 	  data: data,
	// 	  success: success 
	// 	});
	// console.log(data);
	// $('.a_0').val(data[0]);
	// $('.a_1').val(data[1]);
	// $('.a_2').val(data[2]);
	// $('.a_3').val(data[3]);
	// $('.a_4').val(data[4]);
	// $('.a_5').val(data[5]);
	// $('.a_6').val(data[6]);
	// $('.a_7').val(data[7]);
	// $('.a_8').val(data[8]);
	// $('.a_9').val(data[9]);	
	// $('.a_10').val(data[10]);
	// $('.a_11').val(data[11]);
	// $('.a_12').val(data[12]);
	// $('.a_13').val(data[13]);
	// $('.a_14').val(data[14]);	
	// $('.a_15').val(data[15]);
	// $('.a_16').val(data[16]);
	// $('.a_17').val(data[17]);
	// $('.a_18').val(data[18]);
	// $('.a_19').val(data[19]);	
	// $('.a_20').val(data[20]);
	// $('.d_0').val(data[21]);
	// $('.d_1').val(data[22]);
	// $('.d_2').val(data[23]);
	// $('.d_3').val(data[24]);
	// $('.d_4').val(data[25]);
	// $('.d_5').val(data[26]);
	// $('.d_6').val(data[27]);	
	// $('.d_7').val(data[28]);
	// $('.c_0').val(data[29]);
	// $('.c_1').val(data[30]);
	// $('.c_2').val(data[31]);
	// $('.c_3').val(data[32]);	
 // }, 1000);
</script>
