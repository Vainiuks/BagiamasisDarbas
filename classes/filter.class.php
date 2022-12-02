<?php 
require_once 'database.class.php';

class Filter extends Database {

    
    public function getCategories() {
        $sql1 = "
        SELECT filterCategoryID, category_Name, display_Category_Name
        FROM filter_category
        ";
 
            $results = $this->mysqli()->query($sql1);
    
            $categories = array();

            if ($results) {
                while ($row = $results->fetch_array()) {
                    $categories[$row['category_Name']] = $row;
                }
            }

        return $categories;
    }

    public function getAttributes() {
        
    $categories = $this->getCategories();
 
        // foreach($categories as $category => $value) {
            // $categoryID = $value['filterCategoryID'];

            $sql2 = "SELECT a.filterAttributeID, a.attribute_Name, a.display_Name, c.category_Name
            FROM filter_attribute as a
            LEFT JOIN filter_category as c
            ON a.filterCategoryID = c.filterCategoryID
            WHERE a.filterCategoryID = c.filterCategoryID
            ";

            $results = $this->mysqli()->query($sql2);
            $attributes = array();

            if($results) {
                while($row = $results->fetch_array()) {
                    $attributes[$row['filterAttributeID']] = $row;
                    // var_export($attributes);
                    // var_Export("|||||||||||||||||");
                                        // var_export($row['attribute_Name']);
                        // $attributes[$row['attribute_Name']] = $row;
                }
            }
        // }

        return $attributes;
    }
}