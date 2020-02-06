<?php
require __DIR__ . '/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()
    ->setHosts(['0.0.0.0:9200'])
    ->build();

if (isset($_GET['q'])) {

    $q = $_GET['q'];

    $indexParams['index'] = 'my18';
    $index = $client->indices()->exists($indexParams);
    if (!$index) {

        try {
            $params = [
                'index' => 'my18',
                'body' => [
                    'settings' => [
                        'number_of_shards' => 1,
                        'number_of_replicas' => 0,
                        'analysis' => [
                            'filter' => [
                                'shingle' => [
                                    'type' => 'shingle',
                                ],
                                'russian_stemmer' => [
                                    'type' => 'stemmer',
                                    'language' => 'russian',
                                ],

                            ],
                            'char_filter' => [
                                'pre_negs' => [
                                    'type' => 'pattern_replace',
                                    'pattern' => '(\\w+)\\s+((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\b',
                                    'replacement' => '~$1 $2',
                                ],
                                'post_negs' => [
                                    'type' => 'pattern_replace',
                                    'pattern' => '\\b((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\s+(\\w+)',
                                    'replacement' => '$1 ~$2',
                                ],
                            ],

                            'analyzer' => [
                                'reuters' => [
                                    'type' => 'custom',
                                    'tokenizer' => 'standard',
                                    'filter' => ['lowercase', 'stop', 'kstem', 'russian_stemmer'],
                                ],
                            ],
                        ],
                    ],
                    'mappings' => [
                        'properties' => [
                            'title' => [
                                'type' => 'text',
                                'analyzer' => 'reuters',
                                'copy_to' => 'combined',
                                'fielddata' => true,
                            ],
                            'body' => [
                                'type' => 'text',
                                'analyzer' => 'reuters',
                                'copy_to' => 'combined',
                            ],
                            'combined' => [
                                'type' => 'text',
                                'analyzer' => 'reuters',
                            ],
                            'topics' => [
                                'type' => 'keyword',
                            ],
                            'places' => [
                                'type' => 'keyword',
                            ],
                        ],
                    ],
                ],
            ];
            // $response = $client->indices()->getIndex($params);
            $client->indices()->create($params);
            // print_r($response);

        } catch (Exception $e) {
            echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        }
    }
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

// print_r(json_encode($params['body']));
    // $params = [
    //     'index' => 'my2',
    //     'id' => 'my_id',
    // ];

// Get doc at /my_index/_doc/my_id
    // $response = $client->get($params);
    // $response = $client->get($params);

    try {
        $querys = $client->search([

            'index' => 'my18',
            'body' => [
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

                        ],
                    ],

                ],
                'sort' => [
                    'title' => [
                        'order' => 'asc',
                    ],
                ],
            ],

        ]);
    } catch (Exception $e) {
        echo 'Выброшено исключение1: ', $e->getMessage(), "\n";
    }

    // while (isset($querys['hits']['hits']) && count($querys['hits']['hits']) > 0) {
    if ($querys['hits']['total'] >= 1) {

        $results = $querys['hits']['hits'];

        $resultNames = array_map(function ($item) {
            return $item['_source'];
        }, $querys['hits']['hits']);

    }
    // **
    // Do your work here, on the $response['hits']['hits'] array
    // **

    // When done, get the new scroll_id
    // You must always refresh your _scroll_id!  It can change sometimes
    //     $scroll_id = $querys['_scroll_id'];

    //     // Execute a Scroll request and repeat
    //     $response = $client->scroll([
    //         'scroll_id' => $scroll_id, //...using our previously obtained _scroll_id
    //         'scroll' => '30s', // and the same timeout window
    //     ]
    //     );

    //     // print_r($response);
    // }

}
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

