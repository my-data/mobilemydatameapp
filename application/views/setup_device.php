<div id="device form" style="margin:30px;    margin-bottom: 100;">
	<h2> <b>Datalogger Setup for <?php echo $user[0]['username'];?></b></h2>
	<?php //print_r($datalogger); ?>
	<?php //print_r($user);?>
	<?php //print_r($_POST);?>
	<?php $user_id = $_POST['user_id'];?>
	<?php $selected_datalogger = $_POST['devices_dropdown']; ?>
	<?php //print_r($selected_datalogger);?>
	</div>
</div>
	<script>
	$(function() {
	  $("#dialog").dialog({autoOpen : false, modal : true, show : "blind", hide : "blind"});
	  $( "#dialog" ).dialog( "option", "width", 500 );
	  $("#contactUs").click(function() {
	    $("#dialog").dialog("open");
	    return false;
	  });
	});
</script>
<!--  <div class='block'>
  <p> Current Devices: 
			<form action="setup_device"method="post">
			<select id="machinename_dropdown" name="machinename_dropdown">
				<?php for ($i =0; $i<count($datalogger); $i++){ ?> 
					<?php echo "<option selected value=".$i.">".$datalogger[$i]['machine_name']."</option>";?>
				<?php } ?>
				<select> 
			    <input id="devicename_autocomplete" name="devicename_autocomplete" placeholder='Enter device here'>
				<button type="submit" value="refresh" name='refresh'>Refresh</button>
				<button type="button" name='Clear Fields' onclick='clear_fields()'>Clear Fields </button></p>
			</form>
	 	<hr>
	</p> 
