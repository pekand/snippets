var timer1 = setTimeout(function(){
    console.log("timer1");
}, 1000)

var timer2 = setTimeout(function(){
    console.log("timer2");
}, 1000)

clearTimeout(timer2);

var timer3 = setInterval(function(){
    console.log("timer3");
}, 1000);
