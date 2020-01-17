<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\BarChart;
    use \koolreport\widgets\google\GeoChart;
?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Test KoolReport</title>
    </head>
    <body>
        <h1>Top 10 des meilleurs clients</h1>

        <?php
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
        ?>

        <?php
            Table::create(array(
                "dataStore"=>$this->dataStore("sales")->sort(array("amount"=>"desc")),
                "columns"=>array(
                    "country"=>array(
                        "label"=>"Country"
                    ),
                    "amount"=>array(
                        "label"=>"Amount",
                        "type"=>"number",
                        "prefix"=>"$",
                    )
                ),
                "paging"=>array(
                    "pageSize"=>3,
                ),
                "cssClass"=>array(
                    "table"=>"table table-bordered table-striped"
                )
            ));
        ?>

        <?php
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
        ?>

        <?php
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
        ?>
    </body>
</html> 