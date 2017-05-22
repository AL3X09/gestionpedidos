/**
 * Created by Alex on 11/03/2017.
 */
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+ "/"; // lineas servidor local
$(document).ready(function() {
//console.log(baseUrl);
})

function acceder() {
    $.ajax({
        url: baseUrl + 'Login/acceder',
        method: 'POST',
        data: $("#loginForm").serialize(),
        success: function (data) {
            console.log(data);
            $.each(data, function (k, v) {

            });
        }
    });
}




