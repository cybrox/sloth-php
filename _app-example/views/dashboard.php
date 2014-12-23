<ul>
<?php  foreach(Registry::get('images') as $image){ ?>

  <li><?php echo $image->link; ?></li>

<?php } ?>
</ul>
