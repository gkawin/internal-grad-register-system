// JavaScript Document
kendo.culture("th-TH");
$(document).ready(function() { 
	
	$("#hire_date").kendoDatePicker({ format: "yyyy-MM-dd", max: new Date(),min: new Date(1990, 0, 1)});
	$("#birthday").kendoDatePicker({ format: "yyyy-MM-dd",
	  min: new Date(1900, 0, 1),
	  max: new Date(2000,0,1)});
	var validatable = $("form").kendoValidator().data("kendoValidator");
	$("input[name='operation']").click(function() {
	if (validatable.validate()) {
		save();
    }
});
	$('#tblistLog').dataTable( {
      		"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0,3,6,2 ] }],
			"bJQueryUI": false,
			"bStateSave": true,
			"sPaginationType" : "full_numbers",
			"bFilter": true,
			"oLanguage": {
			"sLengthMenu": "แสดง _MENU_ แถวต่อหน้า",
			"sZeroRecords": "ไม่มีข้อมูล",
			"sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
			"sInfoEmtpy": "ไม่มีข้อมูล",
			"sInfoFiltered": "(จากทั้งหมด _MAX_ แถว)",
			}	
		 });
	$('#tblist').dataTable({
		"bJQueryUI": false,
		"bStateSave": true,
		"sPaginationType" : "full_numbers",
		"bFilter": true,
		"oLanguage": {
			"sLengthMenu": "แสดง _MENU_ แถวต่อหน้า",
			"sZeroRecords": "ไม่มีข้อมูล",
			"sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
			"sInfoEmtpy": "ไม่มีข้อมูล",
			"sInfoFiltered": "(จากทั้งหมด _MAX_ แถว)",
		}
	});
    $(".tablesorter").tablesorter(); 

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	//On Click Event
	$("ul.tabs li").click(function() {
	$("ul.tabs li").removeClass("active"); //Remove any "active" class
	$(this).addClass("active"); //Add "active" class to selected tab
	$(".tab_content").hide(); //Hide all tab content
	var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
	$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
    $('.column').equalHeight();
    $('#generatePwd').bind('click',function(){
		$('#sPwd').val(randomPassword());
	});
	$("#religion").change(function(){
		if($(this).val()==999){
			$("div#religionTH_landing").html("<div class='fieldreligion'><input name='religion' type='text' size='12' class='k-textbox' required validationMessage='กรุณาป้อนศาสนา'/></div>");
			$("td#label_religionEN").html("<div class='fieldreligion'>Religion :</div>");
			$("td#religion_landing").html("<div class='fieldreligion'><input name='religionEN' type='text'  size='12'  required validationMessage='Religion is required.' class ='k-textbox'/></div>");
			
		}else{
			$(".fieldreligion").remove();
		}
	});
	$("img.ico_del").click(function(){
		$this = $(this);
		var accid = $(this).attr("data-rel")
		if(!confirm("ยืนยันการลบข้อมูลหรือไม่")) return false;
		$this.addClass("loading")
		$.post("/system/user/del",
		{
			"accid":accid
		},function(res){
			if(res.result){
				alert("ทำรายการสำเร็จ")
				$this.removeClass("loading");
				$this.parents("tr").fadeOut('fast').remove()
			}
		},'json')
		
	});
	$("#emp input[type=text],textarea").css("width","90%");
	$("#emp input[type=text],textarea").each(function(index, element) {
        $(this).removeClass("k-textbox");
    });
	$("#opration").click(function(event){
		if(!confirm("ยืนยันการทำรายการ")) return;
		var temp = $("form").serialize()
		$.post("/system/user/add",{ "opration":temp}
		,function(res){
			if(res.result){
				$("#result").fadeIn("slow").html("ทำรายการสำเร็จ").delay(5500).fadeOut("slow");
			}else{
				$("#result").fadeIn(res.reason).html("ไม่สามารถทำรายการได้").delay(5500).fadeOut("slow");
			}
		},'json');
		event.preventDefault();
	})
});

//====== FUNCTION ทั่วไป ================
function randomPassword() {
	var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	var size = 10;
	var i = 1;
	var ret = ""
	while ( i <= size ) {
		$max = chars.length-1;
		$num = Math.floor(Math.random()*$max);
		$temp = chars.substr($num, 1);
		ret += $temp;
		i++;
	}
	return ret;
}
//สร้างรูปแบบเลขประจำตัวประชาชน
function autoTab(obj){

   /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น
   
   1. รูปแบบเลขที่บัตรประชาชน เช่น 4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
   2. รูปแบบเบอร์โทรศัพท์ เช่น 08-4521-6521 กำหนดเป็น __-____-____
   3. รูปแบบกำหนดเวลา เช่น 12:45:30 กำหนดเป็น __:__:__
   
   ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
   */

      var pattern=new String("_-____-_____-__-_"); // กำหนดรูปแบบในนี้
      var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
      var returnText=new String("");
      var obj_l=obj.value.length;
      var obj_l2=obj_l-1;
      for(i=0;i<pattern.length;i++){         
         if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
            returnText+=obj.value+pattern_ex;
            obj.value=returnText;
         }
      }
      if(obj_l>=pattern.length){
         obj.value=obj.value.substr(0,pattern.length);         
      }
}
//ตรวจสอบตัวเลข
function checkDex(elm){
	var filter = /^[0-9\-]*$/;
	if(!filter.test(elm.value)) {
		alert('ขออภัย กรอกเฉพาะตัวเลขเท่านั้น');
		elm.value = '';
		elm.focus();
	}
}

//ตรวจสอบภาษาไทย
function checkThai(elm){
	var filter = /^[ก-๙\-\0-9]*$/;
	if(!filter.test(elm.value)) {
		alert('ขออภัย กรุณากรอกภาษาไทยเท่านั้น');
		elm.value = '';
		elm.focus();
	}
}

//ตรวจสอบภาษาอังกฤษ(ทั่วไป)
function checkEngChar(elm) {
	var filter = /^[a-zA-Z\d!@#$%\^\&\*\(\)\-\+~\[\]{}\\|;:'"\M<>\?\/,\.\s=_]*$/;
	if(!filter.test(elm.value)) {
		alert('Sorry, only english charactors are allowed here.');
		elm.value = '';
		elm.focus();
	}
}

//แสดงนาฬิกา
function chkUser(o){
	if(o.value.length<5){
		$("#landing").html("<span style='color:red;'>กรุณากรอกมากกว่า 5 ตัวอักษร</span>");
		return false;
	}else{
		$.post("/system/user/chk",{ "accChk":true,"data":o.value},
		function(res){
			if(res.result){
				$("#landing").html("<span style='color:green;'>สามารถใช้ชื่อบัญชี "+o.value+" นี้ได้</span>");
				return true;
			}else{
				$("#landing").html("<span style='color:red;'>ไม่สามารถใช้ชี่อบัญชี "+o.value+" นี้ได้</span>");
				return false;
			}
		},'json')
	}
}
function changeStatus(o,acc_id){
	if(!confirm("ยืนยันการเปลี่ยนแปลง")) return;
	$.post("/system/user/view",
	{
		"operation" : true,
		"acc_id" : acc_id,
		"value":o.value
	},function(res){
		if(res.result){
			$("div#landing").fadeIn('slow').html("<strong>ทำรายการสำเร็จ</strong>");
		}
	},'json')
}