$(document).ready(function(){

    // show list of product on first load
    showProducts();
    // when a 'read products' button was clicked
    $(document).on('click', '.read-products-button', function(){
        showProducts();
    });

});

// showProducts() method will be here
// function to show list of products
function showProducts(){
// get list of products from the API
    $.getJSON("http://192.168.33.10/api/product/read.php", function(data){

    });
}
