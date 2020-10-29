<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arParams["SHOW_MAP"] === "Y") {

    $APPLICATION->IncludeComponent("bitrix:map.yandex.view", "", [
        "INIT_MAP_TYPE" => "MAP",
        "MAP_ID"        => "salon",
        "MAP_WIDTH"     => "600",
        "MAP_HEIGHT"    => "500",
        "MAP_DATA"      => serialize($arResult["POSITION"]),
        "CONTROLS"      => ["ZOOM", "TYPECONTROL"],
        "OPTIONS"       => ["ENABLE_SCROLL_ZOOM"],
    ]);
}