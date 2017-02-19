<?php

$options = array( 
			"row_interval" => 30, // set the schedule to display a row for every /2hr
			"start_time" => 800, // schedule start time  (10am)
			"end_time" => 2200,   // schedule end time (10pm)
			"title" => "Class Schedule for John Doe",
			"title_style" => "font-family: Tahoma; font-size: 14pt;", // css style for schedule title
			"time_style" => "font-family: Tahoma; font-size: 9pt; padding:2pt;",  // css style for the time cells
			"dayheader_style" => "font-family: Tahoma; font-size: 10pt;", // css style for the day header cells
			
			// default css style for the class cells. Eachs tyle can be overridden using the "style" property of each class
			// see schedule.inc.php for details.
			"class_globalstyle" => "background-color: #c0c0c0; font-family: Tahoma; font-size: 8pt; text-align: center;", 
);
function schedule_generate($classes_arr, $options) {

		// if no row interval set or is zero, use 30mins
		if ( intval($options["row_interval"]) == 0 ) $options["row_interval"] = 30;	

		// define start time as 8am if not set
		if ( ! isset($options["start_time"]) ) {
			$options["start_time"] = 800;
		}
		else {
			// change to the nearest row interval hour down.
			$time_hour = ($options["start_time"] - $options["start_time"] % 100) / 100; 
			$time_min = $options["start_time"] % 100;
			
			$time_totalmins = $time_hour * 60 + $time_min;
			
			
			if ( $time_totalmins % $options["row_interval"] > 0) 
				$time_totalmins = $time_totalmins - $time_totalmins % $options["row_interval"];
				$options["start_time"] = ($time_totalmins - $time_totalmins % 60) / 60 * 100 + $time_totalmins % 60;
		}
		
		
		// define end time as 10pm if not set
		if ( ! isset($options["end_time"]) ) {
			$options["end_time"] = 2200;
		}
		else {
			// change to the nearest row interval hour down.
			$time_hour = ($options["end_time"] - $options["end_time"] % 100) / 100; 
			$time_min = $options["end_time"] % 100;
			
			$time_totalmins = $time_hour * 60 + $time_min;
			
			if ( $time_totalmins % $options["row_interval"] > 0) $time_totalmins = $time_totalmins - $time_totalmins % $options["row_interval"];
			$options["end_time"] = ($time_totalmins - $time_totalmins % 60) / 60 * 100 + $time_totalmins % 60;
		
		}

		$days_arr = array("จันทร์","อังคาร","พุธ","พฤหัส","ศุกร์","เสาร์","อาทิตย์");
		$days_norow = array(0, 0, 0, 0, 0, 0, 0);

		
		$html = "<table width=\"100%\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"0\">\n";
		
		// output title if set in $options.
		if ( isset($options["title"]) ) {
			$cell_style = "background-color: #000000; color: #ffffff;"; // default title style 
 			$cell_style .= $options["title_style"];
			
			$html .= "	<tr>\n		<th colspan=\"8\" style=\"$cell_style\">".$options["title"]."</th>\n	</tr>\n";
		}
		
		$cell_style = "background-color: #c0c0c0; color: #000000;"; // default day header style
		$cell_style .= $options["dayheader_style"];
		
		$html .= "	<tr style=\"$cell_style\">\n		<th>&nbsp;</th>\n";
		foreach ($days_arr as $day){
			$html .= "		<th>$day</th>\n";
		}
		$html .= "	</tr>\n";
		
		$cur_time = $options["start_time"];
		while ($cur_time < $options["end_time"]) {
			$format_time = date("G:i", strtotime(substr($cur_time, 0, strlen($cur_time) - 2).":".substr($cur_time, -2, 2)));
			
			$cell_style = "background-color: #c0c0c0; color: #000000;"; // default time cell style
			$cell_style .= $options["time_style"];			
				
			$html .= "	<tr bgcolor=\"#ffffff\">\n		<td align=\"right\" width=\"2%\" style=\"$cell_style\"><b>$format_time</b></td>\n";
			
			for ($cur_day = 0; $cur_day < 7; $cur_day++) {
			
				// if flag is set not to print any row for the next
				// row (since a class spans more than one row), then
				// continue.
				if ($days_norow[$cur_day] > 0) {
					$days_norow[$cur_day]--;
					continue;
				}
				 // check if there is a class during this day/time
				if ( isset($classes_arr[$cur_day][$cur_time]) ) {
					
						$class_interval = intval($classes_arr[$cur_day][$cur_time]["interval"]);
						if ( $class_interval == 0 ) $class_interval = 60; // default interval is 60mins
						
						// round to nearest interval
						$class_span = intval($class_interval / $options["row_interval"]);
						
						// flag that for the next $class_span rows, we should not print a cell
						$days_norow[$cur_day] += $class_span - 1;		
					
					    if ( isset($classes_arr[$cur_day][$cur_time]["style"]) )
							$cell_style = $options["class_globalstyle"]."; ".$classes_arr[$cur_day][$cur_time]["style"];
						else
							$cell_style = $options["class_globalstyle"];
						
						$html .= "		<td width=\"14%\" rowspan=\"$class_span\" style=\"$cell_style\">".$classes_arr[$cur_day][$cur_time]["html"]."</td>\n";
						}		
				else {
						$html .= "		<td width=\"14%\" align='center'><input type='checkbox' class='range' name='range[$cur_time]'></td>\n";
				}
			}
			$html .= "	</tr>\n";
			$cur_time += $options["row_interval"]; // increment to next row interval
			if ($cur_time % 100 >= 60) $cur_time = $cur_time - $cur_time % 100 + 100;
		};
		$html .= "</table>\n";
		return $html;	
	
}


?>
<script>
$(function(){
	$(".range").bind("change",function(){
		if($(this).attr("checked")=="checked"){
			$(this).parent("td").css("background-color","#FF0");
		}else{
			$(this).parent("td").css("background-color","#FFF");
		}
	});
});
</script>

<form method="post" action="/edu/course/section/schedule/saveroom">

<?php 
echo schedule_generate($classes, $options); ?>

  <input type="hidden" value="<?= $_POST['roomid']?>" name="building_room_id">
  <input type="hidden" value="<?= $options['row_interval']?>" name="row_interval"><br>
  <input type="submit" value="บันทึก" name="operation">
</form>
