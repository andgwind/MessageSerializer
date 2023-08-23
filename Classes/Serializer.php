<?php

namespace App;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer as Handler;

class Serializer
{
    /**
     * @var Handler
     */
    private Handler $serializer;

    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $extractor = new PropertyInfoExtractor(typeExtractors: [new PhpDocExtractor(), new ReflectionExtractor()]);
        $normalizers = [new ArrayDenormalizer(), new ObjectNormalizer(propertyTypeExtractor: $extractor)];

        $this->serializer = new Handler($normalizers, $encoders);
    }

    /**
     * @param mixed $message Объект сообщения
     * @return string
     */
    public function serialize(mixed $message): string
    {
        return $this->serializer->serialize($message, 'json');
    }

    /**
     * @param string $message Строка сообщения
     * @return mixed
     */
    public function deserialize(string $message): mixed
    {
        return $this->serializer->deserialize($message, Message::class, 'json');
    }
}