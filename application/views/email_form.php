<div id="email-form" style="margin:100px;">
	<?php // print_r($alarm_table); ?>
	<?php //echo $user_id; ?>
	<?php //echo $sender_id; ?>
	<?php // print_r($devices); ?>
	<?php //print_r($config); ?>
	<h1><b> Email Alerts </b></h1>
	<br >
<div class="block"> 
	<form method="post">
		<!-- <b> Alarms: </b> -->
				<select style='width:220px;  margin: 10;'class="form-control"id="alarms_dropdown" name="alarms_dropdown">
				<option>Please Select:</option>
				<?php for ($i =0; $i<count($alarm_table); $i++){ ?> 
					<?php echo "<option value=".$i.">".strtoupper($alarm_table[$i]['alarm_name']).' (<i>alarm '.$alarm_table[$i]['alarm_number'].'</i>)'."</option>";?>
				<?php } ?>
				<select>
<!-- 				<button type="submit" value="refresh" name='refresh' onclick='get_user_info()'>Refresh</button>
 --> 				<button class="btn btn-default" type="button" name='Clear Fields' onclick='clear_fields()'>Clear Fields </button></p> 
 					 		<a style='margin:10; 'class="btn btn-default"href="<?php echo base_url();?>rawdata">Back</a>
		<a style='margin:10'class="btn btn-info" href="#" id="contactUs">Help Button</a>
 			</form>
	 	<hr>
	</div>  
	<?php $selected_alarm = $_POST['alarms_dropdown'];?>
	<?php //echo $selected_alarm;?>
	<form id='email_alarm_form' method="POST" action="<?php echo base_url();?>sendreport/submit">
				<div> 
		<h2> Alarm Name </h2> 
		<?php //print_r($alarm_name);?>
		<div class='block'>
			<select style='margin:0;    width: 370;'class='form-control' name="alarm_name" id="alarm_name">
				<option value='a0'>An0</option> 
				<option value='a1'>An1</option> 
				<option value='a2'>An2</option> 
				<option value='a3'>An3</option> 
<!-- 				<option value='a4'>An4</option> 
				<option value='a5'>An5</option> 
				<option value='a6'>An6</option> 
				<option value='a7'>An7</option> 
				<option value='a8'>An8</option> 
				<option value='a9'>An9</option> 
				<option value='a10'>An10</option> 
				<option value='a11'>An11</option> 
				<option value='a12'>An12</option> 
				<option value='a13'>An13</option> 
				<option value='a14'>An14</option> 
				<option value='a15'>An15</option> 
				<option value='a16'>An16</option> 
				<option value='a17'>An17</option> 
				<option value='a18'>An18</option> 
				<option value='a19'>An19</option>  -->
				<option value='d0'>Din0</option> 
				<option value='d1'>Din1</option> 
				<option value='d2'>Din2</option> 
				<option value='d3'>Din3</option> 
				<option value='d4'>Din4</option> 
				<option value='d5'>Din5</option> 
				<option value='d6'>Din6</option> 
				<option value='d7'>Din7</option> 
				<option value='c0'>C0</option> 
				<option value='c1'>C1</option> 
				<option value='c2'>C2</option> 
				<option value='c3'>C3</option> 
			</select>
					<div style='margin:10;margin-left:-3;margin-left: 20; display:none'class="alert alert-danger" id='onlyonealarm'>Only one alarm allowed per input</div>
