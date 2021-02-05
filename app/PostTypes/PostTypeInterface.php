<?php
//Namespace our code for our application
namespace WPDataSearch\PostTypes;

//Instantiate our class
interface PostTypeInterface {
    public function set_post_type_name(string $postTypeName);
    public function get_post_type_name() : string;
    public function set_singular_name(string $singular_name);
    public function get_singular_name() : string;
    public function set_plural_name(string $plural_name);
    public function get_plural_name() : string;
    public function set_menu_name(string $menu_name);
    public function get_menu_name() : string;
    public function set_slug(string $slug);
    public function get_slug() : string;
    public function set_description(string $description);
    public function get_description() : string;
    public function set_filters(string $filters);
    public function get_filters() : string;
    public function set_menu_icon(string $menu_icon);
    public function get_menu_icon() : string;
    public function set_menu_position(int $menu_position);
    public function get_menu_position() : int;
    public function set_labels(array $labels);
    public function get_labels() : array;
    public function set_taxonomies(array $taxonomies);
    public function get_taxonomies() : array;
    public function set_hierarchical(bool $isHierarchical);
    public function get_hierarchical() : bool;
    public function set_public(bool $isPublic);
    public function get_public() : bool;
    public function set_show_in_menu(bool $isShowInMenu);
    public function get_show_in_menu() : bool;
}