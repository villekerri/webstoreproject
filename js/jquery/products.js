//products
$(document).ready(function() {
    // show sign up / registration form
    $(document).on('click', '#products', function () {

        var html = `
            <h2>Products</h2>
              <form id='products_form'>
        
        
        
        
        `;
        clearResponse();
        $('#products').html(html);
    });
    $(document).ready(function(){
        $.get("demo_test.asp", function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    });
});