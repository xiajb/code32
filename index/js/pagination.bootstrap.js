
/*全局变量，分页参数名称*/
var purlName; 

/*创建带有页码的地址*/
function cUrl(argName, page) {
    var url = location.protocol + '//' + location.host + location.pathname;
    var args = location.search;
    var reg = new RegExp('([\?&]?)' + argName + '=[^&]*[&$]?', 'gi');
    args = args.replace(reg, '$1');
    if (args == '' || args == null) {
        args += '?' + argName + '=' + page;
    } else if (args.substr(args.length - 1, 1) == '?' || args.substr(args.length - 1, 1) == '&') {
        args += argName + '=' + page;
    } else {
        args += '&' + argName + '=' + page;
    }
    return url + args;
}
/*返回地址栏参数的值*/
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}
/*页码跳转函数:*/
/*参数:this,总页数,分页对象*/
function LoadPagingTo(currentElement, totalPages, LoadPaging) {
    /*获取当前节点同级的第一个节点的值*/
    var obj = currentElement.parentNode.childNodes;
    var p = 1;
    if (obj[0].name == "gotxt") p = obj[0].value;
    var input = obj[0];
    var jumpval = p; /*输入的跳转页码*/
    /*是数字*/
    if (/\d/.test(jumpval)) {
        jumpval = parseInt(jumpval);
        /*如果输入的值大于总页数,不做处理*/
        if (jumpval > totalPages || jumpval <= 0) {
            return false;
        }
        else {
            LoadPaging(jumpval);
        }
    }
    else {
        input.value = "";
        return false;
    }
}

