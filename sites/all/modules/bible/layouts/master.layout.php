
<?php foreach ($cursor as $document){ ?>

	<br />
	<div>
		<?php foreach ($document as $key => $value){ ?>
			<div>
				<span><?php echo $key;?>:</span>
				<span><?php echo print_r($value);?></span>
			</div>
		<?php } ?>
	</div>
	<br />

<?php } ?>