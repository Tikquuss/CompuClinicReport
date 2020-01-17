<?php
require_once dirname(__FILE__)."/../../reports/koolreport/core/autoload.php";
require_once dirname(__FILE__)."/../../reports/SaleReport.php";

$this->title = 'Reporting with koolreport';
$this->params['breadcrumbs'][] = $this->title;

$report = new SaleReport();
$report->run()->render();