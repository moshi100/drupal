
<div class="col-md-4 commentaryBox">
	<div class="commentaryBoxScroll">
		<?php foreach ($cursor as $document){ ?>
            <div class="commentary-verse">
                <?php foreach ($document as $key => $value){ ?>
                    <div class="commentary verse-<?php echo $value['verse']+1;?>" data-verse="<?php echo $value['verse']+1;?>">
                        <span class="commentator <?php echo $value['titleEn'];?>"><?php echo $value['title'];?>:</span>
                        <span class="commentator-text"><?php echo $value['value'];?></span>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
	</div>
</div>