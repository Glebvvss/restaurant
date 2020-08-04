<?php

require_once __DIR__."/vendor/autoload.php";

$restaurant = new Restaurant(
    new Halls(
        new Tables(
            new Reserves()
        )
    )
);

$restaurantRequest = new RestaurantRequest($restaurant);
$restaurantRequest->hall('Main')
                  ->tableFreeAt('2022-12-12 18:00', '2022-12-12 19:00')
                  ->reserveAt('2022-12-12 18:00', '2022-12-12 19:00');