<?php
//Namespace our code for our application
namespace WPDataSearch\Admin;


//Instantiate our class
class Columns {
    //Instantiate our class variables
    private static string $postTypeName = ''; //Post type for the columns we are modifying
    private static array $cols = []; //Array of all of our columns
    
    /**********************************************************************************
     * Constructor, calls the init function
     * ********************************************************************************/
    public function __construct(string $postTypeName = ''){
        //Call our initialization function if it is not called immediately (PHP5 style)
        self::init($postTypeName);
    }
    
    /**********************************************************************************
     * Initializes our custom post type
     * ********************************************************************************/
    public static function init(string $postTypeName = ''){
        //Set our post type
        self::$postTypeName = $postTypeName;
        
        //Perform first run initialization our columns
        self::initCols();
    }
    
    /**********************************************************************************
     * Sets our columns
     * ********************************************************************************/
    public static function setCols(array $cols = []){
        //Set all of our columns
        self::$cols = $cols;
    }
    
    /**********************************************************************************
     * Gets our columns
     * ********************************************************************************/
    public static function getCols(): array {
        //Return our columns array
        return self::$cols;
    }
    
    /**********************************************************************************
     * Gets a single column
     * ********************************************************************************/
    public static function getCol(string $assocIndex = ''): array {
        //Return our column, if it exists
        return isset(self::$cols[$assocIndex]) ? self::$cols[$assocIndex] : [];
    }
    
    /**********************************************************************************
     * Adds a column
     * ********************************************************************************/
    public static function addCol(string $assocIndex = '', string $assocContent = '') {
        //Add column to columns array if it does not already exist
        if (!empty($assocIndex) && !isset(self::$cols[$assocIndex])) self::$cols[$assocIndex] = $assocContent;
    }
    
    /**********************************************************************************
     * Removes a column
     * ********************************************************************************/
    public static function removeCol(string $assocIndex = '') {
        //If the associative index exists, remove it
        if (!empty($assocIndex) && isset(self::$cols[$assocIndex])) unset(self::$cols[$assocIndex]);
    }
    
    /**********************************************************************************
     * Updates a column
     * ********************************************************************************/
    public static function updateCol(string $assocIndex = '', string $assocContent = '') {
        //If the column exists, update the assocContent
        if (!empty($assocIndex) && isset(self::$cols[$assocIndex])) self::$cols[$assocIndex] = $assocContent;
    }
    
    /**********************************************************************************
     * Initializes our columns management filter
     * ********************************************************************************/
    public static function initCols() {
        //Add the filter for adding and removing columns
        add_filter('manage_'.self::$postTypeName.'_posts_columns', function($columns){
            //If our class columns variable is empty, this is our first run so we
            //must set our columns variable
            //self::$cols = empty(self::$cols) ? $columns : self::$cols;
error_log(print_r(self::$cols,true));
            //Return the passed columns if our columns are empty
            return self::$cols;
        });
        apply_filters('manage_'.self::$postTypeName.'_posts_columns', '');
    }
    
    /**********************************************************************************
     * Applies our column filters
     * ********************************************************************************/
    public static function applyCols() {
        error_log(print_r(self::$cols,true));
        //Apply our column filters
        apply_filters('manage_'.self::$postTypeName.'_posts_columns', '');
    }
}