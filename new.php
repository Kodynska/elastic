<?php

require __DIR__ . '/vendor/autoload.php';

use Elasticsearch\ClientBuilder;
// создаём клиент библиотеки elasticsearch для выполнения запросов
$client = ClientBuilder::create()
    ->setHosts(['0.0.0.0:9200']) // указываем, в виде массива, хост и порт сервера elasticsearch
    ->build();

// if (isset($_GET['q'])) {

$q = $_GET['q'];
// try {
//     $params = [
//         'index' => 'tests1',
//         'body' => [
//             'settings' => [
//                 'number_of_shards' => 1,
//                 'number_of_replicas' => 0,
//                 'analysis' => [
//                     'filter' => [
//                         'shingle' => [
//                             'type' => 'shingle',
//                         ],
//                     ],
//                     'char_filter' => [
//                         'pre_negs' => [
//                             'type' => 'pattern_replace',
//                             'pattern' => '(\\w+)\\s+((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\b',
//                             'replacement' => '~$1 $2',
//                         ],
//                         'post_negs' => [
//                             'type' => 'pattern_replace',
//                             'pattern' => '\\b((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\s+(\\w+)',
//                             'replacement' => '$1 ~$2',
//                         ],
//                     ],
//                     'analyzer' => [
//                         'reuters' => [
//                             'type' => 'custom',
//                             'tokenizer' => 'standard',
//                             'filter' => ['lowercase', 'stop', 'kstem'],
//                         ],
//                     ],
//                 ],
//                 'analysis' => [
//                     'char_filter' => [
//                         'ru' => [
//                             'type' => 'mapping',
//                             'mappings' => ['Ё=>Е', 'ё=>е'],
//                         ],
//                     ],
//                     'analyzer' => [
//                         'default' => [
//                             'alias' => ['index_ru'],
//                             'type' => 'custom',
//                             "tokenizer" => "standard",
//                             'filter' => ['stop', 'custom_word_delimiter', 'lowercase', 'snowball', 'russian', 'english_morphology'],
//                             'char_filter' => ['ru'],
//                         ],
//                         'default_search' => [
//                             'alias' => ['search_ru'],
//                             'type' => 'custom',
//                             'tokenizer' => 'standard',
//                             'filter' => ['stop', 'custom_word_delimiter', 'lowercase', 'snowball', 'russian', 'english_morphology'],
//                             'char_filter' => ['ru'],
//                         ],
//                     ],
//                     'filter' => [
//                         'stopwords_ru' => [
//                             'type' => 'stop',
//                             'stopwords' => ['а', 'без', 'более', 'бы', 'был', 'была', 'были', 'было', 'быть', 'в', 'вам', 'вас', 'весь', 'во',
//                                 'вот', 'все', 'всего', 'всех', 'вы', 'где', 'да', 'даже', 'для', 'до', 'его', 'ее', 'если', 'есть',
//                                 'еще', 'же', 'за', 'здесь', 'и', 'из', 'или', 'им', 'их', 'к', 'как', 'ко', 'когда', 'кто', 'ли',
//                                 'либо', 'мне', 'может', 'мы', 'на', 'надо', 'наш', 'не', 'него', 'нее', 'нет', 'ни', 'них', 'но',
//                                 'ну', 'о', 'об', 'однако', 'он', 'она', 'они', 'оно', 'от', 'очень', 'по', 'под', 'при', 'с', 'со',
//                                 'так', 'также', 'такой', 'там', 'те', 'тем', 'то', 'того', 'тоже', 'той', 'только', 'том', 'ты',
//                                 'у', 'уже', 'хотя', 'чего', 'чей', 'чем', 'что', 'чтобы', 'чье', 'чья', 'эта', 'эти', 'это', 'я'],
//                             'ignore_case' => true,
//                         ],
//                         'custom_word_delimiter' => [
//                             'type' => 'word_delimiter',
//                             'generate_word_parts' => true,
//                             'generate_number_parts' => true,
//                             'catenate_words' => true,
//                             'catenate_numbers' => false,
//                             'catenate_all' => true,
//                             'split_on_case_change' => true,
//                             'preserve_original' => true,
//                             'split_on_numerics' => false,
//                         ],
//                     ],
//                 ],
//             ],
//             'mappings' => [
//                 'properties' => [
//                     'title' => [
//                         'type' => 'text',
//                         'analyzer' => 'reuters',
//                         'copy_to' => 'combined',
//                     ],
//                     'body' => [
//                         'type' => 'text',
//                         'analyzer' => 'reuters',
//                         'copy_to' => 'combined',
//                     ],
//                     'combined' => [
//                         'type' => 'text',
//                         'analyzer' => 'reuters',
//                     ],
//                     'topics' => [
//                         'type' => 'keyword',
//                     ],
//                     'places' => [
//                         'type' => 'keyword',
//                     ],
//                 ],
//             ],
//         ],
//     ];
//     $client->indices()->create($params);
//     // $response = $client->indices()->getSettings($params);
// } catch (Exception $e) {
//     echo 'Выброшено исключение: ', $e->getMessage(), "\n";
// }
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
//     if ($query['hits']['total'] >= 1) {

//         $results = $query['hits']['hits'];
//         // $result = json_encode($results);

//     }

// }

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
//
//
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
    //         'index' => 'tstidx',
    //         'body' => [
    //             'try' => [
    //                 'text' => 'a',
    //                 'completion' => ['field' => 'suggest'],
    //             ],
    //         ],
    //     ];

    if ($query['hits']['total'] >= 1) {

        $results = $query['hits']['hits'];

    }

}