<!--  			<input size="50"type="text" name="alarm_name" id="alarm_name" value="<?php if (isset($alarm_name)){ echo $alarm_name; } else {echo $alarm_table[$selected_alarm]['alarm_name']; }?>"> 
 -->				 <div style='margin:10;margin-left:-3;margin-left: 20; display:none'class="alert alert-danger" id='nametoolong'>This is not the name of a valid input name</div>
				<div style='margin:10;margin-left:-3;margin-left: 20; display:none'class="alert alert-danger" id='nametoolong'>Name of input should only be 3 charactors of less</div>
			</div> 
		</div>
		<div class='block'>
			<h2 id = 'alarm_number_header' > Alarm Number </h2>
			<select style='margin:0;    width: 100; 'class='form-control' name='alarm_number_analogues' id='alarm_number_analogues'>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
				<option value='4'>4</option>
			</select>
		</div>
		<div>
		<h2> From </h2> 
			<input size="50" type="text" name="from" id="from" value="<?php echo $alarm_table[$selected_alarm]['from'];?>"> 
		</div>
		<div> 
		<h2> To</h2>
		<div class='block'> 
			<input style='margin:0;    'type="email" size="50" type="text" name="to" id="to" value="<?php echo $alarm_table[$selected_alarm]['to'];?>"> 
		<div style='margin:10;margin-left:-3;margin-left: 20; display:none'class="alert alert-danger" id='not_email'><label style='margin: 2; display: inline;'>Please put an email address in this box</label></div>
		</div>
		</div>
		<div id="error"></div>
				<!-- <div> 
		<h2> Email 2</h2> 
			<input size="50" type="text" name="email2" id="email2" value="<?php echo $alarm_table['email2'];?>"> 
		</div>
				<div> 
		<h2> Email 3</h2> 
			<input size="50" type="text" name="email3" id="email3" value="<?php echo $alarm_table['email3'];?>"> 
		</div>
				<div> 
		<h2> Email 4</h2> 
			<input size="50" type="text" name="email4" id="email4" value="<?php echo $alarm_table['email4'];?>"> 
		</div>
				<div> 
		<h2> Email 5</h2> 
			<input size="50" type="text" name="email5" id="email5" value="<?php echo $alarm_table['email5'];?>"> 
		</div>
				<div> 
		<h2> Email 6</h2> 
			<input size="50" type="text" name="email6" id="email6" value="<?php echo $alarm_table['email6'];?>"> 
		</div> -->

			<div> 
			<h2> Subject </h2> 
				<input size="50"type="text" name="subject" id="subject" value="<?php echo $alarm_table[$selected_alarm]['subject']; ?>"> 
			</div>
			<div> 

<!-- 		<div> 
		<h2> Alarm </h2> 
			<input size="50"type="text" name="alarm" id="alarm" value="<?php echo $alarm_table['alarm']; ?>"> 
		</div> -->


		<!-- <div id="list">
			<?php //echo $email; ?>
				<button type="button" onclick="function1()">Add</button>
				<hr> 
				<h2> Email List </h2>
				<ul id="list">
				<li id="element1" value="<?php echo $alarm_table['email'];?>"><em></em></li>
				<li id="element2"value="<?php echo $alarm_table['email2'];?>"><em></em></li>
				<li id="element3" value="<?php echo $alarm_table['email3'];?>"><em></em></li>
				<li id="element4" value="<?php echo $alarm_table['email4'];?>"><em></em></li>
				<li id="element5"value="<?php echo $alarm_table['email5'];?>"><em></em></li>
				<li id="element6" value="<?php echo $alarm_table['email6'];?>"><em></em></li>
				</ul>
				<button type="button" onclick="function1();">Add</button>
				<button type="button" onclick="function2();">Remove</button>
				<input type="text" name="addemail" id="addemail" value=""> 
				<input hidden type="text" name="email" id="email" value=""> 

		</div>  -->
		<h2> User Message </h2> 
			<textarea style='width:650px;'class="form-control" name="message" cols="86" rows ="10" id="message"value="<?php echo $alarm_table[$selected_alarm]['message'];?>"></textarea> 
		</div>

		<!-- <p> Email this to all? </p>
		<input type="checkbox" name="email_all" value="<?php echo $alarm_table['email_all'];?>"> </br> -->
		<br>
		<button style='margin:10px;'id='addbutton'class="btn btn-default"type="button"value='add'>Add</button>
		<button style='margin:10px;'id='updatebutton'class="btn btn-primary"type="button"value='update'>Update</button>
		<button style='margin:10px;'id='deletebutton'class="btn btn-danger"type="button"value='update'>Delete</button>
		<input style='display:none' size="25" type="text" name="user_id" id="user_id" value="<?php echo $user_id;?>"> 
		<input style='display:none' size="25" type="text" name="sender_id" id="sender_id" value="<?php echo $sender_id;?>"> 
		<div class="alert alert-danger" style='display:none;margin: 10;' id='alreadyisalarm'><label style='margin: 2; display: inline;'>This alarm is already configured</label></div>
		<div class="alert alert-danger" style='display:none;margin: 1;' id='fillinform'><label style='margin: 2; display: inline;'>Please fill in all parts of form</label></div>

			</form>
