var notes = [];


    document.getElementById('logRegister').style.display = 'none';
    document.getElementById('ostoskori').style.display = 'none';


document.getElementById('eka').onclick = function () {
    console.log('ekaa nappia painettu');
    document.getElementById('products').style.display = 'block';
    document.getElementById('logRegister').style.display = 'none';
    document.getElementById('ostoskori').style.display = 'none';
};

document.getElementById('toka').onclick = function () {
    console.log('tokaa nappia painettu');
    document.getElementById('products').style.display = 'none';
    document.getElementById('logRegister').style.display = 'none';
    document.getElementById('ostoskori').style.display = 'block';
};

document.getElementById('kolmas').onclick = function () {
    console.log('kolmatta nappia painettu');
    document.getElementById('products').style.display = 'none';
    document.getElementById('logRegister').style.display = 'block';
    document.getElementById('ostoskori').style.display = 'none';
};

function listingProducts() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("prodList");
    filter = input.value.toUpperCase();
    table = document.getElementById("productList");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

