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

function getStaffNotifications(){

    $(document).ready(function(){

        $.ajax({
            method: "POST",
            url: "/notifications/fetchAll",
            dataType: "json"
        })
            .done(function (data) {
                console.log('Staff Notifications: ');
                console.log(data.result);
                var html = [];
            }).fail(function (msg) {
                console.log( msg );
            })
            .always(function () {
                //alert( "complete" );
            });
    });
}

function getUserNotifications(){

    $(document).ready(function(){

        $.ajax({
            method: "POST",
            url: "/notifications/fetchUser",
            dataType: "json"
        })
            .done(function (data) {
                console.log('User Notifications: ');
                console.log(data.result);
                setNotificationBadgeNumber(data.result);
                var html = [];
            }).fail(function (msg) {
                console.log( msg );
            })
            .always(function () {
                //alert( "complete" );

            });
    });
}

function setNotificationBadgeNumber(data){

    var unreadCount = 0;
    if(typeof data.user != "undefined"){
        data.user.forEach(function(read){
            if(read.notification_read == 0) unreadCount++;
        });
    }

    if(typeof data.type != "undefined"){
        data.type.forEach(function(read){
            if(read.notification_read == 0) unreadCount++;
        });
    }

    console.log("Count: " + unreadCount);
    $('#notification_count').text(unreadCount);
}

function displayNotificationsList(){

    console.log('Display Notifications ');
    $(document).ready(function(){

        $.ajax({
            method: "POST",
            url: "/notifications/fetchUser",
            dataType: "json"
        })
            .done(function (data) {
                console.log('User Notifications: ');
                console.log(data.result);
                $('#notificationsBody').append('<ul id="notification-body-list"></ul>');
                data.result.user.forEach(function(n){
                    $('#notification-body-list').append('<li>'+ n.notification_msg+' <span style="color:#000066">'+n.notification_date+'</span></li>');
                });

                setNotificationsRead(data);
                var html = [];
            }).fail(function (msg) {
                console.log( msg );
            })
            .always(function () {
                //alert( "complete" );

            });
    });





}

function setNotificationsRead(data){

}
