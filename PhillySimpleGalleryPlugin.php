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
define('PHILLY_SIMPLE_GALLERY_PAGE_PATH', 'gallery/');
define('PHILLY_SIMPLE_GALLERY_PAGE_TITLE', 'Gallery');
define('PHILLY_SIMPLE_GALLERY_PAGE_INSTRUCTIONS', 'Include an introduction for the page here.');
define('PHILLY_SIMPLE_GALLERY_ADD_TO_MAIN_NAVIGATION', 1);


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
        set_option('philly_simple_gallery_page_title', PHILLY_SIMPLE_GALLERY_PAGE_TITLE);
        set_option('philly_simple_gallery_page_instructions', PHILLY_SIMPLE_GALLERY_PAGE_INSTRUCTIONS);    
        set_option('philly_simple_gallery_add_to_main_navigation', PHILLY_SIMPLE_GALLERY_ADD_TO_MAIN_NAVIGATION);    
    }

    public function hookUninstall()
    {
        delete_option('philly_simple_gallery_page_title');
        delete_option('philly_simple_gallery_page_instructions');
        delete_option('philly_simple_gallery_add_to_main_navigation');    
    }


    function hookDefineRoutes($args)
    {
        $router = $args['router'];
        $router->addRoute(
            'philly_simple_gallery_form_form', 
            new Zend_Controller_Router_Route(
                PHILLY_SIMPLE_GALLERY_PAGE_PATH, 
                array('module'       => 'philly-simple-gallery')
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
        set_option('philly_simple_gallery_page_title', $post['gallery_page_title']);
        set_option('philly_simple_gallery_page_instructions',$post['gallery_page_instructions']);
        set_option('philly_simple_gallery_add_to_main_navigation', $post['add_to_main_navigation']);
    }

    public function filterPublicNavigationMain($nav)
    {
        $gallery_title = get_option('philly_simple_gallery_page_title');
        $gallery_add_to_navigation = get_option('philly_simple_gallery_add_to_main_navigation');
        if ($gallery_add_to_navigation) {
                $nav[] = array(
                    'label'   => $gallery_title,
                    'uri'     => url(array(),'philly_simple_gallery_form_form'),
                    'visible' => true
                );
        }
        return $nav;
    }
}
