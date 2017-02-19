<?php
	//print_r($row['_reg']);
	
/*	foreach ($row['_reg'] as $key=>$unused){
		if($key = )
	}*/
//print_r($multiply_grade);
$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','print transcript')");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?=$gradInfo['stdName']?> : <?=$gradInfo['Graduate_ID']?></title>
<style>
body {
	font-family:"Cordia New";
	font-size:18px;
}
td.borderLeft {
	border-left-width: 1px;
	border-left-style: solid;
	border-left-color: #000000;
}
td.borderRight {
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #000000;
}
td.borderTop {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #000000;
}
td.borderBottom {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;
}
td.borderOutLeft {
	border-left-width: 2px;
	border-left-style: solid;
	border-left-color: #000000;
	text-align: center;
}
td.borderOutRight {
	border-right-width: 2px;
	border-right-style: solid;
	border-right-color: #000000;
}
td.borderOutTop {
	border-top-width: 2px;
	border-top-style: solid;
	border-top-color: #000000;
	text-align: center;
}
td.borderOutBottom {
	border-bottom-width: 2px;
	border-bottom-style: solid;
	border-bottom-color: #000000;
}
.qoute {
	padding-right:25px;
}
.titlebold {
	font-weight:bold;
}
</style>
</head>
<div style="position:absolute; width: 44px; left: 9px; top: 5px;" onClick="window.print()"></div>
<body onLoad="window.print()">

