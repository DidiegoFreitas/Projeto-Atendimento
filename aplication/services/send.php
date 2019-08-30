<?php
require '../../vendor/autoload.php';

$id_pusher = (isset($_REQUEST['id_pusher']))?$_REQUEST['id_pusher']:'3c8e93a6f7612e82df8c';

$channel = (isset($_REQUEST['channel']))?$_REQUEST['channel']:'my-channel';
$event = (isset($_REQUEST['event']))?$_REQUEST['event']:'mensagem-channel';
//$send = (isset($_REQUEST['send']))?$_REQUEST['send']:array('data'=>'hello world');

$user = (isset($_REQUEST['user']))?$_REQUEST['user']:'0';
$recebe = (isset($_REQUEST['recebe']))?$_REQUEST['recebe']:'1';
$msg = (isset($_REQUEST['msg']))?$_REQUEST['msg']:'teste';

$send = array('id_envia' => $user,'id_recebe' => $recebe,'msg'=>$msg);

$options = array(
  'cluster' => 'us2',
  'useTLS' => true
);
$pusher = new Pusher\Pusher(
  $id_pusher,
  'ecffc69a6eb74b772b18',
  '848966',
  $options
);

//$data['message'] = 'hello world';

$pusher->trigger($channel, $event, $send);
echo 'terminou';
  