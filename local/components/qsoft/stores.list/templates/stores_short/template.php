<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<h2 class="inline-block"><?=GetMessage("STORES_TITLE")?></h2>
<span class="dark_grey all_list">&nbsp;/&nbsp;<a href="<?=$arParams["ALL_URL"]?>" class="text_decor_none"><b><?=GetMessage("ALL_STORES")?></b></a></span>
<div>
	<?php foreach($arResult["ITEMS"] as $arItem): ?>
		<figure class="shops_block_item">
			<a href=""><img src="<?=$arItem["PREVIEW_PICTURE_SRC"] ?? NO_IMAGE_PATH?>" alt="" title="" /></a>
			<figcaption class="shops_block_item_description">
				<h3 class="shops_block_item_name"><?=$arItem["NAME"]?></h3>
				<p class="dark_grey"><?=$arItem["PROPERTY_ADDRESS_VALUE"]?></p>
				<p class="black"><?=$arItem["PROPERTY_PHONE_VALUE"]?></p>
				<p><?=GetMessage("WORK_HOURS")?><br/><?=$arItem["PROPERTY_WORK_HOURS_VALUE"]?></p>
			</figcaption>
		</figure>
	<?php endforeach; ?>
</div>