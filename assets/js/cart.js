$(document).ready(function() {
    var path = $("#total").attr("data-path");
    $.ajax({
        method: "GET",
        url: path,
        success: function(data){
            $('#total').html("<h3><strong>" + data + " \u20AC</strong></h3>");  
        }
    });
});