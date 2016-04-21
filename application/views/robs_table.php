<div>
<h2><b>All Incoming Messages</b></h2>
<?php //echo base_url('setup_users');?>
<div class="block">
	<div class="form-inline">
<a style="margin:20px;"class="btn btn-primary" href="<?php echo base_url('setup_users');?>">Return to Dashboard</a>
	<form action="<?php echo base_url('get_uri/add_incoming_to_message_table');?>" method="post">
		<button style="margin:20px;" class="btn btn-default"type="submit" id="get_data_button" name='get_data_button' value=''>Add Message Data</button> 
	</form>
	<button style="margin:20px;"class="btn btn-danger" onclick="ajax_delete_incoming()">Delete Incoming</button>
	<button style="margin:20px;"class="btn btn-warning" id='clear_table'>Clear All Data</button>
</div>
</div>
<?php $last=count($results)-1; ?>
<?php //print_r($results); ?>
<?php //echo $last; ?>
<?php //print_r($results[$last]['command']); ?>
<span id="ajax"></span>
<table id='table'>
	<th> Device ID </th><th> IP Address </th><th> DateTime </th><th> Message </th>
<?php for ($i=0; $i < $last; $i++){ ?>
	<tr id='row<?php echo $i;?>'>
	<td> <?php echo $results[$i]['idx']; ?> </td>
	<td> <?php echo $results[$i]['IP']; ?> </td>
	<td> <?php echo $results[$i]['datetime']; ?> </td>
	<td> <?php echo $results[$i]['command']; ?> </td>
</tr>
<?php } ?>
</table>
<script>
$('#clear_table').on('click',function(){
		$('#table tr').css('display','none');
		sender_id = '<?php echo $sender_id;?>';
		console.log(sender_id);
		$.ajax({
		url:'<?php echo base_url('get_uri/get/all_incoming'); ?>'+'/'+sender_id,
		type:'POST',
		dataType:'json',
		success: function(data_messages){
			console.log(data_messages);
			$.ajax({
				url:'<?php echo base_url('get_uri/get/last_update_time'); ?>'+'/'+sender_id,
				type:'POST',
				dataType:'json',
				success: function(data_updatetime){
					console.log(data_updatetime);
					// display messages since last update time
					for(i=0;i<data_messages.length;i++){
						unixtimeincoming = Date.parse(data_messages[i].datetime);
						unixtime = unixtimeincoming.getTime()/1000;
						//var parsedUnixTime = new Date(unixtimeincoming).getUnixTime();
						//Date().getTime() / 1000;
						//console.log(unixtime);
						updatetime = parseInt(data_updatetime);
						//console.log(updatetime);
						if(unixtime > updatetime){
							console.log('time',unixtime,'date',updatetime);
							$('tr #row'+i).css('display','inline-grid');
						}
					}
				},
				error: function(error){
					console.log(error);
				}
			});
		},
		error: function(error){
			console.log(error);
		}
	});
});
$(function(){

})
function ajax_delete_incoming(){
	$.ajax({
		url:'<?php echo base_url('get_uri/delete_incoming'); ?>',
		type:'POST',
		success: function(data){
			console.log(data);
		},
		error: function(error){
			console.log(error);
		}
	});
}
 setInterval(function () {
		$.ajax({
        url: '<?php echo base_url('rawdata/add_incoming_to_message_table'); ?>',
        type: 'POST',
        // data: {
        //     key: value
        // },
        //dataType: 'json',
        success: function(data) {
            //console.log('success');
            //console.log(data);
        },
        error : function(error) {
        	//console.log('error');
    	}
    });
 }, 1000);
 setInterval(function () {
		 $.ajax({url: "<?php echo base_url();?>get_uri/get/incoming", success: function(result){
            //$("#ajax").html(result);
            //console.log(result);
        }});
 }, 1000);

// odd and even coloring of chart
	//$("tr:even").css("background-color", "#eeeeee");
	//$("tr:odd").css("background-color", "#ffffff");
	// get all message incoming data
	
	//console.log(data);
	//send remaingin data back to api.
</script>
</div>