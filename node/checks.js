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
var mysql = require('mysql');

var db = mysql.createPool ({
    connectionLimit : 100,
    host: 'localhost',
    user: 'root',
    password: 'testtest',
    database: 'chickcafe',
    debug: false
});

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
};

function checkFoods(){
    var date = new Date();
    var time = addZero(date.getHours()) + ':' + addZero(date.getMinutes()) + ':' + addZero(date.getSeconds());
    var now = addZero(date.getFullYear()) + '-' + addZero(date.getMonth()) + '-' + addZero(date.getDay()) + '-' +time;


    db.query('SELECT * FROM item WHERE ?', {item_available:'0'}, function(err, result){
        if (err) throw err;

        result.forEach(function(food){

            if(food.item_stock_notification == 0){
                db.query('INSERT INTO notification SET ?', {
                    notification_type: 'N',
                    notification_msg: food.item_name + ' stock is empty',
                    notification_user_type: 'M',
                    notification_date: now
                }, function(err, result){
                    if (err) throw err;
                    db.query('UPDATE item SET ? WHERE ?', [
                        {item_stock_notification: 1},
                        {item_id: food.item_id}
                    ], function(err, result){
                        if (err) throw err;
                        console.log('Notification sent to Manager');
                        console.log('Food Name: '+food.item_name);
                        console.log('Time: ' + now);
                    });
                });
            }
        });

    });

    checkIngredients();

}

function checkIngredients(){
  //  console.log('Check ingredient ');
    var date = new Date();
    var time = addZero(date.getHours()) + ':' + addZero(date.getMinutes()) + ':' + addZero(date.getSeconds());
    var now = addZero(date.getFullYear()) + '-' + addZero(date.getMonth()) + '-' + addZero(date.getDay()) + '-' +time;


    db.query('SELECT * FROM ingredient WHERE ?', {ingredient_available:'0'}, function(err, result){
        if (err) throw err;

        result.forEach(function(food){

            if(food.ingredient_stock_notification == 0){
                db.query('INSERT INTO notification SET ?', {
                    notification_type: 'N',
                    notification_msg: food.ingredient_name + ' stock is empty',
                    notification_user_type: 'M',
                    notification_date: now
                }, function(err, result){
                    if (err) throw err;
                    db.query('UPDATE ingredient SET ? WHERE ?', [
                        {ingredient_stock_notification: 1},
                        {ingredient_id: food.ingredient_id}
                    ], function(err, result){
                        if (err) throw err;
                        console.log('Notification sent to Manager');
                        console.log('Ingredient Name: '+food.ingredient_name);
                        console.log('Time: ' + now);
                    });
                });
            }
        });

    });

}

setInterval(checkFoods, 1000);


