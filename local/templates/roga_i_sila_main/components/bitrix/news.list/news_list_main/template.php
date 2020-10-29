<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<section class="news_block inverse">
	<h2 class="inline-block"><?=GetMessage("NEWS_TITLE")?></h2><span class="all_list">&nbsp;/&nbsp;<a href="<?=$arResult["LIST_PAGE_URL"]?>" class="text_decor_none"><b><?=GetMessage("ALL_NEWS")?></b></a></span>
	<div>
		<?php foreach($arResult["ITEMS"] as $arItem): ?>
		<figure class="news_item">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"] ?? NO_IMAGE_PATH?>" alt="" title="" /></a>
			<figcaption class="news_item_description">
				<h3><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h3>
				<div class="news_item_anons">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="text_decor_none">
						<?=$arItem["PREVIEW_TEXT"]?>
					</a>
				</div>
				<div class="news_item_date grey"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
			</figcaption>
		</figure>
		<?endforeach;?>
	</div>
</section>