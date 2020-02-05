<?php
require_once "koolreport/core/autoload.php";
require_once "SaleReport.php";
require_once "HistoriqueReport.php";

class LoadReport{
    public static $dataStoreQueryDic = array();

    function __construct($args=array()){
        if(count($args) > 0){
            $i = 0;
            foreach($args as $element){
                array_push(
                    self::$dataStoreQueryDic, 
                    $this->builtElement($element, strval($i))
                );
                $i++;
            }
        }
    }

    function builtElement($element, $dataStore){
        $result = array();
        if($element["isHistorique"]){        
            $result["query"] = 
            "SELECT id, nomTable, valeurAv, valeurAp, isInsert, typeDonnee, nomColonne, dateModification".
            " FROM  historique".
            " WHERE nomTable='".$element["nomTable"]."' and nomColonne='".$element["nomColonne"].
            "' LIMIT ".$element["limit"];
        }
        
        $result["dataStore"] = $dataStore;
        $result["widget"] = $element["widget"];
        if(array_key_exists("columns", $element)){
            $result["columns"] = array();
            foreach($element["columns"] as $cle =>$valeur){
                $result["columns"][$cle] = $valeur;
            }  
        }
        if(array_key_exists("title", $element)){
            $result["title"] = $element["title"];   
        }

        switch($element["widget"]){
            case "Table":
                $result["paging"] = array("pageSize"=>$element["paging"]);
                break;
            case "Card":
                $result["query"] = 
                "SELECT DISTINCT avg(prix) as value".
                " FROM  consultation";
                $result["value"] = array(
                    "value"
                );
            case "ColumnChart" :
                $result["query"] = 
                "SELECT DISTINCT etatPatient, SUM(prix) as prix".
                " FROM  consultation".
                " GROUP BY etatPatient";
                $result["columns"] = array(
                    "etatPatient",
                    "prix"=>array("label"=>"Prix de la consultation","type"=>"number","prefix"=>"$")
                );
                break;
            case "BarChart" :
                if(array_key_exists("width", $element)){
                    $result["width"] = $element["width"];
                }
                if(array_key_exists("height", $element)){
                    $result["height"] = $element["height"];   
                }
                $result["options"] = array("title"=>$element["title"]);
                break;
            case "Piechart" :
                $result["query"] = 
                "SELECT etatPatient, prix as nombre".
                " FROM  consultation".
                " GROUP BY etatPatient";
                
                $result["columns"] = array(
                    "etatPatient",
                    "nombre"=>array("type"=>"number")
                );
                break;
            case "AreaChart" :
                $result["query"] = 
                "SELECT medecin.nom as nom, sum(consultation.prix) as prix, count(consultation.code_medecin)*100000 as codeMed ". 
                "FROM consultation JOIN Medecin ON medecin.code = consultation.code_medecin ".
                "GROUP BY nom";
                
                $result["columns"] = array(
                    "nom",
                    "prix"=>array("type"=>"number"),
                    "codeMed"=>array("label"=>"Nombre de consultation (*100000)","type"=>"number"),
                );
            case "SteppedAreaChart" :
                /*
                $result["columns"] = array(
                        array("Director (Year)","Rotten Tomatoes","IMDB"),
                        array("Tikeng (1935)",8.4,7.9),
                        array("Kameni (1959)",6.9,6.5),
                        array("Tedonze (1978)",6.5,6.4),
                        array("Nna (2008)",4.4,6.2)
                );
                $result["options"]=array("isStacked"=>true);
                //*/
                break;
            case "LineChart":
                break;
            case "GeoChart":
                $result["width"] = "100%";
                $result["options"] = array(
                        "showTooltip"=> true,
                        "showInfoWindow"=> true        
                );
                //*/
                break;
        }
        return $result;
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

