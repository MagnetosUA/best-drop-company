//function for getting products from table and creating table with orders

var productArray = new Array();

$(".to-order").click(function () {
    var product = new Object();
    var element = $(this).parents("tr");
    product.id = $(element).children(".product-id").text();
    product.name = $(element).children(".product-name").text();
    product.cost = $(element).children(".product-cost").text();
    product.count = $(element).children("td.product-count").children("input").val();
    product.myCost = $(element).children("td.my-cost").children("input").val();
    var productJson = JSON.stringify(product);
    var host = window.location.href;
    $.ajax({
        url: host,
        type: "POST",
        dataType: "text",
        data: {"product": productJson},
        success: function () {
            $("#myOrder").append("<tr>" +
                "<td>"+product.id+"</td>" +
                "<td>"+product.name+"</td>" +
                "<td>"+product.cost+"</td>" +
                "<td>"+product.myCost+"</td>" +
                "<td>"+product.count+"</td>" +
                "<td>"+((product.count * product.myCost)-(product.count * product.cost))+"</td>" +
                "<td><button class='btn btn-danger btn-xs delete-order' onclick='deleteOrder(this);' od='ordr'>Удалить заказ</button></td>"+
                "</tr>");
            console.log(productArray);
            console.log("step 2");
            productArray.push(product);
            console.log(productArray);
        }
    })
    $(this).parents("tr").remove();
});
$(".save-order").click(function () {
    // console.log("after submit");
    var p = JSON.stringify(productArray);
    // console.log(p);
    $(".hidden-product").val(p);
    var ch = $(".hidden-product").val();
    // console.log("in hidden form")
    // console.log(ch);
    alert("Поздравляем ! Заказ сохранен !");
});
// function for deleting orders from orders table

//(BUT !!! Where we make order, a product disappear after we adding it to new orders table. But when we deleting any position in orders table,
// - that product not appear in product table. This problem we MUST solve as soon as possible!!!)

function deleteOrder(element) {
    var tr = $(element).parents("tr");//.children("td.first");
    var txtId = $(tr).children("td").first().text();
    for (var i=0; i<productArray.length; i++) {
        console.log(i);
        var onear = productArray[i];
        if((onear!=null) && (onear.id == txtId)) {
            productArray[i] = null;                 // Attention !!! This property must be another(maybe) You have to check it
            // and find out more methods that can deleting values from arrays !!!
            console.log("remove tr with ID "+onear.id);
        }
    }
    tr.remove();
}

// function for searching in products table

function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}