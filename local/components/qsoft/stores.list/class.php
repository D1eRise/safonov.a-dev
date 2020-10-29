<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

class StroresList extends CBitrixComponent {
	public function onPrepareComponentParams($arParams) {
        $arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);

		$arParams["IBLOCK_ID"] = intval(trim($arParams["IBLOCK_ID"]));

		$arParams["SORT_BY"] = trim($arParams["SORT_BY"]);
		if (strlen($arParams["SORT_BY"])<=0) {
		    $arParams["SORT_BY"] = "RAND";
		}

		$arParams["SORT_ORDER"] = trim($arParams["SORT_ORDER"]);
		if (!preg_match('/^(ASC|DESC)/', $arParams["SORT_ORDER"])) {
			$arParams["SORT_ORDER"]="DESC";
		}

		$arParams["ALL_URL"] = trim($arParams["ALL_URL"]);

		$arParams["STORES_COUNT"] = intval($arParams["STORES_COUNT"]);

		return $arParams;
    }

    protected function checkModules() {
        if (!Loader::includeModule("iblock")) {
			$this->abortResultCache();
			ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
			return;
		}
    }

    protected function getResult() {

        if ($this->startResultCache($arParams['CACHE_TIME'])) {

        	$this->checkModules();

			$arSelect = [
				"ID",
				"IBLOCK_ID",
				"NAME",
				"PREVIEW_PICTURE",
				"PROPERTY_ADDRESS",
		        "PROPERTY_PHONE",
		        "PROPERTY_WORK_HOURS",
			];

			if ($this->arParams['SHOW_MAP']) {
				$arSelect[] = "PROPERTY_MAP";
			}

			//WHERE
			$arFilter = [
		        "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
		        "ACTIVE" => "Y",
		    ];

		    if ($this->arParams["STORES_COUNT"]<=0) {
		    	$arNavParams = false;
			} else {
				$arNavParams = [
			    	"nTopCount" => $this->arParams["STORES_COUNT"],
			    ];
			}

			//ORDER BY
			$arSort = [
				$this->arParams["SORT_BY"] => $this->arParams["SORT_ORDER"]
			];

			$arItem = [];
			$this->arResult["ITEMS"] = [];
			$imgIds = [];
			$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);

			while ($arItem = $rsElement->GetNext(true, false)) {

				$arButtons = CIBlock::GetPanelButtons(
					$arItem["IBLOCK_ID"],
					$arItem["ID"],
					0,
					array("SECTION_BUTTONS"=>false, "SESSID"=>false)
				);

				$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
				$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

				if ($arItem["PREVIEW_PICTURE"]) {
					$imgIds[] = $arItem["PREVIEW_PICTURE"];
				}

				if ($arItem["PROPERTY_MAP_VALUE"]) {
	                [$lat, $lon]  = explode(',', $arItem["PROPERTY_MAP_VALUE"]);
	                $position["yandex_scale"] = "10"; 
					$position["yandex_lat"] = $lat;
					$position["yandex_lon"] = $lon;
	                $position["PLACEMARKS"][] = [
	                    "LAT"  => $lat,
	                    "LON"  => $lon,
	                    "TEXT" => $arItem['PROPERTY_ADDRESS_VALUE'],
	                ];
	            }

				$this->arResult['ITEMS'][] = $arItem;
				$this->arResult["POSITION"] = $position;
			}

			$this->AddIncludeAreaIcon([
				"ID" => "add_new",
	            "URL" => CIBlock::GetPanelButtons($this->arParams["IBLOCK_ID"])['edit']['add_element']['ACTION'],
	            "TITLE" => CIBlock::GetArrayByID($this->arParams["IBLOCK_ID"], "ELEMENT_ADD"),
	            "ICON" => "bx-context-toolbar-create-icon"
			]);

			if (!empty($imgIds)) {

				$dbFiles = CFile::GetList([], ["@ID" => $imgIds]);
				$image = [];

				while ($image = $dbFiles->GetNext()) {
					$image["SRC"] = CFile::GetFileSRC($image);
					foreach ($this->arResult["ITEMS"] as &$arItem) {
						if ($arItem["PREVIEW_PICTURE"] === $image["ID"]) {
							$arItem["PREVIEW_PICTURE_SRC"] = $image["SRC"];
						}
					}
				}
			}

        }
    }

    public function executeComponent() {
    	$this->getResult();
		$this->setResultCacheKeys($this->arParams['SHOW_MAP'] ? ["POSITION"] : []);
		$this->includeComponentTemplate();
    }
}
