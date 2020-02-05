<?php
require_once "koolreport/core/autoload.php";
require_once "SaleReport.php";
require_once "HistoriqueReport.php";
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\BarChart;
use \koolreport\widgets\google\GeoChart;

return [
    "dataStoreQueryDic" => array(
        array(
            "query"=>"
                SELECT valeurAv, valeurAp, isInsert, typeDonnee, nomColonne
                FROM historique
                LIMIT 10
            ",
            "dataStore"=>"0",
            "columns"=>array(
                "valeurAv"=>array(
                    "label"=>"Name"
                ),
                "id"=>array(
                    "type"=>"number",
                    "label"=>"Sale Amount",
                    "prefix"=>"$"
                )
            ),
            "widget"=>"Table",
            "paging"=>array(
                "pageSize"=>3
            ),
            "cssClass"=>array(
                "table"=>"table table-hover table-bordered"
            )    
        )
    )
];

return [
    "dataStoreQueryDi" => array(
        array(
            "query"=>"
                SELECT valeurAv, valeurAp, isInsert, typeDonnee, nomColonne
                FROM historique
                LIMIT 10
            ",
            "dataStore"=>"result",
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
            "widget"=>"Table",
            "paging"=>array(
                "pageSize"=>3
            ),
            "cssClass"=>array(
                "table"=>"table table-hover table-bordered"
            )    
        ),
        array(
            "widget"=>"Card",
            "title"=>"Month Sale",
            "value"=>11249,
            "baseValue"=>9230,
            "format"=>array(
                "value"=>array(
                    "prefix"=>"$"
                )
            )
        ),
        array(
            "widget"=>"ColumnChart",
            "title"=>"Sale Report",
            "dataStore"=>"sales",
            "columns"=>array(
                /*"category"*/"country",
                "amount"=>array("label"=>"Sale","type"=>"number","prefix"=>"$"),
                /*"cost"*/"avg"=>array("label"=>"Cost","type"=>"number","prefix"=>"$"),
                /*"profit"*/"amount"=>array("label"=>"Profit","type"=>"number","prefix"=>"$"),
            )
        ),
        array(
            "widget"=>"BarChart",
            "dataStore"=>"result",
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
        ),
        array(
            "widget"=>"AreaChart",
            "dataStore"=>"sales",
            "title"=>"Sale vs Cost",
            "columns"=>array(
                /*"month"*/"country",
                /*"sale"*/"amount"=>array(
                    "label"=>"Sale",
                    "type"=>"number",
                    "prefix"=>"$"
                ),
                /*"cost"*/"avg"=>array(
                    "label"=>"Cost",
                    "type"=>"number",
                    "prefix"=>"$"
                ),
            ),
        ),
        array(
            "widget"=>"SteppedAreaChart",
            "title"=>"Accumulated Rating",
            "dataStore"=>array(
                array("Director (Year)","Rotten Tomatoes","IMDB"),
                array("Tikeng (1935)",8.4,7.9),
                array("Kameni (1959)",6.9,6.5),
                array("Tedonze (1978)",6.5,6.4),
                array("Nna (2008)",4.4,6.2)
            ),
            "options"=>array(
                "isStacked"=>true
            )
        ),
        array(
            "widget"=>" LineChart",
            "title"=>"Sale vs Cost__________",
            "dataSource"=>'sales',
            "columns"=>array(
                "country",
                /*"sale"*/"amount"=>array("label"=>"Sale","type"=>"number","prefix"=>"$"),
                /*"cost"*/"avg"=>array("label"=>"Cost","type"=>"number","prefix"=>"$"),
            )
        ),
        array(
            "widget"=>"GeoChart",
            "dataStore"=>"sales",
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
        )
    )
];

class LoadReport{
    public static $dataStoreQueryDic = array(
        /*
        array(
            "query"=>"
                SELECT valeurAv, valeurAp, isInsert, typeDonnee, nomColonne
                FROM historique
                LIMIT 10
            ",
            "dataStore"=>"0",
            "columns"=>array(
                "valeurAv"=>array(
                    "label"=>"Name"
                ),
                "id"=>array(
                    "type"=>"number",
                    "label"=>"Sale Amount",
                    "prefix"=>"$"
                )
            ),
            "widget"=>"Table",
            "paging"=>array(
                "pageSize"=>3
            ),
            "cssClass"=>array(
                "table"=>"table table-hover table-bordered"
            )    
        )
        //*/
        /*
        array(
            "query"=>"
                SELECT customers.customerName, sum(payments.amount) as saleamount
                FROM payments
                JOIN customers ON customers.customerNumber = payments.customerNumber
                GROUP BY customers.customerName
                ORDER BY saleamount desc
                LIMIT 10
            ",
            "dataStore"=>"result",
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
            "widget"=>"Table",
            "paging"=>array(
                "pageSize"=>3
            ),
            "cssClass"=>array(
                "table"=>"table table-hover table-bordered"
            )
        ),
        array(
            "query"=>"
                SELECT customers.country, sum(payments.amount) as amount, avg(payments.amount) as avg
                FROM  payments
                JOIN customers ON customers.customerNumber = payments.customerNumber
                GROUP BY customers.country
                LIMIT 10
            ",
            "dataStore"=>"sales"
        )
        */
    );

    function __construct($args=array()){
        if(count($args) > 0){
            $i = 0;
            foreach($args as $element){
                array_push(self::$dataStoreQueryDic, $this->builtElement($element, strval($i)));
                $i++;
            }
        }
    }

    function builtElement($element, $dataStore){
        $result = array();
        $result["query"] = 
        "SELECT id, nomTable, valeurAv, valeurAp, isInsert, typeDonnee, nomColonne, dateModification".
        " FROM  historique".
        " WHERE nomTable='".$element["nomTable"]."' and nomColonne='".$element["nomColonne"].
        "' LIMIT ".$element["limit"];
        
        $result["dataStore"] = $dataStore;
        $result["widget"] = $element["widget"];
        switch($element["widget"]){
            case "Table":
                $result["columns"] = array();
                foreach($element["columns"] as $cle =>$valeur){
                    $result["columns"][$cle] = $valeur;
                }
                /*
                $result["columns"]=array(
                    "customerName"=>array(
                        "label"=>"customer Name"
                    ),
                    "saleamount"=>array(
                        "type"=>"number",
                        "label"=>"Sale Amount",
                        "prefix"=>"$"
                    )
                ),
                */
                $result["paging"] = array("pageSize"=>$element["paging"]);
                break;
        }
        return $result;
    }

    function queryBuilder(){
        foreach($this->params["dataStoreQueryDic"] as $element){
            $temp = $this->src($this->params["dbname"])
            ->query($element["query"])
            ->pipe($this->dataStore($element["dataStore"]));  
        }    
    }

    public function getDataStoreQueryDic(){
        return self::$dataStoreQueryDic;
    }

    function render(){
        $report = new HistoriqueReport(
            array(
                "dbname"=>"automaker",
                "host"=>"mysql:host=localhost",
                "username"=>"root",
                "password"=>"",
                "charset"=>"utf8",
                "dataStoreQueryDic"=>self::$dataStoreQueryDic      
            )
        ); 
        //$report = new SaleReport(array("dbname"=>"automaker"));
        $report->run()->render();
    }
}

