<?php 
require_once 'database.class.php';

class Filter extends Database {


    public function getFilters() {
        

        $sql1 = "
        SELECT filterCategoryID, category_Name, display_Category_Name
        FROM filter_category
        ";

        $sql2 = "
        SELECT filterCategoryID, attribute_Name, display_Name
        FROM filter_attribute
        ";
            $sql = "
            SELECT category.category_Name, category.display_Category_Name, attribute.attribute_Name, attribute.display_Name
            FROM filter_category as category
            LEFT JOIN filter_attribute as attribute
            ON category.filterCategoryID = attribute.filterCategoryID
            WHERE category.filterCategoryID = attribute.filterCategoryID
            ";
    
            $results = $this->mysqli()->query($sql1);
            $results2 = $this->mysqli()->query($sql2);
    
            $filters = array();
            $attributes = array();
    
            if ($results) {
                while ($row = $results->fetch_array()) {
                    $filters[] = $row;
                }
            }

            if ($results2) {
                while ($row = $results->fetch_array()) {
                    foreach($filters as $filter => $value) {
                        if($value['filterCategoryID'] == $row['filterCategoryID']) {
                            $value['category_Name'][] = $row;
                        }
                    }
                }
            }

            // var_export($filters);
            // die();
    
            return $filters;
    }
}