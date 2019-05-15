//products
$(document).ready(function() {
    // show sign up / registration form
    $(document).on('click', '#productsButton', async function () {
        refreshList();
    });

    $(document).on('click', '#submitproduct', function () {
        var productname = $('#createproductname').val();
        var producttype = $('#createproducttype').val();
        var productprice = $('#createproductprice').val();
        var productquantity = $('#createproductquantity').val();
        $.post(
            '/api/product/create.php',
            JSON.stringify({ productname: productname , producttype: producttype, productprice: productprice , productquantity:productquantity})
        );
        refreshList();
    });

    function clearResponse(){
        $('#response').html('');
    };

});

async function ordering(proId, number) {
    var userId = await getUserId();
    $.post('/api/order/check_cart.php', JSON.stringify({userid: userId}));
}

async function removeProduct(id) {
    $.post('/api/product/delete.php',JSON.stringify({ productid: id}));
    refreshList();
}

async function refreshList() {
    var datajson = await $.getJSON("/api/product/read.php");
    var div = document.createElement("div");
    var userid = await getUserId();
    console.log(datajson);
    var productList = function () {
        var table = "<table class='table table-striped table-hover'><tr><th>Name</th><th>Type</th><th>Price</th><th>Quantity</th><th>Order Product</th>";
        if ( userid == 1){
            table += "<th>Remove</th></tr>";
        } else {
            table+= "</tr>";
        }
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
            if (userid == 1){
                table += "<td><button class='button' onclick='removeProduct(" + datajson.products_list[i].id + ")'>Remove</button></td></tr>";
            } else {
                table += "</tr>";
            }
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
    if ( userid == 1) {
        html += createProduct;
    }
    $('#home').html(html);
};

