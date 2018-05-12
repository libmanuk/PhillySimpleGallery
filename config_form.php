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
$splash_page_title                      = get_option('simple_splash_form_splash_page_title');
$splash_page_instructions               = get_option('simple_splash_form_splash_page_instructions');
$add_to_main_navigation                  = get_option('simple_splash_form_add_to_main_navigation');
$view = get_view();
?>


<div class="field">
    <?php echo $view->formLabel('splash_page_title', 'Splash Page Title'); ?>
    <div class="inputs">
        <?php echo $view->formText('splash_page_title', $splash_page_title, array('class' => 'textinput')); ?>
        <p class="explanation">
            The title of the splash page (not HTML).
        </p>
    </div>
</div>

<div class="field">
    <?php echo $view->formLabel('splash_page_instructions', 'Introduction for Splash Page'); ?>
    <div class="inputs">
        <?php echo $view->formTextarea('splash_page_instructions', $splash_page_instructions, array('rows' => '10', 'cols' => '60', 'class' => array('textinput', 'html-editor'))); ?>
        <p class="explanation">
            An introduction to add to the splash page.
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




