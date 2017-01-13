<?php
/*
 * Sometime too hot the eye of heaven shines
 */

namespace EchoServer;

use EchoServer\RedisOperation;

class EchoMessage
{
    private $request;

    private $redis;

    public function __construct()
    {
        $this->request = new Request();

        $redisOperate = new RedisOperation();
        $this->redis = $redisOperate->getRedis();

    }

    public function message($socketServer, $frame)
    {
        $fd = $frame->fd;
        $this->request->parse($frame->data);

        $event   = $this->request->getEvent();
        $channel = $this->request->getChannel();

        $this->redis->subscribe([$channel], function ($instance, $channelName, $message) use ($socketServer, $fd, $event, $channel) {

            $message = json_decode($message);
            $eventName = $message->event;

            if ($eventName == $event && $channelName == $channel) {
                $socketServer->push($fd, json_encode($message->data));
            }

        });

    }
}