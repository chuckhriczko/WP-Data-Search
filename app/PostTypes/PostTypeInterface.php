<?php
//Namespace our code for our application
namespace WPDataSearch\PostTypes;

//Instantiate our class
interface PostTypeInterface {
    public function setPostTypeName(string $postTypeName);
    public function getPostTypeName(): string;
    public function setSingularName(string $singular_name);
    public function getSingularName(): string;
    public function setPluralName(string $plural_name);
    public function getPluralName(): string;
    public function setMenuName(string $menu_name);
    public function getMenuName(): string;
    public function setSlug(string $slug);
    public function getSlug(): string;
    public function setDescription(string $description);
    public function getDescription(): string;
    public function setFilters(string $filters);
    public function getFilters(): string;
    public function setMenuIcon(string $menu_icon);
    public function getMenuIcon(): string;
    public function setMenuPosition(int $menu_position);
    public function getMenuPosition(): int;
    public function setLabels(string $lblAddNew, string $lblAddNewItem, string $lblEditItem, string $lblNewItem, string $lblAllItems, string $lblViewItems, string $lblSearchItems, string $lblNotFound, string $lblNotFoundInTrash);
    public function getLabels(): array;
    public function setTaxonomies(array $taxonomies);
    public function getTaxonomies(): array;
    public function setHierarchical(bool $isHierarchical);
    public function getHierarchical(): bool;
    public function setPublic(bool $isPublic);
    public function getPublic(): bool;
    public function setShowInMenu(bool $isShowInMenu);
    public function getShowInMenu(): bool;
    public function addSupports(array $supports = []);
    public function removeSupports(array $supports = []);
    public function getSupports(): array;
}