</div> --> 
	<?php  //if (!isset($user_id)){ echo "<p><b>User no selected. GO back to previous page and select a user to edit there devices</b></p>";}?>
	<script>
	$(function(){
		user_id = <?php echo $user[0]['user_id'];?>;
		empty = <?php echo isset($user[0]['user_id']);?>;
		//console.log('user_id', user_id, 'is_empty?', empty);
		username = $('#username').val();
		if (!user_id){
			$('#nouserid').css('display','inline');
		}
		if (username) {
			//console.log('no username selected and present in username text box');
		}

	});
	</script>
	<div id="dialog3" title="No User found." style='display:none'>
			  <p><b>You have not selected a User therefore no devices have been found. Please go back and select a user to edit there devices. </b></p>
		  </div>
		 <script>
		  $(function() {
		  	// if (count.length > 0 ){
		  	// 	//console.log('messages present');
		  	// 	('#dialog2').dialog('close');
		  	// }
		    $("#dialog3").dialog({
		        autoOpen: false,
		        height: 275,
		        width: 300,
 				position: { my: 'top', at: 'top+150' },
 				//resizable: true,
				buttons: {
				        'Close' : function() {
				            $(this).dialog('close');
				        } 
				    }
        				//position: ["bottom",50],
		        //title: "Dialog"
		    });
		   	userid = <?php echo $user[0]['user_id'];?>;
		  	if (!userid){
			  	var options = { 
				    autoOpen: false,
			        height: 225,
			        width: 300,
	 				position: { my: 'top', at: 'top+150' ,of:window},
	 				buttons: {
					        'Close' : function() {
					            $(this).dialog('close');
					        } 
					    }
	 				//resizable: true,
				}; 
			  	var myDialog = $("#dialog3").dialog(options);
			  	//console.log('Contains no devices. Open dialog',myDialog);
			  	//$('#dialog2').css('visibility','visible');
				myDialog.dialog('open');
				myDialog.dialog( "option", "position", { my: 'top', at: 'top+150' } );
			 }
		  });
		  </script>	 
	<?php // if (count($datalogger) ==0){ echo "<p><b>No dataloggers for this person. Please add a device.</b></p>";}?>
		<div id="dialog2" title="No device found." style='display:none'>
			  <p><b>No dataloggers for this person. Please add a device.</b></p>
		  </div>
		 <script>
		  $(function() {
		  	// if (count.length > 0 ){
		  	// 	//console.log('messages present');
		  	// 	('#dialog2').dialog('close');
		  	// }
		    $("#dialog2").dialog({
		        autoOpen: false,
		        height: 275,
		        width: 300,
 				position: { my: 'top', at: 'top+150' },
 				//resizable: true,
				buttons: {
				        'Close' : function() {
				            $(this).dialog('close');
				        } 
				    }
        				//position: ["bottom",50],
		        //title: "Dialog"
		    });
		   	count = <?php echo count($datalogger);?>;
		 // messages = <?php echo count($messages);?>;
		 // //console.log('number of messages', messages);
		  if (count === 0){
		  	var options = { 
			    autoOpen: false,
		        height: 225,
		        width: 300,
 				position: { my: 'top', at: 'top+150' ,of:window},
 				buttons: {
				        'Close' : function() {
				            $(this).dialog('close');
				        } 
				    }
 				//resizable: true,
			}; 
		  	var myDialog = $("#dialog2").dialog(options);
		  	//console.log('Contains no devices. Open dialog',myDialog);
		  	//$('#dialog2').css('visibility','visible');
			myDialog.dialog('open');
			myDialog.dialog( "option", "position", { my: 'top', at: 'top+150' } );

		  }
		  if(count === 1){
		  		  	$.ajax({
				        url: '<?php echo base_url('get_uri/get/get_device_for_user'); ?>'+'/'+'<?php echo $user[0]['user_id'];?>',
				        type: 'POST',
				        dataType: 'json',
				        success: function(data) {
				            //console.log(data);
				            ////console.log(data[device_id]);
				            //loop through data and place in table here 
				            var machinenames = [];
				            for (i=0;i<data.length;i++){
				            	////console.log(data[i].username);
				            	machinenames.push(data[i].machine_name);
				            	//console.log(machinenames[i]);
				            }
				            //console.log(machinenames);
				            $('#type option[value='+data[0].type+']').attr('selected', 'selected');
				            $('#sender_id').val(data[0].sender_id);
				            $('#machinename').val(data[0].machine_name);
				            // $('#location').val(data[0].location);
				            $('#address1').val(data[0].address1);
				            $('#address2').val(data[0].address2);
				            $('#phone').val(data[0].phone);
				            $.ajax({
						        url: '<?php echo base_url('get_uri/get/user'); ?>'+'/'+'<?php echo $user[0]['user_id'];?>',
						        type: 'POST',
						        dataType: 'json',
						        success: function(data) {	  
						        //console.log(data);      
						            $('#username').val(data[0].username);
						        },
						        error : function(error) {
						        	//console.log(error);
						    	}
						    });
				        },
				        error : function(error) {
				        	//console.log(error);
				    	}
				    });
		  }
		  });
		  </script>	  
	<?php // if(!isset($_POST)){ echo "<p><b>No user selected please go back to previous page to select the user.</b></p>";}?>
	 <script>
  $(function() {
  	var devices = [];
  	//console.log('user_id',<?php echo $user[0]['user_id'];?>);
  });
  </script>
  <div class='block' style='    width: 350px;'>
  	 <p><b style='margin-top: 15;    margin-left: 30;'> Current Devices: <b></p>
<!-- 	 <form class="form-horizontal" style="margin-left:100px;">
 -->  	 <!-- 	<div class="form-group" style="width:300px;"> -->
  		<form method="post" action="setup_device">
  			<?php //print_r($datalogger);?>
			<select style='width:150px;  margin-bottom: 50;  float: right; margin-top: -50;'class="form-control" id="devices_dropdown" name="devices_dropdown">
			<option>Select device:</option>
			<?php for ($i =0; $i<count($datalogger); $i++){ ?> 
				<?php echo "<option value=".$i.">".$datalogger[$i]['machine_name']."</option>";?>
			<?php  } ?>
			<select> 
	        <div class="alert alert-danger" style='display:none;color:red;'id='nouserid'><label style='display:inline;'>No username found. Go back and select a username</label></div>				
		</div>
			<input hidden value='<?php echo $user[0]['user_id'];?>'type='text' id="useridhidden2" name="useridhidden2"placeholder="user id" class="form-control pad" style="margin:20px;width:90%;visibility:hidden"></input>			
			<div class='block' style='   width: 350;margin-left: 200; margin-top: -80;'>
