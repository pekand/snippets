function Component(app, container) {
    return {
        init: function(app, container) {
            this.app = app;
            this.container = container;
            this.components = {};
            this.element = this.template();
            this.container.appendChild(this.element);

            this.bindEvents();
            return this;
        },
        bindEvents: function() {
        },
        template: function() {
            return tools.el('div', {class:'component'}, [
                tools.tx("pekand"),
            ]);
        },
    }.init(app, container);
}

function Homepage(app, container) {
    return {
        init: function(app, container) {
            this.app = app;
            this.container = container;
            this.components = {};
            this.element = this.template();
            this.container.appendChild(this.element);
            this.bindEvents();
            this.element.style.position = "absolute";
            this.resize();

            this.angle = 0;
            this.x = 0;
            this.y = 0;

            this.time = tools.microtime(true);

            return this;
        },
        bindEvents: function() {
        },
        template: function() {
            return tools.el('div', {class:'homepage'}, [
                tools.tx("pekand"),
            ]);
        },
        position : function(x, y) {
            this.element.style.left = x +'px';
            this.element.style.top = y +'px';
        },
        resize: function() {
            this.position(this.x, this.y);
        },
        rotate : function(cx, cy, x, y, angle) {
            var radians = (Math.PI / 180) * angle,
                cos = Math.cos(radians),
                sin = Math.sin(radians),
                nx = (cos * (x - cx)) + (sin * (y - cy)) + cx,
                ny = (cos * (y - cy)) - (sin * (x - cx)) + cy;
            return [nx, ny];
        },
        tick: function(elapsed) {

            if (this.elapsed === undefined)
                this.elapsed = elapsed;

            var circle = 0.5;

            if ((elapsed - this.elapsed) > circle) {
                this.elapsed = elapsed;
            }

            var timeDiff = (elapsed  - this.elapsed) / circle;

            var cx = this.app.state.w/2;
            var cy =  this.app.state.h / 2;

            var x = cx - 100;
            var y = cy - 100;

            if (360 * timeDiff == this.angle) {
                return;
            }

            this.angle = 360 * timeDiff;


            var p = this.rotate(cx, cy, x, y, this.angle);

            this.position(p[0], p[1]);

            if (this.app.state.w < this.x) {
                this.x = 0;
            }

            if (this.app.state.h < this.y) {
                this.y = 0;
            }
        }
    }.init(app, container);
}

var app = {
    init : function() {
        this.container = tools.id('app');
        this.state = {};
        this.components = {};
        this.bindComponents();
        this.bindEvents();

        //setInterval(this.tick.bind(this), 1);
        requestAnimationFrame(this.tick.bind(this))

        this.resize();
    },
    bindComponents : function () {
        this.components.homepage = Homepage(this, this.container);
    },
    bindEvents : function () {
        window.addEventListener('resize', this.resize.bind(this));
    },
    resize : function () {
        this.state.w = window.innerWidth;
        this.state.h = window.innerHeight;
        this.components.homepage.resize();
    },
    tick : function (timestamp) {
        if (this.start === undefined)
             this.start = timestamp;

        var elapsed = (timestamp - this.start) / 1000;

        this.components.homepage.tick(elapsed);
        requestAnimationFrame(this.tick.bind(this));
    }
}

document.addEventListener("DOMContentLoaded", app.init.bind(app));
