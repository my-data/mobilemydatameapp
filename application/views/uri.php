<html>
<head>
	<style>
	.api_results{
		text-align:center;
	}
	</style>
</head>
<body>
<h2> API Docs Page </h2>
<a href="<?php echo base_url('index.php/setup_users');?>">Back</a>
<p>This site contains a RESTful API. This means that if you type 
	<?php echo base_url();?>index.php/geturi/post/c=cv32 you will add the user cv32. If you use 
	<?php echo base_url();?>index.php/get_uri/post/c=senderid,8080,HI,LO,HI,LO,HI,HI,LO,LO,11,512,212,16,5,1,0,9. 
	This is what the X91000 does. put your sender id first then the localport number then then eigtht digitals, 
	4 analogues and then 4 counters. The RESTful API also contains the methods GET, PUT and DELETE.  </p>

<p><b>POST</b>  If you want to post a record add to the current url. <?php echo base_url();?>index.php/geturi/post/c={{here you put your csv file containing your message / radio telemetry data}}. 
An example is /post/c=</p>
<p><b>GET</b>  There is a json api which returns your chart data in a time series stream for each input. This is accessd using GET/{{input_name}}. If you want custom access to your chart data through and api and to develop yourself contact 
us on how to implement the API and manipulate your own data.</p>
<!-- <p><b>UPDATE</b> This updates a record in your message database and you can use it to amend user information and configuration information  for your device</p>
 --><p><b>DELETE</b> This deletes user records, data on devices and your devices as well as configuration files. 
To delete a user you type <?php echo base_url();?>index.php/get_uri/delete/user/{{user_id}}. To delete a device you use
<?php echo base_url();?>index.php/get_uri/delete/device/{{user_id}} and to delete data for user 
<?php echo base_url();?>index.php/get_uri/delete/data/{{user_id}}</p>

<h4 class="api_results"> Your Data </h4>
<p class="api_results"> </p>
<div id="tag"></div>
<a href="#one">#one</a> | <a href="#two">#two</a> | <a href="#lolwut">#lolwut</a>
<script>
$(document).ready(function() {
        $(window).bind('hashchange', function() {
            var hash = window.location.hash.substring(1);
            $.get('ajax-hash.php', { tag: hash },
                function(data) { $('#tag').html(data); }
            );
        });
    });
$( document ).ready(function() {
	var hash = window.location.hash;
	console.log(hash); 
	console.log(hash.substr(1)); 
});
</script>
</body>
</html>