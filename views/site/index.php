<?php
require_once dirname(__FILE__)."/../../reports/LoadReport.php";

$this->title = 'Reporting';
$this->params['breadcrumbs'][] = $this->title;

$report = new LoadReport(
    //*
    array(
        array(
            "nomTable"=>"patient",
            "nomColonne"=>"nom",
            "isHistorique"=>True,
            "limit"=>"10",
            "widget"=>"Table",
            "columns"=>array(
                "id"=>array(
                    "type"=>"number",
                    "label"=>"Identifiants"
                ),
                "valeurAv"=>array(
                    "label"=>"Valeur Avant"
                ),
                "valeurAp"=>array(
                    "label"=>"Valeur apres"
                ),
                "dateModification"=>array(
                    "label"=>"date de modification"
                )
            ),
            "paging"=>"3"
        ), 
        array(
            "isHistorique"=>False,
            "widget"=>"Card",
            "title"=>"Nombre de changement de la Base de données",
            'type' => "Count",
            "prefix"=>"~"
        ),
        array(
            "title"=>"patient",
            "isHistorique"=>False,
            "nomTable"=>"patient",
            "nomColonne"=>"nom",
            "limit"=>"10",
            "widget"=>"ColumnChart",
            "title"=>"Traitement"
        ),
        array(
            "title"=>"patient",
            "isHistorique"=>False,
            "nomTable"=>"patient",
            "nomColonne"=>"nom",
            "limit"=>"10",
            "widget"=>"Piechart",
            "title"=>"Sale Report"
        ),
        array(
            "title"=>"patient",
            "isHistorique"=>False,
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
            "title"=>"patient",
            "isHistorique"=>False,
            "widget"=>"AreaChart",
            //"dataStore"=>"sales",
            "title"=>"d"
        ),
        array(
            "title"=>"patient",
            "isHistorique"=>False,
            "widget"=>"ComboChart",
            //"dataStore"=>"sales",
            "title"=>"d"
        )
    )
);
$report->render();