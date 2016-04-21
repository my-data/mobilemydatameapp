<?php 
//ini_set('display_errors',1);  error_reporting(E_ALL);
?>
<!--PE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>configuration table</title> 
</head>
<body> --> 
<!-- 	<h1> Hi, Welcome to your Data.me </h1>
 -->	
 <?php //print_r($user_inputs);?>
 <h2><b>Configuration Panel</b></h2>     
	<script>
	function configure_dashboard(){
		$.ajax({
	            type: 'POST',
	            url: '<?php  echo base_url();?>display/scaling',
	            data: $('configuration_table').serialize(),
	            success: function (res) {
	              if (res){
						// Show Entered Value
						//////console.log('succesful', number);
						}
				},
				 error: function(e) {
					//called when there is an error
					//////console.log(e.message);
				  }
	        });
		window.location="<?php  base_url();?>display/scaling";
	}

	function number_of_inputs(){
		number = $('#number_inputs').val();
		$.ajax({
		  type: 'POST',
		  url: '<?php  echo base_url();?>/configure_dashboard',
		  data: {'number': number},
		  success: function(res) {
			if (res){
				//////console.log('succesful', number);
				}
			}
		});
	}
	</script>
	<?php $selected_device = $_POST['selecteddevice'];?>
	<?php if (empty($_POST['selecteddevice'])){ $selected_device = 0;} ?>
	<?php $count = count($devices); ?>
	<div class='block'>
		<table>
			<tr>
				<td style='width: 300;'>
		<form action='<?php echo base_url();?>/configure_dashboard' method='post'>
		<div class='block form-line'>
			<label style='float:left;width:35%'>Name:</label>
			<select style="margin: 5;float: left;font-weight: bold;width:auto"class="form-control" id="selecteddevice" name="selecteddevice">
			<?php for ($i=0; $i<$count; $i++){ ?>
				<?php echo "<option value=".$i."><b>".$devices[$i]['machine_name']."</b></option>";?>
			<?php } ?>
		</select>
		<script>
		// selected_device = <?php echo $selected_device;?>;
		// //////console.log('selected_device', selected_device);
		// $('#selecteddevice option[value='+selected_device+']').prop('selected',true);
		</script>
<!-- 		<button style="margin:5px;float: right;width:80px;"class="btn btn-primary" type="submit">Refresh</button>
 -->		</div>
		<?php //echo $selected_device;?>
		</form>
		<td style='width: 400;'>
 		<div class='block'>
<!-- 			<form action='<?php echo base_url('sendreport')?>' method='post'>
			<button style='margin-top:25' type="submit" class="btn btn-default"  id='alarmsetup<?php echo $i;?>' name='alarmsetup<?php echo $i;?>' value='<?php echo $user_inputs[$selected_device][$i]['name'];?>'><b>Configure Emails</b></a>
			<input style='display:none' id='hiddenuserid'name='hiddenuserid' value='<?php echo $user_id;?>'></input>
			<input style='display:none' id='hiddensenderid'name='hiddensenderid' value='<?php echo $sender_id;?>'></input>
			</form> -->
		</div> 

<!-- 		<div class='block form-inline'>
			<label style='float: left; display:none'>Sender ID:</label>
			<input style='margin: 5px; width: 60%;font-weight: bold;display:none'name="sender_id" id="sender_id" value="<?php echo $user_inputs[$selected_device][0]['sender_id'];?>"></input>
		</div> -->
		<script>
		// $('#selecteddevice').on('change',function(){
		// 	index = $(this).val();
		// 	//////console.log('selected index: ',index);
		// 	//////console.log('sender_id','<?php echo $user_inputs['+index+'][0]['sender_id'];?>');
		// 	$('#sender_id_box').val('<?php echo $user_inputs['+index+'][0]['sender_id'];?>');
		// })
		</script>
		</td>
		<td>
		<a href='#' onclick='post_inputs()'id='update_inputs_button' style="margin:10px;"class="btn btn-primary" type="button"><b>Update Inputs</b></a>
		<script>
		function post_inputs(){
		//$('#update_inputs_button').on('submit', function(e) {
			//e.preventDefault;
			//var url = form.attr("action");
		    // var formData = {};
		    // $(this).find("input[name]").each(function (index, node) {
		    //     formData[node.name] = node.value;
		    // });
		    // $.post(url, formData).done(function (data) {
		    //     //////console.log(data);
		    // });
			 //////console.log('submit button pressed');
		 //    //prevent the default submithandling
		 //    e.preventDefault();
		 //    //////console.log($(this));
		 //    //send the data of 'this' (the matched form) to yourURL
		 //    //////console.log(data);
		      var data = $('#inputs_configuration_form').serialize();
		      //////console.log(data);
		      //test no two are checked
		      for (i=20; i<29;i++){
			      hiischecked = $('#HI'+i+'-0').is(':checked');		      
			      loischecked = $('#LO'+i+'-0').is(':checked');
			      //console.log(hiischecked, loischecked);
			      if (hiischecked && loischecked){
			      	//console.log('display error');
			      	$('#hiandlochecked'+i+'-0').css('display','inline-block');
			      }	 else {
			      	$('#hiandlochecked'+i+'-0').css('display','none');			      	
			      }	      	
		      } 
		     $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url(); ?>configure_dashboard/add_labels',
			  data: data,
			  success: function(res) {
					console.log(res);
					$('#fillinputs').css('visibility','visible');
				},
			  error: function(err){
			  	////console.log(err);
			  }
			});

	}
		</script>
		</td>
		<td>
					<a style="float:right;margin:10px;"class="btn btn-danger" href="<?php echo base_url('User/login'); ?>"><b>Logout</b></a>
		</td>
		<td>
		<a style="float:right;margin:10px;" class = "btn btn-info" href="#" id="contactUs"><b>Help Button</b></a>  
		</td>
		<td>
					<a style='margin-bottom: 6;'class="btn btn-default" href="<?php echo base_url('/rawdata'); ?>"><b>Back</b></a>
		</td>
		<td>
			<div class="block">
<!-- 				<label style="display:inline-block" id='titleloading'>Loading Bar</label>
 -->					<!-- 	<div style='margin:10;margin-left:-3;float:left'class="alert alert-info" id='bootstrap_warning_message'> This page is loading </div>
 	 -->	<div style="width:100px;display:inline-block;margin-left:5;float:right"id="progressbar"></div>
			<div class="alert alert-success" style='display:none' id='success_load'>
			 <p> <strong>Success!</strong> The Page has loaded.</p>
			</div>
			</div>
			<script>
			    $( "#progressbar" ).progressbar({
				      value: 37
				    });

			        var value = $( "#progressbar" ).progressbar( "option", "value" );
			          //  $("#jqProgressBar").progressbar(status);
			        //////console.log('progress_bar_initilaised',value);
			</script>
		</td>
		<td>
			<div class="alert alert-success" style='visibility:hidden;margin: 10;' id='fillinputs'><label style='margin: 2; display: inline;'>Inputs updated!</label></div>