// try {
//     $params = [
//         'index' => 'my13',
//         'body' => [
//             'settings' => [
//                 'number_of_shards' => 1,
//                 'number_of_replicas' => 0,
//                 'analysis' => [
//                     'filter' => [

//                         'shingle' => [
//                             'type' => 'shingle',
//                         ],
//                         'russian_stemmer' => [
//                             'type' => 'stemmer',
//                             'language' => 'russian',
//                         ],

//                     ],
//                     'char_filter' => [
//                         'pre_negs' => [
//                             'type' => 'pattern_replace',
//                             'pattern' => '(\\w+)\\s+((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\b',
//                             'replacement' => '~$1 $2',
//                         ],
//                         'post_negs' => [
//                             'type' => 'pattern_replace',
//                             'pattern' => '\\b((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\s+(\\w+)',
//                             'replacement' => '$1 ~$2',
//                         ],
//                     ],

//                     'analyzer' => [
//                         'reuters' => [
//                             'type' => 'custom',
//                             'tokenizer' => 'standard',
//                             'filter' => ['lowercase', 'stop', 'kstem', 'russian_stemmer'],
//                         ],
//                     ],
//                 ],
//             ],
//             'mappings' => [
//                 'properties' => [
//                     'title' => [
//                         'type' => 'text',
//                         'analyzer' => 'reuters',
//                         'copy_to' => 'combined',
//                     ],
//                     'body' => [
//                         'type' => 'text',
//                         'analyzer' => 'reuters',
//                         'copy_to' => 'combined',
//                     ],
//                     'combined' => [
//                         'type' => 'text',
//                         'analyzer' => 'reuters',
//                     ],
//                     'topics' => [
//                         'type' => 'keyword',
//                     ],
//                     'places' => [
//                         'type' => 'keyword',
//                     ],
//                 ],
//             ],
//         ],
//     ];
//     $client->indices()->create($params);

// } catch (Exception $e) {
//     echo 'Выброшено исключение: ', $e->getMessage(), "\n";
// }
// $params = [
//     'index' => 'my2',
//     'id' => 'my_id',
//     'routing' => 'company_xyz',
//     'body' => ['title' => 'abc'],
// ];
// $params = [
//     'index' => 'my2',
//     'body' => [
//         'query' => [
//             'match' => [
//                 'title' => $q,
//             ],
//         ],
//     ],
// ];

// if ($query['hits']['total'] >= 1) {

//     $results = $query['hits']['hits'];

// }
//
// print_r(json_encode($params['body']));
// $params = [
//     'index' => 'my2',
//     'id' => 'my_id',
// ];

// Get doc at /my_index/_doc/my_id
// $response = $client->get($params);
// $response = $client->get($params);
//
//
try {
    $query = $client->search([
        'index' => 'my13',
        'body' => [
            'query' => [ // (5)
                'bool' => [
                    'should' => [
                        // 'match' => ['name' => $q],
                        'match' => ['title' => $q],

                    ],

                ],

            ],
        ],
    ]);
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "\n";
}
try {
    $params = [
        'index' => 'my13',
        // 'type'   => 'my_type',
        'body' => [
            'query' => [
                'query_string' => [
                    // 'match' => ['title' => $q],
                    'fields' => ['title'],
                    'fuzziness' => 1,
                    'query' => sprintf('*%s*', ['title' => $q]),
                ],
            ],
            'highlight' => [
                'fields' => [
                    '*' => new \stdClass(),
                ],
            ],
        ],
    ];

    // $response = $client->search($params);
    $suggest = $client->search($params);
    // print_r($suggest);
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "\n";
}
try {
    $querys = $client->search([
        'index' => 'my13',
        'body' => [
            // 'query' => [ // (5)
            // 'bool' => [
            // 'should' => [
            // 'match' => ['name' => $q],
            // 'match' => [
            // 'title' => $q
            // "title" =>
            // $q,
            "query" => [
                'bool' => [
                    'should' => [
                        "match" => [
                            "title" => [
                                "query" => $q,
                                "fuzziness" => 2,
                                "operator" => "and",
                            ],
                        ],
                        // 'query_string' => [
                        // 'match' => ['title' => $q],
                        // "fuzziness" => 1,
                        // "operator" => "or",
                    ],
                ],

            ],
            // ],
        ],
        // ],
        // ],
    ]);
} catch (Exception $e) {
    echo 'Выброшено исключение1: ', $e->getMessage(), "\n";
}
// $results = $client->search($params);
// $response = $client->index($params);
// print_r($results);
if ($querys['hits']['total'] >= 1) {

    $results = $querys['hits']['hits'];

    $resultNames = array_map(function ($item) {
        return $item['_source'];
    }, $querys['hits']['hits']);
    print_r($resultNames);
    print_r($results);

}
// } catch (Exception $e) {
//     echo 'Выброшено исключение: ', $e->getMessage(), "\n";
// }
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
           <a href="#id">Attributes:  <?php foreach ($results as $res) {
    print_r($res['_source']['title'] . ' ');

}?>

           </a>
        </div>
        <div class="res">Name:  <?php foreach ($results as $res) {
    print_r($res['_source']['name'] . ' ');
}?></div>
<h1>Search Results</h1>

<ul>
<?php foreach ($resultNames as $resultName): ?>
    <li><?php echo implode(' ', $resultName); ?></li>
<?php endforeach;?>
</ul>
    </body>
</html>

