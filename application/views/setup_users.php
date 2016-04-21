<div id="configuration_header">
	<h1><b></b></h1>
	<!-- <p><img alt="#" height=150 src="<?php echo base_url('assets/pictures/picture1.jpg');?>">
	<img alt="#" height=150 src="<?php echo base_url('assets/pictures/picture2.jpg');?>">
	<img alt="#" height=150 src="<?php echo base_url('assets/pictures/picture3.jpg');?>">
	<img alt="#" height=150 src="<?php echo base_url('assets/pictures/picture4.jpg');?>"> -->
</div>
<div id="configuration_header" class="collapse navbar-collapse">
	<div class="container">
	<h3>  </h3>
	<nav style=' margin-top: -30;   margin-left: -10; ' class="navbar navbar-default">
  	<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><b>Warwick Wireless</b></a>
    </div>
	<ul class="nav navbar-nav">
<!-- 		<li><form action='<?php echo base_url('get_uri/robs_data');?>' method='post'>
			<button style='    margin-top: 13;'class="btn btn-link navbar-btn" type="submit" type='submit'>Messages Received</button>
			<input id = 'hiddensenderid'name = 'hiddensenderid'style='display:none' value=<?php echo $sender_id;?>></input>
			<input id = 'hiddenuserid'name = 'hiddenuserid'style='display:none' value=<?php echo $user_id;?>></input>
			</form>
		</li> -->		
		<li><a href="<?php echo base_url('get_uri/robs_data');?>">Messages Received</a></li>
		<li><a href="<?php echo base_url('sendreport/all_emails');?><?php echo '?user_id='.$user_id.'&sender_id='.$sender_id;?>">Emails Sent</a></li>
		<li><a href="#" id="contactUs">Help Button</a></li>
		<li><a href="<?php echo base_url('user/login');?>">Logout</a></li>
	</ul>
<!-- 		<ul>
     	<li> <a href="<?php echo base_url('dashboard');?>">All Data Table</a> </li>
		<li> <a href="<?php echo base_url('get_uri');?>">API Documentation</a> </li>
		<li>  </li>
		</ul> -->
	</div>
</div>

<div id="configuration_form" style="    margin-left: -200px; margin-top: -135px;">
<!-- 	<hr>
 -->		<p> 
<!-- 			<form action="setup_users"method="post">
 -->			<!-- <select hidden id="username_dropdown" name="username_dropdown" class="form-control pad" style="width:300px;">
					<?php //print_r($info[5]);?>
				<?php for ($i =0; $i<count($info); $i++){ ?> 
					<?php echo "<option value=".$i.">".$info[$i]['username']."</option>";?>
				<?php } ?>
				<select>  -->
					<div class="ui-widget block form-control-inline">
					  <label for="tags">Current Users:  </label>
					  <input id="username_autocomplete" name="username_autocomplete" placeholder='Enter Username' title='Write username here to update this record'>
					   <button type="button" name='Clear Fields' onclick='clear_fields()'class="form-control " style="width:100px;margin:10px;">Clear</button>
					<form action="<?php echo base_url('setup_device');?>" method="post">
					<input style='display:none'type='text' name='company_logo' id="company_logo" placeholder="select file if empty" class="form-control pad" style="width:90%;visibility:'hidden';"
					value="<?php if (isset($selectOption)){echo $info[$selectOption]['company_logo'];} else { echo ""; }?>" >
					<input style='visibility:hidden;display:hidden' name = 'useridhidden2'id='useridhidden2'type='text'></input>
					<!-- 		<input style='visibility:hidden' name = 'senderidhidden'id='senderidhidden2'type='text'></input>
 					-->		<button style='float: right; position: absolute;    left: 500;   top: 10;'class="btn btn-primary" type="submit" id="user_id" value='<?php echo $info[$selectOption]['user_id'];?>'>Edit User Devices</button> 
			<div class="alert alert-danger" style='display:none;color:red;'id='nohiddenuserid'><label>A User has not been selected</label></div>				
					   <label id='num_of_devices'style='margin-top: -52;margin:auto;float:left;display:none;padding:10'>Number of Devices:<span class="badge" id='number_of_devices' style='margin: 5;'>0</span></label>

	</form>
