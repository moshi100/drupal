
<div class="col-md-8 book">
	<h1> 
    	<?php echo $title; ?>
    </h1>

	<?php foreach ($cursor as $key => $value){ ?>
        <div class="verse" data-verse="<?php echo ($key+1);?>">
            <span class="verse-number"><?php echo ($key+1);?></span>
            <span class="verse-text"><?php echo $value;?></span>
        </div>
    <?php } ?>
</div>
