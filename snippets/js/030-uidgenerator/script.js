function uid(length){
    var ch = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var uid = '';

    if(window.crypto) {
        var n = new Uint32Array(length);
        window.crypto.getRandomValues(n);
        for (var i = 0; i<length; i++) {
            uid += ch[n[i] % ch.length];
        }
    } else {
        for (var i = 0; i<length; i++) {
            uid += ch[Math.floor(Math.random() * ch.length)];
        }
    }

    return uid;
}
