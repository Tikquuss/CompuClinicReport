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
    $loadreport = new LoadReport(
        /*
        array(
            array(
                "nomTable"=>"patient",
                "nomColonne"=>"nom",
                "limit"=>"10",
                "widget"=>"Table",
                "columns"=>array(
                    "valeurAp"=>array(
                        "label"=>"Name"
                    ),
                    "id"=>array(
                        "type"=>"number",
                        "label"=>"Id",
                        "prefix"=>"$"
                    )
                ),
                "paging"=>"3",
            )
            //, array(...)
        )
        */
    );
?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Test KoolReport</title>
    </head>
    <body>
        <h1></h1>
        <?php 
            //['dataStoreQueryDic' => $dataStoreQueryDic] = require 'LoadReport.php';
            $dataStoreQueryDic = LoadReport::$dataStoreQueryDic;
            foreach($dataStoreQueryDic as $element){
                switch ($element["widget"]) {
                    case "Table":
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
                        break;
                    case "Card":
                        Card::create(array(
                            "title"=>$element["title"],
                            "value"=>20,

                            "baseValue"=>100,
                            "format"=>array_key_exists("format", $element) ? 
                                    $element["format"]:
                                    array(
                                        "value"=>array(
                                            //"prefix"=>"$"
                                        )
                                    )
                            )
                        );
                        break;
                    case "ColumnChart":
                        ColumnChart::create(array(
                            "title"=>$element["title"],
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"]
                        ));
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
                        break;
                    case "PieChart" :
                        DonutChart::create(array(
                            "title"=>$element["title"],
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"]
                        ));
                    case "AreaChart":
                        AreaChart::create(array(
                            "title"=>$element["title"],
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"]
                        ));
                        break;
                    case "SteppedAreaChart":
                        SteppedAreaChart::create(array(
                            "title"=>$element["title"],
/*//////todo///////*/      "dataSource"=>$element["dataStore"],
                            "options"=>$element["options"]
                        ));
                        break;
                    case "LineChart":
                        LineChart::create(array(
                            "title"=>$element["title"],
                            "dataSource"=>$this->dataStore($element["dataStore"]),
                            "columns"=>$element["columns"]
                        ));
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
                        ComboChart::create(array(
                            "title"=>"Centre medicaux",
                            "dataSource"=>array(
                                array("sss"=>"CHU","entrées"=>50000,"depenses"=>20000,"profit"=>12000),
                                array("sss"=>"Hopital Central", "entrées"=>32000,"depenses"=>36000,"profit"=>7000),
                                array("sss"=>"Hopital Général","entrées"=>54000,"depenses"=>39000,"profit"=>15000),
                                array("sss"=>"Hopital Militaire","entrées"=>23000,"depenses"=>18000,"profit"=>5000),
                                array("sss"=>"Hopital des Soeurs","entrées"=>12000,"depenses"=>6000,"profit"=>6000),
                            ),
                            "columns"=>array(
                                "sss",
                                "entrées"=>array(
                                    "label"=>"Total Entrées",
                                    "type"=>"number",
                                    "prefix"=>"$"
                                ),
                                "depenses"=>array(
                                    "label"=>"Total Sorties",
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

            Timeline::create(array(
                "dataSource"=>[
                    ['Docteur','Start','End'],
                    [ 'Dr Batchakui',  "1999-01-20",  "2020-01-18" ],
                    [ 'Dr CHANA',  "2000-01-20",  "2020-01-18" ],
                    [ 'Pr Bouetou',  "1995-01-20",  "2020-01-18" ],
                    [ 'Ing NGATCHUI',  "2010-01-20",  "2020-01-18" ]
                ],
                "columns"=>array(
                    "Docteur",
                    "Start"=>array(
                        "type"=>"date",
                    ),
                    "End"=>array(
                        "type"=>"date",
                    )
                ),
                "withoutLoader"=>true
            ));
        ?>
    </body>
</html> 