</p>
					</div>
<!-- 				<button type="submit" value="refresh" name='refresh' class="form-control btn btn-primary" style="width:100px;margin:10px;">Refresh</button>
<!-- 			</form>
 -->	 	<!-- <hr> -->
	</p>
<script>
  $(function() {
  	var usernames = [];
  	$.ajax({
        url: '<?php echo base_url('get_uri/get/allusers'); ?>',
        type: 'POST',
        // data: {
        //     key: value
        // },
        dataType: 'json',
        success: function(data) {
            //console.log(data);
            //loop through data and place in table here 
            var usernames = [];
            for (i=0;i<data.length;i++){
            	//console.log(data[i].username);
            	usernames.push(data[i].username);
            }
            // $.each(data, function(i, username){
            // 	console.log(data[i].username);
            // 	console.log(data.username[i]);
            // 	usernames.concat(data[i].username, usernames);
            // 	console.log(data.username[i]);
            // })
            //console.log(usernames);
            //console.log(data);
             $( "#username_autocomplete" ).autocomplete({
			      source: usernames
			    });

        },
        error : function(error) {
        	console.log(error);
    	}
    });
  });
  </script>
	<?php if (isset($_POST["username_dropdown"])) {$selectOption = $_POST['username_dropdown'];} else {$selectOption = 0;} ?>
	<script>
		function clear_fields(){
			console.log("clear Fields");
			$("#username").val("");
			$("#password").val("");
			$("#passconf").val("");			
			$("#companyname").val("");
			$("#description").val("");
			$("#firstname").val("");
			$("#lastname").val("");
			$("#email").val("");
			$("#senderid").val("");
		}
	</script>
	<script>
	$('#username_autocomplete').on('autocompleteselect', function (e, ui) {
        $('#username_autocomplete').html(ui.item.value);
        $.ajax({
        	url: '<?php echo base_url('get_uri/get/allusers/'); ?>',
	        type: 'POST',
	        dataType: 'json',
	        success: function(data) {
	            username = $('#username_autocomplete').val();
	        	console.log(username);
	            console.log(data);
	            for (i=0;i<data.length;i++){
	            	if (data[i].username === username){
	            		console.log(data[i]);
	            		$("#userid").val(data[i].user_id);
	            		$("#useridhidden").val(data[i].user_id);
	            		$("#useridhidden2").val(data[i].user_id);
	            		$("#senderidhidden2").val(data[i].sender_id);      		
	            		$("#username").val(data[i].username);
	            		$('#nohiddenuserid').css('display','none');
						$("#password").val(data[i].password);
						$("#passconf").val(data[i].password);
						$("#companyname").val(data[i].companyname);
						$("#description").val(data[i].description);
						$("#firstname").val(data[i].first_name);
						$("#lastname").val(data[i].last_name);
						$("#email").val(data[i].email);
						$("#senderid").val(data[i].sender_id);
						if (data[i].company_logo){
							$('#logo_name').css('display','').html('<b>'+data[i].company_logo+'</b>');							
						}
						is_admin = parseInt(data[i].is_admin);
						console.log('is_admin',is_admin, typeof is_admin);
						if (is_admin === 1){
							$('#is_admin').attr('checked','checked');
						}
						user_id = data[i].user_id;
					  	$.ajax({
					        url: '<?php echo base_url('get_uri/get/get_number_of_devices_for_user'); ?>'+'/'+user_id,
					        type: 'POST',
					        dataType: 'json',
					        success: function(data2) {
					        	console.log('number of devices for user',data2);
					        	$('#number_of_devices').html(data2);
					        	$('#num_of_devices').css('display','block');
					        },
					        error : function(error) {
					        	console.log(error);
					    	}
					    });
						console.log('autocomplete completed');
	            	}
	            }
	        },
	        error : function(error) {
	        	console.log(error);
	    	}
        });
    });
	</script>
    <form id="myForm" action="<?php echo base_url('setup_users/add_user');?>" method='POST' enctype="multipart/form-data">
    	<table class="admin table-striped"style="float:left;border: 1px groove black;">
    		<tbody>
    		<tr class="table-striped">
    			<td>
	 			 	<!-- <div class="block">
	 			 		<label style='float: left;'>Administrator: </label>
	 			 			<div class="checkbox">
	 			 				<input style='margin-left: -126; margin-top: 15;' type='checkbox' name='is_admin' id='is_admin' value ='1'></input>
	 			 		</div>
	 			 	</div> -->
 			 	</td>
				<td>
					<div class="block">
					 <label style="width:20%;">Username: </label>
						<input required type='text' name='username' id="username"  style="width:60%;"> 
			 			<div class="alert alert-danger" style='display:none;color:red; top: -100;margin-left: 100;'id='nousername'><label>Username has not been selected</label></div>				
					</div>
				</td>
			</tr>
			<tr class="table-striped">
				<td>
					<div class="block">
					 <label style="width:20%;">First name:</label>
						<input type='text' name='firstname' id="firstname"  style="width:60%;"> 
					</div>
				</td>
				<td>
					<div class="block">
					 <label style="width:20%;">Last name:</label>
						<input type='text' name='lastname' id="lastname" style="width:60%;"> 
					</div>
				</td>
			</tr>
			<tr class="table-striped">
				<td>
					<div class="block">
					 <label style="width:20%;">Password:</label> 
						<input required name='password' id="password" style="width:60%;"> 
					</div>
				</td>
				<td>		
				<div class="block">		
					 <label style="width:20%;">Conf pass: </label>
						<input required  name='passconf' id="passconf"  style="width:60%;"> 
			 			<div class="alert alert-danger" style='display:none; top: -100;margin-left: 100;'id='nopasswordmatching'><label>These passwords do not match.</label></div>				
			 			<div class="alert alert-success" style='display:none;top: -100;margin-left: 100;'id='passwordmatching'><label>These passwords do match.</label></div>				
					</div>
				</td>
			<tr class="table-striped">
				<td>
					<div class="block">
					 <label style="width:20%;">Company: </label>
						<input type='text' name='companyname' id="companyname" style="width:60%;"> 
					</div>
				</td>
				<td>
					<div class="block">
					 <label style="width:20%;">Email: </label>
						<input size="25"type='text' name='email' id="email"  style="width:60%;"> 
						<div class="alert alert-danger" style='display:none;color:red; top: -100;margin-left: 100;'id='noemail'><label>This is not a valid email address</label></div>				
					</div>
					<script>
					$('#email').blur(_.debounce(function(){
						text = $(this).val();
						console.log(text);
						if (!/\@/.test(text)){
							$('#noemail').css('display','block');
						}
					},500));
					</script>

				</td>
			</tr>
 			 <tr class="table-striped">
