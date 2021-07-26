<?php

$floraFile = file_get_contents('../../json/furniture_and_terrain/terrain-flora.json');
$flora = json_decode($floraFile);
$out = [];

foreach ($flora as $f) {
    if (in_array("SHRUB", $f->flags)) {
        echo $f->name . PHP_EOL;
        $out[] = [
            'type' => 'construction',
            'id' => "constr_clear_underbrush_{$f->id}",
            'description' => 'Clear Underbrush',
            'category' => 'OTHER',
            'required_skills' => [
                [
                    'survival', 3
                ]
            ],
            'time' => "1 m",
            "tools" => [ 
                [ 
                    [ "machete", -1 ], 
                    [ "makeshift_machete", -1 ], 
                    [ "scythe", -1 ], 
                    [ "sickle", -1 ], 
                    [ "survivor_machete", -1 ] 
                ] 
            ],
            'byproducts' => [
                [
                    "item" => "withered",
                    "count" => [ 0, 2 ] 
                ]
            ],
            'pre_terrain' => $f->id,
            'post_terrain' => 't_grass'
        ];
    }
}
file_put_contents('./construction.json', json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));