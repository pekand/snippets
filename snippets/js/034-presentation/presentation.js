class Presentation {

	constructor(firstElement) {

		this.history = [];

		this.bindEvents();

		
		this.first();
		this.buildHistory();

		//console.log(this.firstElement.dataset.first);

		//console.log([this.firstElement]);
	}

	bindEvents() {
		document.onkeydown = this.keydown.bind(this);
	}

	keydown(e) {
		console.log(e.which);
		switch(e.which) {
	        case 37: // left
	        this.prev();
	        break;

	        case 38: // up
	        break;

	        case 39: // right
	        this.next();
	        break;

	        case 40: // down
	        break;

	        default: return;
	    }
	    e.preventDefault();
	}

	id(id) {
		return document.getElementById(id.replace("#", ""));
	}

	select(selector) {
		let elements = document.querySelectorAll(selector);

		if(elements.length == 1) {
			return elements[0];
		}

		return elements;
	}

	setUrl(id) {
		let hash = id.replace("#", "");

		if(window.location.hash == hash){
			return;
		}

		window.location.hash = hash;
	}

	buildHistory() {
		if(window.location.hash == "") {
			return;
		}

		let activeElementId = window.location.hash;
		let activeElement = this.id(activeElementId);

		if(activeElement == null) {
			return;
		}

		let allElements = this.select('[data-next]');

		for (var i = 0, len = allElements.length; i < len; i++) {
		    if(allElements[i] == activeElement) {
			  	break;
			}

			this.history.push(allElements[i]);
		}

		for (var i = 0, len = this.history.length; i < len; i++) {
			if(this.history[i].contains(activeElement)){
				this.history[i].classList.add("active");
			}
		}

		this.activate(this.active, activeElement);

		this.active = activeElement;
		this.active.classList.add("selected");
		this.active.classList.add("active");

		if (this.active.hasAttribute('data-action') && 
			!this.active.classList.contains(this.active.dataset.action)) {
			this.active.classList.add(this.active.dataset.action);
		}

		this.active.scrollIntoView();
	}

	first() {
		this.firstElement = this.select("[data-first]");
		this.active = this.firstElement;
		this.firstElement.classList.add("active");
		this.firstElement.classList.add("selected");
	}

	activate(prev, next) {

		if (typeof prev == "undefined" || typeof next == "undefined") {
			return;
		}

		let oldParents = [];
		let newParents = [];
		let elem = null;

		elem = prev;
		for ( ; elem && elem !== document; elem = elem.parentNode ) {
			if(elem.hasAttribute('data-next')) {
				oldParents.push(elem);
			}
		}

		elem = next;
		for ( ; elem && elem !== document; elem = elem.parentNode ) {
			if(elem.hasAttribute('data-next')) {
				newParents.push(elem);
			}
		}

		for(let i = 0; i < oldParents.length; i++) {
		    if (!newParents.includes(oldParents[i])) {
		    	oldParents[i].classList.remove("active");
		    }
		}

		for(let i = 0; i < newParents.length; i++) {
		    if (!newParents[i].classList.contains("active")) {
		    	newParents[i].classList.add("active");
		    }
		}
	}

	next() {
		let nextElementId =this.active.dataset.next

		if(typeof nextElementId == 'undefined' || nextElementId.trim() == "") {
			return;
		}

		let nextElement = this.select(nextElementId);

		if(typeof nextElement == 'undefined') {
			return;
		}

		this.activate(this.active, nextElement);

		if (this.active.hasAttribute('data-action') && 
			this.active.classList.contains(this.active.dataset.action)) {
			this.active.classList.remove(this.active.dataset.action);
		}

		this.active.classList.remove("selected");
		this.history.push(this.active);
		this.active = nextElement;
		this.active.classList.add("selected");

		if (this.active.hasAttribute('data-action') && 
			!this.active.classList.contains(this.active.dataset.action)) {
			this.active.classList.add(this.active.dataset.action);
		}

		this.setUrl(this.active.id);
		this.active.scrollIntoView();
	}

	prev() {
		if(this.history.length == 0) {
			return;
		}

		let  prevElement = this.history.pop();

		this.activate(this.active, prevElement);

		if (this.active.hasAttribute('data-action') && 
			this.active.classList.contains(this.active.dataset.action)) {
			this.active.classList.remove(this.active.dataset.action);
		}

		this.active.classList.remove("selected");
		this.active = prevElement;
		this.active.classList.add("selected");

		if (this.active.hasAttribute('data-action') && 
			!this.active.classList.contains(this.active.dataset.action)) {
			this.active.classList.add(this.active.dataset.action);
		}

		this.setUrl(this.active.id);
		this.active.scrollIntoView();
	}

	last() {

	}

}

document.addEventListener('DOMContentLoaded', () => {
	var p = new Presentation();
}, false);


