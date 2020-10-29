<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<section class="shops_block">
	<?php foreach($arResult["ITEMS"] as $arItem): ?>

		<?php
		$this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("DELETE_CONFIRM")));
		?>

		<div id="<?=$this->GetEditAreaId($arItem["ID"]);?>">
			<figure class="shops_block_item" id="<?=$this->GetEditAreaId($arItem["ID"]);?>">
				<a href=""><img src="<?=$arItem["PREVIEW_PICTURE_SRC"] ?? NO_IMAGE_PATH?>" alt="" title="" style="margin-bottom: 25px;"/></a>
				<figcaption class="shops_block_item_description">
					<h3 class="shops_block_item_name"><?=$arItem["NAME"]?></h3>
					<p class="dark_grey"><?=$arItem["PROPERTY_ADDRESS_VALUE"]?></p>
					<p class="black"><?=$arItem["PROPERTY_PHONE_VALUE"]?></p>
					<p><?=GetMessage("WORK_HOURS")?><br/><?=$arItem["PROPERTY_WORK_HOURS_VALUE"]?></p>
				</figcaption>
			</figure>
		</div>
		
	<?php endforeach; ?>
</section>
<div style="clear:both"></div>