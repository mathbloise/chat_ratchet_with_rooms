<?php
    require_once 'vendor/autoload.php';
    use React\Socket\Server;
    use Ratchet\Server\IoServer;
    use Ratchet\Http\HttpServer;
    use Ratchet\WebSocket\WsServer;
    use Ratchet\Wamp\WampServer;

    $loop   = React\EventLoop\Factory::create();
    $pusher = new Rafa\WebSocket\Pusher;

        $webSock = new Server('0.0.0.0:8082', $loop);
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WampServer(
                        $pusher
                    )
                )
            ),
            $webSock
        );

    $loop->run();