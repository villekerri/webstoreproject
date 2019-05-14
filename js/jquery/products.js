//products
$(document).ready(function() {
    // show sign up / registration form
    $(document).on('click', '#productsButton', async function () {
        var datajson = await $.getJSON("http://192.168.33.10/api/product/read.php", (data)=>{
            console.log(data);
        });
        var div = document.createElement("div");

        console.log(datajson);
        var productList = function () {
            var table = "<table class='table table-striped table-hover'><tr><th>Name</th><th>Type</th><th>Price</th><th>Quantity</th><th>Order Product</th></tr>";
            for (var i = 0; i < datajson.products_list.length; i++) {
                var options = "";
                for (var j = 1; j <=datajson.products_list[i].quantity ; j++){
                    options = options + "<option value= "+ j +">"+ j +"</option>";
                }
                table += "<tr><td>" + datajson.products_list[i].name + "</td>" +
                    "<td>" + datajson.products_list[i].type + "</td>" +
                    "<td>" + datajson.products_list[i].price + "</td>" +
                    "<td>" + datajson.products_list[i].quantity + "</td>" +
                    "<td><select name='score' id=sel"+i+">" + options  + "</select>" +
                    "<button class='button' onclick= ordering(" + datajson.products_list[i].id + ",document.getElementById('sel"+i+"').selectedIndex+1)>Order</button></td>";
                // if (admin) {
                table += "<td><button class='button' onclick='removeProduct(" + datajson.products_list[i].id + ")'>Remove</button></td></tr>";
                // }else{
                // table += "</tr>";
            };
            table += "</table>";
            return table;
        };

        var createProduct = '<h4>Add a new product:</h4><br><form id="product_form" method="post">' +
            '  Product name: <br><input type="text" name="productname" id="createproductname"/><br>' +
            '  Product type: <br><input type="text" name="producttype" id="createproducttype"/><br>' +
            '  Product price: <br><input type="number" step="0.01" name="productprice" id="createproductprice" /><br>' +
            '  Product quantity: <br><input type="number" name="productquantity" id="createproductquantity"/>' +
            '  <br><input type="button" id="submitproduct" value="Add product"/>' +
            '</form><br>'

        var html = `<h2>Products</h2>` + productList();
        //if (admin) {
        html += createProduct;

        $('#home').html(html);
    });

    $(document).on('click', '#submitproduct', function () {
        var productname = $('#createproductname').val();
        var producttype = $('#createproducttype').val();
        var productprice = $('#createproductprice').val();
        var productquantity = $('#createproductquantity').val();
        $.ajax({
            url: 'http://192.168.33.10/api/product/create.php',
            type: 'POST',
            data: '{ "productname": "' + productname + '", "producttype": "' + producttype + '", "productprice": "' + productprice + '", "productquantity": "' + productquantity + '"}',
            datatype: 'json'
        });
    });

    // remove any prompt messages
    function clearResponse(){
        $('#response').html('');

    };

});

async function ordering(proId, number) {
    var cart;
    var userId = await getUserId();
    console.log(userId);
    cart = await $.post('http://192.168.33.10/api/order/read_cart.php',JSON.stringify({userid: userId}), function(data){});
    console.log(cart);
    var message = await $.post('http://192.168.33.10/api/order/add.php', JSON.stringify({ productid: proId , orderquantity: number , orderid: cart}), function(data){});
    alert(message);
}

async function removeProduct(id) {
    $.ajax({
        url: 'http://192.168.33.10/api/product/delete.php',
        type: 'POST',
        data: '{ "productid": "' + id + '"}',
        datatype: 'json'
    })
}

