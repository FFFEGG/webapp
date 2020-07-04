<?php

function getstate($val)
{
	switch ($val) {
		case 1:
			$state = '正常';
			break;
		case 2:
			$state = '取消';
			break;
		case 3:
			$state = '数据异常';
			break;
		case 4:
			$state = '撤销';
			break;
		case 5:
			$state = '已授权';
			break;
		case 6:
			$state = '待收取';
			break;
		case 7:
			$state = '已收取';
			break;
		case 8:
			$state = '已使用';
			break;
		case 9:
			$state = '已退物资';
			break;
		case 10:
			$state = '已退款';
			break;
		case 11:
			$state = '已还款';
			break;
		case 12:
			$state = '已收回';
			break;
		case 13:
			$state = '未支付';
			break;
		case 14:
			$state = '待确认收货';
			break;
		case 15:
			$state = '待确认发货';
			break;
		case 16:
			$state = '已确认发货';
			break;
		case 17:
			$state = '待确认';
			break;
		case 18:
			$state = '冻结';
			break;
		case 101:
			$state = '已安排';
			break;
		case 102:
			$state = '已接单';
			break;
		case 103:
			$state = '已送达';
			break;
		case 104:
			$state = '已汇总';
			break;
		case 105:
			$state = '已完成';
			break;
		default:
			$state = '正常';
	}
	return $state;
}

function object_array($array)
{
	if (is_object($array)) {
		$array = (array)$array;
	}
	if (is_array($array)) {
		foreach ($array as $key => $value) {
			$array[$key] = object_array($value);
		}
	}
	return $array;
}


/**
 * @param $array
 * @return string
 */
function Myencode($array)
{
	return (string)base64_encode(json_encode($array));
}


/**
 * 解密
 * @param $string
 * @return array
 */
function Mydecode($string)
{
	return (array)json_decode(base64_decode($string));
}

function getCity()
{
	$json = file_get_contents('cities.php');

	return object_array(json_decode($json)->data->info);
}


function getArea()
{

	$json = file_get_contents('areas.php');
	return object_array(json_decode($json)->data->info);
}

function getStreet()
{
	$json = file_get_contents('streets.php');
	return object_array(json_decode($json)->data->info);
}


function returnDate($time)
{
	return date('Y-m-d', $time);
}


function return_packingtype($value)
{
	$result = '未知';

	if (strlen($value) == 9) {
		$spec = -1;
	} else {
		$spec = substr($value, strlen($value) - 14, 1);
	}

	switch ($spec) {
		case 0:
			$result = 'YSP35.5型钢瓶';
			break;
		case 6:
			$result = 'YSP35.5型钢瓶';
			break;
		case 1:
			$result = 'YSP12型钢瓶';
			break;
		case 7:
			$result = 'YSP12型钢瓶';
			break;
		case 2:
			$result = 'YSP118型钢瓶';
			break;
		case 8:
			$result = 'YSP118型钢瓶';
			break;
		case 3:
			$result = 'YSP28.6型钢瓶';
			break;
		case 9:
			$result = 'YSP28.6型钢瓶';
			break;
		default:
			$result = '未知';
	}

	return $result;
}

