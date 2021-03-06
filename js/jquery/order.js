$(document).ready(function(){
    $(document).on('click', '#ordersbutton', async function() {
        refreshOrderView()
    });
});

async function refreshOrderView(){
    var userid = await getUserId()

    if (userid == 1) {
        var orders = await $.getJSON("http://192.168.33.10/api/order/read.php", function(data){
            console.log(data);
        });
        console.log(orders);

        var tassa = function () {
            var table = "<table class='table table-striped'><tr><th>Order ID</th><th>Status</th><th>Productorder ID</th><th>Product</th><th>Quantity</th><th>User ID</th><th>User address</th><th></th><th></th></tr>";
            for (var i = 0; i < orders.orders_list.length ; i++){
                table += "<tr><td>" + orders.orders_list[i].id +
                    "</td><td>" + orders.orders_list[i].status +
                    "</td><td>" + orders.orders_list[i].productorderid +
                    "</td><td>" + orders.orders_list[i].product +
                    "</td><td>" + orders.orders_list[i].quantity +
                    "</td><td>" + orders.orders_list[i].userid +
                    "</td><td>" + orders.orders_list[i].useraddress +
                    "</td><td><button class='confirm_" + orders.orders_list[i].id + "' onclick='confirmOrder(" + orders.orders_list[i].id + ")'>Confirm</button></td>" +
                    "<td><button class='delete_" + orders.orders_list[i].id + "' onclick='deleteOrder(" + orders.orders_list[i].id + ")'>Delete</button></td></tr>";
            }
            table += "</table>"
            return table
        }
        
        var html = `<h2>List of the orders</h2>` + tassa();
        clearResponse();
        $('#home').html(html);
    } else {
        var userid = await getUserId()
        var orders = await $.post("http://192.168.33.10/api/order/read_one.php", JSON.stringify({userid: userid})).done(function(result) {
        });
        console.log(orders);

        var cart = await $.post("http://192.168.33.10/api/order/read_cart.php", JSON.stringify({userid: userid})).done(function(result) {
        });
        var cartcheck = cart.orders_list[0].id;

        var all_orders = function () {
            var orderslist = "<table class='table table-striped table-hover'>";
            for (var i = 0; i < orders.orders_list.length ; i++){
                if ( orders.orders_list[i].status == "Shopping cart" && cartcheck!=0) {
                    orderslist += "<tr><th>Order ID</th><th>Status</th><th>Productorder ID</th><th>Product</th><th>Quantity</th><th>Submmit shopping cart</th><th>Remove from the cart</th></tr>";
                    for (var i = 0; i < cart.orders_list.length; i++) {
                        orderslist += "<tr><td>" + cart.orders_list[i].id +
                            "</td><td>" + cart.orders_list[i].status +
                            "</td><td>" + cart.orders_list[i].productorderid +
                            "</td><td>" + cart.orders_list[i].productname +
                            "</td><td>" + cart.orders_list[i].orderquantity;
                        if (cart.orders_list[i].status == "Shopping cart") {
                            orderslist += "</td><td><button class='send' onclick='submitOrder(" + userid + ")'>Submit whole cart</button></td>" +
                                "<td><button class='remove_part' onclick='removePart(" + cart.orders_list[i].productorderid + ")'>Remove from cart</button></td></tr>";
                        }
                    }
                } else {
                    orderslist += "<h5>Your shopping cart is empty.</h5>";
                    break;
                }

            }
            orderslist += "</table><br><h3>List of orders</h3><table class='table table-striped table-hover'><tr><th>Order ID</th><th>Order status</th></tr>";
            for (var i = 0; i < orders.orders_list.length ; i++) {
                orderslist += "<tr><td>" + orders.orders_list[i].id +
                    "</td><td>" + orders.orders_list[i].status + "</td></tr>";
            }
            orderslist += "</table>";
            return orderslist;
        }

        var html = `<h2>Your shopping cart</h2>` + all_orders();
        clearResponse();
        $('#home').html(html);
    }
};

async function deleteOrder(id){
    await $.post('/api/order/delete.php', JSON.stringify( {orderid:id}) );
    refreshOrderView();
}

async function confirmOrder(id){
    await $.post('/api/order/update.php', JSON.stringify( {orderid:id}) );
    refreshOrderView();
}

async function submitOrder(id){
    await $.post('/api/order/create.php', JSON.stringify( {userid:id}) );
    refreshOrderView();
}

async function removePart(id) {
    await $.post('/api/order/delete_part.php', JSON.stringify( {productorderid:id}) );
    refreshOrderView();
}

function clearResponse(){
    $('#response').html('');
}