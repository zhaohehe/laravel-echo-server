<?php
/*
 * Sometime too hot the eye of heaven shines
 */

namespace EchoServer;


class Request
{
    /**
     * @var
     */
    private $data;

    /**
     * @var default event namespace
     */
    private $eventNameSpace = 'App\\Events\\';

    public function __construct()
    {

    }

    public function parse($data)
    {
        $this->data = json_decode($data);
    }

    public function getChannel()
    {
        try {
            $channel = $this->data->channel;
            return $channel;
        } catch (\Exception $e) {

        }
    }

    public function getEvent()
    {
        try {
            $event = $this->data->event;
            return $this->getEventNameSpace().$event;
        } catch (\Exception $e) {

        }
    }

    protected function getEventNameSpace()
    {
        try {
           return $this->data->namespace;
        } catch (\Exception $e) {

        }
        return $this->eventNameSpace;
    }
}