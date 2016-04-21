<h1 style='margin-left:20'> Emails Sent From website </h1>
<a style='margin:10;'class='btn btn-link'href="<?php echo base_url('setup_users');?>">Back</a> 
<a style='margin:10;'id='delete_emails'class='btn btn-danger' href="#">Delete</a> 
<!-- <div id="search">
		<h2>Search Sender Id:</h2>
		<input type="text" id="search_box" placeholder="Type to search">
</div>   -->
<?php // print_r($config); ?>
<div id="wrold-table">
	<table id="my-wrold-table">
		<thead>
			<tr style='font-size:large'>
			<th> Sender ID </th>
			<th> Datetime </th>
																<th> name </th> 

			<th> To </th>
			<th> From </th>
			<th> Subject </th>	
									<th> User message </th>
	
<!-- 						<th> Message </th>
<!--  -->			<!-- <th> Type </th> -->
		<!-- <th> Alarm no </th>
						<th> value </th>
						<th>scale</th>
									<th> threshold</th>	
											<th> direction </th>	
													<th> reset</th>
													<th> is on</th>
																						<th> threshold2</th>	
											<th> direction2 </th>	
													<th> reset2</th>
																										<th> is on 2</th>

																						<th> threshold3</th>	
											<th> direction 3</th>	
													<th> reset3</th>
													<th>is on 3</th>
																						<th> threshold4</th>	
											<th> direction </th>	
													<th> reset4</th>
													<th> is on 4 <th>-->
					</tr>
 		</thead>
 		<tbody>
 		<?php if (isset($email)){  ?>
	 		<?php $i = count($email); ?>
			<?php foreach ($email as $email) { ?>
			<tr>
				<td id="hello-wrold"> <?php echo $email['sender_id'] ?> </td>
				<td> <b> <?php echo gmdate("Y-m-d H:i:s", $email['time']);?> </b></td>
					 			<td> <b><?php echo $email['name']; ?></b> </td> 

	 			<td> <b><?php echo $email['to']; ?> </b></td>
	 			<td> <b><?php echo $email['from']; ?> </b></td>
	 			<td> <b><?php echo $email['subject']; ?> </b></td>
 			<td> <b><?php echo $email['usermessage']; ?> </b></td>
<!-- 	 			<td style="width:300px;"> <b><?php echo $email['message']; ?> </b></td>
 -->	 			<!-- <td> <b><?php echo $email['type']; ?></b> </td> -->
	 			<!-- <td> <b><?php echo $email['alarm_no']; ?></b> </td>
	 			<td> <b><?php echo $email['value']; ?> </b></td>
	 			<td> <b><?php echo $email['scaleby']; ?> </b></td>
	 			<td> <b><?php echo $email['threshold']; ?></b> </td>
	 			<td> <b><?php echo $email['direction']; ?> </b></td>
	 			<td> <b><?php echo $email['is_on']; ?> </b></td>
	 			<td> <b><?php echo $email['reset_level']; ?> </b></td>
	 			<td> <b><?php echo $email['threshold2']; ?></b> </td>
	 			<td> <b><?php echo $email['direction2']; ?></b> </td>
	 			<td> <b><?php echo $email['reset2']; ?></b> </td>
	 			<td> <b><?php echo $email['is_on2']; ?> </b></td>
	 			<td> <b><?php echo $email['threshold3']; ?> </b></td>
	 			<td><b> <?php echo $email['direction3']; ?> </b></td>
	 			<td> <b><?php echo $email['reset3']; ?> </b></td>
	 			<td> <b><?php echo $email['is_on3']; ?> </b></td>
	 			<td><b> <?php echo $email['threshold4']; ?> </b></td>
	 			<td><b> <?php echo $email['direction4']; ?> </b></td>
	 			<td><b> <?php echo $email['reset4']; ?> </b></td>
	 			<td> <b><?php echo $email['is_on4']; ?> </b></td>-->
		</tr>
			<?php } ?>
		<?php } else { echo "no messages"; } ?>
	</tbody>
	</table>
</div>

<script> 
	// var $rows = $('#my-wrold-table tr');
	// $('#search_box').keyup(function() {
	//     var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase().toString();
	//     //val = val.tostring();
	//     console.log(typeof val);
	//     $rows.show().not('thead tr').filter(function() {
	//         var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	//         return !~text.indexOf(val);
	//     }).hide();
	// });
</script>
<script>
$('#delete_emails').on('click',function(){
     $.ajax({
	  type: 'POST',
	  url: '<?php echo base_url(); ?>get_uri/delete/all_emails',
	  data: data,
	  dataType:'json',
	  success: function(res) {
			console.log(res);
			location.reload();
		},
	  error: function(err){
	  	console.log(err);
	  }
	});
});
</script>

<!--  	<button name='clear all' onclick="clear_all()">Clear All</button>
 --> 