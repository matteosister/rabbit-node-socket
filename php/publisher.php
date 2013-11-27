<?php

include __DIR__.'/vendor/autoload.php';

if (array_key_exists('msg', $_POST)) {
    $conn = new \PhpAmqpLib\Connection\AMQPConnection('localhost', 5672, 'guest', 'guest');
    $channel = $conn->channel();
    $channel->exchange_declare('rabbit-node-test', 'fanout', false, false, true);
    $msg = new \PhpAmqpLib\Message\AMQPMessage($_POST['msg']);
    $channel->basic_publish($msg, 'rabbit-node-test');
    //$channel->basic_publish($msg, 'amq.fanout');
    echo sprintf("Message <strong>%s</strong> sent", $_POST['msg']);
}
?>

<html>
<head>
    <title>rabbit test</title>
</head>
<body>
    <form method="post" action="">
        Testo del messaggio <input type="text" name="msg" />
        <input type="submit" value="invia" />
    </form>
    <script src="bower_components/jquery/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('input[type=text]').trigger('focus');
        })
    </script>
</body>
</html>