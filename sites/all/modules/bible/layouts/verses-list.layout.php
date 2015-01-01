
<h4><?php echo $bookHe;?></h4>

<ul class="chapters">
	<?php for ($i = 0; $i < $length; $i++){ ?>
        <li id="<?php echo "/".$book.".".($i+1);?>">
        	<a href="<?php echo "/".$book.".".($i+1);?>">
				<?php echo $this->index->getNameVerse($i);?>
            </a>
        </li>
    <?php } ?>
</ul>
