$(document).ready(function () {
    var globalCityArea = ''; // For saving the first data in textarea
    $(".js-example-basic-single").change(function(){ //invoke when we change select city
        var val = $(this).val();
        globalCityArea = '';
        $.ajax ({
            url: "http://localhost:8000/ajax-new-post",//{{ path('ajax-new-post') }}", !!! The PROBLEM NOT SOLVED
            //in page Twig it is work with "{{ path('ajax-new-post') }}", but from here it's not work !
            type: "POST",
            dataType: 'json',
            data: {"destination" : val},
            success: function (data) {
                $(".warehouses").empty();
                $(".warehouses").append("<option value selected='selected'>Укажите отделениё</option>");
                $(".full-address").text(data[1]+', '+data[0]);
                for (var i=0;i<data[2].length;i++) {
                    $(".warehouses").append("<option>"+data[2][i]+"</option>");
                }
            }
        });
    });
    $(".warehouses").change(function() { //invoke when we change select warehouse
        if (globalCityArea == '') {
            globalCityArea = $(".full-address").text();
        }
        var text = $(".full-address").text(null);
        var fullAddress = globalCityArea + ', ' + $(this).val();
        $(".full-address").text(fullAddress);
});
});