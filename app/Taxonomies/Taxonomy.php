<?php
//Namespace our code for our application
namespace WPDataSearch\Taxonomies;


//Instantiate our class
class Taxonomy implements TaxonomyInterface {
    //Declare our class variables
    //const 
    
    //Init our class variables
    private string $taxonomyName = ''; //Name for the taxonomy
    private string $postType = ''; //Post type to which to add the taxonomy to
    private array $opts = [
        'name'          => '', //Plural name for the taxonomy
        'slug'          => '', //Slug for the taxonomy
        'singular_name' => '', //Singular name for the taxonomy
        'description'   => '', //Description for the taxonomy
        'labels'        => [ //Labels for the taxonomy
            'name'              => '',
            'singular_name'     => '',
            'menu_name'         => '',
            'parent_item'       => null,
            'parent_item_colon' => null
        ], 
        'hierarchical'      => true, //Whether the menu shows hierarchically
        'public'            => true, //Whether or not the taxonomy shows publically
        'show_in_menu'      => true, //Whether or not the taxonomy shows in the menu
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_tagcloud'     => true
    ];
    
    /**********************************************************************************
     * Constructor, calls the init function
     * ********************************************************************************/
    public function __construct(string $taxonomyName = '', string $postType = '', array $opts = []){
        //Call our plugin initialization function
        $this->init($taxonomyName, $postType, $opts);
    }
    
    /**********************************************************************************
     * Initializes our custom taxonomy
     * ********************************************************************************/
    public function init(string $taxonomyName = '', $postType = '', array $opts = []){
        //Process our optional data
        $opts['singular_name'] ??= $taxonomyName;
        $opts['name'] ??= $taxonomyName;
        $opts['slug'] ??= $taxonomyName;
        $opts['labels']['name'] ??= $taxonomyName;
        $opts['labels']['singular_name'] ??= $taxonomyName;
        $opts['labels']['menu_name'] ??= $taxonomyName;
        
        //Init our default values by merging the array with the one passed
        //Any duplicate values will be overwritten
        $this->opts = array_merge($this->opts, $opts);
        
        //Initialize our custom taxonomy name
        $this->taxonomyName = $taxonomyName;
        
        //Initialize our post type name
        $this->postType = $postType;
    }
    
    /**********************************************************************************
     * Registers our custom taxonomy
     * ********************************************************************************/
    public function register(){
        //Register our custom taxonomy
        add_action('init', function(){
            //Register custom taxonomy
            register_taxonomy($this->taxonomyName,  $this->postType, $this->opts);
        });
    }
    
    /**********************************************************************************
     * Getters and setters for our custom taxonomy properties
     * ********************************************************************************/
    public function setTaxonomyName(string $taxonomyName = ''){ $this->taxonomyName = $taxonomyName; }
    public function getTaxonomyName(): string { return $this->taxonomyName; }
    public function setSingularName(string $singular_name = ''){
        $this->opts['singular_name'] = $singular_name;
        $this->opts['labels']['singular_name'] = $singular_name;
    }
    public function getSingularName(): string{ return $this->opts['$singular_name']; }
    public function setPluralName(string $plural_name = ''){
        $this->opts['name'] = $plural_name;
        $this->opts['labels']['name'] = $plural_name;
    }
    public function getPluralName(): string{ return $this->opts['plural_name']; }
    public function getMenuName(): string{ return $this->opts['$singular_name']; }
    public function setMenuName(string $menu_name = ''){
        $this->opts['labels']['menu_name'] = $menu_name;
    }
    public function setSlug(string $slug = ''){ $this->opts['slug'] = $slug; }
    public function getSlug(): string{ return $this->opts['slug']; }
    public function setDescription(string $description = ''){ $this->opts['description'] = $description; }
    public function getDescription(): string{ return $this->opts['description']; }
    public function setLabels(string $lblSearchItems = '', string $lblPopularItems = '', string $lblAllItems = '', string $lblEditItem = '', string $lblUpdateItem = '', string $lblAddNewItem = '', string $lblNewItemName = '', string $lblMenuName = ''){
        if (!empty($lblSearchItems)) $this->opts['labels']['search_items'] = $lblSearchItems;
        if (!empty($lblPopularItems)) $this->opts['labels']['popular_items'] = $lblPopularItems;
        if (!empty($lblAllItems)) $this->opts['labels']['all_items'] = $lblAllItems;
        if (!empty($lblEditItem)) $this->opts['labels']['edit_item'] = $lblEditItem;
        if (!empty($lblUpdateItem)) $this->opts['labels']['update_item'] = $lblUpdateItem;
        if (!empty($lblAddNewItem)) $this->opts['labels']['view_items'] = $lblAddNewItem;
        if (!empty($lblNewItemName)) $this->opts['labels']['search_items'] = $lblNewItemName;
        if (!empty($lblMenuName)) $this->opts['labels']['not_found'] = $lblMenuName;
    }
    public function getLabels(): array{ return $this->opts['labels']; }
    public function setHierarchical(bool $isHierarchical = true){ $this->opts['hierarchical'] = $isHierarchical; }
    public function getHierarchical(): bool{ return $this->opts['hierarchical']; }
    public function setPublic(bool $isPublic = true){ $this->opts['public'] = $isPublic; }
    public function getPublic(): bool{ return $this->opts['public']; }
    public function setShowInMenu(bool $isShowInMenu = true){ $this->opts['show_in_menu'] = $isShowInMenu; }
    public function getShowInMenu(): bool{ return $this->opts['show_in_menu']; }
    public function setTaxonomies(array $taxonomies = array()){ $this->opts['taxonomies'] = $taxonomies; }
    public function getTaxonomies(): array { return $this->opts['taxonomies']; }
}
