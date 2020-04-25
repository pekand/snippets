console.log(document.cookie);
    
function setCookie(name, value, secs) {
    var expires = new Date(Date.now()+ secs * 1000).toUTCString()
    document.cookie = name+"="+encodeURIComponent(value)+";expires="+expires+";domain="+window.location.hostname+";path=/";    
}

setCookie("name1", "value1", 10 * 24 * 60 * 60);
setCookie("name2", "value2", 10 * 24 * 60 * 60);
setCookie("name3", "value3<>&=", 10 * 24 * 60 * 60);

////////////////

console.log(document.cookie)

// Max-Age is wxpiration in seconds;
function removeCookie(name) {
    document.cookie = "name2=;Max-Age=-99999999;path=/";
}

removeCookie("name2");

////////////////    

function getCookie(name, defaultVal) {
    var value = new RegExp(name + "=([^;]+)").exec(document.cookie);
    return (value != null) ? decodeURIComponent(value[1]) : defaultVal;
}
        
console.log(getCookie("name1", ""));

////////////////

function getCookies() {
    var cookies = {};
    document.cookie.split('; ').forEach(function(v){
        var c = v.split('=');
        cookies[c[0]] = decodeURIComponent(c[1]);
    });
    return cookies;
}
        
console.log(getCookies());
console.log(getCookies().name1);
console.log(getCookies().name10 || "default value");
