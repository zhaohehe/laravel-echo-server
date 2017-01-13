<?php
/*
 * Sometime too hot the eye of heaven shines
 */

namespace EchoServer;

use Redis;

class RedisOperation
{
    private $redis;

    public function __construct()
    {
        $this->redis = new Redis();

        $host = config('database.redis.default.host');

        $port = config('database.redis.default.port');

        $database = config('database.redis.default.database');

        $this->redis->pconnect($host, $port, $database);

    }

    public function getRedis()
    {
        return $this->redis;
    }
}