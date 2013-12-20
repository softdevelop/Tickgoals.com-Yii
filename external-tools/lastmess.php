<?php
$sessSavePath = realpath('../../../jlruntime/session/');
session_save_path($sessSavePath);
session_start();
$sess = $_SESSION;
$pattern = "/[a-fA-F0-9]+__id$/";
$userBinId = '';
$uid = isset($_GET['uid'])?$_GET['uid']:'';
$available = false;

if($uid!=''){
	foreach ($sess as $key => $value) {
		if (preg_match($pattern, $key, $matches)) {
			$userBinId = $value;
			break;
		}
	}
	if($userBinId!=''){
		include 'IDHelper.php';
		$userHexId = IDHelper::uuidFromBinary($userBinId, true);
	}
	if($userHexId==$uid){
		$available = true;
	}
}

function getLastMess($uid){
	$mongo = new Mongo('mongodb://192.168.1.25');
	$c = $mongo->selectDB('jl_messages')->selectCollection('notifications');
	$o = false;
	$tmp = $c->findOne(array("user_id" => $uid));
	if($tmp){
		$o = $tmp['lastmess'];
	}
	return $o;
}
function response($a){
	header('content-type:text/javascript;charset=utf-8');
	echo json_encode($a);
	exit;
}
if(!!$available){
	$tmp = getLastMess($uid);
	if($tmp){
		$output = $tmp;
	}
	else{
		$output = array(
			'lastmess'=>array(
				'message_id'=> '',
				'reply_to'=> '',
				'sender'=> array(
					'user_id'=> '',
					'username'=> '',
					'location'=> '',
					'avatar'=> ''
				),
				'subject'=> '',
				'append_time'=> ''
			),
			'unread'=> 0,
			'update_time'=> date('D, M d, Y H:i:s O', time())
		);	
	}
}
else{
	$output = array(
		'error'=>1,
		'message'=>'Access denied'
	);	
}
response($output);
?>