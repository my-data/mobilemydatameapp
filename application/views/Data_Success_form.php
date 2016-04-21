<h2> Current Digital Configuration (sent to XX9100) </h2>
<?php // print_r($data); ?>
<span> D0 current value is: <?php echo $data[0]['d0']; ?> </span><br />
<span> D0 current value is: <?php echo $data[0]['d1']; ?> </span><br />
<span> D0 current value is: <?php echo $data[0]['d2']; ?> </span><br />
<span> D0 current value is: <?php echo $data[0]['d3']; ?> </span><br />
<span> D0 current value is: <?php echo $data[0]['d4']; ?> </span><br />
<span> D0 current value is: <?php echo $data[0]['d5']; ?> </span><br />
<span> D0 current value is: <?php echo $data[0]['d6']; ?> </span><br />
<span> D0 current value is: <?php echo $data[0]['d7']; ?> </span><br />
<h2> Receive string returned from the X9100</h2>
<?php echo "received OK"; ?>


<?php $string = array('d0', $data[0]['d0'],'d1', $data[0]['d1'],'d2', $data[0]['d2'],'d3', $data[0]['d3'],
'd4', $data[0]['d4'],'d5', $data[0]['d5'],'d6', $data[0]['d6'],'d7', $data[0]['d7']); ?>
<?echo $string; ?>
