<?php

namespace App\Service;


class Calcul
{
    /** 
    * takes an order array
    *   returns an array of all ingredients arrays (name, quantity, units)
    *   for each amount of said recipe
    */
    public function getOrderIngredients(array $order)
    {
        $orderIngredients = [];
        foreach ((array) $order as &$orderItem) {
            for ($i= 0; $i < $orderItem["nombre"] ; $i++) { 
                foreach ((array) $orderItem["ingredients"] as $key => $value) {
                    array_push($orderIngredients, $value);
                }
            }
        }
        unset($orderItem);
        return $orderIngredients;
    }

    /**
     * function that sort the ingredients from the order, and gets the total quantity
     * @param array $order the order array to sort
     * @return array
     */
    public function sortOrder(array $order, Calcul $calcul){
        $orderIngredients = $calcul->getOrderIngredients($order);
        $sortedOrder = $calcul->unique_multidim_array($orderIngredients, "name");
        return $sortedOrder;
    }

    /**
     * function to fuse duplicates and their quantities
     * does not work
     * @return array
     */
    function unique_multidim_array(array $ingredientsArray, string $keyName) {

        $temp_array = array();
    
        $i = 0;
    
        $name_array = array();
    
        foreach($ingredientsArray as $val) {
    
            if (!in_array($val[$keyName], $name_array)) {
    
                $name_array[$i] = $val[$keyName];
    
                $temp_array[$i] = $val;
    
            }
    
            $i++;
    
        }
    
        return $temp_array;
    
    }
}