<!-- 				<td>
					<p> <label>Company logo:</label><input required type='text' name='company_logo' id="company_logo" placeholder="select file if empty" class="form-control pad" style="width:90%;"
						value="<?php if (isset($selectOption)){echo $info[$selectOption]['company_logo'];} else { echo ""; }?>" > </p>
						</td> 
				<td> --> <!--
					<div class="block">
					<p> <label style="width:20%;"></label>
						<input type='text' name='senderid' id="senderid" placeholder=" ######"  style="width:60%;visibility:'hidden'"
						value="<?php if (isset($selectOption)){echo $info[$selectOption]['sender_id'];} else { echo ""; }?>" > </p>
					</div>
				</td> 
<!-- 			</tr> 
 -->			<tr class="table-striped">
				<td>
					<div class="block">
					 <label style="width:20%;  margin-right: 50px; float: left;">Description: </label>
					<textarea class="form-control" cols="40" rows="4" type='textarea' name='description' id="description" style="width:60%;resize:none;vertical-align: top;    margin-bottom: 20;"
					value="<?php if (isset($selectOption)){echo $info[$selectOption]['description'];} else { echo ""; }?>" ></textarea> 
					<div class="alert alert-danger" style='display:none;color:red; top: -100;margin-left: 100;'id='descriptiontoolong'><label>Description should be less than 140 characters</label></div>				
					<div>
					<script>
						$('#description').keyup(function(){
							description = $(this).val();
							console.log('length', description.length, description);
							if (description.length > 140){
								$('#descriptiontoolong').css('display','inline');
							} else {								
								$('#descriptiontoolong').css('display','none');
							}
						})
					</script>
				</td>
				<td>
					<div class="block">
					<label style="width:20%;">Select logo:</label>
					<input type="file" name="userfile" id="userfile" style="width:60%;">
						<div class="alert alert-success"style='display:none;color:green;  margin-top: 0;top: -100;margin-left: 100;'id='fill'><label>This file can be uploaded</label></div>
						<div class="alert alert-success"style='display:none;color:green;  margin-top: 0;top: -100;margin-left: 100;    margin-left: 160px;width:160'id='logo_name'><label></label></div>
			 			<div class="alert alert-danger" style='display:none;color:red; top: -100;margin-left: 100;'id='nofill'><label>This file contains illegal characters</label></div>				
			 			<div class="alert alert-danger" style='display:none;color:red; top: -100;margin-left: 100;'id='nofillfile'><label>Please add a picture for a new user</label></div>				
					</div>
					<script>
					// Variable to store your files
					var file;
					// Add events
					$('input[type=file]').on('change', function(){
						  file = event.target.files;
					});
					// function image_validation(){
						$("#userfile").change(function(){
							var filename = $(this).val();
							if (/\#|\<|\$|\+|\%|\>|\*|\||\{|\?|\}|\@|&/.test(filename)){
								console.log('this file has an illegal character', filename);
								$('#nofill').css('display', 'block');
								$('#fill').css('display', 'none');
								$('#nofillfile').css('display','none');
							} else {
								console.log('this does not have illegal characters', filename);
								$('#fill').css('display','block');
								$('#nofill').css('display', 'none');
								$('#nofillfile').css('display','none');
							}
							$('#userfile').html(filename);
							console.log(filename);
						});
					//}
					</script>
				</td>
			</tr>
		</tbody>
		</table>
	
	<br />
	<br />
	<p> <a onclick='post_user()'href='#'style="margin:20px; margin-left:400px;"class="btn btn-default pad"type="submit" name='method' value='Add User'>Add User</a>
		<a style="margin:20px;"class="btn btn-warning pad"type="submit" name='method' value='Update User' onclick='update_user()'>Update User</a> 
		<a style="margin:20px;"class="btn btn-danger pad" type="submit" name='method' onclick='delete_user()' value='Delete User'>Delete User</a> </p>
		<input hidden name = 'useridhidden'id='useridhidden'type='text'></input>
		<div id='error_handler' class='alert-danger' style='display:none'>Fatal error has been thrown. Please contact IT support.</div>
 		<input  hidden type='text' name='userid' id="userid" style="display:none;">  </p>
	</form>
	<hr>
	<br>
	<script>
	$('#user_id').on('click',function(e){
		hiddenuserid = $('#useridhidden2').val();
		console.log(hiddenuserid);
		if (!hiddenuserid){
			console.log(e);
			e.preventDefault();
			$('#nohiddenuserid').css('display','inline-block');
		}
	});		
