<?php echo js_tag('vendor/tinymce/tinymce.min'); ?>
<script type="text/javascript">
jQuery(window).load(function () {
    Omeka.wysiwyg({
        mode: 'specific_textareas',
        editor_selector: 'html-editor'
    });
});
</script>

<?php
$gallery_page_title                      = get_option('philly_simple_gallery_page_title');
$gallery_page_instructions               = get_option('philly_simple_gallery_page_instructions');
$add_to_main_navigation                  = get_option('philly_simple_gallery_add_to_main_navigation');
$view = get_view();
?>


<div class="field">
    <?php echo $view->formLabel('gallery_page_title', 'Gallery Page Title'); ?>
    <div class="inputs">
        <?php echo $view->formText('gallery_page_title', $gallery_page_title, array('class' => 'textinput')); ?>
        <p class="explanation">
            The title of the gallery page (not HTML).
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('gallery_page_instructions', 'Introduction for Gallery Page'); ?>
    <div class="inputs">
        <?php echo $view->formTextarea('gallery_page_instructions', $gallery_page_instructions, array('rows' => '10', 'cols' => '60', 'class' => array('textinput', 'html-editor'))); ?>
        <p class="explanation">
            An introduction to add to the gallery page.
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('add_to_main_navigation', 'Add to Main Navigation'); ?>
    <div class="inputs">
        <?php echo $view->formCheckbox('add_to_main_navigation', $add_to_main_navigation, null, array('1', '0')); ?>
        <p class="explanation">
            If checked, add a link to the splash page to the main site
            navigation.
        </p>
    </div>
</div>




