<?php

require_once __DIR__."/vendor/autoload.php";

$restaurant = new Restaurant(
    new Halls(
        new Tables(
            new Reserves()
        )
    )
);

$restaurant = new Restaurant(
    new HallsMysql(
        new TablesMysql(
            new ReservesMysql($dbAdapter), $dbAdapter), $dbAdapter)
);