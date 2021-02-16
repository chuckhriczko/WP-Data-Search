<?php
//Namespace our code for our application
namespace WPDataSearch\Admin;

//Instantiate our class
class Columns {
    //Instantiate our class variables
    private string $postTypeName = ''; //Post type for the columns we are modifying
    private int $contentLength = 100; //The maximum length of content to be displayed
    
    /**********************************************************************************
     * Constructor, calls the init function
     * ********************************************************************************/
    public function __construct(string $postTypeName = ''){
        //Call our initialization function if it is not called immediately (PHP5 style)
        $this->init($postTypeName);
    }
    
    /**********************************************************************************
     * Initializes our custom post type
     * ********************************************************************************/
    public function init(string $postTypeName = ''){
        //Set our post type
        $this->postTypeName = $postTypeName;
    }
    
    /**********************************************************************************
     * Adds a column
     * ********************************************************************************/
    public function addColumn(string $assocIndex = '', string $assocLabel = '', int $pos = null) {
        //Add the filter for adding and removing columns
        add_filter('manage_'.$this->postTypeName.'_posts_columns', function($columns) use ($assocIndex, $assocLabel, $pos){
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
     * Adds action to add post content to columns
     * ********************************************************************************/
    public function addColumnPostContent(string $assocIndex = '') {
        add_action('manage_'.$this->postTypeName.'_posts_custom_column', function($columnKey, $postId) use ($assocIndex) {
            if ($columnKey==$assocIndex){
                //Get the current post object
                $post = get_post($postId);
                
                //Get the content
                $content = $post->post_content;
                
                //Cut the content
                substr($content, 0, $this->contentLength);
                
                //Display the content
                echo apply_filters('the_content', $content);
            }
        }, 10, 2);
    }
    
    /**********************************************************************************
     * Adds action to add post meta data to columns
     * ********************************************************************************/
    public function addColumnPostMeta(string $assocIndex = '', string $metaKey = '') {
        add_action('manage_'.$this->postTypeName.'_posts_custom_column', function($columnKey, $postId) use ($assocIndex, $metaKey) {
            if ($columnKey==$assocIndex){
                //Get the metadata from the post based on the meta_key field
                $meta = get_post_meta($postId, $metaKey, true);
                
                //Echo the metadata
                echo $meta;
            }
        }, 10, 2);
    }
    
    /**********************************************************************************
     * Adds action to add option meta data to columns
     * ********************************************************************************/
    public function addColumnOptionData(string $assocIndex = '', string $optionKey = '', string $defaultData = '') {
        add_action('manage_'.$this->postTypeName.'_posts_custom_column', function($columnKey, $postId) use ($assocIndex, $optionKey, $defaultData) {
            if ($columnKey==$assocIndex){
                //Get the metadata from the post based on the meta_key field
                $option = get_option($optionKey, $defaultData);
                
                //Echo the metadata
                echo $option;
            }
        }, 10, 2);
    }
    
    /**********************************************************************************
     * Adds action to add custom content to columns
     * ********************************************************************************/
    public function addColumnCustomContent(string $assocIndex = '', string $content = '') {
        add_action('manage_'.$this->postTypeName.'_posts_custom_column', function($columnKey, $postId) use ($assocIndex, $content) {
            echo $columnKey==$assocIndex ? $content : '';
        }, 10, 2);
    }
    
    /**********************************************************************************
     * Removes a column
     * ********************************************************************************/
    public function removeColumn(string $assocIndex = '') {
        //Add the filter for adding and removing columns
        add_filter('manage_'.$this->postTypeName.'_posts_columns', function($columns) use ($assocIndex){
            //Remove the column if it exists
            if (!empty($assocIndex) && isset($columns[$assocIndex])) unset($columns[$assocIndex]);
            
            //Return the passed columns if our columns are empty
            return $columns;
        });
    }
    
    /**********************************************************************************
     * Updates a column
     * ********************************************************************************/
    public function updateColumn(string $assocIndex = '', string $assocLabel = '') {
        //Add the filter for adding and removing columns
        add_filter('manage_'.$this->postTypeName.'_posts_columns', function($columns) use ($assocIndex, $assocLabel){
            //If the column exists, update the column label
            $columns[$assocIndex] = (!empty($assocIndex) && isset($columns[$assocIndex])) ? $assocLabel : $columns[$assocIndex];
            
            //Return the passed columns if our columns are empty
            return $columns;
        });
    }
    
    /**********************************************************************************
     * Reorders a column
     * ********************************************************************************/
    public function reorderColumn(string $assocIndex = '', int $pos = null) {
        //Add the filter for adding and removing columns
        add_filter('manage_'.$this->postTypeName.'_posts_columns', function($columns) use ($assocIndex, $pos){
            if (!empty($assocIndex)){
                //Instantiate our temporary columns array
                $newCols = [];
                
                //Instantiate our current column counter
                $colCurrent = 0;
                
                //Get the label of the column we want to reposition
                $colLabel= $columns[$assocIndex];
                
                //Get the number of columns that have been passed
                $colsCount = count($columns);
                
                //If our position is null, append to the end of the array
                $pos = (is_null($pos) || $pos>$colsCount) ? $colsCount : $pos;
                
                //Loop through columns
                foreach($columns as $key=>$col){
                    //If this is the specified position, add the new column
                    if ($colCurrent==$pos){
                        //Add the new item to the columns array
                        $newCols[$assocIndex] = $colLabel;
                        
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
}