<?php
/* PHP PROCESS*/

$obj = json_decode($row['_log'][$_GET['id']]['detail']);

//print_r($obj->ip);
?>
<div style="width:100%;position:relative;">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <th colspan="2" class="k-header">รายละเอียดต่างๆ</th>
  </tr>
  <tr>
    <td width="44%" ><strong>Remote IP Address :</strong></td>
    <td width="56%"><?=$obj->ip?></td>

  </tr>
  <tr>
    <td><strong>โมดูล :</strong></td>
    <td><?=$obj->modules?></td>
  </tr>
  <tr>
    <td valign="top"><strong>url path :</strong></td>
    <td><?=$obj->path?></td>
  </tr>
  <tr>
    <td valign="top"><strong>Error Detail :</strong></td>
    <td><?php if(empty($row['_log'][$_GET['id']]['err_reason'])){?>-<?php }else{?><?=$row['_log'][$_GET['id']]['err_reason']?><?php }?></td>
  </tr>
  <tr>
    <td valign="top"><strong>ข้อมูลที่ดำเนินการ :</strong></td>
    <td>
    <ul style="padding:0; list-style:none; margin:0;">
	<?php
	if(!empty($obj->data)){
    foreach($obj->data as $key=>$item){
	?>
    <li style="word-wrap:break-word;"><u><?=$key?></u> : <?=$item?></li>
    <?
	}
	}else{
	?>
    <li><u>Not Found</u></li>
    <?
	}
	?>
    </ul>
    </td>
  </tr>
</table>
</div>