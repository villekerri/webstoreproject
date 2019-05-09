//products
$(document).ready(function() {
    // show sign up / registration form
    $(document).on('click', '#productsButton', async function () {
        var datajson = await $.getJSON("http://192.168.33.10/api/product/read.php", function(data){
            console.log(data);
        });
        var div = document.createElement("div");

        console.log(datajson);
        var productList = function () {
            var table = "<table><tr><th>Name</th><th>Type</th><th>Quantity</th><th>Order Product</th></tr>";
            for (var i = 0; i < datajson.products_list.length; i++) {
                var options = "";
                for (var j = 1; j <=datajson.products_list[i].quantity ; j++){
                    options = options + "<option value= "+ j +">"+ j +"</option>";
                }
                table += "<tr><td>" + datajson.products_list[i].name + "</td>" +
                    "<td>" + datajson.products_list[i].type + "</td>" +
                    "<td>" + datajson.products_list[i].quantity + "</td>" +
                    "<td><select name='score' id=sel"+i+">" + options  + "</select>" +
                    "<button class='button' onclick= ordering(" + datajson.products_list[i].id + ",document.getElementById('sel"+i+"').selectedIndex+1)>Order</button></td></tr>";

            };
            table += "</table>";
            return table;
        };
        var html = `<h2>Products</h2>`+ productList();


        $('#home').html(html);
    });

    // remove any prompt messages
    function clearResponse(){
        $('#response').html('');

    };

});

async function ordering(proId, number) {
    var cart;
    console.log(proId + " "+ number);
    cart = await $.post('http://192.168.33.10/api/order/read_cart.php',{id: getUserId()}, function(data){});
    var message = await $.post('http://192.168.33.10/api/order/add.php', { productid: proId , orderquantity: number , orderid: cart}, function(data){});
    alert(message);

}


