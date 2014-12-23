<div id="image-menu">
  <a id="menu-close" href="#" onClick="closeMenu();">Close</a>
  <span id="image-name"></span>
  <span class="bb">&bull;</span> <a id="image-link" href="#" target="_blank">Open</a>
  <span class="bb">&bull;</span> <a href="#" onClick="dropImage();">Remove</a>
</div>

<ul class="image-list">
<?php  foreach(Registry::get('images') as $image){ ?>

  <li class="image-item" id="image<?php echo $image->id ?>">
    <img src="<?php echo $image->link; ?>" alt="BROKEN!!"/>
  </li>

<?php } ?>
</ul>

<div class="image-pagination">
  <a href="<?php echo Router::link("dashboard/".Registry::get('prev_page')); ?>">&laquo; Prev</a>
  <span class="image-range"><?php __('range'); ?></span>
  <a href="<?php echo Router::link("dashboard/".Registry::get('next_page')); ?>">Next &raquo;</a>
  <!--<br />Total images: <?php __('total'); ?> -->
</div>