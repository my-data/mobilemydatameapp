<h2 style='margin:10px;'> Email Log </h2>
<a style='margin:10px;'class= 'btn btn-default'href="<?php echo base_url('rawdata');?>">Back</a> 
<a style='margin:10px;'class= 'btn btn-danger'href="#" id='delete_email'>Delete</a> 
<?php // print_r($this->session->all_userdata()); ?>
<!-- <div id="search">
		<h2>Search Sender Id:</h2>
		<input type="text" id="search_box" placeholder="Type to search">
</div> -->  
<?php // print_r($email_table); ?>
<div id="email-table" style='    margin: 40;'>
	<table id="my-wrold-table">
		<thead>
			<tr>
				<th> Sender ID </th>
				<th> Datetime </th>
				<th> Alarm </th>
				<th> Alarm Number</th>
				<th> Received by <th>
			</tr>
 		</thead>
 		<tbody>
 		<?php if (isset($email_table)){  ?>
	 		<?php $i = count($messages[0]); ?>
			<?php foreach ($email_table as $email) { ?>
			<tr>
				<td id="hello-wrold"> <?php echo $email['sender_id'] ?> </td>
				<td> <?php echo gmdate("Y-m-d H:i:s", $email['time']); ?></td>
	 			<td> <?php echo $email['alarm_no']; ?> </td>
	 			<td> <?php echo $email['name']; ?> </td>
	 			<td> <?php echo $email['to']; ?> </td>
			</tr>
			<?php } ?>
		<?php } else { echo "no emails"; } ?>
	</tbody>
	</table>
	<input style='display:none'type="text" id="hidden_user_id" placeholder="Type to search" value='<?php echo $user_id;?>'>
</div>

<script> 
$('#delete_email').on('click',function(){
	user_id = $('#hidden_user_id').val();
	console.log(user_id);
	$.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>get_uri/delete/email',
        data: {user_id: user_id},
        success: function (res) {
        	console.log(res);
        	location.reload();
    //       if (res){
				// // Show Entered Value
				// //////console.log('succesful', number);
				// }
		},
		 error: function(e) {
		 	console.log(e);
			//called when there is an error
			//////console.log(e.message);
		  }
    });
})
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

<!--  	<button name='clear all' onclick="clear_all()">Clear All</button>
 --> 