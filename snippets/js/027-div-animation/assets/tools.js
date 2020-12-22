var tools = {
    id: function(id) {
        return document.getElementById(id);
    },
    select: function(el, className) {
        return el.getElementsByClassName(className);
    },
    hide: function(el) {
        if(el.style.display != "none") {
            el.style.display = "none";
        }
    },
    show: function(el) {
        if(el.style.display != "block") {
            el.style.display = "block";
        }
    },
    escape: function(text) {
      var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
      };

      return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    },
    tx: function(text) {
        return document.createTextNode(text);
    },
    el: function() {

        if(arguments.length == 0) {
            return document.createElement('div');
        }

        if(arguments.length == 1) {
            var text = arguments[0];
            var element = document.createElement('div');
            element.innerHTML = text;

            if(element.childNodes.length == 1) {
                return element.childNodes[0];
            }
            
            return element;
        }

        var tagName = null;
        var attribs = null;
        var styles = null;
        var childs = null;
        
        if(arguments.length > 1) {
            var tagName = arguments[0];
            var childs = arguments[1];
        }

        if(arguments.length > 2) {
            var attribs = arguments[1];
            var childs = arguments[2];
        }

        if(arguments.length > 3) {
            var styles = arguments[2];
            var childs = arguments[3];
        }

        var element = document.createElement(tagName);

        if(attribs !== null) {
            for(attrib in attribs) {
                element.setAttribute(attrib, attribs[attrib]);
            }
        }

        if(styles !== null) {
            for(style in styles) {
                element.style[style] = styles[style];
            }
        }

        if(childs !== null) {
            for(var i=0; i<childs.length; i++) {
                element.appendChild(childs[i]);
            }
        }

        return element;
    },
    microtime: function(get_as_float) {  
        var now = new Date().getTime() / 1000;  
        var s = parseInt(now);  
        return (get_as_float) ? now : (Math.round((now - s) * 1000) / 1000) + ' ' + s;  
    }  
}
