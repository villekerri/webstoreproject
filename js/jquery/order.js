//orders
$(document).ready(function(){
    //http://192.168.33.10/api/order/read.php
    $(document).on('click', '#ordersbutton', async function(){
        // if (admin) {
        /*
        var orders = await $.getJSON("http://192.168.33.10/api/order/read.php", function(data){
            console.log(data);
        });
        console.log(orders);
        var tassa = function () {
            var jotain = "<table><tr><th>Order ID</th><th>Status</th><th>Productorder ID</th><th>Product</th><th>Quantity</th><th>User ID</th><th>User address</th></tr>";
            for (var i = 0; i < orders.orders_list.length ; i++){
                jotain += "<tr><td>" + orders.orders_list[i].id +
                    "</td><td>" + orders.orders_list[i].status +
                    "</td><td>" + orders.orders_list[i].productorderid +
                    "</td><td>" + orders.orders_list[i].product +
                    "</td><td>" + orders.orders_list[i].quantity +
                    "</td><td>" + orders.orders_list[i].userid +
                    "</td><td>" + orders.orders_list[i].useraddress +
                    "</td><td><button class='confirm_" + orders.orders_list[i].id + "' onclick='confirmOrder(" + orders.orders_list[i].id + ")'>Confirm</button></td>" +
                    "<td><button class='delete_" + orders.orders_list[i].id + "' onclick='deleteOrder(" + orders.orders_list[i].id + ")'>Delete</button></td></tr>";
            }
            jotain += "</table>"
            return jotain
        }
        var html = `<h2>List of the orders</h2>` + tassa();
        clearResponse();
        $('#home').html(html);
        // } else {
        */

        var orders = await $.ajax({
            url: 'http://192.168.33.10/api/order/read_one.php',
            type: 'POST',
            data: '{"userid": "101"}', //tähän tarvitaan nykyisen käyttäjän userid
            dataType: 'json',
            success: function(data) {
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
        var tassa = function () {
            var jotain = "<table><tr><th>Order ID</th><th>Status</th><th>Productorder ID</th><th>Product</th><th>Quantity</th></tr>";
            for (var i = 0; i < orders.orders_list.length ; i++){
                jotain += "<tr><td>" + orders.orders_list[i].id +
                    "</td><td>" + orders.orders_list[i].status +
                    "</td><td>" + orders.orders_list[i].productorderid +
                    "</td><td>" + orders.orders_list[i].product +
                    "</td><td>" + orders.orders_list[i].quantity;
                    if (orders.orders_list[i].status=="Shopping cart"){
                        jotain += "</td><td><button class='send' onclick='submitOrder(" + 9999 + ")'>Submit shopping cart</button></td></tr>"; // userid 9999 tilalle
                    } else {
                        jotain += "</td></tr>";
                    }
            }
            jotain += "</table>"
            return jotain
        }
        var html = `<h2>List of the orders</h2>` + tassa();
        clearResponse();
        $('#home').html(html);

        // }
    });



    function clearResponse(){
        $('#response').html('');
    }
});

async function deleteOrder(id){
    $.ajax({
        url: 'http://192.168.33.10/api/order/delete.php',
        type: 'POST',
        data: '{ "orderid": "' + id + '"}',
        datatype: 'json'
    })
}

async function confirmOrder(id){
    $.ajax({
        url: 'http://192.168.33.10/api/order/update.php',
        type: 'POST',
        data: '{ "orderid": "' + id + '"}',
        datatype: 'json'
    })
}

async function submitOrder(id){
    $.ajax({
        url: 'http://192.168.33.10/api/order/create.php',
        type: 'POST',
        data: '{ "userid": "101"}', //data: '{ "orderid": "' + id + '"}', kun löytyy oikee userid
        datatype: 'json'
    })
}