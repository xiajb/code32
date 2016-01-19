/*
    jc.common.js
    v1
    2013.1.1
    ningyb
*/
var jc = {
    /*
       判断是否登录
    */
    "isLogined": function(){
        var logined = $.cookie("learnerId");
        if (logined != null) {
            return true;
        }
        return false;
    },
    /*
        判断是否注册（新版注册 entrance = 1）
    */
    "isRegistered": function(){
        var entrance = $.cookie("regEntrance");
        var emailpass = $.cookie("emailPass");
        if (entrance == "1" && emailpass=="1") {
            return true;
        }
        return false;
    },
    /*
        判断手机是否通过验证（新版注册 entrance = 1）
    */
    "mobileIsPass": function(){
        var entrance = $.cookie("regEntrance");
        var mobile = $.cookie("mobilePass");
        if (entrance == "1" && mobile == "1") {
            return true;
        }
        return false;
    }
}

/*
*/
function CheckLoginemail() {
    var login = $.cookie("learnerId");
    if (login == null) {
//        $.Boxen.open(window, {
//            url: "/newlogin.aspx",
//            urlParams: { callback: document.URL, comment: "1" },
//            width: 450,height: 400,
//            postClose: function () { }
//        });
        window.location.href = "http://www.rfgxy.com/newlogin.aspx?callback=" + escape(document.URL);
        return false;
    }
    else {
        return true;
    }


}
function CheckIsemailRegister() {
    var login = $.cookie("regEntrance");
    var emailpass = $.cookie("emailPass");
    if (login == "1" && emailpass=="0") {
        $.Boxen.open(window, {
            url: "/emailregister/v_email.aspx",
            urlParams: { callback: document.URL, comment: "1" },
            width: 450,height: 400,
            postClose: function () { }
        });
        return false;
    }
    else {
        return true;
    }
}
function Checkmobilepass() {
    var login = $.cookie("regEntrance");
    var mobile = $.cookie("mobilePass");
    if (login == "1" && mobile == "0") {
        $.Boxen.open(window, {
            url: "/emailregister/v_mobile.aspx",
            urlParams: { callback: document.URL, a:"down", jk:"site.down.1" },
            width: 500,height: 450,
            postClose: function () { }
        });
        return false;
    }
    else {
        return true;
    }
}
function Checkallmobilepass() {
    var mobile = $.cookie("mobilePass");
    if (mobile == "0") {
        $.Boxen.open(window, {
            url: "/emailregister/v_mobile.aspx",
            urlParams: { callback: document.URL, a: "comment", jk: "site.down.1" },
            width: 500,height: 450,
            postClose: function () { }
        });
        return false;
    }
    else {
        return true;
    }
}

/* 返回_url中_para的值 */
function GetQueryString2(_url, _para) {
    var reg = new RegExp("(^|&)" + _para + "=([^&]*)(&|$)");
    var r = _url.substring(_url.indexOf("?")).substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}

/* 进入答疑 */
function IntoDY(time) {
    $.ajax({
        type: "get",
        cache: false,
        url: "/ashx/lesson/EnterNew.aspx?time=" + escape(time),
        success: function (d) {
            d = eval("(" + d + ")");
            if (d.message != "" && d.message != "yes") {
                alert(d.message);
                //return false;
            } else if (d.url != null || d.url != "") {
                //$("#enterNew").attr("href", d.url);
                if (d.message == "yes") {
                    window.location.href = "/include/UserLogin_chat.asp?username=" + escape(d.url); //"../Meeeting/RemoteMeeting.aspx";//
                }
                else {
                    window.location.href = d.url;
                }
            } else {
                DetectActiveX1();
            }
        }
    });
    return false;
}
/*进入YY公开课 2013-08-15*/
function IntoDY1(time,coursename) {
    $.post("http://www.rfgxy.com/ashx/lesson/EnterNewYY.aspx", { 'time': escape(time), 'name': coursename }).done(function (d) {
        if ($.parseJSON(d).message == "1") {
            //window.parent.location.href = "http://bbs.rfgxy.com/thread-36046-1-1.html";
			window.parent.location.href = "yy://join:room_id=81114100";
        }
        else {
            $.Boxen.open(window, {
                url: "/ashx/lesson/YYcourseopen.aspx",
                urlParams: { time: escape(time), message: $.parseJSON(d).message,name:coursename },
                width: 500,height: 200,
                postClose: function () { }
            });
            //alert($.parseJSON(d).message);
            return false;
        }
    });
 }
function DetectActiveX1() {
    try {
        var comActiveX = new ActiveXObject('V2.V2Ctrl.1');
    } catch (e) {
        alert("您还没有安装语音插件，请安装后再进入在线答疑辅导中心");
        //$("#chajian").css("font-weight", "bold");
        return false;
    }
    $.post("/ashx/lesson/EnterNew.ashx", { "id": 4 }, function (data, textStatus) {
        alert("答疑正在进行，可以进入，页面开始跳转");
    });
    window.location.href = '/include/UserLogin_chat.asp';
    return true;

}