<!-- 			<button onclick='stuffdevicehidden()'class="btn btn-primary" type="submit" style="margin:10px;"> Refresh </button>
 -->		
			<button class="btn btn-default" type="button" name='Clear Fields' onclick='clear_fields()' style="margin:10px;"> Clear Fields </button></p>
			<a style="float:right;margin:10px;    margin-top: -52;margin-right:120" class = "btn btn-info" href="#" id="contactUs">Help Button</a>  
			<a style="margin:10px;margin-top: -52;    margin-left: 280;"class="btn btn-danger" href="<?php echo base_url('User/login'); ?>">Logout</a>
			<a class="btn btn-default"style="margin: 20px;margin-left: 110px;    margin-left: 370px;    margin-top: -52;"href="<?php echo base_url('setup_users');?>">Back</a>
			<div class='block'>
				<label style='margin: 15;float: left;display:inline-block'><b>SenderID:</b></label><input type='text' class='form_control' id ='find_user' style='float:right;'></input>
 					<div class="alert alert-danger" style='display:none;color:red;float:right;position:absolute;left:750;top:285;'id='senderidnotfound'><label style='display:inline-block; height:15;'>SenderID not present</label></div>				
 					<div class="alert alert-success" style='display:none;float:right;position:absolute;left:750;top:300;'id='senderidfound'><label style='display:inline'></label></div>				
			</div>
		</div>
		</form>
