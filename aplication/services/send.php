<?php
  require '../../vendor/autoload.php';

  $options = array(
    'cluster' => 'us2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '3c8e93a6f7612e82df8c',
    'ecffc69a6eb74b772b18',
    '848966',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
  echo 'terminou';
?>