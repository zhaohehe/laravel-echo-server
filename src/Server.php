<?php

/*
 * Sometime too hot the eye of heaven shines
 */

namespace EchoServer;

use Redis;
use EchoServer\SocketServer;

class Server
{
    /**
     * @var SocketServer
     */
    private $serv;


    /**
     * socket constructor.
     */
    public function __construct()
    {
        $this->serv = new SocketServer();

        $this->serv->start();
    }
}