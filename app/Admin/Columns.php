<?php
//Namespace our code for our application
namespace WPDataSearch\Admin;

//Instantiate our class
class Columns {
    //Instantiate our class variables
    private static string $postTypeName = ''; //Post type for the columns we are modifying
    
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
    }
    
    /**********************************************************************************
     * Adds a column
     * ********************************************************************************/
    public static function addColumn(string $assocIndex = '', string $assocLabel = '', $pos = null) {
        //Add the filter for adding and removing columns
        add_filter('manage_'.self::$postTypeName.'_posts_columns', function($columns) use ($assocIndex, $assocLabel, $pos){
            if (!empty($assocIndex) && !isset($columns[$assocIndex])){
                //Instantiate our temporary columns array
                $newCols = [];
                
                //Instantiate our current column counter
                $colCurrent = 0;
                
                //Get the number of columns that have been passed
                $colsCount = count($columns);
                
                //If our position is null, append to the end of the array
                $pos = (is_null($pos) || $pos>$colsCount) ? $colsCount : $pos;
                
                //Loop through columns
                foreach($columns as $key=>$col){
                    //If this is the specified position, add the new column
                    if ($colCurrent==$pos){
                        //Add the new item to the columns array
                        $newCols[$assocIndex] = $assocLabel;
                        
                        //Increment our counter so we can continue adding items
                        $colCurrent++;
                    }
                    
                    //Regardless of the specified position, add the current element
                    $newCols[$key] = $col;
                    
                    //Increment our counter variable
                    $colCurrent++;
                }
                
                //Now that we have sorted the $newCols array, set it to be the contents of the $columns array
                $columns = $newCols;
            }
            
            //Return the passed columns if our columns are empty
            return $columns;
        });
    }
    
    /**********************************************************************************
     * Removes a column
     * ********************************************************************************/
    public static function removeColumn(string $assocIndex = '') {
        //Add the filter for adding and removing columns
        add_filter('manage_'.self::$postTypeName.'_posts_columns', function($columns) use ($assocIndex){
            //Remove the column if it exists
            if (!empty($assocIndex) && isset($columns[$assocIndex])) unset($columns[$assocIndex]);
            
            //Return the passed columns if our columns are empty
            return $columns;
        });
    }
    
    /**********************************************************************************
     * Updates a column
     * ********************************************************************************/
    public static function updateColumn(string $assocIndex = '', string $assocLabel = '') {
        //Add the filter for adding and removing columns
        add_filter('manage_'.self::$postTypeName.'_posts_columns', function($columns) use ($assocIndex, $assocLabel){
            //If the column exists, update the column label
            $columns[$assocIndex] = (!empty($assocIndex) && isset($columns[$assocIndex])) ? $assocLabel : $columns[$assocIndex];
            
            //Return the passed columns if our columns are empty
            return $columns;
        });
    }
}