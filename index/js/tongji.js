

//订单来源记录: 需要在需统计的页面头部新增如下代码：window.enable_ad_stat_ord = true; //表示本页面启用订单来源统计
//cookie名称：adfrom 、adref
function _RequestString(a) { var b = new RegExp("(^|&)" + a + "=([^&]*)(&|$)"); var r = window.location.search.substr(1).match(b); if (r != null) { return decodeURI(r[2]) } return "" } function _getCookie(name) { var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)"); if (arr = document.cookie.match(reg)) { return unescape(arr[2]) } else { return "" } } function _addCookie(name, value, days, path) { var name = escape(name); var value = escape(value); var expires = new Date(); expires.setTime(expires.getTime() + days * 3600000 * 24); path = path == "" ? "" : ";path=" + path; var _expires = (typeof days) == "string" ? "" : ";expires=" + expires.toUTCString(); document.cookie = name + "=" + value + _expires + path };
if (typeof (enable_ad_stat_ord) != "undefined" && enable_ad_stat_ord) { var adfrom = _RequestString("adfrom"); var adref = document.referrer; if (adfrom) { _addCookie("adfrom", adfrom, "", "/") } if (adref) { _addCookie("adref", adref, "", "/") } };



//百度统计
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fcf1920cd78fec4dcdfbe5f528a5aa8c6' type='text/javascript'%3E%3C/script%3E"));


var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Ffd82c57a8319c1dbafb08c6a6a52bfdd' type='text/javascript'%3E%3C/script%3E"));
  



var _sogou_sa_q = _sogou_sa_q || [];
_sogou_sa_q.push(['_sid', '15531-16104']);
(function () {
var _sogou_sa_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");
var _sogou_sa_src = _sogou_sa_protocol + "hermes.sogou.com/sa.js%3Fsid%3D15531-16104";
document.write(unescape("%3Cscript src='" + _sogou_sa_src + "' type='text/javascript'%3E%3C/script%3E"));
})();


//var _qqhmProtocol = "http://tajs.qq.com/stats?sId=36636532";腾讯统计
var _qqhmProtocol = "http://tajs.qq.com/gdt.php?sId=34994518";//广点通统计
document.write(unescape("%3Cscript src='" + _qqhmProtocol + "' type='text/javascript'%3E%3C/script%3E"));


if(top.location != location){ 
    document.write("<style type=\"text/css\">#BDBridgeWrap{display:none;}</style>");
}  



//自动弹出qq聊天窗口：
/*
var qq_chat = true;
function PlayJsAdPopWin() {
 if (qq_chat) {
     popwin = window.location.href = "tencent://message/?Menu=yes&amp;amp;uin=938002869&amp;amp;Service=58&amp;amp;SigT=A7F6FEA02730C988193D82A852583714787989509BB563904A2E343BAFDEB57F0213ED7E21EFCE484206324B88A5DC52A080DE951A09C8C76DD6D1D12D42DE41EF3EA95D4E512475333A95B020C4B537F8D2A9A55AD9DF35882C0D86CBEFCCB83ADFD6353FD12AAB6766A14C740CE7944C10A16D7A762A51&amp;amp;SigU=30E5D5233A443AB211F4750FF33BCA80DC17108FBA5C6F48139A435BCDD887018C1679108838A4CB5F767D0B8D0BFEB627F1C6FAF95490AE4AA940C5F838AA90CEA2CF4D525169C0"
 }
};
setTimeout("PlayJsAdPopWin()", 300000);
*/


//通过邮件进入网站后的点击统计 ，该统计代码需要放在“http://tj.rfgxy.com/tj.js”的后面，才能正确记录数据
/**/


$(function () { var g = RequestString("PLANEMAIL"); if (g && g != null) { var h = g.split("$")[1]; var i = g.split("$")[2]; var j = "http://jcmanage.rfgxy.com/jc_email_autosending/ajax/email_click_log.aspx?action=email_click"; j += "&email=" + escape(h); j += "&plan_id=" + i; CrossAjaxMethod(j, null) } $(document).on("click", "a", function () { var a = $(this).attr("href"); var b = $(this).attr("title"); var c = $(this).text(); b = b ? b : ""; c = c ? c : ""; var d = window.location.host; var e = window.location.href; if (b == "" && c == "") { return } var f = "http://jcmanage.rfgxy.com/jc_email_autosending/ajax/email_click_log.aspx?action=site_click"; f += "&href=" + escape(a); f += "&title=" + escape(b); f += "&text=" + escape(c); f += "&domain=" + escape(d); f += "&url=" + escape(e); var cookie_val = getcookie("C_P_ID"); if (cookie_val != "") { CrossAjaxMethod(f, null) } }); function CrossAjaxMethod(b, c) { $.ajax({ type: "get", url: b, dataType: "jsonp", jsonp: "jsoncallback", success: function (a) { if (c != null) { c(a) } } }) } function RequestString(a) { var b = new RegExp("(^|&)" + a + "=([^&]*)(&|$)"); var r = window.location.search.substr(1).match(b); if (r != null) { return decodeURI(r[2]) } return null } function getcookie(name) { var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)"); if (arr = document.cookie.match(reg)) { return unescape(arr[2]) } else { return "" } } });