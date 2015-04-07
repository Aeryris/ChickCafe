<?php

/**
    The MIT License (MIT)

    Copyright (c) 2015 Bartlomiej Kliszczyk

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 */

/**
 * @author Bartlomiej Kliszczyk
 * @date 12-02-2015
 * @version 1.0
 * @license The MIT License (MIT)
 */



class Food_Model extends Foundation_Model implements Foundation_Interface{

    public $iFoodId;
    public $data;

    public function all(){
        try{
            $sQuery = 'SELECT * FROM item';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->execute();

            return $oStmt->fetchAll(PDO::FETCH_ASSOC);


        }catch(Exception $e){
            var_dump($e);
        }
    }





    public function create($sName){

    }

    public function get($iId){

        try{

            $sQuery = 'SELECT * FROM item WHERE item_id = :id';
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':id', $iId);
            $oStmt->execute();

            $this->data = $oStmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){

        }



        return $this;
    }

    public function in($iItemId, $iIngredientId){
        try{

            $sQuery = 'SELECT * FROM item_ingredients WHERE ingredient_id = :ing_id AND item_id = :it_id';
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':ing_id', $iIngredientId);
            $oStmt->bindValue(':it_id', $iItemId);

            $oStmt->execute();

            return $oStmt->fetchAll(PDO::FETCH_ASSOC);


        }catch(Exception $e){

        }
    }

    public function addIngredient($iItemId, $iIngredientId){
        try{

            if(empty($this->in($iItemId, $iIngredientId))){
                $sQuery = 'INSERT INTO item_ingredients(ingredient_id, item_id) VALUES(:ing_id, :it_id)';
                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':ing_id', $iIngredientId);
                $oStmt->bindValue(':it_id', $iItemId);

                $oStmt->execute();
            }else{
                $sQuery = 'UPDATE item_ingredients SET ingredient_quantity = ingredient_quantity+1 WHERE ingredient_id = :ing_id AND item_id = :it_id';
                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':ing_id', $iIngredientId);
                $oStmt->bindValue(':it_id', $iItemId);

                $oStmt->execute();
            }




        }catch(Exception $e){

        }
    }

    public function removeIngredient($iItemId, $iIngredientId){
        try{
            $info = $this->in($iItemId, $iIngredientId);

            if(empty($this->in($iItemId, $iIngredientId)) || $info[0]['ingredient_quantity'] <= 0) {

                $sQuery = 'DELETE FROM item_ingredients WHERE ingredient_id = :ing_id AND item_id = :it_id';
                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':ing_id', $iIngredientId);
                $oStmt->bindValue(':it_id', $iItemId);

                $oStmt->execute();

            }else{
                $sQuery = 'UPDATE item_ingredients SET ingredient_quantity = ingredient_quantity-1 WHERE ingredient_id = :ing_id AND item_id = :it_id';
                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':ing_id', $iIngredientId);
                $oStmt->bindValue(':it_id', $iItemId);

                $oStmt->execute();
            }


        }catch(Exception $e){

        }
    }

    public function order($iItemId, $iQuantity){
        try{
            $sQuery = 'SELECT * FROM item AS i WHERE item_id = :iid';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':iid', $iItemId);
            $oStmt->execute();

            $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);

            $stock = $data[0]['item_available'] + $iQuantity;

            if($stock <= $data[0]['item_stock']){
                $sUpdate = 'UPDATE item SET item_available = item_available + :quantity, item_stock_notification = 0 WHERE item_id = :iid';
                $oStmtUpdate  = $this->db->prepare($sUpdate);
                $oStmtUpdate ->bindValue(':quantity', $iQuantity);
                $oStmtUpdate->bindValue(':iid', $iItemId);
                $oStmtUpdate ->execute();
                return 'Order made';
            }else{
                return 'The maximum stock is '.$data[0]['item_stock'].' by ordering more you will end up with '.$stock ;
            }


        }catch(Exception $e){
            var_dump($e);
        }
    }

    public function add($aItemDetails){
        try{

            $sQuery = 'INSERT INTO item VALUES (NULL, :name, :desc, :stock, :avail, :price, :preptime, NULL, 0)';
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':name', $aItemDetails['food_name']);
            $oStmt->bindValue(':desc', $aItemDetails['food_desc']);
            $oStmt->bindValue(':stock', $aItemDetails['food_stock']);
            $oStmt->bindValue(':avail', $aItemDetails['food_available']);
            $oStmt->bindValue(':price', $aItemDetails['food_price']);
            $oStmt->bindValue(':preptime', $aItemDetails['food_preptime']);

            $oStmt->execute();

            return 'Item '.$aItemDetails['food_name'].' added to the system';

        }catch(Exception $e){
            return $e;
        }
    }

} 