<!-- 	</div>  -->
</div>
<?php if (empty($selected_datalogger)){
	$selected_datalogger = 0;
} ?>
<script>
$('#devices_dropdown').on('change', function(){
	device_id = $('#devices_dropdown').val();
	//console.log('device_id selected is:', device_id);
	  	$.ajax({
        url: '<?php echo base_url('get_uri/get/get_device_for_user'); ?>'+'/'+'<?php echo $user[0]['user_id'];?>',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            //console.log(data);
            //console.log(data[device_id]);
            //loop through data and place in table here 
            var machinenames = [];
            for (i=0;i<data.length;i++){
            	////console.log(data[i].username);
            	machinenames.push(data[i].machine_name);
            	//console.log(machinenames[i]);
            }
            //console.log(machinenames);
            $('#type').val(data[device_id].type);
            $('#sender_id').val(data[device_id].sender_id);
            $('#machinename').val(data[device_id].machine_name);
            //$('#location').val(data[device_id].location);          
            $('#address1').val(data[device_id].address1);
            $('#address2').val(data[device_id].address2);
            $('#phone').val(data[device_id].phone);
            $('#postcode').val(data[device_id].postcode);
            $('#googlemap').attr('src','http://maps.google.com/maps/api/staticmap?center='+data[device_id].postcode+'&zoom=14&size=200x200&maptype=roadmap&markers=color:ORANGE|label:A|POSTCODEHERE&sensor=false"');
            $.ajax({
		        url: '<?php echo base_url('get_uri/get/user'); ?>'+'/'+'<?php echo $user[0]['user_id'];?>',
		        type: 'POST',
		        dataType: 'json',
		        success: function(data) {	  
		        //console.log(data);      
		            $('#username').val(data[0].username);
		        },
		        error : function(error) {
		        	//console.log(error);
		    	}
		    });
        },
        error : function(error) {
        	//console.log(error);
    	}
    });
})
</script>
<script>
function stuffdevicehidden(){
	val = $('devices_dropdown').text();
	//console.log(val);
	$('devicehidden').val(val);
	$('useridhidden').val(<?php echo $user[0]['user_id'];?>);
	$('useridhidden2').val(<?php echo $user[0]['user_id'];?>);

}
</script>
<!-- 	<hr>
 -->	</p>
	<div class="center-block" style="margin-left:200px;">
  <form id="myForm" action="<?php echo base_url('setup_device/add_device');?>" method='POST'>
  	<table class='table-striped'>
  		 <tr>
  			<td >
  				<div class="block">
  				 <label style='width: 30%;'>User:</label> <input style='margin: 20px; width: 50%;' type='text' name='username' id="username"  
  				 value="<?php echo $user[0]['username'];?>" > 	
  				</div>	
  			</td>
			<td>
				<div class="block">
				<label style='width: 30%;'> Type: </label><select style='    width: 50%;'class='form-control'name='type', id='type'><option value='empty'><b>Please select:</b></option><option value='X9100'>X9100</option><option value='Raspberry Pi'>X1000</option></select> <!-- <input type='text' name='type' id="type" style="margin:20px;width:50%;">  -->
				 <div class="alert alert-danger" style='display:none;color:red; width:180;      margin-right: 40;  float: right;'id='notype'><label style='display:inline'>Please enter type of device</label></div>				
				</div>
			</td>
		</tr>
  		<tr>
  			<td >
  				<div class="block">
  				 <label style='width: 30%;'>Sender ID:</label> <input style='margin: 20px; width: 50%;height:auto;' type='text' name='sender_id' id="sender_id"  
  					 > 	
  				</div>	
  				<div class="alert alert-success"style='display:none;color:green;    margin-top: 0;top: -100;margin-left: 100;'id='fill'><label>This sender id is available</label></div>
  				 <div class="alert alert-danger" style='display:none;color:red; margin-top: -80; top: -100;margin-left: 100;'id='nofill'><label>This is not available</label></div>				
  			</td>
			<td>
				<div class="block">
				<label style='width: 30%;'>Name:</label> <input required type='text' name='name' id="machinename" style="margin:20px;width:50%;"
					> 
				 <div class="alert alert-danger" style='display:none;color:red; width: 200;margin-left:150;'id='nomachinename'><label style='display:inline'>Please assign a machine name</label></div>				
				 <div class="alert alert-danger" style='display:none;color:red; margin-left:140;'id='samename'><label style='display:inline'>Name already taken</label></div>				
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="block">
				 <label style='width: 30%;'>Address 1: </label><input type='text' name='address1' id="address1" style="margin:20px;width:50%;"
					> 
				</div>
			</td>
			<td>
				<div class="block">
				 <label style='width: 30%;'>Address 2: </label><input type='text' name='address2' id="address2" style="margin:20px;width:50%;"
					> 
				</div>
 			</td>
 		</tr>
		<tr>
			<td>
				<div class="block">
				 <label style='width: 30%;'>Postcode: </label><input type='text' name='postcode' id="postcode" style="margin:20px;width:50%;"
					> 
				</div>
			</td>
			<td>
				<div class="block">
				 <label style='width: 30%;'>Phone:</label> <input type='text' name='phone' id="phone"  style="margin:20px;width:50%;"
					> 
				 <div class="alert alert-danger" style='display:none;color:red; top: -100;margin-left: 100;width:width: 300;'id='nophone'><label>Assign contact number</label></div>				
 				</div>
 			</td>
 		</tr>
 	</table>
</div>
	<br>
 		<a id='add_device_button' href='#' onclick='post_device()' class="btn btn-default" value='add_device' style="margin:20px; margin-left: 385px;">Add Device</a>
		<a href='#' onclick='edit_device()' class="btn btn-primary" value='edit_device' style='margin:20px;'>Edit Device</a>
	    <a href='#' onclick='delete_data()' class="btn btn-danger"  value='delete_data' style='margin:20px;'>Delete Data</a>
		<a href='#' onclick='delete_device()' class="btn btn-warning"  value='delete_device' style='margin:20px; height: 35; width: 130;'>Delete Device</a>
 		<input style='visibility:hidden' type='text' name='useridhidden' id="useridhidden" 
		value="<?php echo $user[0]['user_id']?>"> 
		</form> 
	<hr>
