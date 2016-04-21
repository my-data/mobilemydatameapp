 <h2><b>Configuration Panel</b></h2>  
 	<div id="dialog" title="Help">
	    <p>In this section you can configuration how you want your data to be displayed. Here you can configure your dashboard if it is graphed. To change these to align with your desired
			units input max and min values along with what the units are as well as what you want to call the input. Min and max values can
			be set for digital inputs. These then scale the values sent from the datalogger which are 1025 for the analogue and 501 for the counters. The trigger direction
			sets if the values are going from high to low or low to high. You can configure the email alarm message for each alarm. </p>
			<p> These inputs belong to datalogger <?php echo $machine_name[0]['machine_name']; ?> and user <?php echo $username;?>. </p>
	</div>
	<script>
	$(function() {
	  $("#dialog").dialog({autoOpen : false, modal : true, show : "blind", hide : "blind"});
	  $("#contactUs").click(function() {
	    $("#dialog").dialog("open");
	    return false;
	  });
	});
	</script>
	<script>
	function configure_dashboard(){
		$.ajax({
	            type: 'POST',
	            url: '<?php echo base_url();?>display/scaling',
	            data: $('configuration_table').serialize(),
	            success: function (res) {
	              if (res){
						// Show Entered Value
						console.log('succesful', number);
						}
				},
				 error: function(e) {
					//called when there is an error
					console.log(e.message);
				  }
	        });
		window.location="<?php base_url();?>display/scaling";
	}

	function number_of_inputs(){
		number = $('#number_inputs').val();
		$.ajax({
		  type: 'POST',
		  url: '<?php echo base_url();?>/configure_dashboard',
		  data: {'number': number},
		  success: function(res) {
			if (res){
				console.log('succesful', number);
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
				<td>
		<form action='<?php echo base_url();?>/configure_dashboard' method='post'>
		<div class='block form-line'><select style="width: 40%;margin: 5;float: left;"class="form-control" id="selecteddevice" name="selecteddevice">
			<?php for ($i=0; $i<$count; $i++){ ?>
				<?php echo "<option value=".$i.">".$devices[$i]['machine_name']."</option>";?>
			<?php } ?>
		</select>
		<script>
		 selected_device = <?php echo $selected_device;?>;
		 console.log('selected_device', selected_device);
		 $('#selecteddevice option[value='+selected_device+']').prop('selected',true);
		</script>
		 <button style="margin:5px;float: right;width:80px;"class="btn btn-primary" type="submit">Refresh</button>
		 </div>
		</form>
		 <td>
		 <div class='block form-inline'>
		 	<label style='float: left;'>Sender ID:</label>
		 	<input style='margin: 5px; width: 60%;'name="sender_id" id="sender_id" value="<?php echo $devices[$selected_device]['sender_id'];?>"></input>
		 </div>
		 <script>
		 	$('.sender_id').val("<?php echo $sender_id;?>");
		 </script>
		 </td>
		 <td>
		 <a href='#' onclick='post_inputs()'id='update_inputs_button' style="margin:10px;"class="btn btn-primary" type="button">Update Inputs</a>
		 <script>
		function post_inputs(){
			 console.log('submit button pressed');
		      var data = $('#inputs_configuration_form').serialize();
		      console.log(data);
		     $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url(); ?>configure_dashboard/add_labels',
			  data: data,
			  success: function(res) {
					console.log(res);
				},
			  error: function(err){
			  	cosole.log(err);
			  }
			});
		}
		</script>
		</td>
		<td>
		<a class="btn btn-primary" href="<?php echo base_url('/rawdata'); ?>">Display Data</a>
		</td>
		<td>
		<a style="float:right;margin:10px;" class = "btn btn-info" href="#" id="contactUs">Help Button</a>  
		</td>
		<td>
		<a style="float:right;margin:10px;"class="btn btn-danger" href="<?php echo base_url('User/login'); ?>">Logout</a>
		</td>
		<td>
			<div class="block">
				<label style="display:inline-block" id='titleloading'>Loading Bar</label>
				<div style="width:100px;display:inline-block;margin-left:5;"id="progressbar"></div>
				<div style='margin:10;margin-left:-3'class="alert alert-info" id='bootstrap_warning_message'> This page is loading </div>
			<div class="alert alert-success" style='visibility:hidden' id='success_load'>
			 <p> <strong>Success!</strong> The Page has loaded.</p>
			</div>
			</div>
			<script>
			    $( "#progressbar" ).progressbar({
				      value: 37
				    });
			        var value = $( "#progressbar" ).progressbar( "option", "value" );
			        console.log('progress_bar_initilaised',value);
			</script>
		</td>
		</tr>
	</table>
	</div>
	<script>
	$('selecteddevice').on('onchange',function(e){
		console.log('select is changed');
		var selected_device = $("option:selected",this);
		var selected_value = this.value;
		var user_id = <?php echo $devices[0]['user_id'];?>;
		console.log('selected_device',selected_device,'selected_value', selected_value, 'user_id', user_id);
		$.ajax({
			type: 'POST',
			url: 'http://www.my-data.org.uk/cloud/get_uri/get/inputs_for_user/'+user_id,
			data: {'selected_value': selected_value, 'user_id':user_id},
			success: function(data){
				console.log(data);
			},
			error: function(e){
				console.log(e);
			}
		});
	});
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
			<th style='font-size: 25;font-style: oblique;'>Chart</th>
			<th style='font-size: 25;font-style: oblique;'>Email</th><th></th></tr>
		</thead>
		<tbody>
			<?php $count=32; ?>
			<?php for ($i=0; $i < 32; $i++){ ?>
			<?php for ($j=0; $j < 4;$j++){ ?>
			<?php $extra_rows = 4;?>
			<tr style='inline-grid'class='inputs digital new_row<?php echo$i;?>'id ='a<?php echo $i;?><?php echo $j;?>'>
				<td>
					<div class="col-md-2">
						<label id='labelname<?php echo $i;?><?php echo $j;?>'><b id='name<?php echo $i;?><?php echo $j;?>' style='margin-left: 20;font-size: 58;'><?php echo $user_inputs[$selected_device][$i]['name'];?></b></label><label class="label label-info"id='alarm_label'>Alarm <?php echo $j+1;?></label>
						<div class='block' style='display: inline-block;width: 200px;'>
						<a style='margin:10px;    float: left;'id='add_alarm<?php echo $i;?>-<?php echo $j;?>'class="btn btn-primary"href='#'>Add</a>
						<a style='margin:10px; width: 80;    float: left;' id='remove_alarm<?php echo $i;?>-<?php echo $j;?>'class="btn btn-primary"href='#'>Remove</a>
						</div>
					</div>
					<script>
					name = $('#name<?php echo $i;?><?php echo $j;?>').text();
					name=name.toString();
					num = <?php echo $i;?>;
					console.log('NAME',name,'NUM',num,'length',name.length);
					if ( num < 19){
						if (name.length === 2){
						var txt2 = name.slice(0, 1) + "n" + name.slice(1);						
					}
					if (name.length === 3){
						var txt2 = name.slice(0, 1) + "n" + name.slice(1);
					}
					}
					if (num > 19 && num < 28){
						var txt2 = name.slice(0,1)+'in'+name.slice(1);
					}
					if (num >27){
						var txt2 = name;
					}
					console.log('ADAPTED NAME',txt2);
					$('#name<?php echo $i;?><?php echo $j;?>').text(txt2);
					</script>
				</td>
				<td>
					<div class="col-md-2">
						<input style='width: 150;'size="8"name="label<?php echo $i;?>-<?php echo $j;?>" type="text" id="label<?php echo $i;?>-<?php echo $j;?>" value="<?php echo $user_inputs[$selected_device][$i]['label_name'];?>">
					</div>
					<script>
					$('#label<?php echo $i;?>-<?php echo $j;?>').val('<?php echo $user_inputs[$selected_device][$i]['label_name'];?>');
					console.log('selector');
					</script>
				</td>
				<td>
					<?php if($user_inputs[$selected_device][$i]['type'] != "counter"){ ?>
				<div class="block" style='width: 200;'>
					<div class='dropup' style="width:90px;    margin-top: -10;">
						<select style='margin:10;margin-left: 0;width: 90;'class='form-control' name="direction<?php echo $i;?>-<?php echo $j;?>" id="direction<?php echo $i;?>-<?php echo $j;?>">
						<option selected value="1">LotoHi</option>
						<option value="0">HitoLo</option>
					</select>
					</div>
				</div>
				
					<script>
					if (<?php echo $j;?>===0){
					$('#direction<?php echo $i;?>-<?php echo $j;?> option[value='+<?php echo $user_inputs[$selected_device][$i]['direction'];?>+']').prop('selected',true);
					}
					$('#direction<?php echo $i;?>-1 option[value='+<?php echo $user_inputs[$selected_device][$i]['direction2'];?>+']').prop('selected',true);
					$('#direction<?php echo $i;?>-2 option[value='+<?php echo $user_inputs[$selected_device][$i]['direction3'];?>+']').prop('selected',true);
					$('#direction<?php echo $i;?>-3 option[value='+<?php echo $user_inputs[$selected_device][$i]['direction4'];?>+']').prop('selected',true);
				    var LotoHI = <?php echo $user_inputs[$selected_device][$i]['direction'];?>;
				    	if (LotoHI === 1){
					        $("#LotoHI<?php echo $i;?>").attr("checked", true);
					        $("#HitoLo<?php echo $i;?>").attr("checked", false);
				    	} else {
					        $("#HitoLO<?php echo $i;?>").attr("checked", true);
					        $("#LotoHi<?php echo $i;?>").attr("checked", false);					        
				    	}
					</script>
					<?php } ?>
				</td>
				<td>
					<?php  if ($user_inputs[$selected_device][$i]['type'] != 'digital') { ?> 
					 <div class="col-md-2">
						<input size="4" name="reset<?php echo $i;?>-<?php echo $j;?>" type="text" id="reset<?php echo $i;?>-<?php echo $j;?>"
						value="<?php echo $user_inputs[$selected_device][$i]['reset_level'];?>">
					</div> 
					<?  } ?>
					<script>
					if (<?php echo $j;?>===0){
						$('#reset<?php echo $i;?>-<?php echo $j;?>').val('<?php echo $user_inputs[$selected_device][$i]['reset_level'];?>');						
					}
					$('#reset<?php echo $i;?>-1').val(<?php echo $user_inputs[$selected_device][$i]['reset2'];?>);
					$('#reset<?php echo $i;?>-2').val(<?php echo $user_inputs[$selected_device][$i]['reset3'];?>);					
					$('#reset<?php echo $i;?>-3').val(<?php echo $user_inputs[$selected_device][$i]['reset4'];?>);
					</script>
				</td>
				<td>
					<?php  if($user_inputs[$selected_device][$i]['type'] != "digital"){ ?>
					<div class="col-md-2" id="thislist">
						
						<input size="4" id="threshold<?php echo $i;?>-<?php echo $j;?>"  type="text" name="threshold<?php echo $i;?>-<?php echo $j;?>"
						value="<?php echo $user_inputs[$selected_device][$i]['threshold'];?>">

					</div>
					<script>
					console.log('selector', $('#threshold<?php echo $i;?>-<?php echo $j;?>'), 'value', '<?php echo $user_inputs[$selected_device][$i]['threshold'.$j];?>');
					if (<?php echo $j;?>===0){
						$('#threshold<?php echo $i;?>-<?php echo $j;?>').val('<?php echo $user_inputs[$selected_device][$i]['threshold'];?>');						
					}
					$('#threshold<?php echo $i;?>-1').val(<?php echo $user_inputs[$selected_device][$i]['threshold2'];?>);
					$('#threshold<?php echo $i;?>-2').val(<?php echo $user_inputs[$selected_device][$i]['threshold3'];?>);					
					$('#threshold<?php echo $i;?>-3').val(<?php echo $user_inputs[$selected_device][$i]['threshold4'];?>);					//$('#threshold<?php echo $i;?>-<?php echo $j;?>').val('<?php echo $user_inputs[$selected_device][$i]['threshold'.$j];?>');
					threshold = '<?php echo $user_inputs[$selected_device][$i]['threshold'];?>';

					function add_li(){
						console.log('button clicked');
						var list = document.getElementById('thislist');
						var threshold = document.getElementById('threshold<?php echo $i;?>').value;
						console.log(threshold);
						var newentry = document.createElement('li');
						newentry.appendChild(document.createTextNode(threshold));
						list.appendChild(newentry);
						$('#thresholdlist li:last').append('<input class="form-control" id="direction" type="checkbox"></input><input class="form-control" id="reset1" size="8"type="text"></input>');
							 input = $('#threshold<?php echo $i;?>').val();
					}
					function remove_li(){
						td = <?php echo $i;?>;
						console.log(td);
							val = $('#threshold<?php echo $i;?>').val();
							console.log(val);
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
					<div class="checkbox">
						<label class="form-control">
							<input style="margin:5px; margin-left:-10"type="checkbox" name="HI<?php echo $i;?>" id="HI<?php echo $i;?>"value="1">Hi</label>
					</div>
					<div class="checkbox">
						<label class="form-control">
							<input style="margin:5px;margin-left:-10" type="checkbox" name="LO<?php echo $i;?>" id="LO<?php echo $i;?>"value="1">Lo</label>
					</div>
					<script>
				    var HI = <?php echo $user_inputs[$selected_device][$i]['HI'];?>;
				    	if (HI === 1){
					        $("#HI<?php echo $i;?>").attr("checked", "checked");
				    	}
				    var LO = <?php echo $user_inputs[$selected_device][$i]['LO'];?>;
				    	if (LO === 1){
					        $("#LO<?php echo $i;?>").attr("checked", "checked");
				    	}
					</script>
					<?php  } ?>
				</td>
				<td>
					<?php if($user_inputs[$selected_device][$i]['type'] != "digital"){ ?>
<!-- 					<input size="8"name="unitstext<?php echo $i;?>" type="text" id="unitstext<?php echo $i;?>">
 -->					<select style='margin:10;margin-left: 0;width: 110;margin-top: -0;'class='form-control' name="units<?php echo $i;?>-<?php echo $j;?>" id="units<?php echo $i;?>-<?php echo $j;?>">
						<option value="none">None</option>
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
					<button type='button'id='custom_units<?php echo $i;?>' class='btn btn-default' onclick="myfunction(id)">None of above</button>
					<div style='margin-top: 5;'id='test<?php echo $i;?>'></div>
					<script>			
					var clicked2 = false;
					function myfunction(id){
						 console.log(clicked2);
						console.log('id name',id,'length',id.length);
						if (id.length ===13){
							var num = id.substr(id.length - 1); 
						} 
						if (id.length===14){
							var num = id.substr(id.length - 2);
						}
						console.log('fill in own units',num);
						$("#custom_units"+num).replaceWith("<b>Units</b><input type='text' style='width:100px;margin:10' name='customunits"+num+"' id='customunits"+num+"' value='<?php echo $user_inputs[$selected_device][0]['units'];?>'></input> ");
						clicked2 = true;
						$("#customunits"+num).text('<?php echo $user_inputs[$selected_device]['+num+']['units'];?>');
						console.log('units', '<?php echo $user_inputs[$selected_device][$i]['units'];?>');
					}			
					</script>
						<script>
						$('document').ready(function(){
							units = '<?php echo $user_inputs[$selected_device][$i]['units'];?>';
							if (!units){
								units = 'none';
							}
							$('#units<?php echo $i;?>-<?php echo $j;?> option[value ='+units+']').prop('selected', true);
						});
						</script>
					<?php } ?>
				</td>
				<td>
					<?php if($user_inputs[$selected_device][$i]['type'] == "analogue"){ ?>
					<input style="margin:5px;margin-top: 0;"size="5"name="min<?php echo $i;?>-<?php echo $j;?>" type="text" id="min<?php echo $i;?>-<?php echo $j;?>"value="<?php echo $user_inputs[$selected_device][$i]['min'];?>">
					<div id="slider_min<?php echo $i;?>-<?php echo $j;?>"style="width:100px"></div>
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
				</td>
				<td>
					<?php  if($user_inputs[$selected_device][$i]['type'] == 'analogue'){ ?>
					<input style="margin:5px;margin-top: 0;"size="5"name="max<?php echo $i;?>-<?php echo $j;?>" type="text" id="max<?php echo $i;?>-<?php echo $j;?>"value="<?php echo $user_inputs[$selected_device][$i]['max'];?>">
					<div id="slider_max<?php echo $i;?>-<?php echo $j;?>"style="width:100px"></div>
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
				</td>
				<td>
						<input type="checkbox" style="margin:10px; margin-left: 35;margin-top: 10;height: 15;width: 15px;"name="is_graphed<?php echo $i;?>-<?php echo $j;?>" id="is_graphed<?php echo $i;?>-<?php echo $j;?>"value="1">
						<script>
						console.log('senderid',sender_id);
						console.log('$i','<?php echo $i;?>', 'is_graphed','<?php echo $user_inputs[$selected_device][$i]['is_graphed'];?>','senderid', '<?php echo $user_inputs[$selected_device][$i]['sender_id'];?>');
						    var charted = <?php echo $user_inputs[$selected_device][$i]['is_graphed'];?>;
						    console.log('is_charted', charted);
						    	if (charted === 1){
							        $("#is_graphed<?php echo $i;?>-<?php echo $j;?>").attr("checked", "checked");
						    	}
						</script>
				</td>
				<td>
					<input type="checkbox" style="margin:10px;margin-left: 18;height: 15;width: 15px;"name="is_email<?php echo $i;?>-<?php echo $j;?>" id="is_email<?php echo $i;?>-<?php echo $j;?>"value="1">
				<script>
				    var emailed = <?php echo $user_inputs[$selected_device][$i]['is_email'];?>;
				    console.log(emailed)
				    	if (emailed === 1){
					        $("#is_email<?php echo $i;?>-<?php echo $j;?>").attr("checked", "checked");
				    	}
				</script>
				 </td>
				<td>
 						<a href='http://my-data.org.uk/cloud/sendreport' type="submit" class="btn btn-default"  id='alarmsetup<?php echo $i;?>' name='alarmsetup<?php echo $i;?>' value='<?php echo $user_inputs[$selected_device][$i]['name'];?>'>Alarm email</a>
 				</td>
			</tr> 
			<script>
			num = <?php echo $i;?>;
			j = <?php echo $j;?>;
			console.log('NUMBNER IN LOOP', num);
			if(num<20){
				console.log('toggle analogue');
				$('#a'+num+j).css('background-color', 'aliceblue');
				$('#a'+num+j).css('outline', 'thin solid black');
			}
			if( 19<num && num<28){
				console.log('toggle digital');
				$('#a'+num+j).css('background-color', 'silver');
				$('#a'+num+j).css('outline', 'thin solid black');
			}			
			if( 27<num && num<33){
				console.log('toggle counter');
				$('#a'+num+j).css('background-color','lightsalmon');
				$('#a'+num+j).css('outline', 'thin solid black');
			}
			j = <? echo $j;?>;
			if (j > 0){
				$('#a<?php echo $i;?><?php echo $j;?>').hide();
				$('#remove_alarm<?php echo $i;?>-<?php echo $j;?>').attr('disabled','disabled');
				$('#add_alarm<?php echo $i;?>-<?php echo $j;?>').attr('disabled','disabled');
			}
			if (j==0){
				var count2=0;
			}
				count2 = count2 +1;
				i = <?php echo$i;?>;
	        	counterperc = 100*((((i+1))/32));
	        	console.log(['count',count2,'counterperc',counterperc,'j',<?php echo $j;?> , 'i', <?php echo $i;?>],'(j+i)/32*4',(j+i)/32*4);
	        	$( "#progressbar").progressbar("value", counterperc );
	        	if (counterperc === 100){
	        		console.log('page is loaded');
	        		$("#progressbar").val("<p class='alert alert-success'>Page is Loaded<p>");
	        		$('#progressbar').css('visibility', 'hidden');
	           		$('#titleloading').css('visibility', 'hidden');
			        $('#bootstrap_warning_message').css('visibility', 'hidden');	
			        $('#success_load').css('visibility','visible');
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
						     		j = <?php echo $j;?> +row;
						     		console.log('add row ahead',j,' when clicked', 'selected',$('#a<?php echo $i;?>'+j+'') );
						     		$('#a<?php echo $i;?>'+j+'').show();
						     		
						     		if (row===3){
						     			$('#add_alarm<?php echo$i;?>-0').attr('disabled', 'disabled');
						     			$('#remove_alarm<?php echo$i;?>-0').removeAttr('disabled');
						     		}
						     	});
						     	$('#remove_alarm<?php echo $i;?>-<?php echo $j;?>').on('click',function(e){
						     		e.preventDefault();
						     		console.log('remove row',row);
						     		$('#a<?php echo $i;?>'+row+'').hide();	
						     		if (row===1){
						     			j = row - 1;
						     			console.log('row number', row,'changealarm',j,'removeattr','disabled');
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
										console.log('i',i,'data[i]',data[i]);
						    		}
						    	}
						    	var row = 0;
						     	
						   //  	$('#add_alarm<?php echo $i;?>').on('click',function(e){
						   //  		e.preventDefault();
						   //  		counter++;
						   //  		row++;
						   //  		num_of_rows = $('#inputs_table tr').length;
						   //  		console.log('number of clonerows',num_of_rows);
						   //  		console.log('current row is',row);
						   //  		rowplusone = row+1;
						   //  		console.log('click',row);
						   //  		 if(row>3){
						   //  		 	return;
						   //  		 }
						   //  		clicked = true;
						   //  		console.log('click',clicked);
						   //  		test = _.map([1, 2, 3], function(num){ return num * 3; });
						   //  		console.log('test underscore',test);
							  // 	    var direction2 = <?php echo $user_inputs[$selected_device][$i]['direction2'];?>;

						   //  		var newRow = $('tr.new_row<?php echo $i;?>').clone(true, true).wrap('</tr><tr>').addClass('new_row<?php echo $i;?>').attr('id','clone_row'+row+'a<?php echo $i;?>');
						   //  		//newrow.find('#a<?php echo $i;?>').attr({'id','newrow2<?php echo $i;?>','class','newrow2<?php echo $i;?>'});
						   //  		console.log(newRow);
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

						   //  		console.log('modified_row',newRow);
						   //  		var children = newRow.children().length;
						   //  		console.log(children);
						   //  		console.log(newRow[0]);
						   //  		console.log(typeof newRow);  

					    //  	    	var direction = <?php echo $user_inputs[$selected_device][$i]['direction'];?>;
							  // 	    console.log('row', row, 'selector', $('.new_row<?php echo $i;?>:nth-of-type('+row+')'));
						   //  		//$('tr#a<?php echo $i;?>:nth-of-type('+row+')').next().after(newRow[0]);
						   //  		val = row + <?php echo $i;?>;
						   //  		console.log('val of row in table', val );
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
						   //  		console.log(innerHTML);
						   //  		//newRow.addClass('new_row');
						   //  		//$('tr#a<?php echo $i;?> input#direction').closest('tr').after(newRow)
						   //  		console.log('append completed');
						   //  		//id = $('tr#a<?php echo $i;?> input#direction');
						   //  		//attrs = id.attr();
						   //  		//console.log('attributed for input box', attrs);
						   //  		//innerHTML = $('tr#a<?php echo $i;?>').prop(innerHTML);
						   //  		//console.log('innerHTML for inserted row', innerHTML);
 								// 	//var direction2 = <?php echo $user_inputs[$selected_device][$i]['direction2'];?>;
								 //    //console.log('direction 2',direction2);
							  //   	('.new_row<?php echo $i;?> #direction2').attr('name','direction2<?php echo $i;?>');
						   //  		('.new_row<?php echo $i;?> tr:nth-child(4)').attr('name','reset2<?php echo $i;?>');
						   //  		('.new_row<?php echo $i;?> tr:nth-child(5)').attr('name','threshold2<?php echo $i;?>');
						   //     		$('#add_alarm<?php echo $i;?>').toggleClass('btn btn-default disabled');	
						   //  		$('#remove_alarm<?php echo $i;?>').toggleClass('btn btn-default active');	
						   //  		});
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
