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



class Notifications_Controller extends Foundation_Model implements Foundation_Interface{

    public function account(){



    }

    public function fetchAll(){

        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);

        $iUserId = $oUser->aData['user_id'];
        $sUserType = $oUser->aData['user_type'];


        $oNotifications = new Notification_Model();
        $aNotificationsList = array();
        $aNotificationsList['user'] = $oNotifications->getById($iUserId);
        $aNotificationsList['type'] = $oNotifications->getByType($sUserType);

        echo json_encode(array('result' => $aNotificationsList));

    }

    public function fetchUser(){
        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);

        $iUserId = $oUser->aData['user_id'];
        $sUserType = $oUser->aData['user_type'];

        $oNotifications = new Notification_Model();
        $aNotificationsList = array();
        $aNotificationsList['user'] = $oNotifications->getById($iUserId, $sUserType);

        echo json_encode(array('result' => $aNotificationsList));
    }

    public function markAsRead(){

        $data = $_POST['data'];

        $oNotifications = new Notification_Model();

        foreach($data as $key => $value){
            $oNotifications->markAsRead($value['notification_id']);
        }
        echo json_encode(array('result' => $_POST));

    }

} 