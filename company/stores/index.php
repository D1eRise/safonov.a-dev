<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Наши салоны");
?><?$APPLICATION->IncludeComponent(
	"qsoft:stores.list", 
	"stores_full", 
	array(
		"ALL_URL" => "/company/stores/",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "salons",
		"SHOW_MAP" => "Y",
		"SORT_BY" => "RAND",
		"SORT_ORDER" => "DESC",
		"STORES_COUNT" => "",
		"COMPONENT_TEMPLATE" => "stores_full"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>