</div>
		<script>
		$('#alarm_name').on('change',function(e){
			var alarm_name = $('#alarm_name :selected').html();
			alarm_name = alarm_name.slice(0,2);
			alarm_name = alarm_name.toLowerCase();
			console.log(alarm_name);
			var testa = /a/;
			var testc = /c/;
			var testd = /d/;
			//console.log(testa.test(alarm_name), testc.test(alarm_name),testd.test(alarm_name))
			if (testa.test(alarm_name)){
				$('#alarm_number_analogues option[value=1]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=2]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=3]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=4]').removeAttr('disabled');	
			} else {
				// $('alarm_number_analogues').css('display','none');				
			}
			if (testc.test(alarm_name)){
				$('#alarm_number_analogues option[value=1]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=2]').attr('disabled', 'disabled');
				$('#alarm_number_analogues option[value=3]').attr('disabled', 'disabled');
				$('#alarm_number_analogues option[value=4]').attr('disabled', 'disabled');				
			} else {
				// $('alarm_number_counters').css('display','none');				
			}
			if (testd.test(alarm_name)){
				$('#alarm_number_analogues option[value=1]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=2]').removeAttr('disabled');				
				$('#alarm_number_analogues option[value=3]').attr('disabled', 'disabled');
				$('#alarm_number_analogues option[value=4]').attr('disabled', 'disabled');	
								// $('alarm_number_digitals').css('display','inline-block');
			} else {
				// $('alarm_number_digitals').css('display','none');				
			}
		});
		$('#alarms_dropdown').on('change',function(e){
			var alarm_name = $('#alarms_dropdown :selected').html();
			alarm_name = alarm_name.slice(0,2);
			alarm_name = alarm_name.toLowerCase();
			console.log(alarm_name);
			var testa = /a/;
			var testc = /c/;
			var testd = /d/;
			//console.log(testa.test(alarm_name), testc.test(alarm_name),testd.test(alarm_name))
			if (testa.test(alarm_name)){
				$('#alarm_number_analogues option[value=1]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=2]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=3]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=4]').removeAttr('disabled');	
			} else {
				// $('alarm_number_analogues').css('display','none');				
			}
			if (testc.test(alarm_name)){
				$('#alarm_number_analogues option[value=1]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=2]').attr('disabled', 'disabled');
				$('#alarm_number_analogues option[value=3]').attr('disabled', 'disabled');
				$('#alarm_number_analogues option[value=4]').attr('disabled', 'disabled');				
			} else {
				// $('alarm_number_counters').css('display','none');				
			}
			if (testd.test(alarm_name)){
				$('#alarm_number_analogues option[value=1]').removeAttr('disabled');
				$('#alarm_number_analogues option[value=2]').removeAttr('disabled');				
				$('#alarm_number_analogues option[value=3]').attr('disabled', 'disabled');
				$('#alarm_number_analogues option[value=4]').attr('disabled', 'disabled');	
								// $('alarm_number_digitals').css('display','inline-block');
			} else {
				// $('alarm_number_digitals').css('display','none');				
			}
		});

		$('#updatebutton').on('click',function(e){		
			 //console.log('submit button pressed');
		      var data = $('#email_alarm_form').serialize();
		      //console.log(data);
		      $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url('sendreport/update');?>',
			  data: data,
			  dataType:'jsonp',
			  success: function(res) {
					//console.log(res);
					$('#fillinputs').css('display','inline');
					location.reload();
				},
			  error: function(err){
			  	//console.log(err);
			  }
			});
		 });

		</script>
