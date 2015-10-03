<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="initial-scale=0.5" />
<title>E m e r g e n c y P u f f J a c k e t . c o m</title>
<link rel="stylesheet" type="text/css" href="css/epj.css" />
<style type="text/css" media="all">
</style>
<!-- begin auto analytics block -->
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-192935-6']);
_gaq.push(['_trackPageview']);
(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<!-- end auto analytics block -->
</head>
<body>
<div class="contain">
<div id="text-shadow-box">
<div class="wall">
    <div id="tsb-box"></div>
    <p id="tsb-text">EmergencyPuffJacket.com</p>
    <div></div>
</div>
<div id="tsb-spot"></div>
</div>

<script type="text/javascript" language="javascript" charset="utf-8">
/**
 * Zachary Johnson
 * June 2009
 * www.zachstronaut.com
 */
var text = null;
var spot = null;
var box = null;
var boxProperty = '';
///window.onload = init;
init();
function init() {
    text = document.getElementById('tsb-text');
    spot = document.getElementById('tsb-spot');
    box = document.getElementById('tsb-box');
    if (typeof box.style.webkitBoxShadow == 'string') {
        boxProperty = 'webkitBoxShadow';
    } else if (typeof box.style.MozBoxShadow == 'string') {
        boxProperty = 'MozBoxShadow';
    } else if (typeof box.style.boxShadow == 'string')
    {
        boxProperty = 'boxShadow';
    }
    if (text && spot && box) {
        document.getElementById('text-shadow-box').onmousemove = onMouseMove;
        document.getElementById('text-shadow-box').ontouchmove = function (e) {e.preventDefault(); e.stopPropagation(); onMouseMove({clientX: e.touches[0].clientX, clientY: e.touches[0].clientY});};
    }
    onMouseMove({clientX: 300, clientY: 200});
}
function onMouseMove(e) {
    var xm = e.clientX - 300;
    var ym = e.clientY - 175;
    var d = Math.round(Math.sqrt(xm*xm + ym*ym) / 5);
    text.style.textShadow = -xm + 'px ' + -ym + 'px ' + (d + 10) + 'px black';
    if (boxProperty) {
        box.style[boxProperty] = '0 ' + -ym + 'px ' + (d + 30) + 'px black';
    }
    xm = e.clientX - 600;
    ym = e.clientY - 450;
    spot.style.backgroundPosition = xm + 'px ' + ym + 'px';
}
</script>
<p class="teenytiny">Shadow effects created by zachary johnson at <a href="http://www.zachstronaut.com/">zachstronaut</a></p>
</body>
</html>