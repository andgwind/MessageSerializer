<?php

namespace Test;

use App\Event;
use App\Message;
use App\Meta;
use App\Payload;
use App\Serializer;
use PHPUnit\Framework\TestCase;

class MessageEntityTest extends TestCase
{
    public function test_message_with_data()
    {
        $meta = new Meta();
        $event = new Event();
        $payload = new Payload();

        $meta->setData(['test' =>'testMeta']);
        $event->setName('testName');
        $payload->setContent(['test' =>'content']);

        $message = new Message($meta, $event, $payload);

        $serializer = new Serializer();

        $messageEncode = $serializer->serialize($message);
        $messageDecode = $serializer->deserialize($messageEncode);

        $this->assertEquals($message, $messageDecode);
    }

    public function test_message_with_empty_date()
    {
        $meta = new Meta();
        $event = new Event();
        $payload = new Payload();

        $message = new Message($meta, $event, $payload);

        $serializer = new Serializer();

        $messageEncode = $serializer->serialize($message);
        $messageDecode = $serializer->deserialize($messageEncode);

        $this->assertEquals($message, $messageDecode);
    }
}