<?php

	class stringsql{
		
		var $SQLString;
		
		//***** Operating **********
	# เพิ่มข้อมูลลงฐานข้อมูลแบบ double qoute
	# $db->add_db("table",array("field"=>"value")); 
	function add_db($table="table", $data="data"){
		$key = array_keys($data);  // key 
		
        $value = array_values($data);  // value ของ key
		
		$sumdata = count($key); //นับจำนวนค่าใน array
		
		for ($i=0;$i<$sumdata;$i++) 
        { 
		
            if (empty($add)){ 
                $add="("; 
            }else{ 
                $add=$add.","; 
            } 
            if (empty($val)){ 
                $val="("; 
            }else{ 
                $val=$val.","; 
            } 
            $add=$add.$key[$i]; 
            $val=$val.'"'.$value[$i].'"'; 
        } 
        $add=$add.")"; 
        $val=$val.")"; 
        $sql="INSERT INTO ".$table." ".$add." VALUES ".$val; 
		/*
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
		*/
		return $sql;
	}
	# เพิ่มข้อมูลลงฐานข้อมูลแบบ single qoute
	# $db->add_db("table",array("field"=>"value")); 
	function add_db_single_qoute($table="table", $data="data"){
		$key = array_keys($data);  // key 
		
        $value = array_values($data);  // value ของ key
		
		$sumdata = count($key); //นับจำนวนค่าใน array
		
		for ($i=0;$i<$sumdata;$i++) 
        { 
		
            if (empty($add)){ 
                $add="("; 
            }else{ 
                $add=$add.","; 
            } 
            if (empty($val)){ 
                $val="("; 
            }else{ 
                $val=$val.","; 
            } 
            $add=$add.$key[$i]; 
            $val=$val."'".$value[$i]."'"; 
        } 
        $add=$add.")"; 
        $val=$val.")"; 
        $sql="INSERT INTO ".$table." ".$add." VALUES ".$val; 
		/*
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
		*/
		return $sql;
	}


	# อัพเดรตข้อมูลลงฐานข้อมูล 
	# $db->update_db("tabel",array("field"=>"value"),"where"); 
    function update_db($table="table",$data="data",$where="where"){ 
        $key = array_keys($data); 
        $value = array_values($data); 
        $sumdata = count($key); 
        $set=""; 
        for ($i=0;$i<$sumdata;$i++) 
        { 
            if (!empty($set)){ 
                $set=$set.","; 
            } 
            $set=$set.$key[$i]."='".$value[$i]."'"; 
        } 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
		return $sql;
		/*
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
		*/
    } 

	# อัพเดรตฐานข้อมูลลงฐานข้อมูลแบบเดี๋ยว
	# $db->update("table","set","where");
	function update($table="table",$set="set",$where="where"){ 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
		/*
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
		*/
		return $sql;
    } 

	# ลบตาราง
	# $db->del("table","where"); 
    function del($table="table",$where="where"){ 
        $sql="DELETE FROM ".$table." WHERE ".$where; 
		/*
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
		*/return $sql;
    }  

	# Query ช้อมูลในฐานข้อมูล
	# $res = $db->query('SELECT field FROM table WHERE where'); 
    function query($sql="sql"){ 
        if ($res = mysql_query($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	# นับจำนวนแถวจาก Query
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	# $rows = $db->rows($res); 
    function rows($sql="sql"){ 
      if ($res = mysql_num_rows($sql)){ 
            return intval($res); 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	# เอาข้อมูลออกมาเป็น Object
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	# while ($arr = $db->fetch($res)) { 
	# 		echo $arr->a." - ".$arr->c."<br>\n"; 
	# }
    function fetch($sql="sql"){ 
      if ($res = mysql_fetch_object($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        }
    } 
	
	# เอาข้อมูลออกมาเป็น array
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	# while ($arr = $db->fetch($res)) { 
	# 		echo $arr[a]." - ".$arr[c]."<br>\n"; 
	# }
	function fetcharray($sql="sql"){ 
      if ($res = mysql_fetch_assoc($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        }
    }
	# เอาข้อมูลออกมาเป็นแถวๆ
	# $res = $db->query('SELECT field FROM table WHERE where'); 
	# while ($arr = $db->fetchrows($res)) { 
	# 		echo $arr[a]." - ".$arr[c]."<br>\n"; 
	# } (ใช้คู่กับ function list() ได้)
	function fetchrows($sql="sql")
	{
		if($res = mysql_fetch_row($sql)){
			return $res;
		}else{
			$this->_error();

			return false;
		}
	}
	
	# แสดงแถวที่มีผลกระทบ
	function affectrow ()
	{
		return mysql_affected_rows($this->db_connectdb);
	}
	#แสดง record ที่ใส่ลงไปล่าสุด
	function lastid ()
	{
		return mysql_insert_id($this->db_connectdb);
	}
	# show Error
    function _error(){ 
        $this->error[]= mysql_errno().'<br/>'.mysql_error(); 
    } 
	
	function anti_db($query = ""){
		return mysql_real_escape_string($query);
	}
	}
	
?>