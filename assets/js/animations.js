var ua = navigator.userAgent;
var isMobile = (ua.search(/iphone|linux/gi) > 0) ? true : false;

try {
  if(innerWidth > 742) {
    $('#hoc').velocity({ opacity: [1,0] });
    autoAdjust();
    window.onload = function() {
      //window.requestAnimationFrame(showText);
    };
  } else {
    autoAdjust();
    window.onload = function() {
      window.requestAnimationFrame(showMobileText);
    };
  }
} catch (err) {
  console.log(err);
}

window.onresize = autoAdjust;