<?php
//Namespace our code for our application
namespace WPDataSearch\Taxonomies;

//Instantiate our class
interface TaxonomyInterface {
    public function setTaxonomyName(string $taxonomyName);
    public function getTaxonomyName() : string;
    public function setSingularName(string $singular_name);
    public function getSingularName() : string;
    public function setPluralName(string $plural_name);
    public function getPluralName() : string;
    public function setMenuName(string $menu_name);
    public function getMenuName() : string;
    public function setSlug(string $slug);
    public function getSlug() : string;
    public function setDescription(string $description);
    public function getDescription() : string;
    public function setLabels(string $lblSearchItems, string $lblPopularItems, string $lblAllItems, string $lblEditItem, string $lblUpdateItem, string $lblAddNewItem, string $lblNewItemName, string $lblMenuName);
    public function getLabels() : array;
    public function setHierarchical(bool $isHierarchical);
    public function getHierarchical() : bool;
    public function setPublic(bool $isPublic);
    public function getPublic() : bool;
    public function setShowInMenu(bool $isShowInMenu);
    public function getShowInMenu() : bool;
    public function setTaxonomies(array $taxonomies = array());
    public function getTaxonomies() : array;
}