</td>
		</tr>
	</table>
	</div>
	<script>
	$(document).ready(function() {
	   $('#selecteddevice').trigger('change');
	});
	$('#selecteddevice').on('change',function(e){
		//////console.log('select is changed');
		var selected_device = $("option:selected",this);
		var selected_value = this.value;
		var user_id = <?php echo $devices[0]['user_id'];?>;
		var index = $(this).val();
		var sender_id = [];
		<?php for ($i=0;$i<count($user_inputs);$i++){ ?>
			sender_id.push('<?php echo $user_inputs[$i][0]['sender_id'];?>');
		<?php } ?>
		//////console.log('index',index);
		//////console.log('test sender_id',sender_id);
		var sender_id = sender_id[index];
		//////console.log('sender_id',sender_id);
		//////console.log('selected_device',selected_device,'selected_value', selected_value, 'user_id', user_id);
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>get_uri/get/inputs_for_device/'+sender_id,
    		crossDomain: true,
    		dataType: 'jsonp',
    			success: function(data){
				console.log(data);
				for (i=0;i<32;i++){
					console.log(i);
					for (j=0;j<3;j++){
						console.log(j);
						$('#sender_id').val(data[i].sender_id);
						$('#hiddensender_id').val(data[i].sender_id);
						$('#hiddenuserid').val(data[i].user_id);
						$('#hiddensenderid').val(data[i].sender_id);
						$('#name'+i+'-'+j+'').text(data[i].name);
						$('#label'+i+'-0').val(data[i].label_name);
						//////console.log(data[1].label_name);
						$('#direction'+i+'-0 option[value='+data[i].direction+']').prop('selected',true);
						$('#direction'+i+'-1 option[value='+data[i].direction2+']').prop('selected',true);
						$('#direction'+i+'-2 option[value='+data[i].direction3+']').prop('selected',true);
						$('#direction'+i+'-3 option[value='+data[i].direction4+']').prop('selected',true);
						$('#reset'+i+'-0').val(data[i].reset_level);						
						$('#reset'+i+'-1').val(data[i].reset2);
						$('#reset'+i+'-2').val(data[i].reset3);					
						$('#reset'+i+'-3').val(data[i].reset4);
						$('#threshold'+i+'-0').val(data[i].threshold);						
						$('#threshold'+i+'-1').val(data[i].threshold2);
						$('#threshold'+i+'-2').val(data[i].threshold3);					
						$('#threshold'+i+'-3').val(data[i].threshold4);	
						$("#customunits"+i).val(data[i].units);
						if (data[i].units){
							$('#units'+i+'-'+j+' option[value ='+data[i].units+']').prop('selected', true);
						}
						$('#min'+i+'-'+j+'').val(data[i].min);
						$('#max'+i+'-'+j+'').val(data[i].max);
						is_graphed = parseInt(data[i].is_graphed);
				    	if (is_graphed === 1){
				    	    $("#is_graphed"+i+"-0").prop("checked", true);
					   	} else {
				    	    $("#is_graphed"+i+"-0").prop("checked", false);					   		
					   	}
					   	if (j===0){
						   	is_email = parseInt(data[i].is_email);
						   	////console.log('is email',is_email === 1);
							if (is_email === 1){
						        $("#is_email"+i+"-0").prop("checked", true);
					    	} else {
						        $("#is_email"+i+"-0").prop("checked", false);				    		
					    	}					   		
					   	}
					   	//add hi and lo
					   	if (j === 0){
		   			        if (i>19 && i<29){
		   			        	console.log('hi',data[i].HI, 'lo', data[i].LO, 'i', i,'j',j);
			   			      	if (data[i].HI == 1){
							      $('#HI'+i+'-0').prop("checked", true);		      	   			      		
			   			      	}
			   			      	if (data[i].LO == 1){
							      $('#LO'+i+'-0').prop("checked", true);	   			      		
			   			      	}      	
					        } 
					   	}
					   	if (j === 1){
		   			        if (i>19 && i<29){
		   			        	console.log('hi2',data[i].HI2, 'lo2', data[i].LO2, 'i',i,'j',j);
			   			      	if (data[i].HI2 == 1){
							      $('#HI'+i+'-1').prop("checked", true);	      	   			      		
			   			      	}
			   			      	if (data[i].LO2 == 1){
							      $('#LO'+i+'-1').prop("checked", true);	   			      		
			   			      	}  
			   			      	if (data[20].LO2 == 1){
			   			      		//console.log('HEY BITACHES', data[20].LO2);
			   			      		$('#LO20-1').prop('checked',true);
			   			      	}    	
					        } 
					   	}					   	
				    }
				}
			},
			error: function(e){
				//////console.log(e);
			}
		});
	});
	//function get_inputs_for_device(){

	//}
	</script>
<form id='inputs_configuration_form' name="configure_input_form" method='post'action=''>
	<input hidden style='margin: 10;'name="hiddenuser_id" id="hiddenuser_id" value="<?php echo $user_id?>"></input> 	
	<input hidden style='margin: 10;'name="hiddensender_id" id="hiddensender_id" value="<?php echo $devices[$selected_device]['sender_id'];?>"></input> 	
 	<table class="table"id="inputs_table"style="float:left;	border: 6px groove black;">
		<thead><tr><th style='font-size: 25;font-style: oblique;'>Name</th><th style='font-size: 25;font-style: oblique;'>Chart Name</th>
			<th style='font-size: 25;font-style: oblique;'>Direction</th>
			<th style='font-size: 25;font-style: oblique;'>Reset</th>
			<th style='font-size: 25;font-style: oblique;'>Threshold</th>		
			<th style='font-size: 25;font-style: oblique;'>Units</th>
			<th style='font-size: 25;font-style: oblique;'>Min</th>
			<th style='font-size: 25;font-style: oblique;'>Max</th>