function getoneGoodsById($id)
{
	foreach ($_SESSION['initData']->Goods->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}

function getoneUserById($id)
{
	foreach ($_SESSION['initData']->Operator->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}


function getoneUserByOpeid($id)
{
	foreach ($_SESSION['initData']->Operator->info as $v) {
		if ($v->opeid == $id) {
			return object_array($v);
		}
	}
	return [];
}

function getCatId($id)
{
	foreach ($_SESSION['initData']->GoodsCat->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}

function getGoodsBrandId($id)
{
	foreach ($_SESSION['initData']->GoodsBrand->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}


function getGoodsTypeId($id)
{
	foreach ($_SESSION['initData']->GoodsType->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}

function getTwohundredtypeid($id)
{
	foreach ($_SESSION['initData']->TwohundredType->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}


function getGoodsId($id)
{
	foreach ($_SESSION['initData']->Goods->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}

function getSalesMashupId($id)
{
	foreach ($_SESSION['initData']->SalesMashup->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}

function getCalltypeId($id)
{
	foreach ($_SESSION['initData']->CallType->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}

function getSecurityCheckTypeId($id)
{
	foreach ($_SESSION['initData']->SecurityCheckType->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}


function getDepartmentById($id)
{
	foreach ($_SESSION['initData']->Department->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}

function getQuartersById($id)
{
	foreach ($_SESSION['initData']->Quarters->info as $v) {
		if ($v->id == $id) {
			return object_array($v);
		}
	}
	return [];
}

/**
 * 二维数组根据首字母分组排序
 * @param array $data 二维数组
 * @param string $targetKey 首字母的键名
 * @return array    根据首字母关联的二维数组
 */
function groupByInitials(array $data, $targetKey = 'name')
{
	$data = array_map(function ($item) use ($targetKey) {
		return array_merge($item, [
			'initials' => getInitials($item[$targetKey]),
		]);
	}, $data);
	$data = sortInitials($data);
	return $data;
}

/**
 * 按字母排序
 * @param array $data
 * @return array
 */
function sortInitials(array $data)
{
	$sortData = [];
	foreach ($data as $key => $value) {
		$sortData[$value['initials']][] = $value;
	}
	ksort($sortData);
	return $sortData;
}

/**
 * 获取首字母
 * @param string $str 汉字字符串
 * @return string 首字母
 */
function getInitials($str)
{
	if (empty($str)) {
		return '';
	}
	$fchar = ord($str{0});
	if ($fchar >= ord('A') && $fchar <= ord('z')) {
		return strtoupper($str{0});
	}

	$s1 = iconv('UTF-8', 'gb2312', $str);
	$s2 = iconv('gb2312', 'UTF-8', $s1);
	$s = $s2 == $str ? $s1 : $str;
	$asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
	if ($asc >= -20319 && $asc <= -20284) {
		return 'A';
	}

	if ($asc >= -20283 && $asc <= -19776) {
		return 'B';
	}

	if ($asc >= -19775 && $asc <= -19219) {
		return 'C';
	}

	if ($asc >= -19218 && $asc <= -18711) {
		return 'D';
	}

	if ($asc >= -18710 && $asc <= -18527) {
		return 'E';
	}

	if ($asc >= -18526 && $asc <= -18240) {
		return 'F';
	}

	if ($asc >= -18239 && $asc <= -17923) {
		return 'G';
	}

	if ($asc >= -17922 && $asc <= -17418) {
		return 'H';
	}

	if ($asc >= -17417 && $asc <= -16475) {
		return 'J';
	}

	if ($asc >= -16474 && $asc <= -16213) {
		return 'K';
	}

	if ($asc >= -16212 && $asc <= -15641) {
		return 'L';
	}

	if ($asc >= -15640 && $asc <= -15166) {
		return 'M';
	}

	if ($asc >= -15165 && $asc <= -14923) {
		return 'N';
	}

	if ($asc >= -14922 && $asc <= -14915) {
		return 'O';
	}

	if ($asc >= -14914 && $asc <= -14631) {
		return 'P';
	}

	if ($asc >= -14630 && $asc <= -14150) {
		return 'Q';
	}

	if ($asc >= -14149 && $asc <= -14091) {
		return 'R';
	}

	if ($asc >= -14090 && $asc <= -13319) {
		return 'S';
	}

	if ($asc >= -13318 && $asc <= -12839) {
		return 'T';
	}

	if ($asc >= -12838 && $asc <= -12557) {
		return 'W';
	}

	if ($asc >= -12556 && $asc <= -11848) {
		return 'X';
	}

	if ($asc >= -11847 && $asc <= -11056) {
		return 'Y';
	}

	if ($asc >= -11055 && $asc <= -10247) {
		return 'Z';
	}

	return null;
}

function arraysort($data, $sortkey, $sortmode)
{


	$sortdata = $data;
	$temp_data = array_column($sortdata, $sortkey);


	if ($sortmode == 'ASC') {
		array_multisort($temp_data, SORT_ASC, $sortdata);
	}

	if ($sortmode == 'DESC') {
		array_multisort($temp_data, SORT_DESC, $sortdata);
	}
	return $sortdata;
}