//});

	</script>
	<script>
		// function update_user(){
		// 	window.location="setup_users/update_user";
		// }
	</script>
	<script>
	// function delete_user(){
	// 	c = confirm('Are you sure you want to delete this user?');
	// 	if ( c == true){
	// 		window.location="setup_users/delete_user";
	// 	}
	// }
	</script>
	<hr> 
</div>
<script>
		function post_user(){
			 console.log('add button pressed');
		      var data = $('#myForm').serialize();
		      var myform = $('#myForm')[0];
		      //console.log(myform);
		      var formdata = new FormData(myform);
		      var inputLogo = $("#userfile")[0];
		      //console.log(inputLogo);
		 	  formdata.append(inputLogo.name, inputLogo.files[0]);
		 	  //formdata.append('big','bangers');
		      //console.log(formdata);
		      // var file = <?php print_r($_FILES['username']['name']);?>;
		      // console.log('file',file);
		      file = $('#userfile').val();
		      //data = data.concat({'file':file});
		      if (!file){
				$('#nofill').css('display', 'none');
				$('#fill').css('display', 'none');
		      	$('#nofillfile').css('display','inline');
		      	return
		      }
		      username = $('#username').val();
		      if(!username){
		      	$('#nousername').css('display','inline');
		      	return
		      }
		     $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url(); ?>setup_users/add_user',
			  data: formdata,
			  processData: false, 
       		  contentType: false,
			  success: function(res) {
					console.log(res);
					$('#nofill').css('display', 'none');
					$('#fill').css('display', 'none');
		      		$('#nofillfile').css('display','none');
		      		$('#nousername').css('display','none');
					$('#nopasswordmatching').css('display','none');
					$('#noemail').css('display','none');	
					//location.reload();	
				},
			  error: function(err){
			  	console.log(err);
			  }
			});

	}
