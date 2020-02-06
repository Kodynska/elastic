<?php
require __DIR__ . '/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

// создаём клиент библиотеки elasticsearch для выполнения запросов
$client = ClientBuilder::create()
    ->setHosts(['localhost:9200']) // указываем, в виде массива, хост и порт сервера elasticsearch
    ->build();
