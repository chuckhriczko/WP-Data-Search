<?php
//Namespace our code for our application
namespace WPDataSearch\PostTypes;


//Instantiate our class
class PostType implements PostTypeInterface {
    //Init our class variables
    private static string $postTypeName = ''; //Name for the post type
    private static array $opts = [
        'name'          => '', //Plural name for the post type
        'singular_name' => '', //Singular name for the post type
        'description'   => '', //Description for the post type
        'slug'          => '', //Slug for the post type
        'filters'       => '', //Filters for the post type
        'menu_icon'     => '', //Icon for the post type menu item
        'menu_position' => null, //Menu position for the menu item
        'labels'        => [
            'name' =>       '',
            'singular_name' => '',
            'menu_name'     => ''
        ], //Labels for the post type
        'taxonomies'    => [], //Taxonomies for the post type
        'hierarchical'  => true, //Whether the menu shows hierarchically
        'public'        => true, //Whether or not the post type shows publically
        'show_in_menu'  => true //Whether or not the post type shows in the menu
    ];
    
    /**********************************************************************************
     * Constructor, calls the init function
     * ********************************************************************************/
    public function __construct(string $postTypeName = '', array $opts = []){
        //Call our plugin initialization function
        self::init($postTypeName, $opts);
    }
    
    /**********************************************************************************
     * Initializes our custom post type
     * ********************************************************************************/
    public static function init(string $postTypeName = '', array $opts = []){
        //Process our optional data
        $opts['singular_name'] ??= $postTypeName;
        $opts['name'] ??= $postTypeName;
        $opts['slug'] ??= $postTypeName;
        $opts['labels']['name'] ??= $postTypeName;
        $opts['labels']['singular_name'] ??= $postTypeName;
        $opts['labels']['menu_name'] ??= $postTypeName;
        
        //Init our default values by merging the array with the one passed
        //Any duplicate values will be overwritten
        self::$opts = array_merge(self::$opts, $opts);
        
        //Initialize our custom post type name
        self::$postTypeName = $postTypeName;
    }
    
    /**********************************************************************************
     * Registers our custom post type
     * ********************************************************************************/
    public function register(){
        //Register our custom post type
        add_action('init', function(){
            //echo '<pre>'.print_r(self::$opts,true).'</pre>';
            //Register custom post type
            register_post_type(self::$postTypeName, self::$opts);
        });
    }
    
    /**********************************************************************************
     * Getters and setters for our custom post type properties
     * ********************************************************************************/
    public function setPostTypeName(string $postTypeName = ''){ self::$postTypeName = $postTypeName; }
    public function getPostTypeName(): string { return self::$postTypeName; }
    public function setSingularName(string $singular_name = ''){
        self::$opts['singular_name'] = $singular_name;
        self::$opts['labels']['singular_name'] = $singular_name;
    }
    public function getSingularName(): string{ return self::$opts['$singular_name']; }
    public function setPluralName(string $plural_name = ''){
        self::$opts['name'] = $plural_name;
        self::$opts['labels']['name'] = $plural_name;
    }
    public function getPluralName(): string{ return self::$opts['plural_name']; }
    public function getMenuName(): string{ return self::$opts['$singular_name']; }
    public function setMenuName(string $menu_name = ''){
        self::$opts['labels']['menu_name'] = $menu_name;
    }
    public function setSlug(string $slug = ''){ self::$opts['slug'] = $slug; }
    public function getSlug(): string{ return self::$opts['slug']; }
    public function setDescription(string $description = ''){ self::$opts['description'] = $description; }
    public function getDescription(): string{ return self::$opts['description']; }
    public function setFilters(string $filters = ''){ self::$opts['filters'] = $filters; }
    public function getFilters(): string{ return self::$opts['filters']; }
    public function setMenuIcon(string $menu_icon = ''){ self::$opts['menu_icon'] = $menu_icon; }
    public function getMenuIcon(): string{ return self::$opts['menu_icon']; }
    public function setMenuPosition(int $menu_position = null){ self::$opts['menu_position'] = $menu_position; }
    public function getMenuPosition(): int{ return self::$opts['menu_position']; }
    public function setLabels(string $lblAddNew = '', string $lblAddNewItem = '', string $lblEditItem = '', string $lblNewItem = '', string $lblAllItems = '', string $lblViewItems = '', string $lblSearchItems = '', string $lblNotFound = '', string $lblNotFoundInTrash = ''){
        if (!empty($lblAddNew)) self::$opts['labels']['add_new'] = $lblAddNew;
        if (!empty($lblAddNewItem)) self::$opts['labels']['add_new_item'] = $lblAddNewItem;
        if (!empty($lblEditItem)) self::$opts['labels']['edit_item'] = $lblEditItem;
        if (!empty($lblNewItem)) self::$opts['labels']['new_item'] = $lblNewItem;
        if (!empty($lblAllItems)) self::$opts['labels']['all_items'] = $lblAllItems;
        if (!empty($lblViewItems)) self::$opts['labels']['view_items'] = $lblViewItems;
        if (!empty($lblSearchItems)) self::$opts['labels']['search_items'] = $lblSearchItems;
        if (!empty($lblNotFound)) self::$opts['labels']['not_found'] = $lblNotFound;
        if (!empty($lblNotFoundInTrash)) self::$opts['labels']['not_found_in_trash'] = $lblNotFoundInTrash;
        
    }
    public function getLabels(): array{ return self::$opts['labels']; }
    public function setTaxonomies(array $taxonomies = []){ self::$opts['taxonomies'] = $taxonomies; }
    public function getTaxonomies(): array{ return self::$opts['taxonomies']; }
    public function setHierarchical(bool $isHierarchical = true){ self::$opts['hierarchical'] = $isHierarchical; }
    public function getHierarchical(): bool{ return self::$opts['hierarchical']; }
    public function setPublic(bool $isPublic = true){ self::$opts['public'] = $isPublic; }
    public function getPublic(): bool{ return self::$opts['public']; }
    public function setShowInMenu(bool $isShowInMenu = true){ self::$opts['show_in_menu'] = $isShowInMenu; }
    public function getShowInMenu(): bool{ return self::$opts['show_in_menu']; }
}
