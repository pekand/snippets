document.querySelectorAll(".random-content").forEach(el => {
     var possible = "abcdefghijklmnopqrstuvwxyz";
      var out = "";
      while (out.length < el.dataset.count) {
              
              var l = Math.floor(Math.random() * 10) + 2;
              for (var i = 0; i < l; i++) {
                out += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            out += " ";
    }
    
    el.innerHTML = out;

});