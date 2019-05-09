//products
$(document).ready(function() {
    // show sign up / registration form
    $(document).on('click', '#productsButton', async function () {
        var datajson = await $.getJSON("http://192.168.33.10/api/product/read.php", function(data){
            console.log(data);
        });

        console.log(datajson);
        for (let i=0; i < datajson.products_list.length; i++){
            var tr = document.createElement("tr");
            document.body.appendChild(tr);

            var nametd = document.createElement("td");
            nametd.innerHTML = datajson.products_list[i].name;
            document.body.appendChild(nametd);

            var typetd = document.createElement("td");
            typetd.innerHTML = datajson.products_list[i].type;
            document.body.appendChild(typetd);

            var quantitytd = document.createElement("td");
            quantitytd.innerHTML = datajson.products_list[i].quantity;
            document.body.appendChild(quantitytd);
        };
        
        var html = `
            <h2>Products</h2>
              <form id='products_form'>
                <h4>Helllooooo</h4>
                    <body>
                        <div id="listing">
                            
                        </div>
                        <script>
                                                 
                        </script>
                    </body>
        
        
        
        `;

        $('#home').html(html);
    });

    // remove any prompt messages
    function clearResponse(){
        $('#response').html('');
    }
});