$(function () {



    $.doTimeout(1000, function () {

        /* 垂直课程分类菜单 */
        if ($("#index_20131009").length) {
            //$("#sidebar_nav_contents").show();
            $("#sidebar_nav_contents").addClass("db");
            $(".sidebar_nav .i1").addClass("sidenav_i_bgn");
        } else {
            $("#sidebar_nav_contents").addClass("dn");
            //$("#sidebar_nav_contents").css({"display":"none"});
            $(".sidebar_nav .i1").addClass("sidenav_i_bg1");
        }
        //$("#sidebar_nav_contents").delegate(".sidebar_nav_content_title","mouseover",function(){
        $(".sidebar_nav").hoverForIE6({ current: "sidebar_navhover", delay: 300 });
        $(".sidebar_nav .sidebar_nav_content").hoverForIE6({ delay: 150 });
        //});


        /* 首页焦点图片水平滚动 */
        if ($("#adSlider").length) {
            $("#adSlider").Xslider({
                // 默认配置
                affect: 'scrollx', //效果  有scrollx|scrolly|fade|none
                speed: 1000, //动画速度
                space: 1000 * 5, //时间间隔
                auto: true, //自动滚动
                trigger: 'mouseover', //触发事件 注意用mouseover代替hover
                conbox: '.lessonAd1', //内容容器id或class
                ctag: 'li', //内容标签 默认为<a>
                switcher: '.lessonAd2', //切换触发器id或class
                stag: 'li', //切换器标签 默认为a
                current: 'cur', //当前切换器样式名称
                rand: false //是否随机指定默认幻灯图片
            });
        };

    });


    
    $.doTimeout(3000, function () {
        /* 学员中心下拉菜单 */
        if ($("#myjc").length) {
            $("#myjc").delegate("dl.myjc-dl", "mouseover", function (event) {
                $(this).addClass("hover");
            }).delegate("dl.myjc-dl", "mouseout", function (event) {
                $(this).removeClass("hover");
            });
        }
        /* 头部大图小图广告 */
        if ($.cookie("ads_ed20140303") != "true") {
            if ($("#js_ads_banner_top_slide").length) {
                var $slidebannertop = $("#js_ads_banner_top_slide"), $bannertop = $("#js_ads_banner_top");
                setTimeout(function () { $bannertop.slideUp(1000); $slidebannertop.slideDown(1000); }, 2500);
                setTimeout(function () { $slidebannertop.slideUp(1000, function () { $bannertop.slideDown(1000); }); }, 12500);
                $.cookie("ads_ed20140303", "true");
            }
        }
        /*   头部登录信息   */
        var l = $.cookie("learnerId");
        //if (l == null) { return; }
        $.post("/ashx/loginstate.aspx", function (data) {
            //alert(data);
            if (data == "no") {
                //未登录

                var login_line_html = "欢迎来到儒风国学院！ [<a class=\"topLeft2Load\" title=\"请登录\" target=\"_top\" href=\"http://www.rfgxy.com/newlogin.aspx\">请登录</a>]  [<a class=\"topLeft2Reg\" title=\"免费注册\" target=\"_top\" href=\"http://www.rfgxy.com/userreg.aspx\">免费注册</a>]";
                $("#login_top_line").html(login_line_html);
                $("#login_top_table_islogin").hide();
                $("#login_top_table").show();
            }
            else if (data == "no1") {
                window.parent.location.href = "http://www.rfgxy.com/newlogin.aspx?callback=" + GetQueryString('geturlvaluenew');
            } else {
                //已登录
                json = $.parseJSON(data);
                var learnername_str = json.name; //学员账号
                var learnergrade_str = json.grade; //学员等级
				var vipExpireTime = json.vipExpireTime;
				//alert(vipExpireTime);

				var login_line_html = "你好，<b>" + learnername_str + "</b>&nbsp;&nbsp;<a href=\"http://www.rfgxy.com/logout.aspx?callback=" + escape(window.location.href) + "\">[退出]</a>";
                //var login_line_html = " " + learnername_str + "，欢迎来到儒风国学院！<a href='http://192.168.0.192:8081/member.php?mod=logging&amp;action=logout&amp;formhash=1639d97f'>[退出]</a>";
                $("#login_top_line").html(login_line_html);

                //$("#login_top_table_info").html(learnername_str + "<a href='http://my.rfgxy.com/index.aspx?url=user/Grade.aspx' class='f2'>[" + learnergrade_str + "]</a>" + "<a href=\"http://www.rfgxy.com/userreg.aspx?u=20130925003\" target=\"_blank\" id=\"nav_xuefei\" onclick=\"_hmt.push(['_trackEvent', 'nav', 'click', 'nav_xuefei','1'])\" style=\"background: url(http://images.rfgxy.com/bg_20130926001.gif) no-repeat scroll 46px -3px rgb(255, 255, 255)\">赚学费</a>");

                //$("#login_top_table_islogin").show();
                //$("#login_top_table").hide();

                $("#loginno_top_table").hide();
                $("#logined_top_table").show();

                /*修改20140121*/
				if(learnergrade_str == "普通学员")
					$("#logined_20140121").html("您好，<a href=\"http://my.rfgxy.com/\">" + learnername_str + "</a> [" + learnergrade_str + "], <a href=\"http://www.rfgxy.com/logout.aspx?callback=" + escape(window.top.location.href) + "\">退出</a>").show();
                else
					$("#logined_20140121").html("您好，<a href=\"http://my.rfgxy.com/\">" + learnername_str + "</a> [" + learnergrade_str + "," + vipExpireTime + "到期], <a href=\"http://www.rfgxy.com/logout.aspx?callback=" + escape(window.top.location.href) + "\">退出</a>").show();
                
				$("#logino_20140121").hide();

            }

        });
        /*   直播课程表   */
        $.ajax({
            type:"get",
            url:"http://u.rfgxy.com/class/api/YYcourseDate2.ashx?type=1",
            dataType:"jsonp",
            jsonp:"jsoncallback"
        }).done(function(d){
			try{
			
				//var d = $.parseJSON(d);
				var temp_str2="", link="", time1="", time2="", _minutes1="", b = 1;
				for (var i = 0; i < d.length; i++) {
					link = d[i].url.length<=0?"http://u.rfgxy.com/class/"+d[i].id:d[i].url; 
					time1 = formatDate(d[i].startime);
					_minutes1 = time1.getMinutes()=="0"?"00":time1.getMinutes();
					time2 = time1.getHours()+":"+_minutes1;

					temp_str2 +="<li class=\"list"+b+"\"><div class=\"h40 oh\"><span class=\"mr10 cblue11 b\">"+time2+"</span><a href=\""+link+"\" target=\"_blank\" class=\"btn_link\" title=\""+d[i].class_name+"\">"+d[i].class_name+"</a></div><div class=\"timeline timeline"+(i+1)+"\"></div></li>";
					if (b==1) {b=b+1;}else if(b==2){b=b-1;};
				};
				$("#n_content_wrapper").html(temp_str2);

				var curtime = formatDate($("#curtime").val());
				//var curtime = formatDate(d[0].startime);
				var _curtime = (parseInt(curtime.getMonth())+1)+"月"+curtime.getDate()+"日";
				$("#course_day").html(_curtime);

			}catch(ex){
			
			}



        });

    });



    $.doTimeout(5000, function () {

        /* 图片懒加载 */
        $("img.lazy").lazyload({ placeholder: "http://images.rfgxy.com/equipment/logo_lazy.gif?a=20131019001", failurelimit: 4, threshold: 200, effect: "fadeIn" });

        /* 加载不同的logo,链接 */
        var cur_location = window.location.href;
        if (!cur_location.indexOf("http://www.rfgxy.com/xiazai/")) {
            $("#btn_logo").attr({"href":"http://www.rfgxy.com/xiazai/","title":"儒风国库——自动化资料下载中心"})
            $("#img_logo").attr({"src":"http://images.rfgxy.com/xiazai_logo.png","title":"儒风国库——自动化资料下载中心","alt":"儒风国库——自动化资料下载中心"});
            //str = "<a href=\"http://www.rfgxy.com/xiazai/\" title=\"儒风国库——自动化资料下载中心\" id=\"btn_logo\"><img src=\"http://images.rfgxy.com/xiazai_logo.png\" width=\"230\" height=\"55\" alt=\"儒风国库——自动化资料下载中心\" title=\"儒风国库——自动化资料下载中心\" id=\"img_logo\" /></a>";
        }else{
            //str = "<a href=\"http://www.rfgxy.com/\" title=\"儒风国学院\" id=\"btn_logo\"><img src=\"http://logo.png\" width=\"230\" height=\"55\" alt=\"儒风国学院\" title=\"儒风国学院\" id=\"img_logo\" /></a>";
        };
        //$("#headLeft1").html(str);

        /*   搜索   */
        function appendArgs(_arg, _id) {
            var _href = location.href.indexOf("lessonSearch") > 0 ? location.href : "http://www.rfgxy.com/lesson/lessonSearch";
            //var _href = "http://www.rfgxy.com/lesson/lessonSearch";
            var _url = _href.substring(0, _href.indexOf("?")) || _href;
            var $id_html = escape($(_id).html());
            if (_href.indexOf("?") > 0) {
                _url = _href;
            }
            return $.request.setQueStr(_url, _arg, $id_html);
        }

        function appendArgs2(_arg, _id) {
            //var _href = location.href;
            var _href = "http://www.rfgxy.com/lesson/lessonSearch";
            var _url = _href.substring(0, _href.indexOf("?")) || _href;
            if (_href.indexOf("?") > 0) {
                _url = _href;
            }
            return $.request.setQueStr(_url, _arg, _id);
        }

        /*
        $("#lessonTypeUl #l1 a").click(function () {
            window.location.href = appendArgs("brand", "#" + $(this).attr("id"));
        });

        $("#lessonTypeUl #l2 a").click(function () {
            window.location.href = appendArgs("device", "#" + $(this).attr("id"));
        });

        $("#lessonTypeUl #l3 a").click(function () {
            window.location.href = appendArgs("course", "#" + $(this).attr("id"));
        });
        */

        $("#lessonTypeUl li a").click(function () {
            var _url = "http://www.rfgxy.com/lesson/lessonSearch" ,
                $this = $(this) ,
                $this_html = $this.html() ,
                $this_parent = $this.parent("li");
            if ($this_parent.attr("id")=="l1") {
                _url = $.request.setQueStr(_url, "brand", escape($this_html) );

                var $l2_a = $("#lessonTypeUl #l2 a.chose").html();
                if ($l2_a) {
                    _url = $.request.setQueStr(_url, "device", escape($l2_a) );
                };
                /*
                var $l3_a = $("#lessonTypeUl #l3 a.chose").html();
                if ($l3_a) {
                    _url = $.request.setQueStr(_url, "course", escape($l3_a) );
                };
                */
            }else if ($this_parent.attr("id")=="l2") {
                _url = $.request.setQueStr(_url, "device", escape($this_html) );

                var $l1_a = $("#lessonTypeUl #l1 a.chose").html();
                if ($l1_a) {
                    _url = $.request.setQueStr(_url, "brand", escape($l1_a) );
                };
                /*
                var $l3_a = $("#lessonTypeUl #l3 a.chose").html();
                if ($l3_a) {
                    _url = $.request.setQueStr(_url, "course", escape($l3_a) );
                };
                */
            }else if ($this_parent.attr("id")=="l3") {
                _url = $.request.setQueStr(_url, "course", escape($this_html) );

                var $l1_a = $("#lessonTypeUl #l1 a.chose").html();
                if ($l1_a) {
                    _url = $.request.setQueStr(_url, "brand", escape($l1_a) );
                };
                /*
                var $l2_a = $("#lessonTypeUl #l2 a.chose").html();
                if ($l2_a) {
                    _url = $.request.setQueStr(_url, "device", escape($l2_a) );
                };
                */
            };

            window.location.href = _url;

        });


        var req1 = $.request.getQueStr2("brand");
        var req2 = $.request.getQueStr2("device");
        var req3 = $.request.getQueStr2("course");

        $("#lessonTypeUl #l1 a").each(function () {
            if ($.trim($(this).html()) == req1) {
                $(this).addClass("chose").siblings("a").removeClass("chose");
            }
        });
        $("#lessonTypeUl #l2 a").each(function () {
            if ($.trim($(this).html()) == req2) {
                $(this).addClass("chose").siblings("a").removeClass("chose");
            }
        });
        $("#lessonTypeUl #l3 a").each(function () {
            if ($.trim($(this).html()) == req3) {
                $(this).addClass("chose").siblings("a").removeClass("chose");
            }
        });

        /* 课程搜索（课程列表，最受欢迎，最多收藏，最多好评） */
        var req_tab = $.request.getQueStr2("tab");
        $("#searchTitle li").each(function () {
            if (req_tab != "" && $(this).attr("id") == "tid" + req_tab) {
                $(this).addClass("on").siblings("li").removeClass("on");
            }
        });

        $("#searchTitle li").click(function () {
            var test = appendArgs("tab", "#" + $(this).attr("id"));
            window.location.href = appendArgs2("tab", $(this).attr("id").replace("tid", ""));
        });



        /* 输入框搜索 */
        var s = "17323522629653896619";
        var search_types = {
            "all": function (arg1) {
                //return "http://baidu.rfgxy.com/cse/search?q=" + arg1 + "&s=" + s;
				return "http://zhannei.baidu.com/cse/search?q=" + arg1 + "&s=" + s;
            },
            "course": function (arg1) {
                return "http://www.rfgxy.com/lesson/lessonSearch?q=" + escape(arg1);
            },
            "video_course": function (arg1) {
                return "http://www.rfgxy.com/lesson/lessonSearch?q=" + escape(arg1);
            },
            "case_course": function (arg1) {
                return "http://www.rfgxy.com/lesson/lessonSearch?q=" + escape(arg1) + "&course=%u6848%u4F8B%u8BFE%u7A0B";
            },
            "down": function(arg1){
                //return "http://baidu.rfgxy.com/cse/search?q="+ arg1 +"&s="+s+"&nsid=2";
				return "http://zhannei.baidu.com/cse/search?q="+ arg1 +"&s="+s+"&nsid=2";
            }
        }
        /* 头部搜索 */
        var topSearch = function () {
            //if (CheckLoginemail()) {
            var searchText = $("#searchText").val();
            if (!searchText) {
                $("#searchText").val("请输入要搜索的内容").focus();
            } else if (!$.trim(searchText).indexOf("请输入要搜索的内容")) {
                $("#searchText").val("请输入要搜索的内容").focus();
            } else {
                //if (CheckIsemailRegister()) {
                    var search_type_on = "all",
                        search_text = $("#searchText").val()
                    ;
                    var cur_location = window.location.href;
                    if (!cur_location.indexOf("http://www.rfgxy.com/xiazai/")) {
                        search_type_on = "down";
                    };
                    window.location.href = search_types[search_type_on](search_text);
                //}
            }
            //}
        }

        $("#headAD").delegate("#searchText", "click mouseenter", function () {
            if ($.trim($(this).val()) == "请输入要搜索的内容") {
                $(this).val("").focus();
            };
        });

        $("#searchBtn").click(topSearch);
        $("#bannerCont1Right").delegate("#searchText", "click", function () {
            var searchText = $("#searchText").val();
            if ($.trim(searchText) == "请输入要搜索的内容") {
                $("#searchText").val("");
            }
        });
        $("#bannerCont1Right").delegate("#searchText", "blur", function () {
            var searchText = $("#searchText").val();
            if ($.trim(searchText) == "") {
                $("#searchText").val("请输入要搜索的内容");
            }
        });

        $("#searchText").keydown(function (event) {
            if (event.which == 13) {
                topSearch();
            }
        });

        $("#search_types").delegate("li", "click", function () {
            var $this = $(this);
            $this.addClass("on").siblings("li").removeClass("on");
        });


    });







    /* 加载对联
    $.get("http://www.rfgxy.com/ashx/ad-couplet.aspx?id=17").done(function(d){
    $(document.body).append(d)
    .delegate("#left_close,#right_close","click",function(){
    $("#ad_left,#ad_right,#left_close,#right_close").hide();
    });
    });*/

    $.doTimeout(7000, function () {

        /* 名师推荐，左右滚动 */
        if ($("#teacherMain").length) {
            $("#teacherMain").slider({
                unitdisplayed: 4,
                movelength: 1,
                unitlen: 231,
                autoscroll: null
            });
        };
        /* 底部学员心声 */
        if ($("#stuContUl").length) {
            setInterval(function () {
                $("#stuContUl li:last").hide().insertBefore($("#stuContUl li:first")).slideDown(1000);
            }, 5000);
        };

        /* 留言板 */
        $("body").append("<div class='liuyanbantop'>"
                       + "    <ul>                 "
                       + "        <li id='sc' style='text-align:right;'><img id='showliuyan' src='http://images.rfgxy.com/leaveplay_01.gif' style='cursor:pointer;' /></li>"
                       + "        <li>&nbsp;</li><li>留言内容：</li><li><textarea id='lycontent' style='width:200px; height:70px;overflow:hidden;border:solid 1px #aaaaaa;' ></textarea></li>"
                       + "        <li>&nbsp;</li><li>手机号码：</li><li><input id='lyphone' type='text' style='width:200px;'/></li><li>&nbsp;</li>"
                       + "        <li>请点击发送提交留言&nbsp;<img id='fasong' src='http://images.rfgxy.com/leavesend.gif' style='cursor:pointer; vertical-align:middle;border:solid 1px #aaaaaa;'/></li>"
                       + "        <li>&nbsp;</li>"
                       + "     </ul>"
                       + "  </div>"
                       + "<div class='liuyanbantop2'><img id='showliuyan' src='http://images.rfgxy.com/leave_small.gif' style='cursor:pointer;' /></div><div class='liuyanbantop3'></div>");

        $(".liuyanbantop2").click(function () {
            $(this).hide();
            $(".liuyanbantop").show();
        });

        $("#showliuyan").click(function () {
            $(".liuyanbantop").hide();
            $(".liuyanbantop2").show();
        });

        $("#fasong").click(function () {
            if ($.trim($("#lycontent").val()).length < 1) {
                //alert("请填写留言内容");
                $("#lycontent").css({ "border": "solid 1px red" });
                $("#lycontent").html("").focus();
            }
            else if ($.trim($("#lycontent").val()).length > 200) {
                alert("您好，您的留言内容过长，请修改");
                $("#lycontent").css({ "border": "solid 1px red" });
                $("#lycontent").html("").focus();
            }
            else if ($.trim($("#lyphone").val()).length < 1) {
                //alert("请填写手机号码");
                $("#lyphone").css({ "border": "solid 1px red" });
                $("#lyphone").val("").focus();
            } else if (!(/^(13[0-9]|15[0-9]|17[0-9]|18[0-9])\d{8}$/).test($("#lyphone").val())) {
                alert("请输入正确的手机号码");
                $("#lyphone").css({ "border": "solid 1px red" });
                $("#lyphone").focus();
            } else {
                if (confirm("请点击确定完成留言的发送,我们将尽快联系您,谢谢!")) {
                    $.ajax({
                        type: "get",
                        url: "/ashx/studentsound/CreateMsg.ashx",
                        cache: false,
                        data: "content=" + encodeURIComponent($("#lycontent").val()) + "&phone=" + encodeURIComponent($("#lyphone").val()) + "",
                        success: function (msg) {
                            if (msg == "留言内容过长") {
                                alert("您好，您的留言内容过长,请修改");
                                $("#lycontent").css({ "border": "solid 1px red" });
                                $("#lycontent").html("").focus();
                            }
                            else {
                                $(".liuyanbantop").hide();
                                $(".liuyanbantop3").html("<ul><li>留言成功!如紧急,请拨免费咨询:110-110-110</li></ul>").slideDown();
                                $(".liuyanbantop2").show();
                                $("#lycontent").val("");
                                $("#lyphone").val("");
                                start = 10;
                                _count();
                            }

                        }
                    });
                }
            }
        });

        var start = 3;
        var step = -1;

        function _count() {
            start += step;
            if (start == 0) {
                $(".liuyanbantop3").html("").hide();
            }
            setTimeout("_count()", 1000);
        }
        /*   页面加载5秒中后，显示留言板   */
        $.doTimeout(3000, function () {
            $(".liuyanbantop2").hide();
            $(".liuyanbantop").show();
        });


        /*  获取最新站内信  */
        $.ajax({
            type: "get",
            url: "http://my.rfgxy.com/ashx/messager/list-handle.aspx?action=new&learnerId=" + $.cookie("learnerId"),
            dataType: "jsonp",
            jsonp: "jsoncallback",
            success: function (d) {
                if (d != "") {
                    var data = d;
                    var content = d.con.replace("&lt;", "<").replace("&gt;", ">");
                    var pop = new Pop(data.title, data.url, content); //弹出提示框
                    $("#pop").delegate("#btn_huifu", "click", function () {
                        window.open(d.url);
                    });
                    $("#pop").append("<input type='hidden' id='hide_pop_base_id' value='" + d.base_id + "'/>");
                }
            }
        });

        /*  点击关闭站内信弹窗   */
        $("#popClose").live("click", function () {
            var base_id = $("#hide_pop_base_id").val();

            pop_message_fun("dialog-clickClose", base_id);

        });

        /*  点击站内信弹窗内容里的超链接 设置该条内容为已读   */
        $("#popIntro a").live("click", function () {
            var base_id = $("#hide_pop_base_id").val();
            pop_message_fun("dialog-setRead", base_id);
        });

        /*  弹窗处理私有方法  */
        function pop_message_fun(action, base_send_id) {
            $.ajax({
                type: "get",
                url: "http://my.rfgxy.com/ashx/messager/list-handle.aspx?action=" + action + "&base_send_id=" + base_send_id, //+ "&learnerId=" + l,
                dataType: "jsonp",
                jsonp: "jsoncallback",
                success: function () { }
            });
        }




        if ($.cookie("popup_ad_ed") != "true") {


            setTimeout(function () {
                try {
                    $.get("http://www.rfgxy.com/ashx/lesson/YYcourseDate.aspx", { "state": "3", "a": new Date().getMilliseconds() }).done(function (d) {
                        try{
                            d = $.parseJSON(d), d = d[0];
                        }catch(ex){

                        }
                        if (d != "" && d != null) {
                            //d = $.parseJSON(d), d = d[0];
                            var startime = formatDate(d.StartTime), endtime = formatDate(d.EndTime);
                            var _hour = startime.getHours(), _minutes = startime.getMinutes(), img_url = d.Imageurl;
                            _startime = formatDate(startime.getFullYear() + "-" + parseInt(startime.getMonth() + 1) + "-" + startime.getDate() + " " + parseInt(startime.getHours() - 2) + ":" + startime.getMinutes() + ":" + startime.getSeconds());

                            $.get("http://www.rfgxy.com/ashx/api/GetSystemDate.aspx").done(function (d) {

                                var cur_date = formatDate(d), cur_date2 = formatDate(d), link1 = "http://www.rfgxy.com/topic/act/20130724/", ad_pic = "http://images.rfgxy.com" + img_url;

                                if (cur_date >= _startime && cur_date < endtime) {

                                    $("#popup_ad").quickAd({ html: "<a href=\"" + link1 + "\"><img id='img1' src='" + ad_pic + "' width='580' height='300' /></a>", closelink: "http://www.rfgxy.com/topic/act/20130724/" });
                                    $.cookie("popup_ad_ed", "true");
                                    var _year = cur_date2.getFullYear(), _month = cur_date2.getMonth() + 1, _date = cur_date2.getDate();
                                    if ($("#countdown_dashboard_main").length) {
                                        $("#countdown_dashboard_main").countDown({
                                            targetDate: { 'year': _year, 'month': _month, 'day': _date, 'hour': _hour, 'min': _minutes, 'sec': 00 },
                                            onComplete: function () {
                                                $("#countdown_dashboard_main").html("<div class=\"dash weeks_dash\"><div class=\"digit2\">正在上课...</div></div>");
                                            }
                                        });
                                    }

                                } else {
                                    /*
                                    var tan = $.cookie("tan");
                                    if($.cookie("tan")!="true"){
                                    $("#popup_ad").quickAd({html:"<a href='http://www.rfgxy.com/topic/act/20131016/'><img id='img2' src='http://images.rfgxy.com/topic/tit_20131019001.png' width='580' height='300' /></a>",closelink:"http://www.rfgxy.com/topic/act/20131016/"});
                                    $("#countdown_dashboard_main").html("<div class=\"h30\">&nbsp;</div>");
                                    $.cookie("tan", "true", {expires: 1});
                                    $.cookie("popup_ad_ed",null);
                                    }
                                    */
                                }

                            });
                        } else {
                            /*
                            if($.cookie("tan")!="true"){
                            $("#popup_ad").quickAd({html:"<a href='http://www.rfgxy.com/topic/act/20131016/'><img id='img2' src='http://images.rfgxy.com/topic/tit_20131019001.png' width='580' height='300' /></a>",closelink:"http://www.rfgxy.com/topic/act/20131016/"});
                            $("#countdown_dashboard_main").html("<div class=\"h30\">&nbsp;</div>");
                            $.cookie("tan", "true", {expires: 1});
                            $.cookie("popup_ad_ed",null);
                            }
                            */
                        }
                    })
                        .fail(function () {

                        })
                        ;
                } catch (e) {

                }
            }, 13000);

        }






    });




    /*判断该简历是否填写完成*/
    /*没填写完成需要弹出图片*/
    /*
    if (jc.isLogined()) {

        if ($.cookie("zhaopin_pop_ad_img")!="1") {
            
            var _url = "http://zhaopin.rfgxy.com/api/CheckResumeStatus.aspx";
            var currentUrl = location.href;
            //console.log(currentUrl);
            //if(currentUrl!="http://www.rfgxy.com/")
                //return;
            setTimeout(function () {
                $.ajax({
                    type: "get",
                    url: _url,
                    dataType: "jsonp",
                    jsonp: "jsoncallback",
                    success: function (data) {
                        if (data.status == "0") {
                        	var cookietime = new Date(); 
							cookietime.setTime(cookietime.getTime() + (2 * 60 * 60 * 1000));//coockie保存2小时
                            $.cookie('zhaopin_pop_ad_img', '1', {expires: cookietime, path: '/'});

                            var ad_pic = "http://images.rfgxy.com/zhaopin/zhaopin_pop_ad.png";
                            var link1 = "http://zhaopin.rfgxy.com/api/adclick/?source=adbottompop&callback=http://zhaopin.rfgxy.com/topic/resume201405/uset";
                            $("body").append("<style type=\"text/css\">#countdown_dashboard_main{ display:none;}</style>");
                            $("#popup_ad").quickAd({ html: "<a href=\"" + link1 + "\"><img id='img1' src='" + ad_pic + "' width='580' height='300' /></a>", closelink: "#" });
                        }
                    }
                });
            }, 12000);
        };
    }
    */






});



