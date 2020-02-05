<?php
array(
    array(
        //"query"=>"",
        "widget"=>"Table",
        //"dataStore"=>"result",
        "columns"=>array(
            // Il choisit les noms de colonnes
            "customerName"=>array(
                "label"=>"customer Name"
            ),
            "saleamount"=>array(
                //"type"=>"number",
                "label"=>"Sale Amount",
                "prefix"=>"$"
            )
        ),
        //padding
        "paging"=>array(
            "pageSize"=>3
        )   
    ),
    array(
        "widget"=>"Card",
            "title"=>"Month Sale",
             type : max, min, moyenne (tu m'envoi avg), somme (tu m'envoi sum)
            //"value"=>11249,
            //"baseValue"=>9230,
            
            "prefix"=>"$"

        ),
        array(
            "widget"=>"ColumnChart",
            "title"=>"Sale Report",
            //"dataStore"=>"sales",
            "columns"=>array(
                /*"category"*/"country",
                "amount"=>array("label"=>"Sale","type"=>"number","prefix"=>"$"),
                /*"cost"*/"avg"=>array("label"=>"Cost","type"=>"number","prefix"=>"$"),
                /*"profit"*/"amount"=>array("label"=>"Profit","type"=>"number","prefix"=>"$"),
            )
        ),
        array(
            
            "widget"=>"BarChart",
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
            //"dataStore"=>"sales",
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
            //"dataSource"=>'sales',
            "columns"=>array(
                "country",
                /*"sale"*/"amount"=>array("label"=>"Sale","type"=>"number","prefix"=>"$"),
                /*"cost"*/"avg"=>array("label"=>"Cost","type"=>"number","prefix"=>"$"),
            )
        ),
        array(
            "widget"=>"GeoChart",
           // "dataStore"=>"sales",
            "columns"=>array(
                // nom des colonnes
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
    private $dataStoreQueryDic = array(
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
    );