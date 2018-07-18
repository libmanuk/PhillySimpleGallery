<?php

/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Eric C. Weig, 2017
 * @package PhillySimpleGallery
 */

/**
 * PhillySimpleGallery plugin class
 *
 * @copyright Eric C. Weig, 2017
 * @package PhillySimpleGallery
 */
// Define Constants.
define('SIMPLE_SPLASH_FORM_PAGE_PATH', 'gallery/');
define('SIMPLE_SPLASH_FORM_SPLASH_PAGE_TITLE', 'Gallery');
define('SIMPLE_SPLASH_FORM_SPLASH_PAGE_INSTRUCTIONS', 'Include an introduction for the page here.');
define('SIMPLE_SPLASH_FORM_ADD_TO_MAIN_NAVIGATION', 1);


class PhillySimpleGalleryPlugin extends Omeka_Plugin_AbstractPlugin
{
    // Define Hooks
    protected $_hooks = array(
        'install',
        'uninstall',
        'define_routes',
        'config_form',
        'config'
    );

    //Add filters
    protected $_filters = array(
        'public_navigation_main'
    );

   public function hookInstall()
    {
        set_option('simple_splash_form_splash_page_title', SIMPLE_SPLASH_FORM_SPLASH_PAGE_TITLE);
        set_option('simple_splash_form_splash_page_instructions', SIMPLE_SPLASH_FORM_SPLASH_PAGE_INSTRUCTIONS);    
        set_option('simple_splash_form_add_to_main_navigation', SIMPLE_SPLASH_FORM_ADD_TO_MAIN_NAVIGATION);    
    }

    public function hookUninstall()
    {
        delete_option('simple_splash_form_splash_page_title');
        delete_option('simple_splash_form_splash_page_instructions');
        delete_option('simple_splash_form_add_to_main_navigation');    
    }


    function hookDefineRoutes($args)
    {
        $router = $args['router'];
        $router->addRoute(
            'simple_splash_form_form', 
            new Zend_Controller_Router_Route(
                SIMPLE_SPLASH_FORM_PAGE_PATH, 
                array('module'       => 'simple-splash-form')
            )
        );

    }

    public function hookConfigForm() 
    {
        include 'config_form.php';
    }

    public function hookConfig($args)
    {
        $post = $args['post'];
        set_option('simple_splash_form_splash_page_title', $post['splash_page_title']);
        set_option('simple_splash_form_splash_page_instructions',$post['splash_page_instructions']);
        set_option('simple_splash_form_add_to_main_navigation', $post['add_to_main_navigation']);
    }

    public function filterPublicNavigationMain($nav)
    {
        $splash_title = get_option('simple_splash_form_splash_page_title');
        $splash_add_to_navigation = get_option('simple_splash_form_add_to_main_navigation');
        if ($splash_add_to_navigation) {
                $nav[] = array(
                    'label'   => $splash_title,
                    'uri'     => url(array(),'simple_splash_form_form'),
                    'visible' => true
                );
        }
        return $nav;
    }
}
