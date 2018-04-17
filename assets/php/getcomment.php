<?php
	header("content-type:text/html; charset=utf-8");
	define("IN", true);
	require "fun.inc.php";
	$id = $_GET['id'];
	$query = "select * from comments where belong=$id order by time";
	$result = _mysql($query,'search');
    
    if(count($result) == 0){
    	
    	echo '[]';
    
    }else{
    	
    	$str = '[';

        foreach ($result as $key => $value) { 

        	$id = $value['id'];	
        	$username = $value['username'];
        	$time = $value['time'];
        	$content = $value['content'];
			$parent = $value['parent'];

			$str .= '{"id":"'.$id.'","parent":"'.$parent.'","username":"'.$username.'","time":"'.$time.'","content":"'.$content.'","response": []},';
        }
        
        $str = substr($str, 0, -1);
        $str .= ']';
        echo $str;
    }
	
?>