<!-- 			<th style='font-size: 25;font-style: oblique;'>Chart</th>
 -->			<th style='font-size: 25;font-style: oblique;'>Email</th></tr>
		</thead>
		<tbody>
			<?php $count=32; ?>
			<?php $arr = array(0,1,2,3,20,21,22,23,24,25,26,27,28,29,30,31); ?>
			<?php foreach ($arr as $i){ ?>
			<?php //for ($i=0; $i < 32; $i++){ ?>
			<?php for ($j=0; $j < 4; $j++){ ?>
			<?php $extra_rows = 4;?>
			<tr style='inline-grid'class='inputs new_row<?php echo$i;?>'id ='a<?php echo $i;?><?php echo $j;?>'>
				<td>
					<div class="col-md-4">
						<label id='labelname<?php echo $i;?><?php echo $j;?>'><b id='name<?php echo $i;?><?php echo $j;?>' style='margin-left: 20;font-size: 58;'><?php echo $user_inputs[$selected_device][$i]['name'];?></b></label>
						<label style = 'display:none'class="label label-info"id='alarm_label<?php echo $i;?>-<?php echo $j;?>'>Alarm <?php echo $j+1;?></label>
						<div class='block' style='display: inline-block;width: 200px;'>
						<?php if ($user_inputs[$selected_device][$i]['type'] != 'counter'){ ?> 
						<a style='margin:10px;    float: left;display:none;    margin-left: -1;'id='add_alarm<?php echo $i;?>-<?php echo $j;?>'class="btn btn-primary add"href='#'>Show</a>
						<a style='margin:10px; width: 80;    float: left;display:none' id='remove_alarm<?php echo $i;?>-<?php echo $j;?>'class="btn btn-primary remove"href='#'>Hide</a>
						<?php } ?>
						</div>
					</div>
					<script>
					name = $('#name<?php echo $i;?><?php echo $j;?>').text();
					name=name.toString();
					num = <?php echo $i;?>;
					//////console.log('NAME',name,'NUM',num,'length',name.length);
					if ( num < 20){ 
						if (name.length === 2){
						var txt2 = name.slice(0, 1) + "n" + name.slice(1);						
					}
					if (name.length === 3){
						var txt2 = name.slice(0, 1) + "n" + name.slice(1);
					}
					} else if (num > 19 && num < 28){
						var txt2 = name.slice(0,1)+'in'+name.slice(1);
					} else if (num >28){
						var txt2 = name;
					} else {
						var txt2 = name;
					}
					// //////console.log('ADAPTED NAME',txt2);
					// //////console.log('label name', '<?php echo $user_inputs[$selected_device][$i]['name'];?>');
					$('#name<?php echo $i;?><?php echo $j;?>').text(txt2);
					</script>
				</td>
				<td>
					<?php if ($j == 0){ ?> 
					<div class="block">
						<input style='width: 150;margin-top:50;margin-left:auto;margin-right:auto'size="8"name="label<?php echo $i;?>-<?php echo $j;?>" type="text" id="label<?php echo $i;?>-<?php echo $j;?>" value="<?php echo $user_inputs[$selected_device][$i]['label_name'];?>">
						 <div class="alert alert-danger" style='display:none;color:red;width: 150;    margin: 10;'id='errornamelength<?php echo $i;?>-<?php echo $j;?>'><label>Label name too long</label></div>				
					</div>
					<script>
					$('#label<?php echo $i;?>-<?php echo $j;?>').val('<?php echo $user_inputs[$selected_device][$i]['label_name'];?>');
					//////console.log('selector');
					$('#label<?php echo $i;?>-<?php echo $j;?>').on('keyup',function(){
						length = $(this).val().length;
						//////console.log(length);
						if (length > 12){
							$('#errornamelength<?php echo $i;?>-<?php echo $j;?>').css('display','inline-block');
						} else {
							$('#errornamelength<?php echo $i;?>-<?php echo $j;?>').css('display','none');
						}
					})
					</script>
					<?php } ?>
				</td>
				<td>
					<?php if($user_inputs[$selected_device][$i]['type'] == "analogue"){ ?>
				<div class="block" style='width: 200; margin-left:auto;margin-right:auto;'>
					<div class='dropup' style="width:90px;    margin-top: -10;">
						<select style='margin:10;margin-left: 50;width: 90;    margin-top: 60;'class='form-control' name="direction<?php echo $i;?>-<?php echo $j;?>" id="direction<?php echo $i;?>-<?php echo $j;?>">
						<option selected value="1">LotoHi</option>
						<option value="0">HitoLo</option>
					</select>
					</div>
				</div>
					<div class="alert alert-danger" style='display:none;color:red;width: 150;'id='errorlotohi<?php echo $i;?>-<?php echo $j;?>'><label>Direction is LotoHi. Reset must not be greater than the threshold.</label></div>				
					<div class="alert alert-danger" style='display:none;color:red;width: 150;'id='errorhitolo<?php echo $i;?>-<?php echo $j;?>'><label>Direction is HitoLo. Threshold must not be greater than the reset.</label></div>				
					<script>
					if (<?php echo $j;?>===0){
					$('#direction<?php echo $i;?>-<?php echo $j;?> option[value='+<?php echo $user_inputs[$selected_device][$i]['direction'];?>+']').prop('selected',true);
					}
					$('#direction<?php echo $i;?>-1 option[value='+<?php echo $user_inputs[$selected_device][$i]['direction2'];?>+']').prop('selected',true);
					$('#direction<?php echo $i;?>-2 option[value='+<?php echo $user_inputs[$selected_device][$i]['direction3'];?>+']').prop('selected',true);
					$('#direction<?php echo $i;?>-3 option[value='+<?php echo $user_inputs[$selected_device][$i]['direction4'];?>+']').prop('selected',true);
				    // var LotoHI = <?php echo $user_inputs[$selected_device][$i]['direction'];?>;
				    // 	if (LotoHI === 1){
					   //      $("#LotoHI<?php echo $i;?>").attr("checked", true);
					   //      $("#HitoLo<?php echo $i;?>").attr("checked", false);
				    // 	} else {
					   //      $("#HitoLO<?php echo $i;?>").attr("checked", true);
					   //      $("#LotoHi<?php echo $i;?>").attr("checked", false);					        
				    // 	}
				   //$('#threshold<?php echo $i;?>-<?php echo $j;?>').keyup(function(){
				   	</script>
					<?php } ?>
				</td>
				<td >
					<?php  if ($user_inputs[$selected_device][$i]['type'] != 'digital') { ?> 
					 <div class="block">
						<input style='    margin-top: 50;
' size="4" name="reset<?php echo $i;?>-<?php echo $j;?>" type="text" id="reset<?php echo $i;?>-<?php echo $j;?>"
						value="<?php echo $user_inputs[$selected_device][$i]['reset_level'];?>">
					</div> 
					<?php } ?>
					<script>
					if (<?php echo $j;?>===0){
						$('#reset<?php echo $i;?>-<?php echo $j;?>').val('<?php echo $user_inputs[$selected_device][$i]['reset_level'];?>');						
					}
					$('#reset<?php echo $i;?>-1').val(<?php echo $user_inputs[$selected_device][$i]['reset2'];?>);
					$('#reset<?php echo $i;?>-2').val(<?php echo $user_inputs[$selected_device][$i]['reset3'];?>);					
					$('#reset<?php echo $i;?>-3').val(<?php echo $user_inputs[$selected_device][$i]['reset4'];?>);
					</script>
				</td>
				<td >
					<?php  if($user_inputs[$selected_device][$i]['type'] != "digital"){ ?>
					<div class="block" id="thislist">
						
						<input size="4" style='margin-top:50;'
						id="threshold<?php echo $i;?>-<?php echo $j;?>"  type="text" name="threshold<?php echo $i;?>-<?php echo $j;?>"
						value="<?php echo $user_inputs[$selected_device][$i]['threshold'];?>">

					</div>
					<script>
					//////console.log('selector', $('#threshold<?php echo $i;?>-<?php echo $j;?>'), 'value', '<?php echo $user_inputs[$selected_device][$i]['threshold'.$j];?>');
					if (<?php echo $j;?>===0){
						$('#threshold<?php echo $i;?>-<?php echo $j;?>').val('<?php echo $user_inputs[$selected_device][$i]['threshold'];?>');						
					}
					$('#threshold<?php echo $i;?>-1').val(<?php echo $user_inputs[$selected_device][$i]['threshold2'];?>);
					$('#threshold<?php echo $i;?>-2').val(<?php echo $user_inputs[$selected_device][$i]['threshold3'];?>);					
					$('#threshold<?php echo $i;?>-3').val(<?php echo $user_inputs[$selected_device][$i]['threshold4'];?>);					//$('#threshold<?php echo $i;?>-<?php echo $j;?>').val('<?php echo $user_inputs[$selected_device][$i]['threshold'.$j];?>');
					threshold = '<?php echo $user_inputs[$selected_device][$i]['threshold'];?>';

					function add_li(){
						//////console.log('button clicked');
						var list = document.getElementById('thislist');
						var threshold = document.getElementById('threshold<?php echo $i;?>').value;
						//////console.log(threshold);
						var newentry = document.createElement('li');
						newentry.appendChild(document.createTextNode(threshold));
						list.appendChild(newentry);
						$('#thresholdlist li:last').append('<input class="form-control" id="direction" type="checkbox"></input><input class="form-control" id="reset1" size="8"type="text"></input>');
							 input = $('#threshold<?php echo $i;?>').val();
					}
					function remove_li(){
						td = <?php echo $i;?>;
						//////console.log(td);
							val = $('#threshold<?php echo $i;?>').val();
							//////console.log(val);
							$('#list li:last').remove();
						 };
						 function stuffhiddenvalues(){
							$('#thislist ul.selector li')
								.each(function(i) {
									$("<input name='threshold-"+ i +"'>")
									.val($(this).html())
									.appendTo('form.selector');
									$("<input name='direction-"+ i +"'>")
									.val($(this).html())
									.appendTo('form.selector');
									$("<input name='reset-"+ i +"'>")
									.val($(this).html())
									.appendTo('form.selector');
								});
							}
					</script>
					<?php  } else { ?>
					<?php if ($j == 0){ ?> 
					<div class="checkbox" style='margin-top:50;'>
						<label class="form-control" style='    width: 120px;    margin-right: auto;    margin-left: auto;'>
								<input style="margin:5px; margin-left:-10"type="checkbox" name="HI<?php echo $i;?>-<?php echo $j;?>" id="HI<?php echo $i;?>-<?php echo $j;?>"value="1">Lo to Hi</label>
					</div>
												<?php } ?>
							<?php if ($j == 1){ ?> 

					<div class="checkbox" style='margin-top:50;'>
						<label class="form-control" style='    width: 120px;    margin-right: auto;    margin-left: auto;'>
								<input style="margin:5px;margin-left:-10" type="checkbox" name="LO<?php echo $i;?>-<?php echo $j;?>" id="LO<?php echo $i;?>-<?php echo $j;?>"value="1">Hi to Lo</label>
					</div>
												<?php } ?>

					 <div class="alert alert-danger" style='display:none;color:red;'id='hiandlochecked<?php echo $i;?>-<?php echo $j;?>'><label style='display:inline-block'>Do not tick both boxes</label></div>				
					<script>
				    var HI = <?php echo $user_inputs[$selected_device][$i]['HI'];?>;
				    	if (HI === 1){
					        $("#HI<?php echo $i;?>-<?php echo $j;?>").attr("checked", "checked");
				    	}
				    var LO = <?php echo $user_inputs[$selected_device][$i]['LO'];?>;
				    	if (LO === 1){
					        $("#LO<?php echo $i;?>-<?php echo $j;?>").attr("checked", "checked");
				    	}
				    $('#HI<?php echo $i;?>-<?php echo $j;?>').change(function(){
					    hi_ticked = $('#HI<?php echo $i;?>-<?php echo $j;?>').is(':checked');
					    lo_ticked = $('#LO<?php echo $i;?>-<?php echo $j;?>').is(':checked');
					    //console.log(hi_ticked, lo_ticked);
					    if (hi_ticked === true && lo_ticked === true){
					    	//console.log('error message both ticked');
						    $('#hiandlochecked<?php echo $i;?>-0').css('display','inline-grid');					    	
					    }				    	
				    });

					</script>
					<?php  } ?>
				</td>
				<td>
				<?php if ($j == 0){ ?> 
					<?php if($user_inputs[$selected_device][$i]['type'] != "digital"){ ?>
<!-- 					<input size="8"name="unitstext<?php echo $i;?>" type="text" id="unitstext<?php echo $i;?>">
 -->					<select style='margin:10;margin-left: auto;width: 110;margin-top: 50;margin-right:auto'class='form-control' name="units<?php echo $i;?>-<?php echo $j;?>" id="units<?php echo $i;?>-<?php echo $j;?>">
						<option value="custom">Custom</option>
						<option value="meter">Meter</option>
						<option value="kilogram">Kilogram</option>
						<option value="second">Second</option>
						<option value="ampere">Ampere</option>
						<option value="kelvin">Kelvin</option>
						<option value="mole">Mole</option>
						<option value="candle">Candle</option>
						<option value="radian">Radian</option>
						<option value="steradian">Steradian</option>
						<option value="hertz">Hertz</option>
						<option value="newton">Newton</option>
						<option value="pascal">Pascal</option>
						<option value="joule">Joule</option>
						<option value="watt">Watt</option>
						<option value="celsius">Celsius</option>
						<option value="coulomb">Coulomb</option>
						<option value="volt">Volt</option>
						<option value="ohm">Ohm</option>
						<option value="siemens">Siemens</option>
						<option value="farad">Farad</option>
					</select>
					<button type='button' style='    margin-left: 0;'id='custom_units<?php echo $i;?>' class='btn btn-default' onclick="myfunction(id)">Custom units</button>
					<div style='margin-top: 5;'id='test<?php echo $i;?>'></div>
					<script>			
					var clicked2 = false;
					function myfunction(id){
						i = <?php echo $i;?>;
						units = ['<?php echo $user_inputs[$selected_device][0]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][1]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][2]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][3]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][4]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][5]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][6]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][7]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][8]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][9]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][10]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][11]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][12]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][13]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][14]['units'];?>',
						  '<?php echo $user_inputs[$selected_device][15]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][16]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][17]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][18]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][19]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][20]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][21]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][22]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][23]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][24]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][25]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][26]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][27]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][28]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][29]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][30]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][31]['units'];?>',
						 '<?php echo $user_inputs[$selected_device][32]['units'];?>']
						//units = units.push('<?php echo $user_inputs[$selected_device][$i]['units'];?>');
						 //////consle.log(clicked2);
						//////console.log('id name',id,'length',id.length);
						if (id.length ===13){
							var num = id.substr(id.length - 1); 
						} 
						if (id.length===14){
							var num = id.substr(id.length - 2);
						}
						num = parseInt(num);
						console.log(num,units,units[num]);
						$("#custom_units"+num).replaceWith("<input type='text' style='width:110px;margin:10' name='custom_units"+num+"' id='custom_units"+num+"' value='<?php echo $user_inputs[$selected_device]["+num+"]['units'];?>'></input> ");
						clicked2 = true;
						$("#custom_units"+num).val(units[num]);
						//////console.log('units', '<?php echo $user_inputs[$selected_device][$i]['units'];?>');
					}			
					</script>
						<script>
							units = '<?php echo $user_inputs[$selected_device][$i]['units'];?>';
							if (!units){
								units = 'none';
							}
							$('#units<?php echo $i;?>-<?php echo $j;?> option[value ='+units+']').prop('selected', true);
						</script>
					<?php } ?>
				<?php } ?>
				</td>
				<td>
				<?php if ($j == 0){ ?> 
					<?php if($user_inputs[$selected_device][$i]['type'] == "analogue"){ ?>
					<input style="margin:5px;margin-top: 50;    width: 110;    margin-left: auto;    margin-right: auto;"size="5"name="min<?php echo $i;?>-<?php echo $j;?>" type="text" id="min<?php echo $i;?>-<?php echo $j;?>"value="<?php echo $user_inputs[$selected_device][$i]['min'];?>">
					<div id="slider_min<?php echo $i;?>-<?php echo $j;?>"style=" width: 110;    margin-left: auto;    margin-right: auto;"></div>
					<script>
					$("#slider_min"+<?php echo $i;?>+"-"+<?php echo $j;?>).slider({
						min:-1024,
						max:1024,
						step:0.01,
						value: 100,
						slide: function(event, ui){
							$('#min'+<?php echo $i;?>+'-'+<?php echo $j;?>).val(ui.value);
						}
					});
					</script>
					<?php  } ?>
				<?php } ?>
				</td>
				<td>
				<?php if ($j == 0){ ?> 	
					<?php  if($user_inputs[$selected_device][$i]['type'] == 'analogue'){ ?>
					<input style="margin:5px;margin-top: 50;    width: 110;    margin-left: auto;    margin-right: auto;"size="5"name="max<?php echo $i;?>-<?php echo $j;?>" type="text" id="max<?php echo $i;?>-<?php echo $j;?>"value="<?php echo $user_inputs[$selected_device][$i]['max'];?>">
					<div id="slider_max<?php echo $i;?>-<?php echo $j;?>"style="    width: 110;    margin-left: auto;    margin-right: auto;"></div>
					<script>
					$("#slider_max"+<?php echo $i;?>+"-"+<?php echo $j;?>).slider({
						min:-1024,
						max:1024,
						step:0.01,
						value: 100,
						slide: function(event, ui){
							$('#max'+<?php echo $i;?>+'-'+<?php echo $j;?>).val(ui.value);
						}
					});
					</script>
					<?php  } ?>
				<?php } ?>	
				</td>
<!-- 				<td>
				<?php if ($j == 0){ ?> 	
					<?php if ($user_inputs[$selected_device][$i]['type'] !== 'digital'){ ?>
							<input type="checkbox" style="margin:10px; margin-left: 35;margin-top: 10;height: 15;width: 15px;"name="is_graphed<?php echo $i;?>-<?php echo $j;?>" id="is_graphed<?php echo $i;?>-<?php echo $j;?>"value="1">
							<script>
							//////console.log('senderid',sender_id);
							//////console.log('$i','<?php echo $i;?>', 'is_graphed','<?php echo $user_inputs[$selected_device][$i]['is_graphed'];?>','senderid', '<?php echo $user_inputs[$selected_device][$i]['sender_id'];?>');
							    var charted = <?php echo $user_inputs[$selected_device][$i]['is_graphed'];?>;
							    //////console.log('is_charted', charted);
							    	if (charted === 1){
								        $("#is_graphed<?php echo $i;?>-<?php echo $j;?>").attr("checked", "checked");
							    	}
							</script>
					<?php } ?>		
				<?php } ?>	
				</td> -->
				<td >
					<input type="checkbox" style="margin:10px;margin-left: auto;height: 15;width: 15px;margin-top:60;margin-right:auto"name="is_email<?php echo $i;?>-<?php echo $j;?>" id="is_email<?php echo $i;?>-<?php echo $j;?>"value="1">
					<script>
					    var emailed = <?php echo $user_inputs[$selected_device][$i]['is_email'];?>;
					    //////console.log(emailed)
					    	if (emailed === 1){
						        $("#is_email<?php echo $i;?>-<?php echo $j;?>").attr("checked", "checked");
					    	}
					</script>
				 </td>
<!-- 				<td>
 				</td> -->
			</tr> 
			<script>
			num = <?php echo $i;?>;
			j = <?php echo $j;?>;
			//////console.log('NUMBNER IN LOOP', num, 'j',j);
			if(num<20){
				//////console.log('toggle analogue');
				if (j===0){
					$('#a'+num+j).css('background-color', 'aliceblue');
					$('#a'+num+j).css('outline', 'thin solid black');
				} else {
					$('#a'+num+j).css('background-color', '#BEEAE2');
					$('#a'+num+j).css('outline', 'thin solid black');
				}

			}
			if( 19<num && num<28){
				if (j===0){
					$('#a'+num+j).css('background-color', 'silver');
					$('#a'+num+j).css('outline', 'thin solid black');
				} else {
					$('#a'+num+j).css('background-color', '#DDD');
					$('#a'+num+j).css('outline', 'thin solid black');
				}

			}			
			if( 27<num && num<32){
				if (j===0){
					$('#a'+num+j).css('background-color','lightsalmon');
					$('#a'+num+j).css('outline', 'thin solid black');					
				} else {
					$('#a'+num+j).css('background-color','#F58975');
					$('#a'+num+j).css('outline', 'thin solid black');
				}

			}
			if (j > 0){
				$('#a<?php echo $i;?><?php echo $j;?>').hide();
				$('#remove_alarm<?php echo $i;?>-<?php echo $j;?>').attr('disabled','disabled');
				$('#add_alarm<?php echo $i;?>-<?php echo $j;?>').attr('disabled','disabled');
			}
			if ((num > 3) && (num < 20)){
				$('#a<?php echo $i;?><?php echo $j;?>').hide();				
			}
			if (j==0){
				var count2=0;
			}
				count2 = count2 +1;
				i = <?php echo$i;?>;
	        	counterperc = 100*((((i+1))/32));
	        	//////console.log(['count',count2,'counterperc',counterperc,'j',<?php echo $j;?> , 'i', <?php echo $i;?>],'(j+i)/32*4',(j+i)/32*4);
	        	$( "#progressbar").progressbar("value", counterperc );
	        	if (counterperc === 100){
	        		//////console.log('page is loaded');
	        		$("#progressbar").val("<p class='alert alert-success'>Page is Loaded<p>");
	        		$('#progressbar').css('display', 'none');
	           		$('#titleloading').css('display', 'none');
			        $('#bootstrap_warning_message').css('display', 'none');	
			        $('#success_load').css('display','none');
			        $('#bootstrap_warning_message').replaceWith($('#success_load'));
	        	}
			</script>
			<script>
						    var direction = <?php echo $user_inputs[$selected_device][$i]['direction'];?>;
						    var direction2 = <?php echo $user_inputs[$selected_device][$i]['direction2'];?>;
						    $('direction0 option[value=1]').attr('disabled','disabled');
						    function add_alarm_html(){
						    	$('#direction<?php echo $i;?>').append('<input type="checkbox" style="margin:10px;margin-left: -20px;margin-top: 6;"name="direction<?php echo $i;?>" id="direction<?php echo $i;?>"value="1">Hi to Lo</label>')
						    }
						    var row = 0;
						    	$('#add_alarm<?php echo $i;?>-<?php echo $j;?>').on('click',function(e){
						     		e.preventDefault();
						     		row++;
						     		i = <?php echo $i;?>;
						     		j = <?php echo $j;?> +row;
						     		//////console.log('add row ahead',j,' when clicked', 'selected',$('#a<?php echo $i;?>'+j+'') );
						     		$('#a<?php echo $i;?>'+j+'').show();
						     		$('.add').attr('disabled','disabled');
						     		$('.remove').attr('disabled','disabled');
						     		$(this).removeAttr('disabled');
						     		$('#remove_alarm<?php echo $i;?>-<?php echo $j;?>').removeAttr('disabled');
						     		if ((i>19) && (i<28) && (j==1)){
						     			$('#add_alarm<?php echo $i;?>-0').attr('disabled', 'disabled');
						     			$('#remove_alarm<?php echo $i;?>-0').removeAttr('disabled');						     			
						     		}
						     		if (row===3){
						     			$('#add_alarm<?php echo$i;?>-0').attr('disabled', 'disabled');
						     			$('#remove_alarm<?php echo$i;?>-0').removeAttr('disabled');
						     		}
						     	});
						     	$('#remove_alarm<?php echo $i;?>-<?php echo $j;?>').on('click',function(e){
						     		e.preventDefault();
						     		//////console.log('remove row',row);
						     		$('#a<?php echo $i;?>'+row+'').hide();	
						     		$('.remove').attr('disabled','disabled');
						     		$('.add').removeAttr('disabled');
						     		$(this).removeAttr('disabled');
						     		if (row===1){
						     			j = row - 1;
						     			//////console.log('row number', row,'changealarm',j,'removeattr','disabled');
						     			$('#add_alarm<?php echo $i;?>-'+j+'').removeAttr('disabled');
						     		}
						       		row--;
						       		if (row===0){
						     			$('#remove_alarm<?php echo $i;?>-<?php echo $j;?>').attr('disabled', 'disabled');
						     		}
						    	});
						    $(function(){
						    	var counter = 1;
						    	var row = 0;
						    	var clicked =false;
						    	function add_existing_alarm_elements(){
						    		for (i=0;i<32;i++){
										data[i] = $('#tr.new_row<?php echo $i;?>').data.i.num_alarms;
										//////console.log('i',i,'data[i]',data[i]);
						    		}
						    	}
						    	var row = 0;
						     	
						   //  	$('#add_alarm<?php echo $i;?>').on('click',function(e){
						   //  		e.preventDefault();
						   //  		counter++;
						   //  		row++;
						   //  		num_of_rows = $('#inputs_table tr').length;
						   //  		//////console.log('number of clonerows',num_of_rows);
						   //  		//////console.log('current row is',row);
						   //  		rowplusone = row+1;
						   //  		//////console.log('click',row);
						   //  		 if(row>3){
						   //  		 	return;
						   //  		 }
						   //  		clicked = true;
						   //  		//////console.log('click',clicked);
						   //  		test = _.map([1, 2, 3], function(num){ return num * 3; });
						   //  		//////console.log('test underscore',test);
							  // 	    var direction2 = <?php echo $user_inputs[$selected_device][$i]['direction2'];?>;

						   //  		var newRow = $('tr.new_row<?php echo $i;?>').clone(true, true).wrap('</tr><tr>').addClass('new_row<?php echo $i;?>').attr('id','clone_row'+row+'a<?php echo $i;?>');
						   //  		//newrow.find('#a<?php echo $i;?>').attr({'id','newrow2<?php echo $i;?>','class','newrow2<?php echo $i;?>'});
						   //  		//////console.log(newRow);
						   //  		newRow.find('#direction<?php echo $i;?>').attr({'id':'directionnr'+row+'<?php echo $i;?>','name':'direction'+row+'nr<?php echo $i;?>'});
						   //  		newRow.find('#reset<?php echo $i;?>').attr({'id':'resetnr'+row+'<?php echo $i;?>','name':'reset'+row+'nr<?php echo $i;?>'});
						   //  		newRow.find('#threshold<?php echo $i;?>').attr({'id':'thresholdnr'+row+'<?php echo $i;?>','name':'threshold'+row+'nr<?php echo $i;?>'});
						   //  		newRow.find('#add_alarm<?php echo $i;?>').attr({'id':'add_alarm'+row+'<?php echo $i;?>'});						    		
						    		
						   //  		newRow.find('#customunits<?php echo $i;?>').css('visibility','hidden');
						   //  		newRow.find('#labelname<?php echo $i;?>').append('<label><b>Alarm '+rowplusone+'</b></label>');
							  //  		//newRow.find('#alarm_label').css('visibility','hidden');
									// newRow.find('#alarm_label').remove();
									// newRow.find('#label<?php echo $i;?>').remove();
									// newRow.find('#min<?php echo $i;?>').remove();
									// newRow.find('#max<?php echo $i;?>').remove();
									// newRow.find('#units<?php echo $i;?>').remove();
									// newRow.find('#custom_units<?php echo $i;?>').remove();									
									// newRow.find('#is_graphed<?php echo $i;?>').remove();									
									// newRow.find('#is_email<?php echo $i;?>').remove();
									// newRow.find('#is_email<?php echo $i;?>').remove();
									// newRow.find('#alarmsetup<?php echo $i;?>').remove();
									// newRow.find('#slider_min<?php echo $i;?>').remove();
									// newRow.find('#slider_max<?php echo $i;?>').remove();

									// // add data to the main row about number of alarms triggers
									// //$('#tr.new_row<?php echo $i;?>').data({i:<?php echo $i;?>,num_alarms:row});
									// //localstorage.num_alarms = row;

						   //  		//////console.log('modified_row',newRow);
						   //  		var children = newRow.children().length;
						   //  		//////console.log(children);
						   //  		//////console.log(newRow[0]);
						   //  		//////console.log(typeof newRow);  

					    //  	    	var direction = <?php echo $user_inputs[$selected_device][$i]['direction'];?>;
							  // 	    //////console.log('row', row, 'selector', $('.new_row<?php echo $i;?>:nth-of-type('+row+')'));
						   //  		//$('tr#a<?php echo $i;?>:nth-of-type('+row+')').next().after(newRow[0]);
						   //  		val = row + <?php echo $i;?>;
						   //  		//////console.log('val of row in table', val );
						   //  		$('tr.new_row<?php echo $i;?>:nth-of-type('+val+')').after(newRow[0]);
						   //  		if (row == 1){
						   //  			//$('#labelname<?php echo$i;?>').append()
							  //   		//newRow.find('#directionnr1<?php echo $i;?> option[value=0]').attr('disabled', 'disabled');
							  //   		//newRow.find('#directionnr1<?php echo $i;?> option[value=1]').prop('disabled', false);
							  //   		newRow.find('#directionnr1<?php echo $i;?> option[value=1]').prop('selected', true);
							  //   		$('#thresholdnr1<?php echo $i;?>').val('<?php echo $user_inputs[$selected_device][$i]['threshold2'];?>');
							  //   		$('#resetnr1<?php echo $i;?>').val('<?php echo $user_inputs[$selected_device][$i]['reset2'];?>');	
						   //  		}
						   //  		if (row == 2){
							  //   		//newRow.find('#directionnr2<?php echo $i;?> option[value=1]').attr('disabled', 'disabled');
							  //   		//newRow.find('#directionnr2<?php echo $i;?> option[value=0]').prop('disabled', false);
							  //   		newRow.find('#directionnr2<?php echo $i;?> option[value=0]').prop('selected', true);						    		
							  //   		$('#thresholdnr2<?php echo $i;?>').val('<?php echo $user_inputs[$selected_device][$i]['threshold3'];?>');
							  //   		$('#resetnr2<?php echo $i;?>').val('<?php echo $user_inputs[$selected_device][$i]['reset3'];?>');	
						   //  		}
						   //  		if (row==3){
							  //   		//newRow.find('#directionnr3<?php echo $i;?> option[value=1]').attr('disabled', 'disabled');
							  //   		//newRow.find('#directionnr3<?php echo $i;?> option[value=0]').prop('disabled', false);
							  //   		newRow.find('#directionnr3<?php echo $i;?> option[value=0]').prop('selected', true);						   		 	
							  //   		$('#thresholdnr3<?php echo $i;?>').val('<?php echo $user_inputs[$selected_device][$i]['threshold4'];?>');
							  //   		$('#resetnr3<?php echo $i;?>').val('<?php echo $user_inputs[$selected_device][$i]['reset4'];?>');				
						   //  		}
						   //  		//$('')
						   //  		innerHTML = $('tr#a<?php echo $i;?>').prop();
						   //  		//////console.log(innerHTML);
						   //  		//newRow.addClass('new_row');
						   //  		//$('tr#a<?php echo $i;?> input#direction').closest('tr').after(newRow)
						   //  		//////console.log('append completed');
						   //  		//id = $('tr#a<?php echo $i;?> input#direction');
						   //  		//attrs = id.attr();
						   //  		////////console.log('attributed for input box', attrs);
						   //  		//innerHTML = $('tr#a<?php echo $i;?>').prop(innerHTML);
						   //  		////////console.log('innerHTML for inserted row', innerHTML);
 								// 	//var direction2 = <?php echo $user_inputs[$selected_device][$i]['direction2'];?>;
								 //    ////////console.log('direction 2',direction2);
							  //   	('.new_row<?php echo $i;?> #direction2').attr('name','direction2<?php echo $i;?>');
						   //  		('.new_row<?php echo $i;?> tr:nth-child(4)').attr('name','reset2<?php echo $i;?>');
						   //  		('.new_row<?php echo $i;?> tr:nth-child(5)').attr('name','threshold2<?php echo $i;?>');
						   //     		$('#add_alarm<?php echo $i;?>').toggleClass('btn btn-default disabled');	
						   //  		$('#remove_alarm<?php echo $i;?>').toggleClass('btn btn-default active');	
						   //  		});
						   });
						</script>
							<script>	
				$(document).ready(function(){
					threshold1 = $('#threshold<?php echo $i;?>-<?php echo $j;?>').val();
				   	reset1 = $('#reset<?php echo $i;?>-<?php echo $j;?>').val();
				   	direction1 = $('#direction<?php echo $i;?>-<?php echo $j;?>').val();
				   	//////console.log('alarm id', <?php echo $i;?>,'alarm no', <?php echo $j;?>, 'direction',direction1,'reset', reset1,'threshold', threshold1);
				   	if ((parseFloat(threshold1) > parseFloat(reset1)) && (parseInt(direction1) === 0)){
						//////console.log(' reset is less than threshold. trigger error message',$('#errorhitolo<?php echo $i;?>-<?php echo $j;?>'));
				   		$('#errorhitolo<?php echo $i;?>-<?php echo $j;?>').css('display','inline-grid');
				   		$('#reset<?php echo $i;?>-<?php echo $j;?>').val((threshold1-1)/2);
				   	}	
				   	if ((parseFloat(threshold1) < parseFloat(reset1)) && (parseInt(direction1) === 1)){
					//////console.log(' threshold is less than reset',$('#errorlotohi<?php echo $i;?>-<?php echo $j;?>'));		   		
				   		$('#errorlotohi<?php echo $i;?>-<?php echo $j;?>').css('display','inline-grid');	
				   		$('#threshold<?php echo $i;?>-<?php echo $j;?>').val(2*reset1);			   		
				   	}
				   	$('#add_alarm<?php echo $i;?>-<?php echo $j;?>').css('display','block');
				   	$('#remove_alarm<?php echo $i;?>-<?php echo $j;?>').css('display','block');
				   	$('#alarm_label<?php echo $i;?>-<?php echo $j;?>').css('display','inline');
					 //   	threshold2 = $('#threshold<?php echo $i;?>-1').val();
					 //   	reset2 = $('#reset<?php echo $i;?>-1').val();
					 //   	direction2 = $('#direction<?php echo $i;?>-1').val();
					 //   	//////console.log('alarm 2', 'direction',direction2,'reset',reset2,'threshold',threshold2);
					 //   	if (threshold2 > reset2 && direction2 === 0){
					 //   		$('#errorlotohi<?php echo $i;?>-<?php echo $j;?>').css('display','inline-grid');
					 //   	}	
					 //   	if (threshold2 < reset2 && direction2 === 1){
					 //   		$('#errorhitolo<?php echo $i;?>-<?php echo $j;?>').css('display','inline-grid');				   		
					 //   	}	
					 //   	threshold3 = $('#threshold<?php echo $i;?>-2').val();
					 //   	reset3 = $('#reset<?php echo $i;?>-2').val();
					 //   	direction3 = $('#direction<?php echo $i;?>-2').val();
					 //   	//////console.log('alarm 3', 'direction',direction3,'reset',reset3,'threshold',threshold3);
						// if (threshold3 > reset3 && direction3 === 0){
					 //   		$('#errorlotohi<?php echo $i;?>-<?php echo $j;?>').css('display','inline-grid');
					 //   	}	
					 //   	if (threshold3 < reset3 && direction3 === 1){
					 //   		$('#errorhitolo<?php echo $i;?>-<?php echo $j;?>').css('display','inline-grid');				   		
					 //   	}
					 //   	threshold4 = $('#threshold<?php echo $i;?>-0').val();
					 //   	reset4 = $('#reset<?php echo $i;?>-0').val();
					 //   	direction4 = $('#direction<?php echo $i;?>-0').val();
					 //   	//////console.log('alarm 4', 'direction',direction4,'reset',reset4,'threshold',threshold4);
					 //   	if (threshold4 > reset4 && direction4 === 0){
					 //   		$('#errorlotohi<?php echo $i;?>-<?php echo $j;?>').css('display','inline-grid');
					 //   	}	
					 //   	if (threshold4 < reset4 && direction4 === 1){
					 //   		$('#errorhitolo<?php echo $i;?>-<?php echo $j;?>').css('display','inline-grid');				   		
					 //   	}
					    //});	
				});
				    
	</script>

			<?php  } ?>
			<?php  } ?>
		</tbody>
	</table>	
	<hr>
	</form>

	<?php  $count = count($user_inputs[$selected_device]); ?>
	<script>
	$("#inputs_table tr").click(function(){
		$(this).toggleClass("highlight");
	});
	window.onload = function(){ 
	}
	</script>
	<script>
		var val = "kelvin";
		var str0 = "<?php echo $user_inputs[$selected_device][0]['units'];?>";
		var str1 = "<?php echo $user_inputs[$selected_device][1]['units'];?>";
		var str2 = "<?php echo $user_inputs[$selected_device][2]['units'];?>";
		var str3 = "<?php echo $user_inputs[$selected_device][3]['units'];?>";
		var str4 = "<?php echo $user_inputs[$selected_device][4]['units'];?>";
		var str5 = "<?php echo $user_inputs[$selected_device][5]['units'];?>";
		var str6 = "<?php echo $user_inputs[$selected_device][6]['units'];?>";
		var str7 = "<?php echo $user_inputs[$selected_device][7]['units'];?>";
		var str8 = "<?php echo $user_inputs[$selected_device][8]['units'];?>";
		var str9 = "<?php echo $user_inputs[$selected_device][9]['units'];?>";
		var str10 = "<?php echo $user_inputs[$selected_device][10]['units'];?>";
		var str11 = "<?php echo $user_inputs[$selected_device][11]['units'];?>";
		var str12 = "<?php echo $user_inputs[$selected_device][12]['units'];?>";
		var str13 = "<?php echo $user_inputs[$selected_device0][13]['units'];?>";
		var str14 = "<?php echo $user_inputs[$selected_device][14]['units'];?>";
		var str15 = "<?php echo $user_inputs[$selected_device][15]['units'];?>";
		var str16 = "<?php echo $user_inputs[$selected_device][16]['units'];?>";
		var str17 = "<?php echo $user_inputs[$selected_device][17]['units'];?>";
		var str18 = "<?php echo $user_inputs[$selected_device][18]['units'];?>";
		var str19 = "<?php echo $user_inputs[$selected_device][19]['units'];?>";
		var str20 = "<?php echo $user_inputs[$selected_device][20]['units'];?>";
		var str21 = "<?php echo $user_inputs[$selected_device][21]['units'];?>";
		var str22 = "<?php echo $user_inputs[$selected_device][22]['units'];?>";
		var str23 = "<?php echo $user_inputs[$selected_device][23]['units'];?>";
		var str24 = "<?php echo $user_inputs[$selected_device][24]['units'];?>";
		var str25 = "<?php echo $user_inputs[$selected_device][25]['units'];?>";
		var str26 = "<?php echo $user_inputs[$selected_device][26]['units'];?>";
		var str27 = "<?php echo $user_inputs[$selected_device][27]['units'];?>";
		var str28 = "<?php echo $user_inputs[$selected_device][28]['units'];?>";
		var str29 = "<?php echo $user_inputs[$selected_device][29]['units'];?>";
		var str30 = "<?php echo $user_inputs[$selected_device][30]['units'];?>";
		var str31 = "<?php echo $user_inputs[$selected_device][31]['units'];?>";
		var str32 = "<?php echo $user_inputs[$selected_device][32]['units'];?>";
		var units =[];
		$("#units0-0").val(str0);
		$("#units1-0").val(str1);
		$("#units2-0").val(str2);
		$("#units3-0").val(str3);
		$("#units4-0").val(str4);
		$("#units5-0").val(str5);
		$("#units6-0").val(str6);
		$("#units7-0").val(str7);
		$("#units8-0").val(str8);
		$("#units9-0").val(str9);
		$("#units10-0").val(str10);
		$("#units11-0").val(str11);
		$("#units12-0").val(str12);
		$("#units13-0").val(str13);
		$("#units14-0").val(str14);
		$("#units15-0").val(str15);
		$("#units16-0").val(str16);
		$("#units17-0").val(str17);
		$("#units18-0").val(str18);
		$("#units19-0").val(str19);
		$("#units20-0").val(str20);
		$("#units21-0").val(str21);
		$("#units22-0").val(str22);
		$("#units23-0").val(str23);
		$("#units24-0").val(str24);
		$("#units25-0").val(str25);
		$("#units26-0").val(str26);
		$("#units27-0").val(str27);
		$("#units28-0").val(str28);
		$("#units29-0").val(str29);
		$("#units30-0").val(str30);
		$("#units31-0").val(str31);
		$("#units32-0").val(str32);
	</script>
