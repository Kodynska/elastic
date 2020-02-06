<?php

require __DIR__ . '/vendor/autoload.php';

use Elasticsearch\ClientBuilder;
// создаём клиент библиотеки elasticsearch для выполнения запросов
$client = ClientBuilder::create()
    ->setHosts(['localhost:9200']) // указываем, в виде массива, хост и порт сервера elasticsearch
    ->build();

if (isset($_GET['q'])) {

    $q = $_GET['q'];
    $query = $client->search([
        'body' => [
            'query' => [ // (5)
                'bool' => [
                    'should' => [
                        // 'match' => ['name' => $q],
                        'match' => ['attributes' => $q],

                    ],

                ],

            ],
        ],
    ]);

// $params = [
    //     'index' => 'tstidx',
    //     'body' => [
    //         'try' => [
    //             'text' => 'a',
    //             'completion' => ['field' => 'suggest'],
    //         ],
    //     ],
    // ];
    // $response = $client->suggest($query);

// print_r($response);
    if ($query['hits']['total'] >= 1) {

        $results = $query['hits']['hits'];

    }

}

// $client = new Elasticsearch\Client();
// $client = ClientBuilder::create()
//     ->setHosts(['localhost:9200']) // указываем, в виде массива, хост и порт сервера elasticsearch
//     ->build();
// $param = array();
// $param['index'] = 'music';
// $param['type'] = '_search';
// $param['body'] = new stdClass();
// $client->create($param);
// $param = array(
//     'index' => 'question_index',
//     'body' => array(
//         'suggestions' => array(
//             'text' => 'someth',
//             'completion' => array(
//                 'field' => 'general_suggest',
//             ),
//         ),
//     ),
// );
// $client->suggest($param);
?>

<!-- HTML STARTS HERE -->
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search Elasticsearch</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <form action="index.php" method="get" autocomplete="off">
            <label>
                Search for Something
                <input type="text" name="q">
            </label>
            <input type="submit" value="search">
        </form>

        <div class="res">
            <a href="#id"><?php print_r($results)?></a>
        </div>
        <div class="res">Attributes</div>
    </body>
</html>

