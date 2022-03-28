//运动框架
var Tween = {
    linear: function (t, b, c, d){  //匀速
        return c*t/d + b;   //  t/d = prop;
    }
};
function move(target , time ) {
    //requestAnimationFrame兼容
    window.requestAnimationFrame=window.requestAnimationFrame||function(a){return setTimeout(a,1000/60)};
    window.cancelAnimationFrame=window.cancelAnimationFrame||clearTimeout;

    var sTime = new Date;//初始时间
    var sVal = parseFloat( window.scrollY );//初始值

    ~function m() {
        var t = new Date - sTime,//经过了多长时间
            b = sVal, //初始值
            c = target - sVal, //变化值
            d = time; //总时长

        if ( t >= d ){
            t = d;
        }else{
            requestAnimationFrame(m);
        }
        var s = Tween.linear(t,b,c,d);

        document.documentElement.scrollTop = document.body.scrollTop = s;
    }();

}