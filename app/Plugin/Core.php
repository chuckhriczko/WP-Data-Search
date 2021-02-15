<?php
//Namespace our code for our application
namespace WPDataSearch\Plugin;

//Include our PostTypes namespace
use \WPDataSearch\PostTypes\PostType as PostType;

//Include our taxonomies namespace
use \WPDataSearch\Taxonomies\Taxonomy as Taxonomy;

//Include our taxonomies namespace
use \WPDataSearch\Admin\Columns as Columns;

//Instantiate our class
class Core {
    //Instantiate our custom post type constant
    private static string $WPDS_POST_TYPE = 'wpds';
    private static string $WPDS_POST_TYPE_NAME = 'Writing';
    private static string $WPDS_POST_TYPE_NAME_PLURAL = 'Writings';
    private static string $WPDS_TAXONOMY_NAME = 'Astrotags';
    
    //Create our instance variables
    private static $taxAstrology = null;
    private static $cptWPDS = null;
    private static $cptWPDSCols = null;
    
    /**********************************************************************************
     * Constructor, calls the init function
     * ********************************************************************************/
    public function __construct(){
        //Call our plugin initialization function
        self::init();
    }
    
    /**********************************************************************************
     * Getter for the post type, used by other classes
     * ********************************************************************************/
    public static function getPostType(){
        return self::$WPDS_POST_TYPE;
    }
    
    /**********************************************************************************
     * Initializes our plugin (hooks, filters, etc)
     * ********************************************************************************/
    public static function init(){
        //Create our custom taxonomy
        self::initCustomTaxonomy();
        
        //Create our custom post type
        self::initCustomPostType();
        
        //Manage our columns for our admin page
        //self::initColumns();
    }
    
    /**********************************************************************************
     * Creates our custom taxonomies
     * ********************************************************************************/
    private static function initCustomTaxonomy(){
        //Instantiate our custom taxonomy object
        self::$taxAstrology = new Taxonomy(self::$WPDS_TAXONOMY_NAME, self::$WPDS_POST_TYPE);
        
        //Set our taxonomy's properties
        self::$taxAstrology->setSingularName(self::$WPDS_TAXONOMY_NAME);
        self::$taxAstrology->setPluralName(self::$WPDS_TAXONOMY_NAME);
        self::$taxAstrology->setMenuName(self::$WPDS_TAXONOMY_NAME);
        self::$taxAstrology->setLabels('Search '.self::$WPDS_POST_TYPE_NAME_PLURAL, 'Popular '.self::$WPDS_POST_TYPE_NAME_PLURAL, 'All '.self::$WPDS_POST_TYPE_NAME_PLURAL, 'Edit '.self::$WPDS_POST_TYPE_NAME, 'Update '.self::$WPDS_POST_TYPE_NAME, 'Add New '.self::$WPDS_POST_TYPE_NAME, 'New '.self::$WPDS_POST_TYPE_NAME.' Name');
        self::$taxAstrology->setDescription(self::$WPDS_POST_TYPE_NAME_PLURAL);
        self::$taxAstrology->setShowInMenu(true);
        self::$taxAstrology->setPublic(true);
        self::$taxAstrology->setHierarchical(false);
        
        //Finally, we register our new taxonomy
        self::$taxAstrology->register();
    }
    
    /**********************************************************************************
     * Creates our custom post type(s)
     * ********************************************************************************/
    private static function initCustomPostType(){
        //Instantiate our custom post type object
        self::$cptWPDS = new PostType(self::$WPDS_POST_TYPE);
        
        //Set our custom post type properties
        self::$cptWPDS->setSingularName(self::$WPDS_POST_TYPE_NAME);
        self::$cptWPDS->setPluralName(self::$WPDS_POST_TYPE_NAME_PLURAL);
        self::$cptWPDS->setMenuName(self::$WPDS_POST_TYPE_NAME_PLURAL);
        self::$cptWPDS->setLabels('Add New', 'Add New '.self::$WPDS_POST_TYPE_NAME, 'Edit '.self::$WPDS_POST_TYPE_NAME, 'New '.self::$WPDS_POST_TYPE_NAME, 'All '.self::$WPDS_POST_TYPE_NAME_PLURAL, 'View '.self::$WPDS_POST_TYPE_NAME_PLURAL, 'Search '.self::$WPDS_POST_TYPE_NAME_PLURAL, 'No '.strtolower(self::$WPDS_POST_TYPE_NAME_PLURAL).' found', 'No '.strtolower(self::$WPDS_POST_TYPE_NAME_PLURAL).' found in the trash');
        self::$cptWPDS->setMenuIcon('dashicons-welcome-write-blog');
        self::$cptWPDS->setSlug(self::$WPDS_POST_TYPE);
        self::$cptWPDS->setDescription('Writings from the universe');
        self::$cptWPDS->setShowInMenu(true);
        self::$cptWPDS->setPublic(true);
        self::$cptWPDS->setTaxonomies([self::$WPDS_POST_TYPE]);
        
        //Register custom post type
        self::$cptWPDS->register();
    }
    
    /**********************************************************************************
     * Creates our custom post type columns
     * ********************************************************************************/
    private static function initColumns(){
      //Initialize our custom post type column management
      self::$cptWPDSCols = new Columns(self::$WPDS_POST_TYPE);
      
      //Remove our title
      self::$cptWPDSCols->removeCol('title');
      
      //Add our content column
      self::$cptWPDSCols->addCol('content', 'Content');
      
      //Initialize our columns
      self::$cptWPDSCols->applyCols();
    }
}
