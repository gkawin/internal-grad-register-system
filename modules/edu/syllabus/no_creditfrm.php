<?php

$query['ncrd'] = "SELECT
graduate_personal.Graduate_ID,
course.course_id,
course.course_name,
no_credit_course.id AS no_credit_course_id
FROM
no_credit_course
INNER JOIN graduate_personal ON no_credit_course.Graduate_ID = graduate_personal.Graduate_ID
INNER JOIN course ON no_credit_course.course_id = course.course_id
 WHERE graduate_personal.Graduate_ID = '".$res['_getdata']['for']."'";
$query['_setTerm'] = "SELECT * FROM term_register WHERE calc_resulted = 0 AND Graduate_ID = '".$res['_getdata']['for']."' ";
 
$key = array_keys($query);
	for($i=0;$i<count($query);$i++){
		$rs[$i] = $db->Execute($query[$key[$i]]);
		while(!$rs[$i]->EOF){
			$page[$key[$i]][]=$rs[$i]->fields;
			$rs[$i]->MoveNext();
		}
	}
	$jsonen = json_encode($page['ncrd']);
			
?>
<form id="no_crd_form" method="post" >
    <table width="96%" border="0" cellspacing="0" cellpadding="5" align="center">
      <thead>
        <tr>
          <th colspan="2" scope="col"></th>
        </tr>
        <tr>
          <td>รายวิชาไม่คิดหน่วยกิต :</td>
          <td><input class="aa" name="no_credit" type="text"></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="35%">เทอมที่เรียน : </td>
          <td width="65%">
          <select name=course_take_term>
          	<?php foreach($page['_setTerm'] as $item){?>
            <option value="<?=$item['id']?>"><?=$item['term']."/".$item['years']?></option>
			<?php }?>
          </select></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="operation" value="เปลี่ยนแปลงข้อมูล" class="k-button" id="a"/></td>
        </tr>
      </tbody>
    </table>
</form>

<div id="result" style="display:none; background:#00FF33; padding:10px;" align="center"></div>
<script>
$(function(){
$(".aa").tokenInput("/service/callbackJson?module=course",{ 
			theme: "facebook",
			preventDuplicates: true,
			prePopulate: <?=$jsonen?>,
            propertyToSearch: "course_id",
			tokenValue: "course_id",
			animateDropdown: true,
			deleteConfirm: true,
			hintText: "ป้อนรหัสวิชาที่ต้องการ",
            noResultsText: "ไม่พบข้อมูล",
            searchingText: "กำลังค้นหา...",
			deleteConfirmText: "ยืนยันที่จะลบวิชานี้",
			resultsFormatter: 
				function(item){ 
				return "<li><div style='display: inline-block;'><div class='course_name'>" + item.course_id + " : " + item.course_name + "</div><div class='course_nameEN'>" + item.course_idEN + " : " + item.course_nameEN + "</div></div></li>" 
				},
            tokenFormatter: function(item) { return "<li><p>" + item.course_id + " : " + item.course_name + "</p></li>" },
			onDelete : function(item){
				$.post('/edu/syllabus',{ "deltype":"<?=sha1(md5('nocreditdel'))?>","course_id":item.course_id,"Graduate_ID":item.Graduate_ID},function(data){
				   if(data.result){
					   $("#result").fadeIn('slow').html('สำเร็จ');
				   }
				},'json');
				}
		});
		$("#a").click(function(event){
			var bin = $('#no_crd_form').serialize();
			$.ajax({
				   type: "POST",
				   url: "/edu/syllabus/plan/nocredit",
				   cache: false,
				   data: bin+"&eid="+<?=$res['_getdata']['eid']?>+"&gid="+<?=$res['_getdata']['for']?>,
				   success: function(msg){
					 if(msg)
					 	$("#result").fadeIn('slow').html('สำเร็จ');
				   
				   	}
				 });
			event.preventDefault();
		});
		
		
});
</script>
<?php
exit();

?>