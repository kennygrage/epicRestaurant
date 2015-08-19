<?php
    require_once "Cuisine.php";

    class Restaurant {
        private $restaurant_name;
        private $id;

        function __construct($restaurant_name, $id = null) {
            $this->restaurant_name = $restaurant_name;
            $this->id = $id;
        }

        function setRestaurantName($new_restaurant_name) {
            $this->restaurant_name = (string) $new_restaurant_name;
        }

        function getRestaurantName() {
            return $this->restaurant_name;
        }

        function getId() {
            return $this->id;
        }

        function getCuisines() {

        }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (restaurant_name) VALUES
                    ('{$this->getRestaurantName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $restaurant_name = $restaurant['restaurant_name'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($restaurant_name, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function find($search_id){
            $found_restaurant = null;
            $restaurant = Restaurant::getAll();
            foreach($restaurants as $restaurant){
                if ($id == $search_id) {
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }
    }
?>