/* 广告 */
function _ad(_id, doc, _width, _height) {

        try{

			$.post("http://www.rfgxy.com/ashx/ad.aspx", { id: _id, width: _width, height: _height }, function (msg) {
				$("#" + doc).html(msg);
			});   
	
		}catch(ex){
		
		}
    
     


}
/* 广告2 */
function _ad2(_id,_course_id, doc, _width, _height) {

            try{
				$.post("http://www.rfgxy.com/ashx/ad.aspx", { "id": _id, "course_id": _course_id, "width": _width, "height": _height }, function (msg) {
					$("#" + doc).html(msg);
				});
    		}catch(ex){
		
		}
}

/* 广告3 */
function _ad3(_id, doc, _width, _height, _isshowtime) {
            try{
				$.post("http://www.rfgxy.com/ashx/ad.aspx", { id: _id, width: _width, height: _height ,isshowtime: _isshowtime }, function (msg) {
					$("#" + doc).html(msg);
				});
    		}catch(ex){
		
		}
}

/*js加载课程评论次数、观看、搜藏、购买次数 loadCount("{id:'1',comment:'comment',playcount:'playcount',fav:'fav',buy:'buy'}") */
function loadPlayCount(_v) {
    //
    setTimeout(function(){

        var v = eval("(" + _v + ")");
        $.post("/ashx/lesson/PlayCountPara.aspx", { courseid: v.id }, function (msg) {
            var d = eval("(" + msg + ")");
            $("#" + v.comment).html(d.comment);
            $("#" + v.playcount).html(d.playcount);
            $("#" + v.fav).html(d.fav);
            $("#" + v.buy).html(d.buy);
        });            

    },5000);
}

