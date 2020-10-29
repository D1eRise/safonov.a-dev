<?php
use Bitrix\Main\EventManager;
use Bitrix\Main\Mail\Event;

$eventManager = EventManager::getInstance();

$eventManager->addEventHandlerCompatible("main", "OnAfterUserAuthorize", function($arUser) {
	$arEventFields = [
    	"LOGIN" => $arUser["user_fields"]["LOGIN"],
    	"EMAIL" => $arUser["user_fields"]["EMAIL"],
    	"DATE" => ConvertDateTime(ConvertTimeStamp(false, "FULL"), "YYYY.DD.MM HH:MI:SS")
    ];

    Event::send(array(
	    "EVENT_NAME" => "MESS_TO_AUTH_USER",
	    "LID" => SITE_ID,
	    "C_FIELDS" => $arEventFields
	)); 
});
