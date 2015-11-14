var smartstats_url = 'http://tj.jcpeixun.com/';
//var smartstats_locationurl = 'http://192.168.0.192:8091/';

var d = document;
var smartstats_locationurl = String(d.location);
var smartstats_date = new Date();
var smartstats_zone = 0 - smartstats_date.getTimezoneOffset() / 60;
var smartstats_color = screen.colorDepth;
var smartstats_ResolutionW = screen.width;
var smartstats_ResolutionH = screen.height;
var webReferer = null; //获得来源
try {
    webReferer = top.document.referrer;
} catch (e) {
    webReferer = document.referrer;
}
var smartstats_referrer = escape(webReferer);
var smartstats_outstr = '<script language=javascript src=' + smartstats_url + 'index.aspx?zone=' + smartstats_zone
	+ '&ResolutionC=' + smartstats_color
	+ '&ResolutionW=' + smartstats_ResolutionW
	+ '&ResolutionH=' + smartstats_ResolutionH
	+ '&locationurl=' + escape(smartstats_locationurl)
	+ '&referrer=' + smartstats_referrer
	+ '><\/script>';
document.write(smartstats_outstr);

document.onclick = smartimgon;
function smartimgon(reftime) {
    var smart_time = new Date();
    var smart_img = new Image();
    //smart_img.src='tj1.asp?ts='+new Date().toLocaleTimeString();
    smart_img.src = smartstats_url + "Action_click.ashx?ts=" + new Date().toLocaleTimeString() + "&locationurl=" + smartstats_locationurl;
    //var smartimgtimeout=setTimeout('smartimgon(5000);',reftime);
}

window.onbeforeunload = smartimgon; 