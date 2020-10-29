<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require ($_SERVER['DOCUMENT_ROOT'] . DEFAULT_TEMPLATE_PATH . "/header_part_1.php");
?>
<a href="/" class="logo inline-block"></a>
<?php require ($_SERVER['DOCUMENT_ROOT'] . DEFAULT_TEMPLATE_PATH . "/header_part_2.php"); ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"breadcrumbs_qsoft", 
	array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0",
		"COMPONENT_TEMPLATE" => "breadcrumbs_qsoft"
	),
	false
);?>
<section class="content_area">
	<aside class="left_block">
	<nav>
		<ul class="left_menu">
			<li>
				<span><?=GetMessage("INFORMATION")?></span>
				<?$APPLICATION->IncludeComponent(
				    "bitrix:menu",
				    "menu_footer",
				    Array(
				        "ALLOW_MULTI_SELECT" => "N",
				        "CHILD_MENU_TYPE" => "left",
				        "DELAY" => "N",
				        "MAX_LEVEL" => "1",
				        "MENU_CACHE_GET_VARS" => array(""),
				        "MENU_CACHE_TIME" => "3600",
				        "MENU_CACHE_TYPE" => "A",
				        "MENU_CACHE_USE_GROUPS" => "Y",
				        "ROOT_MENU_TYPE" => "bottom",
				        "USE_EXT" => "N"
				    )
				);?>
			</li>
		</ul>
	</nav>
</aside>
<h1><?$APPLICATION->ShowTitle()?></h1>