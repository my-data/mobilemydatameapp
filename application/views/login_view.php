<div id="login_header">
	<h1 style="font-family: Consolas"> My Data Centre <small>Managing your site telemetry data</small></h1>
	<p>
	<div class="container">
		<div class="row">
			<img class='image' style='visibility:hidden' height=150 src="<?php echo base_url('assets/pictures/ist1_82583-dishes[1].jpg');?>">
			<img class='image' style='visibility:hidden' height=150 src="<?php echo base_url('assets/pictures/iStock_000028650530_Small.jpg');?>">
			<img class='image' style='visibility:hidden' height=150 src="<?php echo base_url('assets/pictures/iStock_000002601070_Small.jpg');?>">
			<img class='image' style='visibility:hidden' height=150 src="<?php echo base_url('assets/pictures/iStock_000016171899_Small.jpg');?>">
		</div>
	</div>
	<script>
	$(function(){
		$('.image').css('visibility','visible');
	});
	</script>
	</p>
</div>
<div class='row'>
<!-- <div id='schematic' style='    position: absolute;
    top: 550;
    left: 50;    margin-bottom: 50;'>
	<div class='block'>
	<h3>Start using Remote Datalogging Today</h3>
	<p> My-data can be used to manage your data from remote datalogging units. It uses a remote datalogging system which can be configured to log a wide range of sensor data such as temperature, pressure and alarms. These remote dataloggers are transmitted via a GRPS network. Using GSM technology, these systems allow downloading stored data, viewing live data and remote configuration from any site that has cellular coverage. Additional capabilities include SMS and email alarms for notification of faults and automatic data upload via FTP. GSM (Global System for Mobile communications) is an open, digital cellular technology used for transmitting mobile voice and data services. GSM supports voice calls and data transfer speeds of up to 9.6 kbps, together with the transmission of SMS (Short Message Service). 
	</p><p>Contact us on <b>mydatame@outlook.com</b> to talk about how we can help you.</p>
	<img class='image' style='position:absolute;top:250;left:50;  margin-bottom: 50;' width=800 src='<?php echo base_url('assets/pictures/Schematic.png');?>'>
	</div>
	</div>
</div> -->
<div id="login_form">
	<div class="container">
		<div class="row">
			<div class="md-2" >
				<br >
				<h2> Login </h2>
				<p> Log into your secure software hub with secure encryted systems. Chart and configure your data how you wish. Access your data on the move from your phone. Sync with Gmail account to receive email updates on the status of your alarms. </p>
				<?php //echo validation_errors(); ?>
<!-- 				<p class="testp"></p>
 -->				<br>
					<form action='<?php echo base_url('/User/login'); ?>' method='POST'autocomplete="off"  role="form">
					<div class="block"><label> Username: </label><!-- <div class="input-group"> -->
						<input id='username'style="width: 20%;"class="form-control" type='text' name='username' autocomplete="off">
						<?php //echo form_error('username'); ?>
<!-- 					</div>-->
					</div>
				<div class="block"><label> Password: </label>
					<input id='password'style="width: 20%;margin-left: 13px"class="form-control" type='password'autocomplete="off" name='password' value="<?php //echo set_value('password'); ?>">
					<?php //echo form_error('password')?>
					<?php //echo validation_errors('<p class="error">'); ?>
				</div>
					<button class="btn btn-default" style="margin: 5px;margin-left: 237px;" type='submit' value='Submit'>Login</button>
					<div class="errors"> <?php //echo validation_errors(); ?></div>
					<?php // $data['msg'] = "Login error message" ?>
					<?php  if (!empty($msg)){ echo $msg;} ?>
					<?php //echo print_r($data); ?>
					<h4><?php //echo $msg; ?> </h4>
					</form>
			<!--
					<form action='<?php echo base_url('configuration/do_upload'); ?>' method='POST' class="new_user_button">
					<button type='submit' value='New User'>New User</button>
					</form>
			-->
			</div>
		</div>
	</div>
</div>
<hr>
<!-- <div class="sales_stuff" style="margin-right: 200px;margin-top: 300px;">
 	<div class="container">
		<div class="row"> -->
			<!-- <div class="md-2" style="top: 100px;width: 250px;margin-right:100px;max-width:400px;margin-left: 15px;">
				<h2> Contact Us </h2>
				<p> This website is a cloud storage system for keeping your data online. you can access your data any time and anywhere.
				Your data is held securely and first rate security and huge storage capabilities. We provide beautiful charts and a
				fully reconfigurable service which allows users to configure there own dashboard with the latest display widgets.</p>
				<h4> Contact Us: </h4>
				<p> Please contact us for dataloggers for a quote or for a subscription to the service. </p>
				<p><em><b> sales@radiotelemetry.co.uk</b></em></p>
				<p><em><b> 01455 233 616 </b></em></p>
			</div> -->
<!-- 		</div>
	</div> -->
</div> 

<script type="text/javascript">
// $(function(){
	
// 	$("#login_form").submit(function(evt){
// 		alert(1);
// 		evt.preventDefault();
// 		var url = $(this).attr('action');
// 		var postData = $(this).serialize();

// 		$.post(url, postData, function(o) {
// 			if (o.result == 1){
// 				window.location.href = '<?= base_url('rawdata')?>';
// 				alert('good login');
// 			}else{
// 				alert('Invalid Login');
// 			}

// 		}, 'json');
// 	}

// 	});

</script>
<script>
$(document).ready(function(){
	$('#username').html('');
	username = $('#username').text();
	$('#password').html("");
	password = $('#password').text();
	console.log('test',typeof username, typeof password);

});
</script>
<script>
//WINDOW RESIZE PROTECTION

$(window).resize(function() {        var wi = $(window).width();     
   $("p.testp").text('Screen width is currently: ' + wi + 'px.');});

</script>
<script>
$(document).ready(function(){
if(!(window.console && console.log)) {
  console = {
    log: function(){},
    debug: function(){},
    info: function(){},
    warn: function(){},
    error: function(){}
  };
}
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");
            console.log('useragent',ua);
            if (msie > 0){
            console.log('useragent',ua, msie);
                alert('This application is not available in Internet Explorer. Please upgrade your browser to google Chrome or Modzilla Firefox.',parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))));
            } else  {
           		 return false;
            }               // If another browser, return 0
                //alert('otherbrowser');

        });
</script>