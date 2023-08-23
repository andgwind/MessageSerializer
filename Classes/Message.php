<?php

namespace App;

class Message
{
    /**
     * @var Meta
     */
    public Meta $meta;

    /**
     * @var Event
     */
    public Event $event;

    /**
     * @var Payload
     */
    public Payload $payload;

    /**
     * @param Meta $meta
     * @param Event $event
     * @param Payload $payload
     */
    public function __construct(Meta $meta, Event $event, Payload $payload)
    {
        $this->meta = $meta;
        $this->event = $event;
        $this->payload = $payload;
    }
}