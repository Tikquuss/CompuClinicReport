<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\koolphp\Card;

    use \koolreport\widgets\google\ColumnChart;
    use \koolreport\widgets\google\BarChart;
    use \koolreport\widgets\google\AreaChart;
    use \koolreport\widgets\google\SteppedAreaChart;
    use \koolreport\widgets\google\LineChart;
    use \koolreport\widgets\google\GeoChart;
    use \koolreport\widgets\google\PieChart;
    use \koolreport\widgets\google\Gauge;
    use \koolreport\widgets\google\Histogram;
    use \koolreport\widgets\google\Timeline;
    use \koolreport\widgets\google\ComboChart;
    
    use \koolreport\instant\Widget;
    require_once "LoadReport.php";
    //use \LoadReport;
?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Test KoolReport</title>
    </head>
    <body>
        <h1>Top 10 des meilleurs clients</h1>
        <?php 
            ['dataStoreQueryDic' => $dataStoreQueryDic] = require 'LoadReport.php';

            foreach($dataStoreQueryDic as $element){
                switch ($element["widget"]) {
                    case "Table":
                        //*
                        Table::create(array(
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"],
                            "paging"=>array_key_exists("paging", $element) ? 
                                        $element["paging"]:
                                        array(
                                            "pageSize"=>3
                                        ),
                            "cssClass"=> array_key_exists("cssClass", $element) ? 
                                        $element["cssClass"]:
                                        array(
                                            "table"=>"table table-hover table-bordered"
                                        )
                        ));
                        //*/
                        /*
                        Table::create(array(
                            "dataSource"=>$this->dataStore("result"),
                            "columns"=>array(
                                "customerName"=>array(
                                    "label"=>"customer Name"
                                ),
                                "saleamount"=>array(
                                    "type"=>"number",
                                    "label"=>"Sale Amount",
                                    "prefix"=>"$"
                                )
                            ),
                            "paging"=>array(
                                "pageSize"=>5,
                            ),
                            "cssClass"=>array(
                                "table"=>"table table-hover table-bordered"
                            )
                        ));
                        //*/
                        break;
                    case "Card":
                        Card::create(array(
                            "title"=>$element["title"],
                            "value"=>$element["value"],
                            "baseValue"=>$element["baseValue"],
                            "format"=>array_key_exists("format", $element) ? 
                                    $element["format"]:
                                    array(
                                        "value"=>array(
                                            "prefix"=>"$"
                                        )
                                    )
                            )
                        );
                        /* 
                        Card::create(array(
                            "title"=>"Month Sale",
                            "value"=>11249,
                            "baseValue"=>9230,
                            "format"=>array(
                                "value"=>array(
                                    "prefix"=>"$"
                                )
                            )
                        ));
                        //*/
                        break;
                    case "ColumnChart":
                        ColumnChart::create(array(
                            "title"=>$element["title"],
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"]
                        ));
                        /*
                        ColumnChart::create(array(
                            "title"=>"Sale Report",
                            "dataSource"=>$this->dataStore("sale"),
                            "columns"=>array(
                                "category",
                                "sale"=>array("label"=>"Sale","type"=>"number","prefix"=>"$"),
                                "cost"=>array("label"=>"Cost","type"=>"number","prefix"=>"$"),
                                "profit"=>array("label"=>"Profit","type"=>"number","prefix"=>"$"),
                            ),
                        ));
                        //*/
                        break;
                    case "BarChart":
                        BarChart::create(array(
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "width"=> array_key_exists("format", $element) ?
                                        $element["width"] : "100%",
                            "height"=> array_key_exists("format", $element) ?
                                        $element["height"] : "500px",
                            "columns"=>$element["columns"],
                            "options"=>$element["options"]
                        ));
                        /*
                        BarChart::create(array(
                            "dataSource"=>$this->dataStore("result"),
                            "width"=>"100%",
                            "height"=>"500px",
                            "columns"=>array(
                                "customerName"=>array(
                                    "label"=>"customer Name"
                                ),
                                "saleamount"=>array(
                                    "type"=>"number",
                                    "label"=>"Sale Amount",
                                    "prefix"=>"$"
                                )
                            ),
                            "options"=>array(
                                "title"=>"Sales By Customer"
                            )
                        ));
                        //*/
                        break;
                    case "AreaChart":
                        AreaChart::create(array(
                            "title"=>$element["title"],
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"]
                        ));
                        /*
                        AreaChart::create(array(
                            "title"=>"Sale vs Cost",
                            "dataSource"=>$this->dataStore('sale_by_time'),
                            "columns"=>array(
                                "month",
                                "sale"=>array(
                                    "label"=>"Sale",
                                    "type"=>"number",
                                    "prefix"=>"$"
                                ),
                                "cost"=>array(
                                    "label"=>"Cost",
                                    "type"=>"number",
                                    "prefix"=>"$"
                                ),
                            ),
                        ));
                        //*/
                        break;
                    case "SteppedAreaChart":
                        SteppedAreaChart::create(array(
                            "title"=>$element["title"],
/*//////todo///////*/      "dataSource"=>$element["dataStore"],
                            "options"=>$element["options"]
                        ));
                        /*
                        SteppedAreaChart::create(array(
                            "title"=>"Accumulated Rating",
                            "dataSource"=>array(
                                array("Director (Year)","Rotten Tomatoes","IMDB"),
                                array("Alfred Hitchcock (1935)",8.4,7.9),
                                array("Ralph Thomas (1959)",6.9,6.5),
                                array("Don Sharp (1978)",6.5,6.4),
                                array("James Hawes (2008)",4.4,6.2)
                            ),
                            "options"=>array(
                                "isStacked"=>true
                            )
                        ));
                        //*/
                        break;
                    case "LineChart":
                        LineChart::create(array(
                            "title"=>$element["title"],
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"]
                        ));
                        /*
                        LineChart::create(array(
                            "title"=>"Sale vs Cost",
                            "dataSource"=>$this->dataStore('time_sales'),
                            "columns"=>array(
                                "month",
                                "sale"=>array("label"=>"Sale","type"=>"number","prefix"=>"$"),
                                "cost"=>array("label"=>"Cost","type"=>"number","prefix"=>"$"),
                            )
                        ));
                        */
                        break;
                    case "GeoChart":
                        GeoChart::create(array(
                            "dataStore"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"],
                            "width"=> array_key_exists("width", $element) ? $element["width"]:"100%",
                            "options"=> array_key_exists("options", $element) ? 
                                    $element["options"] :
                                    array(
                                        "showTooltip"=> true,
                                        "showInfoWindow"=> true        
                                    )
                        ));
                        /*
                        GeoChart::create(array(
                            "dataStore"=>$this->dataStore("sales"),
                            "columns"=>array(
                                "country"=>array(
                                    "label"=>"Country"
                                ),
                                "amount"=>array(
                                    "label"=>"Sales",
                                    "type"=>"number",
                                    "prefix"=>"$"
                                )
                            ),
                            "width"=>"100%",
                            "options"=>array(
                                "showTooltip"=> true,
                                "showInfoWindow"=> true        
                            )
                        ));
                        //*/
                        break;
                    case "GaugeChart":
                        Gauge::create(array(
                            "name"=>"resourceChart",
                            "title"=>"Resource Usage",
                            "dataSource"=>[
                                ["Label","Value"],
                                ['Memory', 80],
                                ['CPU', 55],
                                ['Network', 68]
                            ],
                            "columns"=>array("Label","Value"=>array("format"=>false)),
                            "options"=>array(
                                "redFrom"=> 90, 
                                "redTo"=> 100,
                                "yellowFrom"=>75, 
                                "yellowTo"=> 90,
                                "minorTicks"=> 5
                            ),
                            "onReady"=>"function(){
                                setInterval(function() {
                                    resourceChart.dataTable.setValue(0, 1, 40 + Math.round(60 * Math.random()));
                                    resourceChart.redraw();
                                }, 13000);
                                setInterval(function() {
                                    resourceChart.dataTable.setValue(1, 1, 40 + Math.round(60 * Math.random()));
                                    resourceChart.redraw();
                                }, 5000);
                                setInterval(function() {
                                    resourceChart.dataTable.setValue(2, 1, 60 + Math.round(20 * Math.random()));
                                    resourceChart.redraw();
                                }, 26000);
                            }"
                        ));                        
                        break;
                    case "Histogram":
                        Histogram::create(array(
                            "dataSource"=>[
                                ['Dinosaur', 'Length'],
                                ['Acrocanthosaurus (top-spined lizard)', 12.2],
                                ['Albertosaurus (Alberta lizard)', 9.1],
                                ['Allosaurus (other lizard)', 12.2],
                                ['Apatosaurus (deceptive lizard)', 22.9],
                                ['Archaeopteryx (ancient wing)', 0.9],
                                ['Argentinosaurus (Argentina lizard)', 36.6],
                                ['Baryonyx (heavy claws)', 9.1],
                                ['Brachiosaurus (arm lizard)', 30.5],
                                ['Ceratosaurus (horned lizard)', 6.1],
                                ['Coelophysis (hollow form)', 2.7],
                                ['Compsognathus (elegant jaw)', 0.9],
                                ['Deinonychus (terrible claw)', 2.7],
                                ['Diplodocus (double beam)', 27.1],
                                ['Dromicelomimus (emu mimic)', 3.4],
                                ['Gallimimus (fowl mimic)', 5.5],
                                ['Mamenchisaurus (Mamenchi lizard)', 21.0],
                                ['Megalosaurus (big lizard)', 7.9],
                                ['Microvenator (small hunter)', 1.2],
                                ['Ornithomimus (bird mimic)', 4.6],
                                ['Oviraptor (egg robber)', 1.5],
                                ['Plateosaurus (flat lizard)', 7.9],
                                ['Sauronithoides (narrow-clawed lizard)', 2.0],
                                ['Seismosaurus (tremor lizard)', 45.7],
                                ['Spinosaurus (spiny lizard)', 12.2],
                                ['Supersaurus (super lizard)', 30.5],
                                ['Tyrannosaurus (tyrant lizard)', 15.2],
                                ['Ultrasaurus (ultra lizard)', 30.5],
                                ['Velociraptor (swift robber)', 1.8]
                            ],
                            "title"=>"Lengths of dinosaurs, in meters",
                            "options"=>array(
                                "legend"=>["position"=>"none"]
                            )
                        ));
                        break;
                    case "Timeline":
                        Timeline::create(array(
                            "dataSource"=>[
                                ['President','Start','End'],
                                [ 'Gerald Ford',  "1974-01-20",  "1977-01-20" ],
                                [ 'Jimmy Carter',  "1977-01-20",  "1981-01-20" ],
                                [ 'Ronald Reagan',  "1981-01-20",  "1989-01-20" ],
                                [ 'George H. W. Bush',  "1989-01-20",  "1993-01-20" ],
                                [ 'Bill Clinton',  "1993-01-20",  "2001-01-20" ],
                                [ 'George W. Bush',  "2001-01-20",  "2009-01-20" ],
                                [ 'Barack Obama',  "2009-01-20",  "2017-01-20" ],
                                [ 'Donald Trump',  "2017-01-20",  date("Y-m-d") ],
                            ],
                            "columns"=>array(
                                "President",
                                "Start"=>array(
                                    "type"=>"date",
                                ),
                                "End"=>array(
                                    "type"=>"date",
                                )
                            ),
                            "withoutLoader"=>true
                        ));
                        break;
                    case "ComboChart":
                        echo "i est un gateau";
                        break;
                    case "ComboChart":
                        ComboChart::create(array(
                            "title"=>"Sale Report",
                            "dataSource"=>array(
                                array("category"=>"Books","sale"=>32000,"cost"=>20000,"profit"=>12000),
                                array("category"=>"Accessories","sale"=>43000,"cost"=>36000,"profit"=>7000),
                                array("category"=>"Phones","sale"=>54000,"cost"=>39000,"profit"=>15000),
                                array("category"=>"Movies","sale"=>23000,"cost"=>18000,"profit"=>5000),
                                array("category"=>"Others","sale"=>12000,"cost"=>6000,"profit"=>6000),
                            ),
                            "columns"=>array(
                                "category",
                                "sale"=>array(
                                    "label"=>"Sale",
                                    "type"=>"number",
                                    "prefix"=>"$"
                                ),
                                "cost"=>array(
                                    "label"=>"Cost",
                                    "type"=>"number",
                                    "prefix"=>"$"
                                ),
                                "profit"=>array(
                                    "label"=>"Profit",
                                    "type"=>"number",
                                    "prefix"=>"$",
                                    "chartType"=>"line",
                                ),
                            ),
                        ));
                        break;
                }
            }
            //foreach($dataStoreQueryDic as $cle =>$valeur){
                //echo $cle.' : '.$valeur. '<br />';
                //$valeur["widget"]::;
            //}
        ?>

        <?php
            ComboChart::create(array(
                "title"=>"Sale Report",
                "dataSource"=>array(
                    array("category"=>"Books","sale"=>32000,"cost"=>20000,"profit"=>12000),
                    array("category"=>"Accessories","sale"=>43000,"cost"=>36000,"profit"=>7000),
                    array("category"=>"Phones","sale"=>54000,"cost"=>39000,"profit"=>15000),
                    array("category"=>"Movies","sale"=>23000,"cost"=>18000,"profit"=>5000),
                    array("category"=>"Others","sale"=>12000,"cost"=>6000,"profit"=>6000),
                ),
                "columns"=>array(
                    "category",
                    "sale"=>array(
                        "label"=>"Sale",
                        "type"=>"number",
                        "prefix"=>"$"
                    ),
                    "cost"=>array(
                        "label"=>"Cost",
                        "type"=>"number",
                        "prefix"=>"$"
                    ),
                    "profit"=>array(
                        "label"=>"Profit",
                        "type"=>"number",
                        "prefix"=>"$",
                        "chartType"=>"line",
                    ),
                ),
            ));

            Histogram::create(array(
                "dataSource"=>[
                    ['Dinosaur', 'Length'],
                    ['Acrocanthosaurus (top-spined lizard)', 12.2],
                    ['Albertosaurus (Alberta lizard)', 9.1],
                    ['Allosaurus (other lizard)', 12.2],
                    ['Apatosaurus (deceptive lizard)', 22.9],
                    ['Archaeopteryx (ancient wing)', 0.9],
                    ['Argentinosaurus (Argentina lizard)', 36.6],
                    ['Baryonyx (heavy claws)', 9.1],
                    ['Brachiosaurus (arm lizard)', 30.5],
                    ['Ceratosaurus (horned lizard)', 6.1],
                    ['Coelophysis (hollow form)', 2.7],
                    ['Compsognathus (elegant jaw)', 0.9],
                    ['Deinonychus (terrible claw)', 2.7],
                    ['Diplodocus (double beam)', 27.1],
                    ['Dromicelomimus (emu mimic)', 3.4],
                    ['Gallimimus (fowl mimic)', 5.5],
                    ['Mamenchisaurus (Mamenchi lizard)', 21.0],
                    ['Megalosaurus (big lizard)', 7.9],
                    ['Microvenator (small hunter)', 1.2],
                    ['Ornithomimus (bird mimic)', 4.6],
                    ['Oviraptor (egg robber)', 1.5],
                    ['Plateosaurus (flat lizard)', 7.9],
                    ['Sauronithoides (narrow-clawed lizard)', 2.0],
                    ['Seismosaurus (tremor lizard)', 45.7],
                    ['Spinosaurus (spiny lizard)', 12.2],
                    ['Supersaurus (super lizard)', 30.5],
                    ['Tyrannosaurus (tyrant lizard)', 15.2],
                    ['Ultrasaurus (ultra lizard)', 30.5],
                    ['Velociraptor (swift robber)', 1.8]
                ],
                "title"=>"Lengths of dinosaurs, in meters",
                "options"=>array(
                    "legend"=>["position"=>"none"]
                )
            ));

            \koolreport\widgets\google\Timeline::create(array(
                "dataSource"=>[
                    ['President','Start','End'],
                    [ 'Gerald Ford',  "1974-01-20",  "1977-01-20" ],
                    [ 'Jimmy Carter',  "1977-01-20",  "1981-01-20" ],
                    [ 'Ronald Reagan',  "1981-01-20",  "1989-01-20" ],
                    [ 'George H. W. Bush',  "1989-01-20",  "1993-01-20" ],
                    [ 'Bill Clinton',  "1993-01-20",  "2001-01-20" ],
                    [ 'George W. Bush',  "2001-01-20",  "2009-01-20" ],
                    [ 'Barack Obama',  "2009-01-20",  "2017-01-20" ],
                    [ 'Donald Trump',  "2017-01-20",  date("Y-m-d") ],
                ],
                "columns"=>array(
                    "President",
                    "Start"=>array(
                        "type"=>"date",
                    ),
                    "End"=>array(
                        "type"=>"date",
                    )
                ),
                "withoutLoader"=>true
            ));

            Card::create(array(
                "title"=>"Month Sale",
                "value"=>11249,
                "baseValue"=>9230,
                "format"=>array(
                    "value"=>array(
                        "prefix"=>"$"
                    )
                )
            ));

            

            GeoChart::create(array(
                "dataStore"=>$this->dataStore("sales"),
                "columns"=>array(
                    "country"=>array(
                        "label"=>"Country"
                    ),
                    "amount"=>array(
                        "label"=>"Sales",
                        "type"=>"number",
                        "prefix"=>"$"
                    )
                ),
                "width"=>"100%",
                "options"=>array(
                    "showTooltip"=> true,
                    "showInfoWindow"=> true        
                )
            ));

            GeoChart::create([
                "title"=>"World Polulation 2016",
                "dataSource"=>[
                    ['City',   'Population', 'Area'],
                    ['Rome',      2761477,    1285.31],
                    ['Milan',     1324110,    181.76],
                    ['Naples',    959574,     117.27],
                    ['Turin',     907563,     130.17],
                    ['Palermo',   655875,     158.9],
                    ['Genoa',     607906,     243.60],
                    ['Bologna',   380181,     140.7],
                    ['Florence',  371282,     102.41],
                    ['Fiumicino', 67370,      213.44],
                    ['Anzio',     52192,      43.43],
                    ['Ciampino',  38262,      11]
                ],
                'mapsApiKey'=> 'your-google-key-map',
                "options"=>[
                    "region"=>'IT',
                    "displayMode" => 'markers',
                    "colorAxis" => ["colors"=> ['green', 'blue']]
                ]
            ]);

            PieChart::create(array(
                "dataSource"=>array(
                    array("browser"=>"Chrome","usage"=>44.5),
                    array("browser"=>"Safari","usage"=>25.4),
                    array("browser"=>"Internet Explorer","usage"=>15.5),
                    array("browser"=>"Firefox","usage"=>7.4),
                    array("browser"=>"Others","usage"=>7.2),
                )
            ));

            SteppedAreaChart::create(array(
                "title"=>"Accumulated Rating",
                "dataSource"=>array(
                    array("Director (Year)","Rotten Tomatoes","IMDB"),
                    array("Alfred Hitchcock (1935)",8.4,7.9),
                    array("Ralph Thomas (1959)",6.9,6.5),
                    array("Don Sharp (1978)",6.5,6.4),
                    array("James Hawes (2008)",4.4,6.2)
                ),
                "options"=>array(
                    "isStacked"=>true
                )
            ));
        ?>
    </body>
</html> 