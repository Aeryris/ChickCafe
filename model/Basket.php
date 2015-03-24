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


interface Basket_Interface{

}

class Basket_Exception extends Exception{}

class Basket_Model extends Foundation_Model implements Basket_Interface{

    public $iOwnerId;


    public static $oInstance;

    public $db;

    public $bCreateBasket = false;

    public $aBasketData = null;



    public static function basket($iId = null){

        if(!self::$oInstance instanceof self){
            self::$oInstance = new Basket_Model($iId);
            var_dump('Basket ID: '.$iId);
        }

        return self::$oInstance;
    }

    public function __construct($iId = null){

        $this->iOwnerId = $iId;
        $this->db = Database_Core::get();

        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);
        $bBasketExists = $this->findBasketByUserId($oUser->aData['user_id']);
        var_dump($bBasketExists);
        if($iId != null) $this->bCreateBasket = true;

        /**
         * Check if basket will be assigned to the user
         */
        //if($sId == null)
          //  throw new Basket_Exception('Basket owner ID cannot be null');

         /**
          * @todo Check if user exists
          */
        return $this;
    }

    public function create(){
        var_dump('Create basket');
        $this->bCreateBasket = true;



        $this->prepareBasket();

        return $this;
    }

    private function prepareBasket(){

        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);

        //var_dump($oUser);

        $bBasketExists = $this->findBasketByUserId($oUser->aData['user_id']);

        var_dump($bBasketExists);

        try{

            /**
             * If basket does not exist crease one and get the data, otherwise get data of existing and active basket
             */
            if(!$bBasketExists){
                $sQuery = 'INSERT INTO basket(basket_owner_id, basket_active) VALUES(:owner_id, :active)';

                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':owner_id', $oUser->aData['user_id'], PDO::PARAM_INT);
                $oStmt->bindValue(':active', "true", PDO::PARAM_STR);

                $bExecute = $oStmt->execute();

                /**
                 * Get newly created basket if sql insert was successful
                 */
                $this->aBasketData = $this->findBasketByUserId($oUser->aData['user_id']);
            }else{
                $this->aBasketData = $this->findBasketByUserId($oUser->aData['user_id']);
            }

        }catch(Basket_Exception $e){
            throw new Basket_Exception($e);
        }

        return $this;
    }

    public function get(){
        var_dump('Get basket');

        $this->bCreateBasket = false;
        return $this;
    }

    public function addItem($iItemId){
        /**
         * Check if item exists
         * Item::get($iItemId)
         */

        var_dump('Add item ID: '.$iItemId);

        $this->isItemInBasket($iItemId);

        return $this;
    }

    public function isItemInBasket($iItemId){

        try{

            $sQuery = 'SELECT * FROM basket_items WHERE basket_items_id = :basket_id AND basket_items_item_id = :item_id';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':basket_id', $this->aBasketData['basket_id'], PDO::PARAM_INT);
            $oStmt->bindValue(':item_id', $iItemId, PDO::PARAM_INT);

            $bExecute = $oStmt->execute();

            $aBasketItemData = $oStmt->fetch(PDO::FETCH_ASSOC);
            var_dump('IsItemInBasket');
            var_dump($aBasketItemData);
            /**
             * If item already exists in the basket increase quantity otherwise add as new item
             */
            if($aBasketItemData){
                $iIncrease = $aBasketItemData['basket_items_quantity'];
                $iIncrease++;
                $sQueryUpdate = 'UPDATE basket_items SET basket_items_quantity = :item_quantity WHERE basket_items_id = :basket_id';

                $oStmtUpdate = $this->db->prepare($sQueryUpdate);

                $oStmtUpdate->bindValue(':basket_id', $this->aBasketData['basket_id'], PDO::PARAM_INT);
                $oStmtUpdate->bindValue(':item_quantity', $iIncrease, PDO::PARAM_INT);

                $bExecute = $oStmtUpdate->execute();
            }else{

                var_dump('Insert');
                $sQueryInsert = 'INSERT INTO basket_items(basket_items_id, basket_items_item_id, basket_items_quantity) VALUES(:basket_id, :item_id, :quantity)';
                $oStmtInsert = $this->db->prepare($sQueryInsert);

                $oStmtInsert->bindValue(':basket_id', $this->aBasketData['basket_id'], PDO::PARAM_INT);
                $oStmtInsert->bindValue(':item_id', $iItemId, PDO::PARAM_INT);
                $oStmtInsert->bindValue(':quantity', 1, PDO::PARAM_INT);

                $bExecute = $oStmtInsert->execute();

                var_dump($bExecute);
            }


        }catch (Basket_Exception $e){
            throw new Basket_Exception($e);
        }

        return $this;
    }

    public function findBasketByUserId($iUserId){

        $aBasketData = false;

        try{

            $sQuery = 'SELECT * FROM basket WHERE basket_owner_id = :id';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':id', $iUserId, PDO::PARAM_INT);

            $bExecute = $oStmt->execute();

            $aBasketData = $oStmt->fetch(PDO::FETCH_ASSOC);



        }catch(Basket_Exception $e){
            throw new Basket_Exception($e);
        }

        return $aBasketData;
    }

    public function findBasketWithItems($iUserId){

        return $this;
    }

    public function view(){
        var_dump('View basket');

        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);

        $this->aBasketData = $this->findBasketWithItems($oUser->aData['user_id']);
        return $this;
    }

} 