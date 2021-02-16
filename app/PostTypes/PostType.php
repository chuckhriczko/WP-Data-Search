<?php
//Namespace our code for our application
namespace WPDataSearch\PostTypes;


//Instantiate our class
class PostType implements PostTypeInterface {
    //Init our class variables
    private string $postTypeName = ''; //Name for the post type
    private array $opts = [
        'name'          => '', //Plural name for the post type
        'singular_name' => '', //Singular name for the post type
        'description'   => '', //Description for the post type
        'slug'          => '', //Slug for the post type
        'filters'       => '', //Filters for the post type
        'menu_icon'     => '', //Icon for the post type menu item
        'menu_position' => null, //Menu position for the menu item
        'labels'        => [
            'name'          => '',
            'singular_name' => '',
            'menu_name'     => ''
        ], //Labels for the post type
        'taxonomies'    => [], //Taxonomies for the post type
        'hierarchical'  => true, //Whether the menu shows hierarchically
        'public'        => true, //Whether or not the post type shows publically
        'show_in_menu'  => true, //Whether or not the post type shows in the menu
        'supports'      => ['title', 'editor'] //Determines which fields are available in post edit screen
    ];
    
    /**********************************************************************************
     * Constructor, calls the init function
     * ********************************************************************************/
    public function __construct(string $postTypeName = '', array $opts = []){
        //Call our plugin initialization function
        $this->init($postTypeName, $opts);
    }
    
    /**********************************************************************************
     * Initializes our custom post type
     * ********************************************************************************/
    public function init(string $postTypeName = '', array $opts = []){
        //Process our optional data
        $opts['singular_name'] ??= $postTypeName;
        $opts['name'] ??= $postTypeName;
        $opts['slug'] ??= $postTypeName;
        $opts['labels']['name'] ??= $postTypeName;
        $opts['labels']['singular_name'] ??= $postTypeName;
        $opts['labels']['menu_name'] ??= $postTypeName;
        
        //Init our default values by merging the array with the one passed
        //Any duplicate values will be overwritten
        $this->opts = array_merge($this->opts, $opts);
        
        //Initialize our custom post type name
        $this->postTypeName = $postTypeName;
    }
    
    /**********************************************************************************
     * Registers our custom post type
     * ********************************************************************************/
    public function register(){
        //Register our custom post type
        add_action('init', function(){
            //echo '<pre>'.print_r($this->opts,true).'</pre>';
            //Register custom post type
            register_post_type($this->postTypeName, $this->opts);
        });
    }
    
    /**********************************************************************************
     * Getters and setters for our custom post type properties
     * ********************************************************************************/
    public function setPostTypeName(string $postTypeName = ''){ $this->postTypeName = $postTypeName; }
    public function getPostTypeName(): string { return $this->postTypeName; }
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
    public function setFilters(string $filters = ''){ $this->opts['filters'] = $filters; }
    public function getFilters(): string{ return $this->opts['filters']; }
    public function setMenuIcon(string $menu_icon = ''){ $this->opts['menu_icon'] = $menu_icon; }
    public function getMenuIcon(): string{ return $this->opts['menu_icon']; }
    public function setMenuPosition(int $menu_position = null){ $this->opts['menu_position'] = $menu_position; }
    public function getMenuPosition(): int{ return $this->opts['menu_position']; }
    public function setLabels(string $lblAddNew = '', string $lblAddNewItem = '', string $lblEditItem = '', string $lblNewItem = '', string $lblAllItems = '', string $lblViewItems = '', string $lblSearchItems = '', string $lblNotFound = '', string $lblNotFoundInTrash = ''){
        if (!empty($lblAddNew)) $this->opts['labels']['add_new'] = $lblAddNew;
        if (!empty($lblAddNewItem)) $this->opts['labels']['add_new_item'] = $lblAddNewItem;
        if (!empty($lblEditItem)) $this->opts['labels']['edit_item'] = $lblEditItem;
        if (!empty($lblNewItem)) $this->opts['labels']['new_item'] = $lblNewItem;
        if (!empty($lblAllItems)) $this->opts['labels']['all_items'] = $lblAllItems;
        if (!empty($lblViewItems)) $this->opts['labels']['view_items'] = $lblViewItems;
        if (!empty($lblSearchItems)) $this->opts['labels']['search_items'] = $lblSearchItems;
        if (!empty($lblNotFound)) $this->opts['labels']['not_found'] = $lblNotFound;
        if (!empty($lblNotFoundInTrash)) $this->opts['labels']['not_found_in_trash'] = $lblNotFoundInTrash;
        
    }
    public function getLabels(): array{ return $this->opts['labels']; }
    public function setTaxonomies(array $taxonomies = []){ $this->opts['taxonomies'] = $taxonomies; }
    public function getTaxonomies(): array{ return $this->opts['taxonomies']; }
    public function setHierarchical(bool $isHierarchical = true){ $this->opts['hierarchical'] = $isHierarchical; }
    public function getHierarchical(): bool{ return $this->opts['hierarchical']; }
    public function setPublic(bool $isPublic = true){ $this->opts['public'] = $isPublic; }
    public function getPublic(): bool{ return $this->opts['public']; }
    public function setShowInMenu(bool $isShowInMenu = true){ $this->opts['show_in_menu'] = $isShowInMenu; }
    public function getShowInMenu(): bool{ return $this->opts['show_in_menu']; }
    public function addSupports(array $supports = []){ $this->opts['supports'] = array_merge($this->opts['supports'], $supports); }
    public function removeSupports(array $supports = []){
        //Loop through supports
        foreach($supports as $key=>$support){
            //Search through array
            $index = array_search($support, $this->opts['supports']);
            
            //If found, remove the support
            if (is_numeric($index)) unset($this->opts['supports'][$index]);
        }
        
    }
    public function getSupports(): array{ return $this->opts['supports']; }
}
