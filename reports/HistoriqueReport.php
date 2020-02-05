<?php
use \koolreport\processes\CalculatedColumn;
use \koolreport\processes\ColumnMeta;

class HistoriqueReport extends \koolreport\KoolReport {
    // Pour ajouter du style
    use \koolreport\clients\Bootstrap;
    
    /**
     * create settings
     * @param {}
     */
    protected function settings(){
        return array(
            "dataSources"=>array(
                "automaker"=>array(
                    "connectionString"=>$this->params["host"].';dbname='.$this->params["dbname"],
                    "username"=> $this->params["username"],
                    "password"=>$this->params["password"],
                    "charset"=>$this->params["charset"]
                )
            )
        );
    }

    //Setup report
    protected function setup(){
        // Pour les clients
        foreach($this->params["dataStoreQueryDic"] as $element){
            if(array_key_exists("query", $element)){
                $temp = $this->src($this->params["dbname"])
                ->query($element["query"]);
                
                if(array_key_exists("CalculatedColumn", $element)){
                    $temp->pipe(new CalculatedColumn(array(
                        //"tooltip"=>"'{country} : $'.number_format({amount})",
                        "tooltip"=>"'{".$element["champ"]."} : $'.number_format({".$element["champ"]."})",
                    )));
                }
                if(array_key_exists("ColumnMeta", $element)){
                    $temp->pipe(new ColumnMeta(array(
                        "tooltip"=>array(
                            "type"=>  $element["type"] //"string"....
                        )
                    )));  
                }
                $temp->pipe($this->dataStore($element["dataStore"])); 
            } 
        }
    }
}