</div>
<!--<img style='margin:10'id='googlemap'src="http://maps.google.com/maps/api/staticmap?center=le103aq&zoom=14&size=200x200&maptype=roadmap&markers=color:ORANGE|label:A|POSTCODEHERE&sensor=false">-->
<script>
		function post_device(){
			 //console.log('add button pressed');
		      //console.log(data);
		      var machine_name = $('#machinename').val();
		      if (!machine_name){
		      	$('#nomachinename').css('display','block');
		      	return
		      } else {
		       	$('#nomachinename').css('display','none');
		      }
		      var type = $('#type').val();
		      if (type == 'empty'){
		      	$('#notype').css('display','block');
		      	return
		      } else {
		      	$('#notype').css('display','none');		      	
		      }
		      var phone = $('#phone').val();
		      if (!phone){
		      	$('#nophone').css('display','block');
		      	return
		      } else {
		      	$('#nophone').css('display','none');		      	
		      }
		      var select = [];
		      $("#devices_dropdown option").each(function()
				{
					option = $(this).text()
				    select.push(option); // Add $(this).val() to your list
				});
		      //console.log(select);
		      index = _.indexOf(select, machine_name); 
		      //console.log('index',index);
		      if (index !== -1){
		   	   	$('#samename').css('display','block');		
		   	   	return      	
		      } else {
		   	   	$('#samename').css('display','none');		      	
		      }
		      sender_id = $('#sender_id').val();
				$.ajax({
			        url: '<?php echo base_url('setup_device/validate_sender_id'); ?>',
			        type: 'POST',
			        data: {
			            sender_id: sender_id
			        },
			        dataType: 'json',
			        success: function(data) {
			            //console.log(data);
			            if (data.validated === 'true'){
							//$('#sender_id').after('<label>sender_id already taken</label>').css('color', 'red');	 
							$('#fill').css('display','inline');   
							$('#nofill').css('display','none');        	
							$('#add_device_button').removeAttr('disabled','disabled').removeClass('disabled');
			     		      var myform = $('#myForm').serialize();
							$.ajax({
							  type: 'POST',
							  url: '<?php echo base_url(); ?>setup_device/add_device',
							  data: myform,
							  success: function(res) {
									//console.log(res);
									location.reload();
								},
							  error: function(err){
							  	//console.log(err);
									$('#nofill').css('display','inline');     
								  	//if (/validated:false/.test(err.responsetext){
									$('#nofill').css('display','inline');     
									$('#fill').css('display','none');  			  		
							  	//}
							  	sender_id = $('#sender_id').val();
								////console.log('sender_id keyup', sender_id);
							  }
							});
			            } else {
			            //if (data.validated === 'false'){
							//$('#sender_id').after('</label>sender_id availible</label>').css('color', 'green');	     
							$('#nofill').css('display','inline');     
							$('#fill').css('display','none');  	
							$('#add_device_button').attr('disabled','disabled').addClass('disabled');
			            }
			        },
			        error : function(error) {
			        	//console.log(error);
							// $('#nofill').css('display','none');       		        	
							// $('#fill').css('display','inline');
							// $('#add_device_button').prop('disabled',true);       		        	
			    	}
			    });
	}
</script>
<script>
		function edit_device(){
			 //console.log('edit button pressed');
		      var data = $('#myForm').serialize();
		      //console.log(data);
		     $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url(); ?>setup_device/edit_device',
			  data: data,
			  success: function(res) {
					//console.log(res);
					location.reload();
				},
			  error: function(err){
			  	//console.log(err);
			  }
			});

	}
</script>
<script>
		function delete_data(){
			c = confirm('Are you sure you want to delete this data?');
			if ( c == false){
				window.location="setup_users";
			}
			 //console.log('delete data button pressed');
		      var data = $('#myForm').serialize();
		      //console.log(data);
		     $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url(); ?>setup_device/delete_data',
			  data: data,
			  success: function(res) {
					console.log(res);
					location.reload();
				},
			  error: function(err){
			  	//console.log(err);
			  }
			});

	}