</script>
<script>
		function delete_user(){
			 console.log('delete button pressed');
		      var data = $('#myForm').serialize();
		      console.log(data);
		     $.ajax({
				  type: 'POST',
				  url: '<?php echo base_url(); ?>setup_users/delete_user',
				  data: data,
				  success: function(res) {
						console.log(res);
						location.reload();
					},
				  error: function(err){
				  	console.log(err);
				  }
			});

	}
</script>
<script>
		function update_user(){
			 console.log('update button pressed');
		      var data = $('#myForm').serialize();
		      console.log(data);
		     $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url(); ?>setup_users/update_user',
			  data: data,
			  success: function(res) {
					console.log(res);
					location.reload();
				},
			  error: function(err){
			  	console.log(err);
			  }
			});

	}
</script>
<script>
	// function add_user(){
	// 	console.log("add user");
	// 	window.location="setup_users/add_user";
	// }
	// function get_user(){
	// 	window.location="setup_users/get_user";
	// }

	function repopulate_users(){
		console.log("refresh clicked");
		$("#username").val("Saul Wiggin");
		$("#password").val("Icarus1987");
		$("#companyname").val("Warwick Wireless");
		$("#description").val("Manufacture radio modems and telemetry equipment for ranges up to 100 km using both license exempt and licenced bands");
	}
// $( document ).ready(function() {
//     console.log( "ready!" );
//     logo_name = ('#company_logo').val();
//     if (logo_name.length > 1){
//     	$('#company_logo').css('visibility','visib');
//     }
// });
</script>
<script>
$(function(){
   var selected_name = $('#username_dropdown :selected').text();
   var selected_option = $('#username_dropdown').val();
});
</script>
<script>
$('#passconf').on('keyup', function () {
	console.log($(this).val());
	console.log($('#password').val());
    if ($(this).val() == $('#password').val()) {
        $('#passwordmatching').css('display', 'inline');
    } else { 
    	$('#nopasswordmatching').css('display', 'none');
    	$('#passwordmatching').css('display', 'none');
    }
});
</script>
<script>
$('#password').on('keyup', function () {
	console.log($(this).val());
	console.log($('#passconf').val());
    if ($(this).val() == $('#passconf').val()) {
        $('#passwordmatching').css('display', 'inline');
    } else {
    	$('#nopasswordmatching').css('display', 'none');
    	$('#passwordmatching').css('display', 'none');
    }
});
</script>
<script>
$( document ).ready(function() {
	console.log('ready!');
	function error_handler(){
		users = <?php echo $users;?>;
		info = <?php echo $info;?>;
		console.log('input data',[info, users])
		if (!users || !info){
			$('#error_handler').css('display','inline');
		} else {
			console.log('no errors/exceptions thrown');
		}
	}
	error_handler();
});
</script>
<script>
	$(function() {
	  $("#dialog").dialog({autoOpen : false, modal : true, show : "blind", hide : "blind"});
	  $("#contactUs").click(function() {
	    $("#dialog").dialog("open");
	    return false;
	  });
	});
</script>
<div id="dialog" title="User Registration">			    
	<p> <b> In this section </b> you configure new users to mydata. Login details are assigned here and checked with a password confirmation box.
	A first name and last name and company name is used for person information. The description should be short as this appears at the top of
	the dashboard and if unsure should be left blank. The logo goes on the user dashboard. New users should not be administrators and this is
	for setting up new users for the admin system. Once the form is complete a new user can be added. If details need to be changed then the user is selected
	in the search box and details changed and updated. The company logo can not be updated and if incorrect a new user needs to be created. The delete user
	deletes the user.   
	</p> 
	<br>
	<p> <b> In the management display </b> it is possible to look at all the message received by the website and all the emails sent by the website in order to see activity of the users.
	</p>
</div>