<?php
if($segment[3]==="th"){
?>
<div class="container" style="width:768px;margin:0 auto; position:static;" > 
  <!-- INFORMATION GRADUATE DATA  AND HEADER--->
  <table width="768" border="0" cellspacing="0" cellpadding="0">
    <tr align="center" style="font-size:20px;">
      <td width="248">&nbsp;</td>
      <td width="275"><strong>กลุ่มภารกิจบัณฑิตศึกษา<br>
        มหาวิทยาลัยแม่โจ้<br>
        ระเบียนผลนักศึกษา</strong></td>
      <td width="84" align="left" style="font-size:18px;"><strong>รหัสนักศึกษา<br>
        สาขาวิชาเอก<br>
        สาขาวิชาโท</strong></td>
      <td width="161" style="font-size:18px;"><?=$gradInfo['Graduate_ID']?>
        <br>
        <?=$gradInfo['major_name']?>
        <br>
        <?php
		if(empty($gradInfo['Minor']))
		echo "-";
		else
		$gradInfo['Minor']
		
		?></td>
    </tr>
  </table>
  <!-- INFORMATION GRADUATE DATA-->
  <table width="768"  border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="2"><strong class="qoute">ชื่อ - สกุล</strong>
        <?=$gradInfo['stdName']?></td>
      <td colspan="2"><strong class="qoute">NAME</strong>
        <?=strtoupper($gradInfo['stdNameEN'])?></td>
    </tr>
    <tr >
      <td colspan="2"><strong class="qoute">หลักสูตร</strong>
        <?php
      if($gradInfo['program_suite']==="ก แบบ ก(1)"){
		?>
        [ / ] ก แบบ ก(1)   [  ] ก แบบ ก(2)    [  ] ข
        <?php  
	  }elseif($gradInfo['program_suite']=="ก แบบ ก(2)"){
	  ?>
        [  ] ก แบบ ก(1)   [ / ] ก แบบ ก(2)    [  ] ข
        <?php
      }elseif($gradInfo['program_suite']=="ข"){
	  ?>
        [  ] ก แบบ ก(1)   [  ] ก แบบ ก(2)    [ / ] ข
        <?php
	  }
      ?></td>
      <td colspan="2"><strong class="qoute">จบการศึกษาระดับปริญญาตรี จาก</strong>
        <?=$gradInfo['Graduated']?></td>
    </tr>
    <tr >
      <td width="300"><strong class="qoute">ปีการศึกษา</strong>
        <?=$gradInfo['School_Year']?></td>
      <td colspan="2"><strong class="qoute">วัน/เดือน/ปี เกิด</strong>
        <?=$gradInfo['Brithday']?></td>
      <td width="247"><strong class="qoute">สถานที่เกิด</strong>
        <?=$gradInfo['Province']?></td>
    </tr>
    <tr >
      <td colspan="2"><strong class="qoute">เข้าศึกษาเมื่อ</strong>
        <?=$gradInfo['admit_academic_date']?></td>
      <td colspan="2"><strong class="qoute">ชื่อประธานกรรมการที่ปรึกษา</strong><?=$gradInfo['Adviser']?></td>
    </tr>
    <tr >
      <td colspan="2"><strong class="qoute">จบการศึกษาเมื่อวันที่ </strong></td>
      <td colspan="2"><strong class="qoute">วุฒิที่ได้รับ </strong></td>
    </tr>
  </table>
  <!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  <?php $bState=false;
  $num = 0;
  $subnum =0;
  $trow = array();
  $sem = array();
  $control_row=0;
  $count_course=0;?>
  <!-- GRADE DATA TABLE LEFT-->
  <table width="384" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr valign="middle" align="center" height="90">
      <td width="55" class="borderLeft borderTop borderBottom">ภาคเรียน<br>
        ปี</td>
      <td width="233" class="borderTop borderLeft borderBottom">ชื่อวิชา</td>
      <td width="31" class="borderTop borderLeft borderBottom">หน่วย<br>
        กิต</td>
      <td width="31" class="borderTop borderLeft borderBottom">เกรด</td>
      <td width="31" class="borderTop borderLeft borderRight borderBottom" style="font-size:14px;">ผลคูณ<br>
        (หน่วย<br>
        กิต x<br>
        เกรด)</td>
    </tr>
    <?php
	
   foreach($row['_reg'] as $key=>$less){
	  
		
	  if(($key != "วิทยานิพนธ์")&& ($key != "ดุษฎีนิพนธ์") ){
 		$bState = false;
		$num++;
		$subnum=0;
		
	?>
    <tr valign="top">
      <td class="borderLeft borderBottom"></td>
      <td class="borderLeft borderBottom"><strong><u>
        <?=$key?>
        </u></strong> (ไม่น้อยกว่า
        <?=$row['_c_t_credit'][$key]?>
        หน่วยกิต)</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	array_multisort($row['_reg'],SORT_DESC);
		foreach ($row['_reg'][$key] as $h=>$reg){	
		 $count_course++;
		$sem[$reg['term']."/".($reg['years']+543)]['term_credit'] +=  $reg['credit'];
		$sem[$reg['term']."/".($reg['years']+543)]['GP'] += $multiply_grade[$key][$h];
			
			//$sem[$reg['term']."/".($reg['years']+543)]['GPA'] = $count_course;
    ?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center"><?=$reg['term']."/".($reg['years']+543)?></td>
      <td class="borderLeft borderBottom" <?php if(strlen($reg['course_name'])>80){?> style="font-size:14px;"<? }?>><?=$reg['course_id']." ".$reg['course_name']?></td>
      <td class="borderLeft borderBottom" align="center"><?=$reg['credit']?></td>
      <td class="borderLeft borderBottom" align="center"><?=$reg['result_grade']?></td>
      <td class="borderLeft borderRight borderBottom" align="center"><?=$multiply_grade[$key][$h]?></td>
    </tr>
    <?php
		$subnum++;
	 	$control_row++;
		}
		$control_row++;
	  }else{
		 
	  	$trow[$key] = $row['_reg'][$key];
	  }
		if($num==1){
			for($i=$subnum;$i<5;$i++){
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	$control_row++;
			}
		}elseif($num==2){
			
			for($i=$subnum;$i<7;$i++){
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	$control_row++;
			}
		}elseif($num==3 ){
			for($i=$subnum;$i<4;$i++){
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	$control_row++;
			}
		
		}
		
	}
	$bin_row[exam_ce] = (count($row['_exam_ce'])*2);
	$bin_row[exam_qe] = (count($row['_exam_qe'])*2);
	$bin_row[exam_fe] = (count($row['_exam_fe'])*2);
	$bin_row[row_span] = $bin_row[exam_ce]+$bin_row[exam_fe]+$bin_row[exam_qe];

	for($i=$control_row;$i<20;$i++){
	?>
	  <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php	
	}
	
	$examcount=0;
	if(!empty($row['_exam_ce'])){
		
	foreach ($row['_exam_ce'] as $examce){
	?>
    <tr valign="top" height="52">
      <td class="borderLeft borderBottom" align="center" valign="bottom"><?=$examce['term']."/".($examce['years']+543)?></td>
      <td class="borderLeft borderBottom" valign="bottom" ><?=$examce['exan_name']?></td>
      <td class="borderLeft borderBottom" align="center">ครั้งที่<br>
        <?=$examce['ce_num']?></td>
      <td class="borderLeft borderBottom" align="center"  valign="bottom"><?=$examce['ce_result']?></td>
      <td class="borderLeft borderRight borderBottom" align="center"  valign="bottom">-</td>
    </tr>
    <?php 

	$examcount++;
		}
	}
	if(!empty($row['_exam_fe'])){
	foreach ($row['_exam_fe'] as $examfe){
	?>
    <tr valign="top" height="52">
      <td class="borderLeft borderBottom" align="center" valign="bottom"><?=$examfe['term']."/".($examfe['years']+543)?></td>
      <td class="borderLeft borderBottom" valign="bottom" ><?=$examfe['exan_name']?></td>
      <td class="borderLeft borderBottom" align="center">ครั้งที่<br>
        <?=$examfe['fe_num']?></td>
      <td class="borderLeft borderBottom" align="center"  valign="bottom"><?=$examfe['fe_result']?></td>
      <td class="borderLeft borderRight borderBottom" align="center"  valign="bottom">-</td>
    </tr>
    <?php 

	$examcount++;
		}
	}
	if(!empty($row['_exam_qe'])){
	foreach ($row['_exam_qe'] as $examqe){
	?>
    <tr valign="top" height="52">
      <td class="borderLeft borderBottom" align="center" valign="bottom"><?=$examqe['term']."/".($examqe['years']+543)?></td>
      <td class="borderLeft borderBottom" valign="bottom" ><?=$examqe['exan_name']?></td>
      <td class="borderLeft borderBottom" align="center">ครั้งที่<br>
        <?=$examqe['qe_num']?></td>
      <td class="borderLeft borderBottom" align="center"  valign="bottom"><?=$examqe['qe_result']?></td>
      <td class="borderLeft borderRight borderBottom" align="center"  valign="bottom">-</td>
    </tr>
    <?php 
	
	$examcount++;
		}
	}
	for($i=$examcount;$i<4;$i++){
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom">&nbsp;</td>
    </tr>
    <?php
			}
		
			?>
  </table>
  <!-------------------------------------------------------------------------------------------------------------------------------------------------------->
  <table width="384" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr valign="middle" align="center" height="90">
      <td width="57" class="borderLeft borderTop borderBottom">ภาคเรียน<br>
        ปี</td>
      <td width="245" class="borderTop borderLeft borderBottom">ชื่อวิชา</td>
      <td width="30" class="borderTop borderLeft borderBottom">C</td>
      <td width="25" class="borderTop borderLeft borderBottom">G</td>
      <td width="28" class="borderTop borderRight borderLeft borderBottom">P</td>
    </tr>
    <tr valign="top">
      <td class="borderLeft borderBottom"></td>
      <td class="borderLeft borderBottom"><strong><u>รายวิชาไม่คิดหน่วยกิต</u></strong></td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	  $examcount =0;
	  $control_row=1;
      if(!empty($row['ncrd'])){
		  foreach ($row['ncrd'] as $nocrd){
			  $control_row++;
	  ?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center"><?=$nocrd['term']."/".($nocrd['years']+543)?></td>
      <td class="borderLeft borderBottom" <?php if(strlen($nocrd['course_name'])>120){?> style="font-size:14px;"<? }?>><?=$nocrd['course_id']." ".$nocrd['course_name']?></td>
      <td class="borderLeft borderBottom" align="center">(
        <?=$nocrd['credit']?>
        )</td>
      <td class="borderLeft borderBottom" align="center"><?=$nocrd['result_grade']?></td>
      <td class="borderLeft borderRight borderBottom" align="center">-</td>
    </tr>
    <?php
	$examcount++;
		  }
	  }
	   for($i=$examcount;$i<6;$i++){
		   $control_row++;
	?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom">&nbsp;</td>
    </tr>
    <?php
			}
			
		foreach($trow as $tkey=>$tless){
			$subnum=0;
			$control_row++;
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom"></td>
      <td class="borderLeft borderBottom"><strong><u>
        <?=$tkey?>
        </u></strong> (ไม่น้อยกว่า
        <?=$row['_c_t_credit'][$tkey]?>
        หน่วยกิต)</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
		foreach ($tless as $titem){
			$control_row++;
	?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center"><?=$titem['term']."/".($titem['years']+543)?></td>
      <td class="borderLeft borderBottom" <?php if(strlen($titem['course_name'])>120){?> style="font-size:14px;"<? }?>><?=$titem['course_id']." ".$titem['course_name']?></td>
      <td class="borderLeft borderBottom" align="center">(
        <?=$titem['credit']?>
        )</td>
      <td class="borderLeft borderBottom" align="center"><?=$titem['result_grade']?></td>
      <td class="borderLeft borderRight borderBottom" align="center">-</td>
    </tr>
    <?php
		$subnum++;
		
		}
		for($i=$subnum;$i<6;$i++){
			$control_row++;
	?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom">&nbsp;</td>
    </tr>
    <?php 
		
		}
	}
	for($i=$control_row;$i<10;$i++){
	
	?>
      <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom">&nbsp;</td>
    </tr>
    <?php
    }
	
	?>
  </table>
  
  <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
  <table width="384" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr valign="top">
      <td width="67" align="center" class="borderLeft borderBottom borderTop">ภาคเรียน<br>
        ปี</td>
      <td width="81" class="borderLeft borderBottom borderTop" align="center">หน่วยกิตลง<br>
        ทะเบียน</td>
      <td width="78" align="center" class="borderLeft borderBottom borderTop" valign="middle">G.P.</td>
      <td width="78" align="center" class="borderLeft borderBottom borderTop" valign="middle">GPA.</td>
      <td width="80" class="borderLeft borderOutRight borderBottom borderTop" align="center">GPA.<br>
        เฉลี่ย</td>
    </tr>
    <?php
		array_multisort($sem,SORT_DESC);
		$sem_count =0;
		foreach ($sem as $semKey=>$semItem){
			$sem_count++;
			$temp += $semItem['GP'] / $semItem['term_credit'];
			$temp2 = $temp/$sem_count;
		?>
    <tr valign="top">
      <td width="67" align="center" class="borderLeft borderBottom "><?=$semKey?></td>
      <td width="81" class="borderLeft borderBottom " align="center"><?=$semItem['term_credit']?></td>
      <td width="78" align="center" class="borderLeft borderBottom " ><?=$semItem['GP']?></td>
      <td width="78" align="center" class="borderLeft borderBottom " ><?php echo number_format($semItem['GP'] / $semItem['term_credit'],2);?></td>
      <td width="80" class="borderLeft borderOutRight borderBottom " align="center"><?php echo number_format($temp2,2);?></td>
    </tr>
    <?php
	echo $GLOBALS['GPA'] ."<br/>";
		}
		for($i=$sem_count;$i<12;$i++){	
		?>
    <tr valign="top">
      <td width="67" align="center" class="borderLeft borderBottom ">&nbsp;</td>
      <td width="81" class="borderLeft borderBottom " align="center">&nbsp;</td>
      <td width="78" align="center" class="borderLeft borderBottom " >&nbsp;</td>
      <td width="78" align="center" class="borderLeft borderBottom " >&nbsp;</td>
      <td width="80" class="borderLeft borderOutRight borderBottom " align="center">&nbsp;</td>
    </tr>
    <?php
		}
		?>
         <tr valign="top">
      <td width="67" align="center" class="borderLeft borderOutBottom ">&nbsp;</td>
      <td width="81" class="borderLeft borderOutBottom " align="center">&nbsp;</td>
      <td width="78" align="center" class="borderLeft borderOutBottom " >&nbsp;</td>
      <td width="78" align="center" class="borderLeft borderOutBottom " >&nbsp;</td>
      <td width="80" class="borderLeft borderOutRight borderOutBottom " align="center">&nbsp;</td>
    </tr>
  </table>
  <div class="clear-all"></div>
</div>
<?php }else{?>
<div class="container" style="width:768px;margin:0 auto; position:static;"> 
  <!-- INFORMATION GRADUATE DATA  AND HEADER--->
  <table width="768" border="0" cellspacing="0" cellpadding="0">
    <tr align="center" style="font-size:20px;">
      <td width="248">&nbsp;</td>
      <td width="275"><strong>Mission of Graduate<br>
        Maejo University<br>
        Graduate Record Register</strong></td>
      <td width="84" align="left" style="font-size:18px;"><strong>รหัสนักศึกษา<br>
        สาขาวิชาเอก<br>
        สาขาวิชาโท</strong></td>
      <td width="161" style="font-size:18px;"><?=$gradInfo['Graduate_ID']?>
        <br>
        <?=$gradInfo['major_name']?>
        <br>
        <?php
		if(empty($gradInfo['Minor']))
		echo "-";
		else
		$gradInfo['Minor']
		
		?></td>
    </tr>
  </table>
  <!-- INFORMATION GRADUATE DATA-->
  <table width="768"  border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="2"><strong class="qoute">ชื่อ - สกุล</strong>
        <?=$gradInfo['stdName']?></td>
      <td colspan="2"><strong class="qoute">NAME</strong>
        <?=strtoupper($gradInfo['stdNameEN'])?></td>
    </tr>
    <tr >
      <td colspan="2"><strong class="qoute">PROGRAM</strong>
        <?php
      if($gradInfo['program_suite']==="ก แบบ ก(1)"){
		?>
        [ / ] ก แบบ ก(1)   [  ] ก แบบ ก(2)    [  ] ข
        <?php  
	  }elseif($gradInfo['program_suite']=="ก แบบ ก(2)"){
	  ?>
        [  ] ก แบบ ก(1)   [ / ] ก แบบ ก(2)    [  ] ข
        <?php
      }elseif($gradInfo['program_suite']=="ข"){
	  ?>
        [  ] ก แบบ ก(1)   [  ] ก แบบ ก(2)    [ / ] ข
        <?php
	  }
      ?></td>
      <td colspan="2"><strong class="qoute">จบการศึกษาระดับปริญญาตรี จาก</strong>
        <?=$gradInfo['Graduated']?></td>
    </tr>
    <tr >
      <td width="300"><strong class="qoute">ปีการศึกษา</strong>
        <?=$gradInfo['School_Year']?></td>
      <td colspan="2"><strong class="qoute">วัน/เดือน/ปี เกิด</strong>
        <?=$gradInfo['Brithday']?></td>
      <td width="247"><strong class="qoute">สถานที่เกิด</strong>
        <?=$gradInfo['Province']?></td>
    </tr>
    <tr >
      <td colspan="2"><strong class="qoute">เข้าศึกษาเมื่อ</strong>
        <?=$gradInfo['admit_academic_date']?></td>
      <td colspan="2"><strong class="qoute">ชื่อประธานกรรมการที่ปรึกษา</strong></td>
    </tr>
    <tr >
      <td colspan="2"><strong class="qoute">จบการศึกษาเมื่อวันที่ </strong></td>
      <td colspan="2"><strong class="qoute">วุฒิที่ได้รับ </strong></td>
    </tr>
  </table>
  <!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  <?php $bState=false;
  $num = 0;
  $subnum =0;
  $trow = array();
  $sem = array();
  $control_row=0;
  $count_course=0;?>
  <!-- GRADE DATA TABLE LEFT-->
  <table width="384" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr valign="middle" align="center" height="90">
      <td width="55" class="borderLeft borderTop borderBottom">SEMESTER<br>
      YEARS</td>
      <td width="233" class="borderTop borderLeft borderBottom">COURSE NAME</td>
      <td width="31" class="borderTop borderLeft borderBottom">CRE<br>
        DIT</td>
      <td width="31" class="borderTop borderLeft borderBottom">RE<br/>SULT</td>
      <td width="31" class="borderTop borderLeft borderRight borderBottom" style="font-size:14px;">ผลคูณ<br>
        (หน่วย<br>
        กิต x<br>
        เกรด)</td>
    </tr>
    <?php
   foreach($row['_reg'] as $key=>$less){
	  if(($key != "วิทยานิพนธ์")&& ($key != "ดุษฎีนิพนธ์") ){
		
 		$bState = false;
		$num++;
		$subnum=0;
		
	?>
    <tr valign="top">
      <td class="borderLeft borderBottom"></td>
      <td class="borderLeft borderBottom"><strong><u>
        <?=$key?>
        </u></strong> (ไม่น้อยกว่า
        <?=$row['_c_t_credit'][$key]?>
        หน่วยกิต)</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	
		foreach ($row['_reg'][$key] as $h=>$reg){	
			$count_course++;
			$sem[$reg['term']."/".($reg['years']+543)]['term_credit'] +=  $reg['credit'];
			$sem[$reg['term']."/".($reg['years']+543)]['GP'] += $multiply_grade[$key][$h];
			//$sem[$reg['term']."/".($reg['years']+543)]['GPA'] = $count_course;
    ?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center"><?=$reg['term']."/".($reg['years']+543)?></td>
      <td class="borderLeft borderBottom" <?php if(strlen($reg['course_name'])>120){?> style="font-size:14px;"<? }?>><?=$reg['course_idEN']." ".$reg['course_nameEN']?></td>
      <td class="borderLeft borderBottom" align="center"><?=$reg['credit']?></td>
      <td class="borderLeft borderBottom" align="center"><?=$reg['result_grade']?></td>
      <td class="borderLeft borderRight borderBottom" align="center"><?=$multiply_grade[$key][$h]?></td>
    </tr>
    <?php
		$subnum++;
	 	$control_row++;
		}
		$control_row++;
	  }else{
	  	$trow[$key] = $row['_reg'][$key];
	  }
		if($num==1){
			for($i=$subnum;$i<5;$i++){
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	$control_row++;
			}
		}elseif($num==2){
			
			for($i=$subnum;$i<9;$i++){
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	$control_row++;
			}
		}elseif($num==3 ){
			for($i=$subnum;$i<5;$i++){
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	$control_row++;
			}
		
		}
		
	}
	$bin_row[exam_ce] = (count($row['_exam_ce'])*2);
	$bin_row[exam_qe] = (count($row['_exam_qe'])*2);
	$bin_row[exam_fe] = (count($row['_exam_fe'])*2);
	$bin_row[row_span] = $bin_row[exam_ce]+$bin_row[exam_fe]+$bin_row[exam_qe];

	for($i=$control_row;$i<24-2;$i++){
	?>
	  <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php	
	}
	
	$examcount=0;
	if(!empty($row['_exam_ce'])){
	foreach ($row['_exam_ce'] as $examce){
	?>
    <tr valign="top" height="52">
      <td class="borderLeft borderBottom" align="center" valign="bottom"><?=$examce['term']."/".($examce['years']+543)?></td>
      <td class="borderLeft borderBottom" valign="bottom" ><?=$examce['exan_name']?></td>
      <td class="borderLeft borderBottom" align="center">ครั้งที่<br>
        <?=$examce['ce_num']?></td>
      <td class="borderLeft borderBottom" align="center"  valign="bottom"><?=$examce['ce_result']?></td>
      <td class="borderLeft borderRight borderBottom" align="center"  valign="bottom">-</td>
    </tr>
    <?php 

	$examcount++;
		}
	foreach ($row['_exam_fe'] as $examfe){
	?>
    <tr valign="top" height="52">
      <td class="borderLeft borderBottom" align="center" valign="bottom"><?=$examfe['term']."/".($examfe['years']+543)?></td>
      <td class="borderLeft borderBottom" valign="bottom" ><?=$examfe['exan_name']?></td>
      <td class="borderLeft borderBottom" align="center">ครั้งที่<br>
        <?=$examfe['fe_num']?></td>
      <td class="borderLeft borderBottom" align="center"  valign="bottom"><?=$examfe['fe_result']?></td>
      <td class="borderLeft borderRight borderBottom" align="center"  valign="bottom">-</td>
    </tr>
    <?php 

	$examcount++;
		}
	foreach ($row['_exam_qe'] as $examqe){
	?>
    <tr valign="top" height="52">
      <td class="borderLeft borderBottom" align="center" valign="bottom"><?=$examqe['term']."/".($examqe['years']+543)?></td>
      <td class="borderLeft borderBottom" valign="bottom" ><?=$examqe['exan_name']?></td>
      <td class="borderLeft borderBottom" align="center">ครั้งที่<br>
        <?=$examqe['qe_num']?></td>
      <td class="borderLeft borderBottom" align="center"  valign="bottom"><?=$examqe['qe_result']?></td>
      <td class="borderLeft borderRight borderBottom" align="center"  valign="bottom">-</td>
    </tr>
    <?php 
	
	$examcount++;
		}
	}
	for($i=$examcount;$i<4;$i++){
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom">&nbsp;</td>
    </tr>
    <?php
			}
		
			?>
  </table>
  <!-------------------------------------------------------------------------------------------------------------------------------------------------------->
  <table width="384" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr valign="middle" align="center" height="90">
      <td width="57" class="borderLeft borderTop borderBottom">ภาคเรียน<br>
        ปี</td>
      <td width="245" class="borderTop borderLeft borderBottom">ชื่อวิชา</td>
      <td width="30" class="borderTop borderLeft borderBottom">C</td>
      <td width="25" class="borderTop borderLeft borderBottom">G</td>
      <td width="28" class="borderTop borderRight borderLeft borderBottom">P</td>
    </tr>
    <tr valign="top">
      <td class="borderLeft borderBottom"></td>
      <td class="borderLeft borderBottom"><strong><u>รายวิชาไม่คิดหน่วยกิต</u></strong></td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
	  $examcount =0;
	  $control_row=1;
      if(!empty($row['ncrd'])){
		  foreach ($row['ncrd'] as $nocrd){
			  $control_row++;
	  ?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center"><?=$nocrd['term']."/".($nocrd['years']+543)?></td>
      <td class="borderLeft borderBottom" <?php if(strlen($nocrd['course_name'])>120){?> style="font-size:14px;"<? }?>><?=$nocrd['course_id']." ".$nocrd['course_name']?></td>
      <td class="borderLeft borderBottom" align="center">(
        <?=$nocrd['credit']?>
        )</td>
      <td class="borderLeft borderBottom" align="center"><?=$nocrd['result_grade']?></td>
      <td class="borderLeft borderRight borderBottom" align="center">-</td>
    </tr>
    <?php
	$examcount++;
		  }
	  }
	   for($i=$examcount;$i<6;$i++){
		   $control_row++;
	?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom">&nbsp;</td>
    </tr>
    <?php
			}
			
		foreach($trow as $tkey=>$tless){
			$subnum=0;
			$control_row++;
			?>
    <tr valign="top">
      <td class="borderLeft borderBottom"></td>
      <td class="borderLeft borderBottom"><strong><u>
        <?=$tkey?>
        </u></strong> (ไม่น้อยกว่า
        <?=$row['_c_t_credit'][$tkey]?>
        หน่วยกิต)</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderBottom">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom" style="font-size:14px;">&nbsp;</td>
    </tr>
    <?php
		foreach ($tless as $titem){
			$control_row++;
	?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center"><?=$titem['term']."/".($titem['years']+543)?></td>
      <td class="borderLeft borderBottom" <?php if(strlen($titem['course_name'])>120){?> style="font-size:14px;"<? }?>><?=$titem['course_id']." ".$titem['course_name']?></td>
      <td class="borderLeft borderBottom" align="center">(
        <?=$titem['credit']?>
        )</td>
      <td class="borderLeft borderBottom" align="center"><?=$titem['result_grade']?></td>
      <td class="borderLeft borderRight borderBottom" align="center">-</td>
    </tr>
    <?php
		$subnum++;
		
		}
		for($i=$subnum;$i<9;$i++){
			$control_row++;
	?>
    <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom">&nbsp;</td>
    </tr>
    <?php 
		
		}
	}
	for($i=$control_row;$i<17;$i++){
	
	?>
      <tr valign="top">
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" >&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderBottom" align="center">&nbsp;</td>
      <td class="borderLeft borderRight borderBottom">&nbsp;</td>
    </tr>
    <?php
    }
	
	?>
  </table>
  
  <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
  <table width="384" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr valign="top">
      <td width="67" align="center" class="borderLeft borderBottom borderTop">ภาคเรียน<br>
        ปี</td>
      <td width="81" class="borderLeft borderBottom borderTop" align="center">หน่วยกิตลง<br>
        ทะเบียน</td>
      <td width="78" align="center" class="borderLeft borderBottom borderTop" valign="middle">G.P.</td>
      <td width="78" align="center" class="borderLeft borderBottom borderTop" valign="middle">GPA.</td>
      <td width="80" class="borderLeft borderOutRight borderBottom borderTop" align="center">GPA.<br>
        เฉลี่ย</td>
    </tr>
    <?php
	
		$sem_count =0;
		foreach ($sem as $semKey=>$semItem){
			$sem_count++;
		?>
    <tr valign="top">
      <td width="67" align="center" class="borderLeft borderBottom "><?=$semKey?></td>
      <td width="81" class="borderLeft borderBottom " align="center"><?=$semItem['term_credit']?></td>
      <td width="78" align="center" class="borderLeft borderBottom " ><?=$semItem['GP']?></td>
      <td width="78" align="center" class="borderLeft borderBottom " ><?=number_format($semItem['GP'] / $semItem['term_credit'],2)?></td>
      <td width="80" class="borderLeft borderOutRight borderBottom " align="center"><?=number_format($semItem['GP'] / $semItem['term_credit'],2)/($sem_count)?></td>
    </tr>
    <?php
	
		}
		for($i=$sem_count;$i<11;$i++){	
		?>
    <tr valign="top">
      <td width="67" align="center" class="borderLeft borderBottom ">&nbsp;</td>
      <td width="81" class="borderLeft borderBottom " align="center">&nbsp;</td>
      <td width="78" align="center" class="borderLeft borderBottom " >&nbsp;</td>
      <td width="78" align="center" class="borderLeft borderBottom " >&nbsp;</td>
      <td width="80" class="borderLeft borderOutRight borderBottom " align="center">&nbsp;</td>
    </tr>
    <?php
		}
		?>
         <tr valign="top">
      <td width="67" align="center" class="borderLeft borderOutBottom ">&nbsp;</td>
      <td width="81" class="borderLeft borderOutBottom " align="center">&nbsp;</td>
      <td width="78" align="center" class="borderLeft borderOutBottom " >&nbsp;</td>
      <td width="78" align="center" class="borderLeft borderOutBottom " >&nbsp;</td>
      <td width="80" class="borderLeft borderOutRight borderOutBottom " align="center">&nbsp;</td>
    </tr>
  </table>
  <div class="clear-all"></div>
</div>
<?php }?>
</body>
</html>
