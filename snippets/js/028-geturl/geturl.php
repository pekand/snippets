<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<script type="text/javascript">
var Tools =  {
    getUrl: function(method, url, getParams, postParams, data, callback, errorcallback, accessToken) {

        if(typeof getParams == 'undefined') getParams = null;
        if(typeof postParams == 'undefined') postParams = null;
        if(typeof data == 'undefined') data = null;
        if(typeof callback == 'undefined') callback = null;
        if(typeof errorcallback == 'undefined') errorcallback = null;
        if(typeof accessToken == 'undefined') accessToken = null;

        var xhttp = new XMLHttpRequest(callback);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    if (typeof callback === "function") {
                        callback(JSON.parse(this.responseText));
                    }
                } else {
                    if (typeof errorcallback === "function") {
                        errorcallback(this.responseText);
                    }
                }
            }
        };

        requestMethod = method;

        if(getParams != null) {
            var params = [];
            for (var key in getParams) {
                if (getParams.hasOwnProperty(key)) {
                    params.push(key + '=' + encodeURIComponent(getParams[key]));
                }
            }

            url = url + '?' + params.join('&');
        }

        xhttp.open(requestMethod , url, true);

        var requestData = null;

        if(typeof data !== "undefined" && data != null) {
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            requestData = JSON.stringify(data);
        } else 
        if(typeof postParams !== "undefined" && postParams != null) {
            var params = [];
            for (var key in postParams) {
                if (postParams.hasOwnProperty(key)) {
                    params.push(key + '=' + encodeURIComponent(postParams[key]));
                }
            }

            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            requestData = JSON.stringify(params.join('&'));
        }

        if (typeof accessToken != undefined){
            xhttp.setRequestHeader('AccessToken', accessToken);
        }

        xhttp.send(requestData);
    }
}


function init()
{
    var data = {
        message: 'aaaa bbb ccc'
    };

    Tools.getUrl('post', '/snippets/php/020-curl/request.php', 
        {a:1,b:2}, 
        {c:1, d:2}, 
        null, 
        function() {
        console.log('ok');
    }, function(){
        console.log('error');
    });

    Tools.getUrl('post', '/snippets/php/020-curl/request.php', 
        {a:1,b:2}, 
        {c:1, d:2}, 
        data, 
        function() {
        console.log('ok');
    }, function(){
        console.log('error');
    });
}

document.addEventListener("DOMContentLoaded", init);

</script>
</body>
</html>
