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
         
            $sql2 = "
            SELECT a.filterAttributeID, a.display_Name, c.category_Name, p.product_Type as attribute_Name
            FROM filter_attribute as a
            LEFT JOIN filter_category as c
            ON a.filterCategoryID = c.filterCategoryID
            LEFT JOIN filters_and_products as fp
            ON a.filterAttributeID = fp.filterAttributeID
            LEFT JOIN product as p
            ON fp.productID = p.productID
            WHERE a.filterCategoryID = c.filterCategoryID
            ";

            // $sql2 = "SELECT a.filterAttributeID a.attribute_Name, a.display_Name, c.category_Name, p.product_Type
            // -- // -- FROM filter_attribute as a
            // -- // -- LEFT JOIN filter_category as c
            // -- // -- ON a.filterCategoryID = c.filterCategoryID
            // -- // -- WHERE a.filterCategoryID = c.filterCategoryID
            // -- // -- ";

            $results = $this->mysqli()->query($sql2);
            $attributes = array();

            if($results) {
                while($row = $results->fetch_array()) {
                    $attributes[$row['filterAttributeID']] = $row;
                }
            }

        return $attributes;
    }

    public function deleteCategory($filterCategoryID)
    {   
        if (!empty($filterCategoryID)) {
            // $prepareStmt = $this->connect()->prepare("DELETE FROM filter_category WHERE filterCategoryID=?; ");
            // $prepareStmt->execute(array($filterCategoryID));

            header("Location:" . $_SERVER['PHP_SELF']);
        }
    }

    public function deleteAttribute($filterAttributeID)
    {   
        if (!empty($filterAttributeID)) {
            // $prepareStmt = $this->connect()->prepare("DELETE FROM filter_attribute WHERE filterAttributeID=?; ");
            // $prepareStmt->execute(array($filterAttributeID));

            header("Location:" . $_SERVER['PHP_SELF']);
        }
    }
}
