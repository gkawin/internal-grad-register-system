<?php
//print_r($page[_plan][0]);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
body {
	font-family:"Browallia New";
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
</style>
</head>

<body>
<div class="container" style="width:768px; margin:0 auto; text-align: left; position:static;">
<!-- INFORMATION GRADUATE DATA  AND HEADER--->
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr align="center" >
      <td colspan="2" style="font-size:20px;padding-bottom:10pt;"><strong>
        <?=$page['_plan'][0]['major_name']?>
      </strong></td>
    </tr>
    <tr valign="top">
      <td>ชื่อหลักสูตร :</td>
      <td>หลักสูตร<?=$page['_plan'][0]['program_name']?> <?=$page['_plan'][0]['major_name']?><br><?=$page['_plan'][0]['program_nameEN']?> Program in <?=$page['_plan'][0]['major_nameEN']?>
</td>
    </tr>
    <tr valign="top">
      <td>ชื่อปริญญา :</td>
      <td><?=trim($page['_plan'][0]['program_name'])?> (<?=trim($page['_plan'][0]['major_name'])?>)<br><?=trim($page['_plan'][0]['program_nameEN'])?> (<?=trim($page['_plan'][0]['major_nameEN'])?>)<br><?=trim($page['_plan'][0]['initDeg_name'])?> (<?=trim($page['_plan'][0]['major_name'])?>)<br><?=trim($page['_plan'][0]['initDeg_nameEN'])?> (<?=trim($page['_plan'][0]['major_nameEN'])?>)

</td>
    </tr>
    <tr>
      <td colspan="2"><hr/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="109">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
<!-- END INFORMATION GRADUATE DATA  AND HEADER -->
</div>
</body>
</html>
<?php
exit();
?>