function geturlvaluenew(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}


var WebYY=WebYY||{};WebYY.swfVersion="10.1";WebYY.hasLogined=false;WebYY.minWidth=1012;WebYY.minHeight=550;WebYY._c={topSid:0,subSid:0,from:"",rel:""};WebYY._pageReady=false;WebYY._historyHash=null;WebYY._wt=document.title;WebYY._errorMessages={iplimit:"您的ip无法访问网页YY",notopen:"频道[#topSid#]未开通网页YY",closed:"频道[#topSid#]关闭了网页YY",ppempty:"频道[#topSid#]真是太受欢迎了, 请稍等一下吧",server:"服务异常, 请稍等一下吧",nonrelease:"没有该合作版本"};WebYY.uids=[];var detectOS=(function(){var c=navigator.platform,e=navigator.userAgent.toLowerCase(),g=[{string:c,regexp:/^.*Win.*$/,identity:"windows"},{string:e,regexp:/^.*((iphone)|(ipad)).*$/,identity:"ios"},{string:e,regexp:/^.*android.*$/,identity:"android"},{string:c,regexp:/^.*Mac.*$/,identity:"mac"},{string:c,regexp:/^.*Linux.*$/,identity:"linux"},{string:c,regexp:/^.*X11.*$/,identity:"unix"}];var b={};for(var d=0,a=g.length;d<a;d++){var f=g[d];if(f.regexp.test(f.string)){b[f.identity]=true;b.identity=f.identity;break}}return function(){return b}})(),_os=detectOS();var detectBrowser=(function(){var d=/(chrome)[ \/]([\w.]+)/,e=/(crios)[ \/]([\w.]+)/,m=/(safari)[ \/]([\w.]+)/,j=/(webkit)[ \/]([\w.]+)/,c=/(opera)(?:.*version)?[ \/]([\w.]+)/,k=/(msie) ([\w.]+)/,h=/(mozilla)(?:.*? rv:([\w.]+))?/,b=/(version)[ \/]([\w.]+)/,a=navigator.userAgent.toLowerCase(),g=d.exec(a)||e.exec(a)||m.exec(a)||j.exec(a)||c.exec(a)||k.exec(a)||a.indexOf("compatible")<0&&h.exec(a)||[],f=navigator.language?navigator.language:navigator.userLanguage||"",n={};var l=g[1]||"",i=g[2]||"0";if(l){n[l]=true,n.identity=l;n.version=i,n.language=f}if(n.safari){n.version=b.exec(a)[2]||i}return function(){return n}})(),_brower=detectBrowser();function userLogin(a){WebYY.hasLogined=true}function userLogout(a){WebYY.hasLogined=false}function isUserLogin(){return WebYY.hasLogined}function toChannel(a){var b=0,c=0;var e=/^(\d+)\/?(\d+)?/gi;if(e.test(a)){b=RegExp.$1,c=RegExp.$2||0}if(!b){return}var d={topSid:b,subSid:c||0,from:WebYY._c.from||""};_changeChannel(d,false)}function _changeChannel(b,a){if(b.topSid==10){return}if(!a){return}try{var d='{"topSid":'+b.topSid+',"subSid":'+b.subSid+"}";if(!_brower.msie&&$("#tuna_flash_inner").length>0){$("#tuna_flash_inner").get(0).changeChannel(d)}else{$("#tuna_flash").get(0).changeChannel(d)}}catch(c){}}function _ajaxGetNoCache(a,b,c){$.ajax({url:a,data:b,success:c,cache:false})}function toSubChannel(a,b,c){if(a==10){return}WebYY._c.topSid=a;WebYY._c.subSid=b;$.bbq.pushState("#"+a+"/"+b+(!WebYY.hasLogined&&c?"&from="+c:""))}function _showNoFlashError(){var b="您可能尚未安装Flash播放器或版本过低(低于10.1) ",c='<p>请<a href="http://get.adobe.com/cn/flashplayer/" target="_blank" style="color: #4E99CC; margin: 0 6px; cursor:pointer;">下载</a>安装完成后<a href="javascript:location.reload();" style="color: #4E99CC; margin: 0 6px; cursor:pointer;">刷新</a>页面 </p>';if(_os.android){c+='<p><a href="http://yydl.duowan.com/m/iyy.apk" style="color: #4E99CC; margin: 0 6px; cursor:pointer;">直接下载安卓版YY</a></p>'}if(_os.ios){b="您当前的操作系统为IOS, 对Flash支持不太友好 ",c='<p>请<a href="http://itunes.apple.com/cn/app/id427941017?mt=8" style="color: #4E99CC; margin: 0 6px; cursor:pointer;">下载iOS版YY</a>吧</p>'}$("body").append(_buildErrorHtml(b,c));var a="type=noflash&os="+(_os.identity||"")+"&browser="+(_brower.identity||"")+"&rel="+(WebYY._c.rel||"main");_submitLog(a)}function _buildErrorHtml(b,c){var a='<div style="font: 18px/1.5 微软雅黑,tahoma,sans-serif; height: 100%; background:url(/img/error_bg.jpg);"><div style="margin: auto; width: 550px; padding-top: 120px; text-align: center;"><img alt="no flash" src="/img/depressed_yy.gif" ><div style="color : #6A767C; font-size : 24px; height : 30px; line-height : 30px; margin-top : 30px;">'+b+"</div>"+c+"</div></div>";return a}function changeTitle(a){if(a){WebYY._wt=_brower.msie?(""+a).replace(/^\s*\S+:\/\//,""):a}else{WebYY._wt="频道 : "+WebYY._c.topSid+" | YY语音"}document.title=WebYY._wt}function addFavorite(){var b=WebYY._wt,a=location.href;if(window.sidebar){window.sidebar.addPanel(a,b,"")}else{if(window.external&&document.all){window.external.AddFavorite(a,b)}else{window.alert("请使用Ctrl+D进行添加, 或手动在浏览器里进行设置")}}}function refreshPage(){window.location.reload()}WebYY.yyclient=false;function checkYYClientInstalled(){if(WebYY.yyclient!==false){return WebYY.yyclient!=null}WebYY.yyclient=null;if(!_os.windows){return false}var c=false,l="undefined",f="object",j="歪歪",i="yy_checker.Checker.1",m="application/x-checker",d="_yy_x_checker_",b='<object id="'+d+'" type="'+m+'" width="0" height="0"></object>',g=window,a=navigator;if(typeof a.plugins!=l&&typeof a.plugins[j]==f){var k=a.plugins[j].description;if(k&&!(typeof a.mimeTypes!=l&&a.mimeTypes[m]&&!a.mimeTypes[m].enabledPlugin)){$("body").append(b);WebYY.yyclient=document.getElementById(d)}}else{if(typeof g.ActiveXObject!=l){try{WebYY.yyclient=new ActiveXObject(i)}catch(h){}}}return WebYY.yyclient!=null}function gotoYYClientChannel(a,b){a=a&&a!=0?a:WebYY._c.topSid;if(checkYYClientInstalled()){try{return 1}catch(c){return 0}}else{return 0}}var isFlashDebug=(function(){var a=null;return function(){if(a===null){a=$("#_flash_debug").val()==="true"}return a}})();function isPageReady(){return WebYY._pageReady}function getRedirectAddress(a){return"http://www.yy.com/gc/"}function openPopupDialog(b,m){if(!b){return}closePopupDialog(b);var i={position:"c",width:0,height:0,left:null,top:null},a=$.extend({},i,m),l="_popup_"+new Date().getTime(),j=_calculatePopupOffset(a),d="position:absolute;left:"+j.l+";top:"+j.t+";"+(a.width?"width:"+a.width+"px;":"")+(a.height?"height:"+a.height+"px;":""),k='<div style="'+d+'" data-url="'+b+'"><div id="'+l+'"><div></div>',h={quality:"high",bgcolor:"#ffffff",allowScriptAccess:"never",allowFullScreen:"true",allownetworking:"internal",wmode:"window",menu:"false"},f={},e=b.indexOf("?"),g=e!=-1?b.substring(b.indexOf("?")+1):"",c=g?g.split("&"):[];$("body").append(k);$.each(c,function(o,p){var n=p&&p.split("=");n[0]&&(f[n[0]]=n[1]||"")});swfobject.embedSWF(b,l,"100%","100%",WebYY.swfVersion,null,f,h,null)}function _calculatePopupOffset(c){var m={l:"50%",t:"50%"};if(!c){return m}var k=c.position,h=c.left,p=c.top,e=c.width,r=c.height;if(h!==null&&p!==null){return{l:h,t:p}}if(!k||!e||!r){return m}var f=$(document),b=f.width(),o=f.height(),l="0px",n=(b/2-e/2)+"px",j=(b-e)+"px",q="0px",g=(o/2-r/2)+"px",a=(o-r)+"px",i={c:{l:n,t:g},n:{l:n,t:q},ne:{l:j,t:q},e:{l:j,t:g},se:{l:j,t:a},s:{l:n,t:a},sw:{l:l,t:a},w:{l:l,t:g},nw:{l:l,t:q}};return i[k]||m}function movePopupDialog(c,b){if(!c||!b){return}var d=_calculatePopupOffset(b),a=$('div[data-url="'+c+'"]');a.css({left:d.l,top:d.t});if(b.width){a.css("width",b.width+"px")}if(b.height){a.css("height",b.height+"px")}}function closePopupDialog(a){if(!a){return}$('div[data-url="'+a+'"]').remove()}function openPopupHTMLDialog(b,i){if(!b){return}closePopupHTMLDialog(b);var e={position:"c",width:0,height:0,left:null,top:null,title:""},a=$.extend({},e,i),f=_calculatePopupOffset(a),c=a.width?"width:"+a.width+"px;":"",g=a.height?"height:"+a.height+"px;":"",d="position:absolute;left:"+f.l+";top:"+f.t+";"+c+"overflow:hidden;",h='<div class="pop-con" style="'+d+'" data-url="'+b+'"><div class="pop-top"><p>'+(a.title?a.title:"")+'</p><div class="pop-icon"></div><div class="pop-close" onclick="_closePopupHTMLDialog(this)"></div></div><iframe src="'+b+'" style="width: 100%; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; border-image: initial; '+g+'"></iframe></div>';$("body").append(h)}function _closePopupHTMLDialog(a){closePopupHTMLDialog($(a).parent().parent().attr("data-url"))}function closePopupHTMLDialog(a){if(!a){return}$('div[data-url="'+a+'"]').remove()}function changeMinDimension(d,e){d&&(WebYY.minWidth=d);e&&(WebYY.minHeight=e);var b=$("#flash_obj"),f=$("#tuna_flash");if(b.length==0||f.length==0){return}if(_brower.msie){if(_brower.version>7){_correctionFlashWidthHeight(b,f);if(b.data("has-resize")){return}b.data("has-resize",true);$(window).resize(function(g){_correctionFlashWidthHeight(b,f)})}else{var c=null;function a(){window.onresize=null;c&&clearTimeout(c);_correctionFlashWidthHeight(b,f);c=setTimeout(function(){window.onresize=a},500)}a()}}else{_setOverflowAndMinWidthHeight(b,f)}}function _correctionFlashWidthHeight(b,d){var a=b.width(),c=b.height();if(a<WebYY.minWidth){b.css("overflow-x","scroll");d.css("width",WebYY.minWidth+"px")}else{b.css("overflow-x","visible");d.css("width","100%")}if(c<WebYY.minHeight){b.css("overflow-y","scroll");d.css("height",WebYY.minHeight+"px")}else{b.css("overflow-y","visible");d.css("height","100%")}}function _setOverflowAndMinWidthHeight(a,b){a.css("overflow","auto");b.css({minWidth:WebYY.minWidth+"px",minHeight:WebYY.minHeight+"px"})}function getJoinChannelData(){var b=$.param.fragment(),a=/^!?\/?(\d+)\/?(\d+)?(\/?[?|&]from=(.*))?/gi;if(a.test(b)){return{hash:b,topSid:RegExp.$1,subSid:RegExp.$2||0,from:RegExp.$4||""}}return false}function YYCallback(f,e,a){if(f==0&&a){var d=a.split("\n"),g=d[1].split(":")[1],c=d[2].split(":")[1],b=d[3].split(":")[1];b&&WebYY.uids.push(b)}}$(function(){WebYY._pageReady=true});var CookieHelper={get:function(b){if(!b||document.cookie.length<=0){return""}var c=document.cookie.indexOf(b+"=");if(c==-1){return""}c=c+b.length+1;var a=document.cookie.indexOf(";",c);if(a==-1){a=document.cookie.length}return unescape(document.cookie.substring(c,a))},remove:function(b){var c=new Date();c.setFullYear(c.getFullYear()-1);var a=" "+b+"=;expires="+c+";";document.cookie=a}};var _udbAuthCallback=null;function UDBAuthentication(d,e,c){if(!d){throw new Error("ticket must be not empty!")}c=c||5060;_udbAuthCallback=e||null;var a="http://udb.duowan.com/authentication.do?ticket="+d+"&appid="+c+"&busiUrl=http%3A//"+($("#http-host").val()||"yy.com")+"/udb/auth/&action=authenticate";if($("#_udb_auth").size()==0){var b="<iframe style='display:none' id='_udb_auth' src="+a+"></iframe>";$("body").append(b)}else{$("#_udb_auth").attr("src",a)}}function _callUDBAuthCallback(){if(_udbAuthCallback){try{if(!_brower.msie&&$("#tuna_flash_inner").length>0){$("#tuna_flash_inner").get(0)[_udbAuthCallback](getCookies())}else{$("#tuna_flash").get(0)[_udbAuthCallback](getCookies())}}catch(a){}}}function getCookies(){var a=document.cookie;if(a){return a}return""}function sendIndeLoadLog(a){a=a||"";_submitLog("type=indexLoad&rel="+a)}function _submitLog(a){$.get("/log/",a,function(){})};