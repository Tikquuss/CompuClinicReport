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
        ?>
    </body>
</html> 