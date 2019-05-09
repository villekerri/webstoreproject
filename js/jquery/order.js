//orders
$(document).ready(function(){
    //http://192.168.33.10/api/order/read.php
    $(document).on('click', '#ordersbutton', async function(){
        var orders = await $.getJSON("http://192.168.33.10/api/order/read.php", function(data){
            console.log(data);
        });
        console.log(orders);
        var tassa = function () {
            var jotain = "<table><tr><th>Order ID</th><th>Status</th><th>Productorder ID</th><th>Product</th><th>Quantity</th></tr>";
            for (var i = 0; i < orders.orders_list.length ; i++){
                jotain += "<tr><td>" + orders.orders_list[i].id + "</td><td>" + orders.orders_list[i].status + "</td><td>" + orders.orders_list[i].productorderid +
                    "</td><td>" + orders.orders_list[i].product + "</td><td>" + orders.orders_list[i].quantity +
                    "</td><td><button class='confirm_" + orders.orders_list[i].id + "'>Confirm</button></td>" +
                    "<td><button class='delete_" + orders.orders_list[i].id + "'>Delete</button></td></tr>";
            }
            jotain += "</table>"
            return jotain
        }
        var html = `<h2>List of the orders</h2>` + tassa();
        clearResponse();
        $('#home').html(html);
    });

    


    function clearResponse(){
        $('#response').html('');
    }
});