<script>
$( document ).ajaxError(function( event, request, settings ) {
  $( "#msg" ).append( "<li>Error requesting page " + settings.url + "</li>" );
});
</script>
<div id="dialog" title="Help">
	    <p> <b>The inputs are split into analogue, counter and digital. </b>Each analogue in light blue can have 4 alarms each with a different direction, threshold and reset. The direction is hitolo or lotohi depending on the direction of travel or gradient of the alarm.</p>
	    <p> <b> Each input can be configured </b> using the configuration dashboard. The name can be customised. The analogues can be given a min and max value to scale the value to your given unit. A list of units are given as well as a feature to allow a custom unit which is displayed on the chart on the main dashboard. </p>
		<p> <b> Select multiple dataloggers </b>. Configure them and email individual alarms. The alarm log button is where you set the indiviual email addresses and alarm for each input. These inputs belong to datalogger <?php echo $machine_name[0]['machine_name']; ?> and user <?php echo $username;?>..</p>
	</div>
	<script>
	$(function() {
	  // this initializes the dialog (and uses some common options that I do)
	  $("#dialog").dialog({autoOpen : false, modal : true, show : "blind", hide : "blind", width: 400});

	  // next add the onclick handler
	  $("#contactUs").click(function() {
	    $("#dialog").dialog("open");
	    return false;
	  });
	});
	</script>