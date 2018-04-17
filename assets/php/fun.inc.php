<?php
	if (!defined('IN'))
	{
		exit('Access Denied!');
	};
	/**
	 * 数据库处理函数
	 * @param  $query mysql处理语句
	 * @param  $kind 处理类型
	 * @return  如果$kind等于count，则返回符合语句的条数
	 * @return  如果$kind等于search，则返回符合语句的二维数组，第一维代表第几个符合，第二维为数据库信息，键为数据库表名
	 * @return  如果$kind等于其他，如果操作成功则返回大于零的数，否则返回零
	 */
	function _mysql($query,$kind){
		/*
		$host = '你的数据库host';
		$user = '数据库用户名';
		$password = '数据库密码';
		$name = '数据库名';
		*/

		$conn=@mysql_connect($host,$user,$password) or die ('数据库链接失败:'.mysql_errno());
		@mysql_select_db($name) or die('数据库错误：'.mysql_errno());
		@mysql_query('SET NAMES UTF8') or die('字符集错误：'.mysql_errno());
	
		$result = mysql_query($query,$conn);
		if($kind == 'count')
		{
			$many = mysql_num_rows($result);
			mysql_close();
			return  $many;
		}elseif ($kind == 'search')
		{
			$arRow = array();
			$i = 0;
			while(!!$row = mysql_fetch_array($result))
			{
				$arRow[$i] = $row;
				$i++;
			};
			mysql_close();
			return $arRow;
		}else 
		{
			mysql_close();
			return $result;
		}
	}
?>