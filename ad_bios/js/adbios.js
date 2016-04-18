
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Pop a pre-sized window, based on variables...
function openCustomWin(urly,wid,ht,topz,leftz,namaroni,scrl) {
   pd = "";
   tf = pd + urly;
   nw = window.open(tf,namaroni,"width=" + wid + ",height=" + ht + ",top=" + topz + ",left=" + leftz + ",scrollbars=" + scrl);
}