<script>
$('#addbutton').on('click',function(e){
	name = $('#alarm_name').val().toUpperCase();
	selectedname = $('#alarms_dropdown :selected').text();
	alarm_number = $('#alarm_number_analogues').val();
	//selectedalarm = <?php echo $alarm_table[$i]['alarm_number']; ?>;
	//console.log(name,  selectedname, alarm_number);
	to = $('#to').val();
	from = $('#from').val();
	subject = $('#subject').val();
	message = $('#message').val();
	//console.log(!to, !from, !subject, !message);
	if (!to || !from || !subject || !message){
		//console.log('error message');
		$('#fillinform').css('display','inline-block');
		return
	}
	var filter = /\@/;
		isEmail = $("#to").val();
	    if (filter.test(isEmail)) {
	    	//console.log('is_email');
	        $("#not_email").css('display','none');
	        //$("input").css("background-color", "pink");
	       	$('#addbutton').removeAttr('disabled');
	    }
	    else {
	    	//console.log('is not email', filter, isEmail);
	    	$('#not_email').css('display','inline');
	    	$('#addbutton').attr('disabled','disabled');
	    	$('#addbutton').prop('disabled',true);
	        return
	    }  
	if (name == selectedname){
		$('#alreadyisalarm').css('display','inline-block');
		return
	} else {
		 //console.log('submit button pressed');
	      var data = $('#email_alarm_form').serialize();
	      //console.log(data);
	     $.ajax({
		  type: 'POST',
		  url: '<?php echo base_url('sendreport/submit')?>',
		  data: data,
		  success: function(res) {
				console.log(res);
				$('#fillinputs').css('display','inline');
				location.reload();
			},
		  error: function(err){
		  	console.log(err);
		  }
		});
	}
});
</script>
<script>
$('#deletebutton').on('click',function(e){
	name = $('#alarm_name :selected').val();
	alarm_no = $('#alarm_number_analogues :selected').val();
	sender_id = $('#sender_id').val();
	user_id = $('#user_id').val();
	//console.log('delete',name, sender_id,user_id);
	$.ajax({
        url: "<?php echo base_url('get_uri/delete/alarm');?>"+'/'+sender_id+'/'+name,
        type: 'POST',
        data: {sender_id: sender_id, user_id: user_id, name: name, alarm_no: alarm_no},
        dataType: 'json',
        success: function(data) {
            console.log(data);
            location.reload();
        },
        error : function(error) {
        	console.log(error);
    	}
    });
});
</script>
<script>
function function1() {
    var ul = document.getElementById("list");
    var li = document.createElement("li");
    var children = ul.children.length + 1
    var input = $('#addemail').val();
    //console.log(input);
    li.setAttribute("id", "element"+children)
    li.appendChild(document.createTextNode(input));
    ul.appendChild(li)
    //$('#list li:last').innerhtml.val() = input;
}
function function2() {
	// var elem = document.getElementById('element6');
	// elem.parentNode.removeChild(elem);
	$('#list li:last').remove();

}
$(document).ready(function(){
	$("#to").blur(_.debounce(function(){
		console.dir('on change validate email');
		var filter = /\@/;
		isEmail = $("#to").val();
	    if (filter.test(isEmail)) {
	    	//console.log('is_email');
	        $("#not_email").css('display','none');
	        //$("input").css("background-color", "pink");
	       	$('#addbutton').removeAttr('disabled');
	    }
	    else {
	    	//console.log('is not email', filter, isEmail);
	    	$('#not_email').css('display','inline');
	    	$('#addbutton').attr('disabled','disabled');
	    	$('#addbutton').prop('disabled',true);
	        //return false;
	    }  
	},2000));
});
// function validateEmail(sEmail) {
// }​
$(document).ready(function(){
    document.getElementById("message").value = "<?php echo $alarm_table['message'];?>";
    document.getElementById("from").value = "<?php echo $alarm_table['from'];?>";
    document.getElementById("to").value = "<?php echo $alarm_table['to'];?>";
});
</script>
<script>
		function clear_fields(){
			//console.log("clear Fields");
			$("#message").val("");
			$("#from").val("");
			$("#to").val("");
			$("#subject").val("");
			$("#alarm_name option[value='']").prop('selected',true);
		}
	</script>
	<script>
	$('#alarms_dropdown').on('change', function(){
		name = $('#alarms_dropdown :selected').text();
		selectedname = $('#alarm_name :selected').val();
		////console.log('check name and selected name are not the same',name,selectedname);
		if (name == selectedname){
			$('#onlyonealarm').css('display','inline');
			$('#addbutton').attr('disabled','disabled');
		} else {
			$('#onlyonealarm').css('display','none');		
			$('#addbutton').removeAttr('disabled','disabled');
		}
	});
	</script>
	<script>
	$('#alarms_dropdown').on('change', function(){
       	selected_alarm = $(this).text();
		////console.log(selected_alarm);
		myform = $('#email_alarm_form').serialize();
		$.ajax({
		        url: '<?php echo base_url('get_uri/get/alarm/'.$alarm_table[0]['sender_id'].'/'.$alarm_table[0]['user_id']); ?>',
		        type: 'POST',
		        data: myform,
		        dataType: 'json',
		        success: function(data) {
		            //console.log(data);
		           	selected_alarm = $('#alarms_dropdown').val();
					console.log(selected_alarm);
		            console.log(data[selected_alarm].alarm_name.toLowerCase());
		            console.log(data[selected_alarm].alarm_number);
		            $("#message").val(data[selected_alarm].message);
					$("#from").val(data[selected_alarm].from);
					$("#to").val(data[selected_alarm].to);
					$("#subject").val(data[selected_alarm].subject);
					$('#alarm_name option[value='+data[selected_alarm].alarm_name.toLowerCase()+']').prop('selected', true);
					$('#alarm_number_analogues option[value='+data[selected_alarm].alarm_number+']').prop('selected', true);
		        },
		        error : function(error) {
		        	//console.log(error);
		    	}
		    });
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
	<p> <b> This is where the alarm is configured </b>. This email is sent whenever a analogue or counter or digital input which is set to feature an alarm either crosses a 
		threshold or goes to the alarm setting. The message will automatically contain details of which alarm name this is
		to the sender you specify below with a message contained below. If you want to send to multiple users then put multiple 
		email addresses in the to field with a coma inbetween. Check email log on the dashboard to see a list of emails sent.</p>
</div>
