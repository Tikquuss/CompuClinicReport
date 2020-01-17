<?php
//dirname(__FILE__)."/../../extension/koolreport/core/autoload.php";
use \koolreport\processes\CalculatedColumn;
use \koolreport\processes\ColumnMeta;

class SaleReport extends \koolreport\KoolReport {

    // Pour ajouter du style
    use \koolreport\clients\Bootstrap;
    
    // create settings()
    protected function settings(){
        return array(
            "dataSources"=>array(
                "automaker"=>array(
                    "connectionString"=>"mysql:host=localhost;dbname=automaker",
                    "username"=>"root",
                    "password"=>"",
                    "charset"=>"utf8"
                )
            )
        );
    }

    //Setup report
    protected function setup(){
        // Pour les clients
        $this->src("automaker")
        ->query("
            SELECT customers.customerName, sum(payments.amount) as saleamount
            FROM payments
            JOIN customers ON customers.customerNumber = payments.customerNumber
            GROUP BY customers.customerName
            ORDER BY saleamount desc
            LIMIT 10
        ")
        ->pipe($this->dataStore("result"));

        // Pour les pays
        $this->src('automaker')
        ->query("
            SELECT customers.country, sum(payments.amount) as amount 
            FROM  payments
            JOIN customers ON customers.customerNumber = payments.customerNumber
            GROUP BY customers.country
            LIMIT 10
        ")
        ->pipe(new CalculatedColumn(array(
            "tooltip"=>"'{country} : $'.number_format({amount})",
        )))
        ->pipe(new ColumnMeta(array(
            "tooltip"=>array(
                "type"=>"string",
            )
        )))
        ->pipe($this->dataStore("sales"));
    }
}