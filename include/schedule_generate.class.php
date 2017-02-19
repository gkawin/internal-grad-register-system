<?php


class schedule_generate{
	var $aDays = array("วันที่/เวลา","จันทร์","อังคาร","พุธ","พฤหัส","ศุกร์","เสาร์","อาทิตย์");
	var $html = "<table width=\"100%\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"0\">\n";
	var $options = array(
					"start_time"=>800,
					"start_stop"=>2200,
					"col_interval"=>30);
	var $classes = array();
	function __construct($options,$classes){
		$this->option = $options;
		$this->classes = $classes;
		return $this->table_generate();
	}
	function table_generate(){
		$time_hour = ($this->options["start_time"] - $this->options["start_time"] % 100) / 100; 
		$time_min = $this->options["start_time"] % 100;
		$time_totalmins = $time_hour * 60 + $time_min;
	}
}
?>