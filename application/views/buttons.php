<h2> Buttons </h2>
<p> If you want to configure the digital inputs to return to the x9100 please configure here. </p>
<div class="container">
  <div class="row">
   <div class="buttons">
	   <form action="<?php echo base_url('index.php/rawdata/configure_digital_inputs')?>" method="POST">
	   <div id="button-1">
		  <h5><?php echo ($user_messages[0]['d_0']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_0'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
	</div> 
   

	<div id="button-2">
		  <h5><?php echo ($user_messages[0]['d_1']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_01'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
	</div> 

	<div id="button-2">
		  <h5><?php echo ($user_messages[0]['d_2']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_2'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
	</div> 

	<div id="button-2">
		  <h5><?php echo ($user_messages[0]['d_3']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_3'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
	</div> 
	</div>
	<div class="row">
	<div id="button-1">
		  <h5><?php echo ($user_messages[0]['d_4']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_4'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
	</div> 

	<div id="button-1">
		  <h5><?php echo ($user_messages[0]['d_5']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_5'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
	</div> 

	<div id="button-1">
		  <h5><?php echo ($user_messages[0]['d_6']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_6'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
	</div> 

	<div id="button-1">
		  <h5><?php echo ($user_messages[0]['d_7']); ?></h5> 
      <div class="round-button"><div class="round-button-circle">
      <a onclick="button_click()" href="#" class="round-button" value="Off"> 
        <?php if ($input[0]['is_on'] == 1 && $user_massages[0]['d_7'] = "HI") {echo "On"; } 
        else {echo "Off";  } ?></a></div></div>
			</div> 
		</div>
	</div>
</div>

<button type="submit">Configure Digital Inputs</button>