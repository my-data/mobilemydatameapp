<h2> Table of All Message Data Ever! </h2>
<a href="<?php echo base_url('setup_users');?>">Back</a> 
<p> this page shows all the messages for all the dataloggers sent in order to debug any issues. </p> 
<div id="search">
		<h2>Search Sender Id:</h2>
		<input type="text" id="search_box" placeholder="Type to search">
</div>  
<?php // print_r($config); ?>
<div id="wrold-table">
	<table id="my-wrold-table">
		<thead>
			<tr>
			<th> Sender ID </th>
			<th> Datetime </th>
			<?php   for ($i = 0; $i < count($config); $i++){ ?>
			<th><?php echo $config[$i]['label_name']; ?></th>
			<?php 	 } ?>
		</tr>
 		</thead>
 		<tbody>
 		<?php if (isset($messages)){  ?>
	 		<?php $i = count($messages[0]); ?>
			<?php foreach ($messages as $message) { ?>
			<tr>
				<td id="hello-wrold"> <?php echo $message['sender_id'] ?> </td>
				<td> <?php echo gmdate("Y-m-d H:i:s", $message['datetime']); ?></td>
	 			<td> <?php echo $message['a_0'] ?> </td>
				<td> <?php echo $message['a_1'] ?> </td>
				<td> <?php echo $message['a_2'] ?> </td>
				<td> <?php echo $message['a_3'] ?> </td>
	 			<td> <?php echo $message['c_0'] ?> </td>
				<td> <?php echo $message['c_1'] ?> </td>
				<td> <?php echo $message['c_2'] ?> </td>
				<td> <?php echo $message['c_3'] ?> </td>
				<td> <?php echo $message['d_0'] ?> </td>
				<td> <?php echo $message['d_1'] ?> </td>
				<td> <?php echo $message['d_2'] ?> </td>
				<td> <?php echo $message['d_3'] ?> </td>
				<td> <?php echo $message['d_4'] ?> </td>
				<td> <?php echo $message['d_5'] ?> </td>
				<td> <?php echo $message['d_6'] ?> </td>
				<td> <?php echo $message['d_7'] ?> </td>
			</tr>
			<?php } ?>
		<?php } else { echo "no messages"; } ?>
	</tbody>
	</table>
</div>

<script> 
	var $rows = $('#my-wrold-table tr');
	$('#search_box').keyup(function() {
	    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase().toString();
	    //val = val.tostring();
	    console.log(typeof val);
	    $rows.show().not('thead tr').filter(function() {
	        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	        return !~text.indexOf(val);
	    }).hide();
	});
</script>

<!--  	<button name='clear all' onclick="clear_all()">Clear All</button>
 --> 