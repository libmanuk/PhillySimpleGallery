<?php echo head(); ?>

<style>

@media screen and (min-width: 801px) and (max-width: 4024px) {
  #primary_mobile { display: none; }   /* hide it elsewhere */
}

@media screen and (min-width: 0px) and (max-width: 800px) {
  #primary { display: none; }  /* show it on small screens */
}
    
</style>

<?php
$items = get_records('Item', array(), 25);
set_loop_records('items', $items)
?>
<button id="splashsort" style="display:none;">Sort</button>
<div id="primary">
    <h1><?php echo html_escape(get_option('simple_splash_form_splash_page_title')); ?></h1>
<div id="simple-splash">
    <div id="form-instructions">
        <?php echo get_option('simple_splash_form_splash_page_instructions'); // HTML ?>
    </div>
    

    
    <?php echo flash(); ?>

</div>

</div> 
<ul id="splashset" class="splashlist">
   
    
<?php foreach (loop('items') as $item): ?>
 <?php 
$type = $item->getItemType()->name;
if ('Oral History' === $type): ?>
<li id="<?php echo metadata('item', array('Item Type Metadata','Sort Priority')); ?>" class="splashitem">
<div class="item record">

    <div class="item-meta">
    <?php if (metadata('item', 'has files')): ?>
    <div class="item-img">
        <?php echo link_to_item(item_image('square_thumbnail')); ?>
    </div>
    <?php endif; ?>
    <h2 class="splash_head_style"><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title'), array('snippet'=>35))); ?></h2>
    <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>160))): ?>
    <div class="splashitem-description">
        <?php echo $description; ?>
    </div>
    <?php endif; ?>

    <!--<?php if (metadata('item', 'has tags')): ?>
    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
        <?php echo tag_string('items'); ?></p>
    </div>
    <?php endif; ?>-->

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div>
</li>

<!-- end class="item entry" -->

    <?php endif; ?>
<?php endforeach; ?>
</ul>

<!-- mobile version -->
<button id="splashsort_mobile" style="display:none;">Sort</button>
 <div id="primary_mobile">
    <h1><?php echo html_escape(get_option('simple_splash_form_splash_page_title')); ?></h1>
<div id="simple-splash">
    <div id="form-instructions">
        <?php echo get_option('simple_splash_form_splash_page_instructions'); // HTML ?>
    </div>
    

    
    <?php echo flash(); ?>

</div>

</div>
<div id="splashset_mobile">
   

    
    
<?php foreach (loop('items') as $item): ?>
 <?php 
$type = $item->getItemType()->name;
if ('Oral History' === $type): ?>

<div id="<?php echo metadata('item', array('Item Type Metadata','Sort Priority')); ?>" class="splashitem_mobile">
<div class="item record">

    <div class="item-meta">
    <?php if (metadata('item', 'has files')): ?>
    <div class="item-img">
        <?php echo link_to_item(item_image('square_thumbnail')); ?>
    </div>
    <?php endif; ?>
    <h2 class="splash_head_style"><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title'), array('snippet'=>35))); ?></h2>
    <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>160))): ?>
    <div class="item-description">
        <?php echo $description; ?>
    </div>
    <?php endif; ?>

    <!--<?php if (metadata('item', 'has tags')): ?>
    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
        <?php echo tag_string('items'); ?></p>
    </div>
    <?php endif; ?>-->

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div>

</div>
<!-- end class="item entry" -->

    <?php endif; ?>
<?php endforeach; ?>
</div>

<!-- end mobile version -->


<?php echo foot();
