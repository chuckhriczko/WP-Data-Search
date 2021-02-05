<?php
//Namespace our code for our application
namespace WPDataSearch\Plugin;

//Include our PostTypes namespace
use \WPDataSearch\PostTypes\PostType as PostType;

//Instantiate our class
class Core {
    /**********************************************************************************
     * Constructor, calls the init function
     * ********************************************************************************/
    public function __construct(){
        //Call our plugin initialization function
        self::init();
    }
    
    /**********************************************************************************
     * Initializes our plugin (hooks, filters, etc)
     * ********************************************************************************/
    public static function init(){
        //Create our custom post type
        self::initCustomPostTypes();
    }
    
    /**********************************************************************************
     * Creates our custom post type(s)
     * ********************************************************************************/
    protected static function initCustomPostTypes(){
        //Instantiate our custom post type object
        $cptWPDS = new PostType('wpds');
        
        //Set our custom post type properties
        $cptWPDS->set_singular_name('Writing');
        $cptWPDS->set_plural_name('Writings');
        $cptWPDS->set_menu_name('Writings');
        $cptWPDS->set_menu_icon('dashicons-database');
        $cptWPDS->set_slug('wpds');
        $cptWPDS->set_description('Writings from the universe');
        $cptWPDS->set_show_in_menu(true);
        $cptWPDS->set_public(true);
        
        //Register custom post type
        $cptWPDS->register();
    }
}
