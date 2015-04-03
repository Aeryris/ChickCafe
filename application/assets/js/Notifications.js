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

var currentNotificationCount = 0;

function getStaffNotifications(){

    $(document).ready(function(){

        $.ajax({
            method: "POST",
            url: "/notifications/fetchAll",
            dataType: "json"
        })
            .done(function (data) {
                //console.log('Staff Notifications: ');
                //console.log(data.result);
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
                //console.log('User Notifications: ');
                //console.log(data.result);
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

function animate() {
    $('#notification_count').animate({backgroundColor:'#ffcc00'}, 500, function(){
        $('#notification_count').animate({backgroundColor:'#eeeeee'}, 500, function(){
            $('#notification_count').animate({backgroundColor:'#3b5998'}, 500, function(){

            });
        });
    });
}

function setNotificationBadgeNumber(data, currentCount){

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

    console.log("unreadCount: " + unreadCount);
    console.log("currentCount: " + currentCount);
    if(unreadCount == 0){
        $("#notification_count").hide();
    }else{

        $("#notification_count").show();

        if(unreadCount != currentCount){

            $("#notificationContainer").show(300);

            //animate();
            //$('#notification_count').addClass('pulseAnimation').delay(2000).removeClass('pulseAnimation');
            console.log('FUCCOEJFIJEJHVEHJVFJEBVIJEBVJENB');
            //$('#notification_count').css("-webkit-transition", "all 2s ease-in-out");

            $('#notification_count').addClass('pulseAnimation');

            $('#notification_count').animate({transform: 'scale(2.0)'}, 500, function(){
                $('#notification_count').animate({transform: 'scale(1.0)'}, 500, function(){
                    $('#notification_count').animate({transform: 'scale(2.0)'}, 500, function(){
                        $('#notification_count').animate({transform: 'scale(1.0)'}, 500, function(){

                        });
                    });
                });
            });


        }
    }
    currentNotificationCount = unreadCount;
    $('#notification_count').text(unreadCount);

    //$('#notification_count').css('-webkit-animation:', 'pulse 0.2s linear infinite');
    //$('#notification_count').css('animation:', 'pulse 0.2s linear infinite');
/**
    $('#notification_count').addClass('pusleAnimation')
    setTimeout(function(){
        $('#notification_count').removeClass('pusleAnimation');
    }, 1800);

 */

}

function displayNotificationsList(){
    var notiData = null;
    console.log('Display Notifications ');
    $(document).ready(function(){

        $.ajax({
            method: "POST",
            url: "/notifications/fetchUser",
            dataType: "json"
        })
            .done(function (data) {
                //console.log('User Notifications: ');
                //console.log(data.result);
                notiData = data.result.user;
                $('#notificationsBody').html('<ul id="notification-body-list"></ul>');

                setNotificationBadgeNumber(data.result, currentNotificationCount);

                data.result.user.forEach(function(n){
                    var style = '';
                    if(n.notification_read == 0) style = ' style="background: rgba(52, 52, 52, 0.24);" '
                    $('#notification-body-list').append('<li '+style+' >'+ n.notification_msg+' <span style="color:#000066; font-size: small">-'+n.notification_date+'</span></li>');
                });

                var html = [];
            }).fail(function (msg) {
                console.log( msg );
            })
            .always(function () {
                //alert( "complete" );

            });
    });
    return notiData;
}



function setNotificationsRead(){
    $(document).ready(function(){

        $.ajax({
            method: "POST",
            url: "/notifications/fetchUser",
            dataType: "json"
        })
            .done(function (data) {
                data.result.user.forEach(function(n){


                });

                $.ajax({
                    method: "POST",
                    url: "/notifications/markAsRead",
                    dataType: "json",
                    data: {'data': data.result.user}
                })
                    .done(function (data) {
                        console.log('MarkAsRead: ');
                        console.log(data);
                    }).fail(function (msg) {
                        console.log( msg );
                    })
                    .always(function () {
                        //alert( "complete" );

                    });





            }).fail(function (msg) {
                console.log( msg );
            })
            .always(function () {
                //alert( "complete" );

            });
    });
}
