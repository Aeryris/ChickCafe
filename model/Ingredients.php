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



class Ingredients_Model extends Foundation_Model{

    public function all(){
        try{
            $sQuery = 'SELECT * FROM ingredient';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->execute();

            return $oStmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){
            var_dump($e);
        }
    }

    public function ingredients($iItemID){
        try{
            $sQuery = 'SELECT * FROM item_ingredients AS ii JOIN ingredient AS i USING (ingredient_id) WHERE item_id = :iid';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':iid', $iItemID);
            $oStmt->execute();

            return $oStmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){
            var_dump($e);
        }
    }

    public function ingredient($iIngID){
        try{
            $sQuery = 'SELECT * FROM ingredient AS i WHERE ingredient_id = :iid';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':iid', $iIngID);
            $oStmt->execute();

            return $oStmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){
            var_dump($e);
        }
    }

    public function order($ingredientId, $iQuantity){
        try{
            $sQuery = 'SELECT * FROM ingredient AS i WHERE ingredient_id = :iid';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':iid', $ingredientId);
            $oStmt->execute();

            $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);

            $stock = $data[0]['ingredient_available'] + $iQuantity;

            if($stock <= $data[0]['ingredient_stock']){
                $sUpdate = 'UPDATE ingredient SET ingredient_available = ingredient_available + :quantity, ingredient_stock_notification = 0 WHERE ingredient_id = :iid';
                $oStmtUpdate  = $this->db->prepare($sUpdate);
                $oStmtUpdate ->bindValue(':quantity', $iQuantity);
                $oStmtUpdate->bindValue(':iid', $ingredientId);
                $oStmtUpdate ->execute();
                return 'Order made';
            }else{
                return 'The maximum stock is '.$data[0]['ingredient_stock'].' by ordering more you will end up with '.$stock ;
            }


        }catch(Exception $e){
            var_dump($e);
        }
    }


    public function add($aItemDetails){
        try{

            $sQuery = 'INSERT INTO ingredient VALUES (NULL, :name, :stock, :avail, NULL, 0)';
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':name', $aItemDetails['food_name']);
            $oStmt->bindValue(':stock', $aItemDetails['food_stock']);
            $oStmt->bindValue(':avail', $aItemDetails['food_available']);

            $oStmt->execute();

            return 'Ingredient '.$aItemDetails['food_name'].' added to the system';

        }catch(Exception $e){
            return $e;
        }
    }





} 