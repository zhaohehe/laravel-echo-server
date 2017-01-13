<?php
/*
 * Sometime too hot the eye of heaven shines
 */

namespace EchoServer;

use swoole_websocket_server;

class SocketServer
{
    /**
     * @var \swoole_websocket_server
     */
    private $socketServer;


    private $echoMessage;

    /**
     * SocketServer constructor.
     */
    public function __construct()
    {
        $this->socketServer = new swoole_websocket_server(config('echo.host'), config('echo.port'));

        $this->socketServer->set([
            'worker_num' => 8,
            'daemonize'  => false,
        ]);

        $this->echoMessage = new EchoMessage();

        $this->socketServer->on('open', [$this, 'onOpen']);
        $this->socketServer->on('message', [$this->echoMessage, 'message']);
        $this->socketServer->on('close', [$this, 'onClose']);

    }


    public function start()
    {
        $this->socketServer->start();
    }



    public function onOpen($socketServer, $request)
    {
//        $fd[] = $request->fd;
//        $fds[] = $fd;
//        $this->echoMessage->setFd($fds);
    }


    public function onClose($socketServer, $fd)
    {
        echo "client-{$fd} is closed\n";
    }

}