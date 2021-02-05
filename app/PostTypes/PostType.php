<?php
//Namespace our code for our application
namespace WPDataSearch\PostTypes;

//Include our utilities namespace
use WPDataSearch\Plugin\Utils as Utils;

//Instantiate our class
class PostType implements \WPDataSearch\PostTypes\PostTypeInterface {
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
                            [
                                'name' =>       '',
                                'singular_name' => '',
                                'menu_name'     => ''
                            ]
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
     * Initializes our plugin (hooks, filters, etc)
     * ********************************************************************************/
    public static function init(string $postTypeName = '', array $opts = []){
        //Process our optional data
        $opts['singular_name'] ??= $postTypeName;
        $opts['name'] ??= $postTypeName;
        $opts['slug'] ??= $postTypeName;
        $opts['labels'][0]['name'] ??= $postTypeName;
        $opts['labels'][0]['singular_name'] ??= $postTypeName;
        $opts['labels'][0]['menu_name'] ??= $postTypeName;
        
        //Init our default values by merging the array with the one passed
        //Any duplicate values will be overwritten
        self::$opts = array_merge(self::$opts, $opts);
        
        //Initialize our custom post type name
        self::$postTypeName = $postTypeName;
    }
    
    /**********************************************************************************
     * Initializes our plugin (hooks, filters, etc)
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
    public function set_post_type_name(string $postTypeName = ''){ self::$postTypeName = $postTypeName; }
    public function get_post_type_name(): string { return self::$postTypeName; }
    public function set_singular_name(string $singular_name = ''){
        self::$opts['singular_name'] = $singular_name;
        self::$opts['labels']['singular_name'] = $singular_name;
    }
    public function get_singular_name(): string{ return self::$opts['$singular_name']; }
    public function set_plural_name(string $plural_name = ''){
        self::$opts['name'] = $plural_name;
        self::$opts['labels']['name'] = $plural_name;
    }
    public function get_plural_name(): string{ return self::$opts['plural_name']; }
    public function get_menu_name(): string{ return self::$opts['$singular_name']; }
    public function set_menu_name(string $menu_name = ''){
        self::$opts['labels']['menu_name'] = $menu_name;
    }
    public function set_slug(string $slug = ''){ self::$opts['slug'] = $slug; }
    public function get_slug(): string{ return self::$opts['slug']; }
    public function set_description(string $description = ''){ self::$opts['description'] = $description; }
    public function get_description(): string{ return self::$opts['description']; }
    public function set_filters(string $filters = ''){ self::$opts['filters'] = $filters; }
    public function get_filters(): string{ return self::$opts['filters']; }
    public function set_menu_icon(string $menu_icon = ''){ self::$opts['menu_icon'] = $menu_icon; }
    public function get_menu_icon(): string{ return self::$opts['menu_icon']; }
    public function set_menu_position(int $menu_position = null){ self::$opts['menu_position'] = $menu_position; }
    public function get_menu_position(): int{ return self::$opts['menu_position']; }
    public function set_labels(string $lblAddNew = '', string $lblAddNewItem = '', string $lblEditItem = '', string $lblNewItem = '', string $lblAllItems = '', string $lblViewItems = '', string $lblSearchItems = '', string $lblNotFound = '', string $lblNotFoundInTrash = ''){
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
    public function get_labels(): array{ return self::$opts['labels']; }
    public function set_taxonomies(array $taxonomies = []){ self::$opts['taxonomies'] = $taxonomies; }
    public function get_taxonomies(): array{ return self::$opts['taxonomies']; }
    public function set_hierarchical(bool $isHierarchical = true){ self::$opts['hierarchical'] = $isHierarchical; }
    public function get_hierarchical(): bool{ return self::$opts['hierarchical']; }
    public function set_public(bool $isPublic = true){ self::$opts['public'] = $isPublic; }
    public function get_public(): bool{ return self::$opts['public']; }
    public function set_show_in_menu(bool $isShowInMenu = true){ self::$opts['show_in_menu'] = $isShowInMenu; }
    public function get_show_in_menu(): bool{ return self::$opts['show_in_menu']; }
}
