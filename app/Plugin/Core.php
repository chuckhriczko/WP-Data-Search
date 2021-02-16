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
    private string $wpdsPostType = 'wpds';
    private string $wpdsPostTypeName = 'Writing';
    private string $wpdsPostTypeNamePlural = 'Writings';
    private string $wpdsTaxonomyName = 'Astrotags';
    
    //Create our instance variables
    private $taxAstrology = null;
    private $cptWPDS = null;
    private $cptWPDSCols = null;
    
    /**********************************************************************************
     * Initializes our plugin (hooks, filters, etc)
     * ********************************************************************************/
    public function __construct(){
        //Create our custom taxonomy
        $this->initCustomTaxonomy();
        
        //Create our custom post type
        $this->initCustomPostType();
        
        //Manage our columns for our admin page
        $this->initColumns();
    }
    
    /**********************************************************************************
     * Getter for the post type, used by other classes
     * ********************************************************************************/
    public function getPostType(){
        return $this->wpdsPostType;
    }
    
    /**********************************************************************************
     * Creates our custom taxonomies
     * ********************************************************************************/
    private function initCustomTaxonomy(){
        //Instantiate our custom taxonomy object
        $this->taxAstrology = new Taxonomy($this->wpdsTaxonomyName, $this->wpdsPostType);
        
        //Set our taxonomy's properties
        $this->taxAstrology->setSingularName($this->wpdsTaxonomyName);
        $this->taxAstrology->setPluralName($this->wpdsTaxonomyName);
        $this->taxAstrology->setMenuName($this->wpdsTaxonomyName);
        $this->taxAstrology->setLabels('Search '.$this->wpdsPostTypeNamePlural, 'Popular '.$this->wpdsPostTypeNamePlural, 'All '.$this->wpdsPostTypeNamePlural, 'Edit '.$this->wpdsPostTypeName, 'Update '.$this->wpdsPostTypeName, 'Add New '.$this->wpdsPostTypeName, 'New '.$this->wpdsPostTypeName.' Name');
        $this->taxAstrology->setDescription($this->wpdsPostTypeNamePlural);
        $this->taxAstrology->setShowInMenu(true);
        $this->taxAstrology->setPublic(true);
        $this->taxAstrology->setHierarchical(false);
        
        //Finally, we register our new taxonomy
        $this->taxAstrology->register();
    }
    
    /**********************************************************************************
     * Creates our custom post type(s)
     * ********************************************************************************/
    private function initCustomPostType(){
        //Instantiate our custom post type object
        $this->cptWPDS = new PostType($this->wpdsPostType);
        
        //Set our custom post type properties
        $this->cptWPDS->setSingularName($this->wpdsPostTypeName);
        $this->cptWPDS->setPluralName($this->wpdsPostTypeNamePlural);
        $this->cptWPDS->setMenuName($this->wpdsPostTypeNamePlural);
        $this->cptWPDS->setLabels('Add New', 'Add New '.$this->wpdsPostTypeName, 'Edit '.$this->wpdsPostTypeName, 'New '.$this->wpdsPostTypeName, 'All '.$this->wpdsPostTypeNamePlural, 'View '.$this->wpdsPostTypeNamePlural, 'Search '.$this->wpdsPostTypeNamePlural, 'No '.strtolower($this->wpdsPostTypeNamePlural).' found', 'No '.strtolower($this->wpdsPostTypeNamePlural).' found in the trash');
        $this->cptWPDS->setMenuIcon('dashicons-welcome-write-blog');
        $this->cptWPDS->setSlug($this->wpdsPostType);
        $this->cptWPDS->setDescription('Writings from the universe');
        $this->cptWPDS->setShowInMenu(true);
        $this->cptWPDS->setPublic(true);
        $this->cptWPDS->setTaxonomies([$this->wpdsPostType]);
        $this->cptWPDS->removeSupports(['title']);
        
        //Register custom post type
        $this->cptWPDS->register();
    }
    
    /**********************************************************************************
     * Creates our custom post type columns
     * ********************************************************************************/
    private function initColumns(){
      //Initialize our custom post type column management
      $this->cptWPDSCols = new Columns($this->wpdsPostType);
      
      //Remove our title
      $this->cptWPDSCols->removeColumn('title');
      
      //Add our content column
      $this->cptWPDSCols->addColumn('content', 'Content', 2);
      
      //Add our content column content
      $this->cptWPDSCols->addColumnPostContent('content');
      
      //Add our content column content
      $this->cptWPDSCols->addColumnOptionData('content', 'site_url');
      
      //Reposition column
      $this->cptWPDSCols->reorderColumn('content', 1);
    }
}
