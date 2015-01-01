<?php
/**
 * @file
 *  tmp file - generate the bible indexing
*/
/*
 //get the data from mysql
$result = db_select('Bible_keying', 'c')
->fields('c')
->execute();

//generate the array by books - levels
$data = array();
$level = array();
$index = new index();

foreach ($result as $node) {

$textLevel = 'level'.count(stringToArray($node->level,'.'));
$level = array(
		"level" => stringToArrayLevel($node->level),
		"level_count" => count(stringToArrayLevel($node->level)),
		"name" => $node->$textLevel,
		"from" => array('chapter' => $index->getIndexByVerse($node->index_start_chapter), 'verse' => $index->getIndexByVerse($node->index_start_verse)),
		"to" => array('chapter' => $index->getIndexByVerse($node->index_end_chapter), 'verse' => $index->getIndexByVerse($node->index_end_verse)),
		"topics" => stringToArray($node->topics),
		"places" => stringToArray($node->places),
		"characters" => stringToArray($node->characters),
		"concepts" => stringToArray($node->concepts),
		"keywords" => stringToArray($node->keywords),
		"periods" => stringToArray($node->periods),
		"events" => stringToArray($node->events),
		"others" => stringToArray($node->others)
);

switch ($level['level_count']) {
case 1:
$data[$node->index_start_book]['levels'][$level['level'][0]] = $level;
break;
case 2:
$data[$node->index_start_book]['levels'][$level['level'][0]]['levels'][$level['level'][1]] = $level;
break;
case 3:
$data[$node->index_start_book]['levels'][$level['level'][0]]['levels'][$level['level'][1]]['levels'][$level['level'][2]] = $level;
break;
case 4:
$data[$node->index_start_book]['levels'][$level['level'][0]]['levels'][$level['level'][1]]['levels'][$level['level'][2]]['levels'][$level['level'][3]] = $level;
break;
case 5:
$data[$node->index_start_book]['levels'][$level['level'][0]]['levels'][$level['level'][1]]['levels'][$level['level'][2]]['levels'][$level['level'][3]]['levels'][$level['level'][4]] = $level;
break;
case 6:
$data[$node->index_start_book]['levels'][$level['level'][0]]['levels'][$level['level'][1]]['levels'][$level['level'][2]]['levels'][$level['level'][3]]['levels'][$level['level'][4]]['levels'][$level['level'][5]] = $level;
break;
}
}

//insert data
foreach ($data as $key => $val){
$index->update(array('heTitle' => $key),$val);
}

function stringToArrayLevel($text){
$arr = explode('.',$text);
foreach ($arr as $key => $val){
if (empty($val) || $val == " ")
	unset($arr[$key]);
}
return $arr;
}
function stringToArray($text){
$arr = preg_split('/(;|,)/',$text);
foreach ($arr as $key => $val){
if (empty($val) || $val == " ")
	unset($arr[$key]);
}
return $arr;

}
*/