</script>
<script>
		function delete_device(){
			c = confirm('Are you sure you want to delete this device?');
			if ( c == false){
				window.location="setup_users";
			}
			 //console.log('delete device button pressed');
		      var data = $('#myForm').serialize();
		      //console.log(data);
		     $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url(); ?>setup_device/delete_device',
			  data: data,
			  success: function(res) {
					//console.log(res);
					location.reload();
				},
			  error: function(err){
			  	//console.log(err);
			  }
		});
	}
</script>
<script>
	$('#find_user').on('keyup', _.debounce(function(){
			var sender_id = $('#find_user').val();
		     //console.log(sender_id);
		     $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url(); ?>get_uri/get/get_user_for_sender_id/'+sender_id,
			  data: data,
			  dataType: 'json',
			  success: function(res) {
					//console.log(res);
					//location.reload();
					if(res.length === 0){
						$('#senderidnotfound').css('display','inline-block');
						$('#senderidfound').css('display','none');
					} else {
						$('#senderidfound').html('<b> SenderID belongs to user: <i>'+res[0].username+'</i></b>').css('display','inline-block');
						$('#senderidnotfound').css('display','none');
					}
				},
			  error: function(err){
			  	//console.log(err);
			  }
		});
	},2000));
</script>
	<script>
		function clear_fields(){
			//console.log("clear Fields");
			$("#machinename").val("");
//			$("#location").val("");
			$("#address1").val("");
			$("#address2").val("");
			$("#phone").val("");
			$('#postcode').val("");
			$("#sender_id").val("");
			$("#type option[value='empty']").attr('selected','selected');
		}
	</script>
	<script>
	$('#machinename').on('keyup', _.debounce(function(){
		//console.log('keyup');
		var select = [];
	      var machine_name = $('#machinename').val();
	      $("#devices_dropdown option").each(function()
			{
				option = $(this).text()
			    select.push(option); // Add $(this).val() to your list
			});
	      //console.log(select);
	      index = _.indexOf(select, machine_name); 
	      //console.log('index',index);
	      if (index !== -1){
	   	   	$('#samename').css('display','block');		
	   	   	return      	
	      } else {
	   	   	$('#samename').css('display','none');		      	
	      }		
	}));
			
	</script>
	<script>
	$('#sender_id').on('keyup', _.debounce(function () {
		sender_id = $('#sender_id').val();
		$.ajax({
	        url: '<?php echo base_url('setup_device/validate_sender_id'); ?>',
	        type: 'POST',
	        data: {
	            sender_id: sender_id
	        },
	        dataType: 'json',
	        success: function(data) {
	            //console.log(data);
	            if (data.validated === 'true'){
					//$('#sender_id').after('<label>sender_id already taken</label>').css('color', 'red');	 
					$('#fill').css('display','inline');   
					$('#nofill').css('display','none');        	
					$('#add_device_button').removeAttr('disabled','disabled').removeClass('disabled');
	            } else {
	            //if (data.validated === 'false'){
					//$('#sender_id').after('</label>sender_id availible</label>').css('color', 'green');	     
					$('#nofill').css('display','inline');     
					$('#fill').css('display','none');  	
					$('#add_device_button').attr('disabled','disabled').addClass('disabled');
	            }
	        },
	        error : function(error) {
	        	//console.log(error);
					// $('#nofill').css('display','none');       		        	
					// $('#fill').css('display','inline');
					// $('#add_device_button').prop('disabled',true);       		        	
	    	}
	    });
	},2000));
	</script>
	<div id="dialog" title="Device help">			    
	<p> <b>In this section</b> you can configure the details of your datalogger for the site giving
			it a machine name and location and telephone number. 
			The address lines one and two are for the address of the customer and the postcode to 
			give the map on the dashboard. The sender id search lets you know which user has that device. This or entering 
			the sender id into the sender id box will tell you if this already exists in the storage. The machine name appears on the
			users website configuration so you might want to give a default name if the user has not specified. The phone number will also
			appear on the device details on the users website dash. The buttons at the bottom and clear fields are all self explanitory and a device must be selected for these to work.
			</p>
</div>