/*分页控件*/
var open_pager = function (container) {
    var sd_pager = this;
    this.firstText = "1...";
    this.prevText = "←";
    this.nextText = "→";
    this.lastText = "尾页";
    this.totalText = "共<em>{0}</em>条记录 ";
    /*this.totalText = "";*/
    this.showPageButtons = 3;
    this.showPageNum = 7; /*页码显示数量*/
    this.showFirst = true;
    this.showLast = true;
    this.currentCss = "current";
    this.linkCss = "page";
    this.pagemoreCss = "pmore";
    this.prevnextCss = "turn";
    this.totalTextCss = "cutPage-statistics";
    this.totalRows = 0;
    this.argName = "page"; /*分页参数*/
    purlName = this.argName;
    this.pageSize = 10;
    this.currentPage = 1;
    this.showPrevNext = true;
    this.showNumButtons = true;
    this.showTotalTip = true; /*是否显示左边全部页数提示。*/
    this.showGoNum = false; /*显示页码跳转*/
    this.allowClone = false; /*是否允许克隆一个相同的分页*/
    this.cloneName = "";
    this.wrapper = document.getElementById(container);
    container = document.getElementById(container);
    this.pageClick = function (pg) { };
    this.createUrl = function (page) {
        /*生成带分页参数的url(参数-当前页)*/
        var url = location.protocol + '//' + location.host + location.pathname;
        var args = location.search;
        var reg = new RegExp('([\?&]?)' + this.argName + '=[^&]*[&$]?', 'gi');
        args = args.replace(reg, '$1');
        if (args == '' || args == null) {
            args += '?' + this.argName + '=' + page;
        } else if (args.substr(args.length - 1, 1) == '?' || args.substr(args.length - 1, 1) == '&') {
            args += this.argName + '=' + page;
        } else {
            args += '&' + this.argName + '=' + page;
        }
        return url + args;
    };
    this.addButton = function (txt, css, pg) {
        var pgbtn = document.createElement("li");
        var pgbtn_href = document.createElement("a");
        /*pgbtn_href.href = 'javascript:;';注：属性改为该值，IE6不支持
        pgbtn_href.href = '#';*/
        if (sd_pager.currentPage != pg) {
            pgbtn_href.href = "javascript:" + sd_pager.pageFuncName + "(" + pg + ")";
        }
        else {
            // pgbtn_href.href = "javascript:;";
            pgbtn_href.href = "javascript:" + sd_pager.pageFuncName + "(" + pg + ")";
        }
        /*pgbtn.className = css;*/
        pgbtn_href.innerHTML = txt;
        pgbtn_href.setAttribute("page", pg);
        container.appendChild(pgbtn).appendChild(pgbtn_href);

    }
    this.addTextButton = function (txt, css) {
        var pgbtn = document.createElement("li");
        var pgbtn_href = document.createElement("a");

        /*pgbtn.className = css;*/
        pgbtn_href.innerHTML = txt;
        container.appendChild(pgbtn).appendChild(pgbtn_href);
    }
    this.addCurrentPage = function (txt) {
        var pgbtn = document.createElement("li");
        var pgbtn_href = document.createElement("a");
        pgbtn.className = "active";
        pgbtn_href.innerHTML = txt;
        container.appendChild(pgbtn).appendChild(pgbtn_href);
    }
    this.addTotalText = function (txt, css) {
        var spnTotal = document.createElement("li");
        var spnTotal_href = document.createElement("a");
        /*spnTotal.className = css;*/
        spnTotal_href.innerHTML = txt;
        container.appendChild(spnTotal).appendChild(spnTotal_href);
        container.innerHTML += "<input type='hidden' id='pagination-totalRows' value='" + this.totalRows + "'/>";
        container.innerHTML += "<input type='hidden' id='pagination-current' value='" + this.currentPage + "'/>";
    }
    /*跳转按钮*/
    this.addGoto = function (txt, css) {
        var spanGoto = document.createElement("li");
        var spanGoto_href = document.createElement("a");
        spanGoto_href.style.cssText = "overflow: hidden;height: 34px;";
        /*_spanGoto.className = css; */
        spanGoto_href.innerHTML = txt;
        container.appendChild(spanGoto).appendChild(spanGoto_href);
    }
    /*输出分页HTML*/
    this.output = function () {
        if (container == undefined) return;
        /*method=url 表示通过地址栏参数分页*/
        if (this.method != undefined && this.method == "url") {
            /*从地址栏获取参数设置当前页*/
            this.currentPage = GetQueryString("page") == null ? 1 : parseInt(GetQueryString("page"));
        }
        /*如果传入的当前页不是数字，默认设为1*/
        var reg = /\d/;
        if (!reg.test(this.currentPage)) {
            this.currentPage = 1;
        }
        container.innerHTML = '';
        if (this.totalRows >= 0 && this.showTotalTip) {
            this.addTotalText(this.totalText.replace("{0}", this.totalRows), this.totalTextCss);
        }
        if (this.totalRows > 0) {
            var _ttps = parseInt(this.totalRows / this.pageSize); /*总页数*/
            if (this.totalRows % this.pageSize > 0) { _ttps++; } /*如果总条数不是每页显示条数的整数倍，总页数+1*/
            if (_ttps == 1) return; /*如果只有1页，不输出页码*/
            var _start = parseInt(this.currentPage) - parseInt(this.showPageButtons); /*开始页*/
            /*var _start = parseInt(this.currentPage) -2; /*开始页*/

            if (_start <= 0) { _start = 1; }
            /*var _end = parseInt(this.currentPage) + parseInt(this.showPageButtons) - 2; /*结束页*/
            var _end = parseInt(this.currentPage) + parseInt(this.showPageButtons) - 0; /*结束页*/

            if (this.currentPage == 1) _end = parseInt(this.currentPage) + parseInt(this.showPageButtons); /*结束页*/
            if (_end < this.showPageNum) _end = this.showPageNum;
            if (_end > _ttps) { _end = _ttps; }

            if (this.showPrevNext) {
                if (this.currentPage - 1 <= 0) { this.addButton(this.prevText, this.linkCss, 1); }
                else { this.addButton(this.prevText, this.linkCss, this.currentPage - 1); }
            }
            if (_start >= 2 && this.showFirst) {
                /*显示首页*/
                this.addButton(this.firstText, this.linkCss, 1);
            }
            /*显示数字页码按钮*/
            if (this.showNumButtons) {
                for (var i = _start; i <= _end; i++) {
                    // console.log(GetQueryString("page"));
                    if (i == GetQueryString("page")) { this.addCurrentPage(i); }
                    else { this.addButton(i, this.linkCss, i); }
                }
                if (_end < _ttps) { this.addTextButton('...', this.pagemoreCss); }
            }
            /*显示尾页按钮*/
            if (this.showLast && _end < _ttps)
                this.addButton(_ttps, this.linkCss, _ttps);

            if (this.showPrevNext) {
                if (this.currentPage + 1 > _ttps) { this.addButton(this.nextText, this.linkCss, _ttps); }
                else { this.addButton(this.nextText, this.linkCss, this.currentPage + 1); }
            }

            /*显示跳转按钮*/
            if (this.showGoNum && this.showPageButtons < _ttps) {
                var _html = "";
                _html += "<input type='text' name='gotxt' style='width: 40px;height: 13px;margin: 0px;line-height: 13px;' value='" + this.currentPage + "'/>";
                _html += " <input onclick='LoadPagingTo(this," + _ttps + "," + sd_pager.pageFuncName + ")' class='btn' type='button'  value='确定' style='height: 27px;margin: 0px;line-height: 16px;'/>";
                this.addGoto(_html, "goto");
            }

            if (this.allowClone && this.cloneName != "" && document.getElementById(this.cloneName)) {
                var cloneVal = container.innerHTML;
                document.getElementById(this.cloneName).innerHTML = cloneVal;
            }
        }
    }
};
/*-----end 分页控件*/