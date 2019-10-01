function generateBlocks() {
   var blocks = document.querySelectorAll(".block");
    blocks.forEach( el => {
        var css = el.querySelector('.css').value;
        var html = el.querySelector('.html').value;
        var js = el.querySelector('.js').value;
        
        var out = el.querySelector('.out');
        
        out.innerHTML = "";
          
        var style = document.createElement('style');
        style.innerHTML = css;
        out.appendChild(style);
        
        var script = document.createElement('script');
        script.innerHTML = js;
        out.appendChild(script);
        
        var content = document.createElement('div');
        content.innerHTML = html;
        out.appendChild(content);
        

    }); 
}



document.querySelectorAll("textarea").forEach(function(el) {
    el.addEventListener("change", function(){
      generateBlocks();
    }); 
    
    el.value = el.value.trim().replace(/(    |\t)/gi, '');
});

generateBlocks();