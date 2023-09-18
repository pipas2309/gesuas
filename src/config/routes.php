<?php

use App\Controller\CitizenController;
use App\Repository\CitizenRepository;
use App\View\CitizenView;
use App\Util\NisUtil;
use FastRoute\RouteCollector;

$citizenRepo = new CitizenRepository();
$citizenView = new CitizenView();
$nisUtil = new NisUtil();
$citizenController = new CitizenController($citizenRepo, $citizenView, $nisUtil);

return function(RouteCollector $r) use ($citizenController) {
    $r->addRoute('GET', '/citizens/{nis}', [$citizenController, 'searchCitizenByNis']);
    $r->addRoute('POST', '/citizens', [$citizenController, 'addCitizen']);
    $r->addRoute('GET', '/verify/{nis}', [$citizenController, 'verifyNis']);
};
