
function fun(callback){
    if (callback && typeof(callback) === "function") {
      callback();
    }
}
