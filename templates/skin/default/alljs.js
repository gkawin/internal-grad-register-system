
//====== FUNCTION ทั่วไป ================
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
function GetClock(){
	d = new Date();
	nhour  = d.getHours();
	nmin   = d.getMinutes();
	if(nmin <= 9){ nmin="0"+nmin}
	document.getElementById('clockbox').innerHTML=""+nhour+":"+nmin+"";
	setTimeout("GetClock()", 1000);
}
window.onload=GetClock;

//============= KENDO JAVASCRIPT FRAMEWORK ============ 
$(function(){
//ตั้งค่าภาาาเป็นไทย
	kendo.culture("th-TH");

//กำหนดให้ html element ทุกตัวที่อ้าง class "treeview" แสดงผลเป็น treeview
	$(".treeView").each(function(index, element) {
	$(".treeView").kendoTreeView({ dragAndDrop: false});
});

//กำหนดว่าหากมีการส่ง Form แล้วช่องใดที่ใช้ attrible "require" จะแสดงข้อความเตือน
var validatable = $("form").kendoValidator().data("kendoValidator");
	$("input[name='operation']").click(function() {
	if (validatable.validate()) {
		save();
    }
});

//============= DATATABLES JQUERY PLUGIN =================
//กำหนดให้ html element ทุกตัวที่อ้าง id "tblist" แสดงผลเป็น tblist dynamic
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
});


