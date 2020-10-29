<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
   "bitrix:menu.sections",
   "",
   array(
      "IS_SEF" => "N",
      "ID" => "",
      "SECTION_URL" => "/catalog/#SECTION_CODE#/",
      "IBLOCK_TYPE" => "products",
      "IBLOCK_ID" => "5",
      "DEPTH_LEVEL" => "2",
      "CACHE_TYPE" => "A",
   )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>