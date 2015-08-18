function loadDemo() {
    var navigation = $($.find('.navigation'));

    var me = this;
    var lastclicked;
    $(".navigationItemContentParent").click(function (event) {
        var tag = $(event.target).parent('li');
        if (event.target.nodeName.toLowerCase() == 'li') {
            tag = $(event.target);
        }

        var id = tag[0].id;
        if (id != null) {
            var state = $(event.target).parent('li').attr('state');
            if (state == 'collapsed') {
                $("." + id).show();
                tag.attr('state', 'expanded');
                tag.find('img')[0].src = "../../jqwidgets/styles/images/icon-down.png";
            }
            else {
                $("." + id).hide();
                tag.attr('state', 'collapsed');
                tag.find('img')[0].src = "../../jqwidgets/styles/images/icon-right.png";
            }
            return false;
        }
    });

    navigation.find('.navigationContent').click(function (event) {
        var target = event.target;
        if (lastclicked == target)
            return false;

        lastclicked = target;

        var elementClicked = $(this);
        startDemo(target);

        event.preventDefault();
        if (getBrowser().browser != 'chrome') {
            event.stopPropagation();
            return false;
        }
    });
}

function initthemes(initialurl) {
    var loadedThemes = [0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1];
    var themes = [
        { label: 'Web', group: 'Themes', value: 'web' },
        { label: 'Bootstrap', group: 'Themes', value: 'bootstrap' },
        { label: 'Metro', group: 'Themes', value: 'metro' },
        { label: 'Office', group: 'Themes', value: 'office' },
        { label: 'Fresh', group: 'Themes', value: 'fresh' },
        { label: 'Energy Blue', group: 'Themes', value: 'energyblue' },
        { label: 'Dark Blue', group: 'Themes', value: 'darkblue' },
        { label: 'Black', group: 'Themes', value: 'black' },
        { label: 'Shiny Black', group: 'Themes', value: 'shinyblack' },
        { label: 'Classic', group: 'Themes', value: 'classic' },
        { label: 'Summer', group: 'Themes', value: 'summer' },
        { label: 'High Contrast', group: 'Themes', value: 'highcontrast' },
        { label: 'Lightness', group: 'UI Compatible', value: 'ui-lightness' },
        { label: 'Darkness', group: 'UI Compatible', value: 'ui-darkness' },
        { label: 'Smoothness', group: 'UI Compatible', value: 'ui-smoothness' },
        { label: 'Start', group: 'UI Compatible', value: 'ui-start' },
        { label: 'Redmond', group: 'UI Compatible', value: 'ui-redmond' },
        { label: 'Sunny', group: 'UI Compatible', value: 'ui-sunny' },
        { label: 'Overcast', group: 'UI Compatible', value: 'ui-overcast' },
        { label: 'Le Frog', group: 'UI Compatible', value: 'ui-le-frog' }
    ];
    var me = this;
    this.$head = $('head');
    $('#themeComboBox').jqxDropDownList({ source: themes, theme: 'web', selectedIndex: 0, dropDownHeight: 200, width: '140px', height: '20px' });

    var hasParam = window.location.toString().indexOf('?');
    if (hasParam != -1) {
        var themestart = window.location.toString().indexOf('(');
        var themeend = window.location.toString().indexOf(')');
        var theme = window.location.toString().substring(themestart + 1, themeend);
        $.data(document.body, 'theme', theme);
        selectedTheme = theme;
        var themeIndex = 0;
        $.each(themes, function (index) {
            if (this.value == theme) {
                themeIndex = index;
                return false;
            }
        });
        $('#themeComboBox').jqxDropDownList({ selectedIndex: themeIndex });
        loadedThemes[0] = -1;
        loadedThemes[themeIndex] = 0;
    }
    else {
        $.data(document.body, 'theme', 'web');
    }

    $('#themeComboBox').on('select', function (event) {
        setTimeout(function () {
            var selectedIndex = event.args.index;
            var selectedTheme = '';
            var url = initialurl;

            var loaded = loadedThemes[selectedIndex] != -1;
            loadedThemes[selectedIndex] = selectedIndex;

            var themes = [
              { label: 'Web', group: 'Themes', value: 'web' },
              { label: 'Bootstrap', group: 'Themes', value: 'bootstrap' },
              { label: 'Metro', group: 'Themes', value: 'metro' },
              { label: 'Office', group: 'Themes', value: 'office' },
              { label: 'Fresh', group: 'Themes', value: 'fresh' },
              { label: 'Energy Blue', group: 'Themes', value: 'energyblue' },
              { label: 'Dark Blue', group: 'Themes', value: 'darkblue' },
              { label: 'Black', group: 'Themes', value: 'black' },
              { label: 'Shiny Black', group: 'Themes', value: 'shinyblack' },
              { label: 'Classic', group: 'Themes', value: 'classic' },
              { label: 'Summer', group: 'Themes', value: 'summer' },
              { label: 'High Contrast', group: 'Themes', value: 'highcontrast' },
              { label: 'Lightness', group: 'UI Compatible', value: 'ui-lightness' },
              { label: 'Darkness', group: 'UI Compatible', value: 'ui-darkness' },
              { label: 'Smoothness', group: 'UI Compatible', value: 'ui-smoothness' },
              { label: 'Start', group: 'UI Compatible', value: 'ui-start' },
              { label: 'Redmond', group: 'UI Compatible', value: 'ui-redmond' },
              { label: 'Sunny', group: 'UI Compatible', value: 'ui-sunny' },
              { label: 'Overcast', group: 'UI Compatible', value: 'ui-overcast' },
              { label: 'Le Frog', group: 'UI Compatible', value: 'ui-le-frog' }
            ];
            selectedTheme = themes[selectedIndex].value;
            url += selectedTheme + '.css';
          
            if (!loaded) {
                if (document.createStyleSheet != undefined) {
                    document.createStyleSheet(url);
                }
                else me.$head.append('<link rel="stylesheet" href="' + url + '" media="screen" />');
            }
            $.data(document.body, 'theme', selectedTheme);
            var startedExample = $.data(document.body, 'example');
            if (startedExample != null) {
                startDemo(startedExample);
            }
        }, 5);
    });
}
function initmenu() {
    var content = $('#demos')[0];
    var navigation = $($.find('.navigation'));
    var self = this;

    if (!$.jqx.browser.msie) {
        $('#navigationmenu').find('li').css('opacity', 0.95);
        $('#navigationmenu').find('ul').css('opacity', 0.95);
    }
    $('#navigationmenu').jqxMenu({ autoSizeMainItems: true, theme: 'demo', autoCloseOnClick: true });
    $('#navigationmenu').css('visibility', 'visible');
}
function prepareExamplePath(url) {
    var path = '<div id="pathElement">';
    var str = '';
    var examplePath = url.toString();
    for (i = 0; i < url.toString().length; i++) {
        if (i == 0) {
            path += "<div style='float: left; width: 16px; height: 16px;' class='jqx-icon-arrow-right'></div>";
        }

        var char = examplePath.substring(i, i + 1);
        if (char == '/' || i == url.toString().length - 1) {
            if (i == url.toString().length - 1) {
                str += char;
                path += '<span style="margin-left: 2px; float: left;">' + str + '</span>';
            }
            else if (str == 'demos') {
                path += '<span style="margin-left: 2px; float: left;">' + str + '</span>';
            }
            else path += '<span style="margin-left: 2px; float: left;">' + str + '</span>';

            path += "<div style='float: left; width: 16px; height: 16px;' class='jqx-icon-arrow-right'></div>";
            str = '';
        }
        else str += char;
    }

    path += '</div>';

    $("#examplePath").html(path);

    $("#examplePath").css('float', 'left');
    $("#examplePath").css('margin-left', 0);
    $("#themeSelector").css('display', 'block');
    $("#themeSelector").css('float', 'right');
}
function initDemo(ismobile) {
    if (ismobile) {
        $.ajax({
            async: false,
            url: "../samplespath.htm",
            success: function (data) {
                $("#samplesPath").append(data);
            }
        });

        $.ajax({
            async: false,
            url: "../bottom.htm",
            success: function (data) {
                $("#pageBottom").append(data);
            }
        });
        $.ajax({
            async: false,
            url: "../top.htm",
            success: function (data) {
                $("#pageTop").append(data);
            }
        });

        $.ajax({
            async: false,
            url: "../mobilenavigator.htm",
            success: function (data) {
                $("#widgetsNavigation").append(data);
            }
        });
        var lastclicked = null;
        $(".topNavigation-item a").click(function (event) {
            this.isTouchDevice = false;
            if (!this.isTouchDevice) {
                var target = event.target;
                if (lastclicked == target)
                    return false;

                lastclicked = target;

                var elementClicked = $(this);
                $("#jqxInnerDemoContent")[0].src = target;
                event.preventDefault();
                event.stopPropagation();

                return false;
            }
        });

        initmenu();
    }
    else {
        $.ajax({
            async: false,
            url: "../../samplespath.htm",
            success: function (data) {
                $("#samplesPath").append(data);
            }
        });

        $.ajax({
            async: false,
            url: "../../bottom.htm",
            success: function (data) {
                $("#pageBottom").append(data);
            }
        });
        $.ajax({
            async: false,
            url: "../../top.htm",
            success: function (data) {
                $("#pageTop").append(data);
            }
        });
        var image = $('<img alt="expandArrow" class="showMoreExpanderArrow" src="../../images/arrowup.gif" />');
        var span = $('<span style="cursor: pointer; position: relative; top: -3px; font-size: 13px;">less widgets</span>');

        $('.topExpander').append(image);
        $('.topExpander').append(span);

        var initialurl = "jqwidgets/styles/jqx.";
        initthemes(initialurl);

        $.ajax({
            async: false,
            url: "../../navigator.htm",
            success: function (data) {
                $("#widgetsNavigation").append(data);
        //        if (!("pushState" in history && getBrowser().browser != 'opera')) {
                    $(".topNavigation-item a").click(function (event) {
                        var theme = $.data(document.body, "theme");
                        if (theme && theme != '') {
                            event.target.href = event.target.href + '?(' + theme + ')';
                        }
                    });
        //        }
            }
        });
        initmenu();
        $(".topExpander").click(function () {
            if ($("#widgetsNavigation").css('display') != 'none') {
                $("#widgetsNavigation").fadeOut(300);
                $(".topExpander span").text("more widgets");
                $(".topExpander img")[0].src = "../../images/arrowdown.gif";
            }
            else {
                $("#widgetsNavigation").fadeIn(300);
                $(".topExpander span").text("less widgets");
                $(".topExpander img")[0].src = "../../images/arrowup.gif";
            }
            return false;
        });
    }

    var content = $('#demos')[0];
    var navigation = $($.find('.navigation'));
    if ($.jqx.browser.msie && $.jqx.browser.version < 8) {
        navigation.parents('table:first').css('table-layout', 'auto');
        $(".topExpander").css('float', 'none');
        $(".topExpander").css('position', 'absolute');
        $(".topExpander").css('margin-left', '830px');
    }

    var self = this;

    var imageOffset = 0;

    var updateheight = function () {
        return;
        setTimeout(function () {
            var navigationheight = parseInt($(".navigationBottom").offset().top);
            $('.demoContent').height(navigationheight);
            var height = $('#demoContent').height();
            var width = 710;
            height -= parseInt(40);
            if ($('#tabs-1').css('visibility') != 'hidden') {
                $('#tabs-1').css({ height: height + 'px', width: width + 'px' });
                $('#tabs-2').css({ height: height + 'px', width: width + 'px' });
                $('#tabs-3').css({ height: height + 'px', width: width + 'px' });
            }
        }, 250);
    }

    var reloadDemo = function () {
        if ($("#demoLink").length > 0) {
            startDemo($("#demoLink")[0]);
        }

        navigation.find('.navigationItem').click(function (event) {
            return false;
        });

        navigation.find('.navigationHeader').click(function (event) {
            var $target = $(event.target);
            var $targetParent = $target.parent();
            if ($targetParent[0].className.length == 0) {
                var $targetParentParent = $($target.parent()).parent();
                var oldChildren = $.data(content, 'expandedElement');
                var oldTarget = $.data(content, 'expandedTarget');

                if (oldTarget != null && oldTarget != event.target) {
                    var $oldTarget = $(oldTarget);
                    var $oldtargetParentParent = $($oldTarget.parent()).parent();
                    if (oldChildren.css('display') == 'block') {
                        oldChildren.css('display', 'none');
                        $oldtargetParentParent.removeClass('navigationItem-expanded');
                        $oldtargetParentParent.find('.navigationContent').css('display', 'none');
                    }
                }

                var children = $targetParentParent.find('.navigationItemContent');
                $.data(content, 'expandedElement', children);
                $.data(content, 'expandedTarget', event.target);

                if (children.css('display') == 'none') {
                    children.css({ opacity: 0, display: 'block', visibility: 'visible' }).animate({ opacity: 1.0 }, 250, function () {
                    });
                    if ($targetParentParent[0].className == 'navigationItem') {
                        $targetParentParent.addClass('navigationItem-expanded');
                        $targetParentParent.find('.navigationContent').css('display', 'block');
                        updateheight();
                    }
                }
                else children.css({ opacity: 1, visibility: 'visible' }).animate({ opacity: 0.0 }, 250, function () {
                    children.css('display', 'none');
                    $targetParentParent.removeClass('navigationItem-expanded');
                    $targetParentParent.find('.navigationContent').css('display', 'none');
                    updateheight();
                });

            }
            return false;
        });

        loadDemo();
    }

    reloadDemo();
    if ($.jqx.browser.mozilla) {
        $('.navigationBarActive-overlay').hide();
    }
}
function closewindows() {
    var windows = $.data(document.body, 'jqxwindows-list');
    if (windows && windows.length > 0) {
        var count = windows.length;
        while (count) {
            count -= 1;
            windows[count].remove();
        }
    }
    var window = $.data(document.body, 'jqxwindow-modal');
    if (window != null && window.length && window.length > 0) {
        window.jqxWindow('closeWindow', 'close');
    }

    $.data(document.body, 'jqxwindow-modal', []);
    $.data(document.body, 'jqxwindows-list', []);
}

function getBrowser() {
    var ua = navigator.userAgent.toLowerCase();

    var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
		        /(webkit)[ \/]([\w.]+)/.exec(ua) ||
		        /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
		        /(msie) ([\w.]+)/.exec(ua) ||
		        ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
		        [];

    return {
        browser: match[1] || "",
        version: match[2] || "0"
    };
}

function startDemo(target) {
    if (target == null || target.href == null)
        return;

    var scrollTop = $(window).scrollTop();
    var hasHref = target.href;
    if (!hasHref) {
        return;
    }
    if (getBrowser().browser == 'chrome') {
        $(".jqx-validator-hint").remove();
        $("#jqxMenu").remove();
        $("#Menu").remove();
        $("#gridmenujqxgrid").remove();
    }

    closewindows();
    $('#tabs').css('visibility', 'visible');
    $('#tabs').css('display', 'block');

    if (!this.jqxtabsinitialized) {
        $('#tabs').show();
        $('#tabs').css('height', '100%');
        $('#tabs').jqxTabs({ keyboardNavigation: false, selectionTracker: false });
        this.jqxtabsinitialized = true;
    }

    $('#tabs').jqxTabs('select', 0);
    $("#divWelcome").css('display', 'none');
    $("#divWelcome").empty();
    $.data(document.body, 'example', target);

    var url = target.href;
    var startindex = url.toString().indexOf('demos');
    var demourl = url.toString().substring(startindex);
    window.location.hash = demourl;
    prepareExamplePath(demourl);

    if ($("iframe").length > 0) {
        var iframe = $("iframe");
        iframe.unload();
        iframe.remove();
        iframe.attr('src', null)
    }

    $("#innerDemoContent").empty();

    height = $('#demoContent').height();
    var width = 710;
    height -= parseInt(40);

    $('#tabs-1').css({ height: height + 'px', width: width + 'px' });
    $('#tabs-2').css({ height: height + 'px', width: width + 'px' });
    $('#tabs-3').css({ height: height + 'px', width: width + 'px' });

    var demoHeight = parseInt(height);
    var demoWidth = parseInt($("#demoContent").width()) / 2;
    var loader = $("<img src='../../images/loader.gif' />");
    loader.css('margin-top', (demoHeight / 2 - 18) + 'px');
    loader.css('margin-left', (demoWidth - 18) + 'px');
    $("#innerDemoContent").html(loader);

    var theme = $.data(document.body, 'theme');
    $("#innerDemoContent").removeAttr('theme');
    if (theme == undefined) theme = '';
    url += '?' + theme.toString();

    var isnonpopupdemo = url.indexOf('window') == -1;

    if (this.isTouchDevice && url.indexOf('chart') == -1) isnonpopupdemo = false;
    var _url = url;
    $.get(url,
                    function (data) {
                        var originalData = data;
                        var descriptionLength = "<title id='Description'>".toString().length;
                        var startIndex = data.indexOf('<title') + descriptionLength;
                        var endIndex = data.indexOf('</title>');
                        var description = data.substring(startIndex, endIndex);

                        $('#divDescription').html('<div style="margin: 10px;">' + description + '</div>');
                        var anchor = $("<div id='demourl' style='color: #444; position: absolute; font-size: 13px; font-family: Arial, Helvetica, Sans-Serif; top: 25%; left: 570px; margin-right: 10px;'><a style='color: #535353;' target='_blank' href='" + _url + "'>Open in new window</a></div>");
                        $('#tabs #demourl').remove();
                        $('#tabs .jqx-tabs-header').append(anchor);

                        if (!isnonpopupdemo) {
                            data = data.replace(/<script.*>.*<\/script>/ig, ""); // Remove script tags
                            data = data.replace(/<\/?link.*>/ig, ""); //Remove link tags
                            data = data.replace(/<\/?html.*>/ig, ""); //Remove html tag
                            data = data.replace(/<\/?body.*>/ig, ""); //Remove body tag
                            data = data.replace(/<\/?head.*>/ig, ""); //Remove head tag
                            data = data.replace(/<\/?!doctype.*>/ig, ""); //Remove doctype
                            data = data.replace(/<title.*>.*<\/title>/ig, ""); // Remove title tags
                            data = data.replace(/..\/..\/jqwidgets\/globalization\//g, "jqwidgets/globalization/"); // fix localization path
                            $("#innerDemoContent").removeClass();

                            var url = "../../jqwidgets/styles/jqx." + theme + '.css';
                            if (document.createStyleSheet != undefined) {
                                document.createStyleSheet(url);
                            }
                            else $(document).find('head').append('<link rel="stylesheet" href="' + url + '" media="screen" />');

                            $("#innerDemoContent").attr('theme', theme.toString());
                            $("#innerDemoContent").html('');
                            $("#innerDemoContent").html('<div id="jqxInnerDemoContent" style="position: relative; top: 10px; left: 10px; width: 700px; height: 90%;">' + data + '</div>');
                            var jqxInnerDemoContent = $("#innerDemoContent").find('#jqxInnerDemoContent');
                            var jqxWidget = $("#innerDemoContent").find('#jqxWidget');
                            jqxInnerDemoContent.css('visibility', 'visible');
                        }

                        //populate tabs.

                        var result = formatCode(originalData);
                        $('#tabs-2').html(result);
                        var demourl = _url.toString().substring(_url.toString().indexOf('demos'));
                        var widgetNameStartIndex = demourl.indexOf('/');
                        var widgetNameEndIndex = demourl.toString().substring(widgetNameStartIndex + 1).indexOf('/');
                        var widgetName = demourl.substring(widgetNameStartIndex + 1, 1 + widgetNameStartIndex + widgetNameEndIndex);
                        if (widgetName == 'jqxbutton' && (_url.indexOf('checkbox') != -1 || _url.indexOf('radiobutton') != -1)) {
                            widgetName = 'jqxcheckbox';
                        }
                        if (widgetName == 'jqxbutton' && (_url.indexOf('radiobutton') != -1)) {
                            widgetName = 'jqxradiobutton';
                        }
                        if (widgetName == 'jqxpanel' && _url.indexOf('dockpanel') != -1) {
                            widgetName = 'jqxdockpanel';
                        }
                        if (widgetName == 'jqxbutton' && (_url.indexOf('switch') != -1)) {
                            widgetName = 'jqxswitchbutton';
                        }
                        if (widgetName == 'jqxbutton' && (_url.indexOf('group') != -1)) {
                            widgetName = 'jqxbuttongroup';
                        }
                        if (widgetName == 'jqxgauge' && (_url.indexOf('linear') != -1)) {
                            widgetName = 'jqxlineargauge';
                        }

                        var apiURL = 'http://www.jqwidgets.com/jquery-widgets-demo/documentation/' + widgetName + '/' + widgetName + '-api.htm';
                        $.ajax({
                            dataType: 'html',
                            url: apiURL,
                            type: 'GET',
                            success: function (api) {
                                api = api.replace(/<script.*>.*<\/script>/ig, ""); // Remove script tags
                                api = api.replace(/<\/?link.*>/ig, ""); //Remove link tags
                                api = api.replace(/<\/?html.*>/ig, ""); //Remove html tag
                                api = api.replace(/<\/?body.*>/ig, ""); //Remove body tag
                                api = api.replace(/<\/?head.*>/ig, ""); //Remove head tag
                                api = api.replace(/<\/?!doctype.*>/ig, ""); //Remove doctype
                                api = api.replace(/<title.*>.*<\/title>/ig, ""); // Remove title tags                   
                                $('#tabs-3').html('<div style="width: 90%; margin-left: 10px; margin-top: 10px; margin-right: 10px;">' + api + '</div>')
                            }
                        });
                    }, "html"
            )

    if (isnonpopupdemo) {
        if ($.jqx.browser.msie && $.jqx.browser.version < 9) {
            try {
                var iframe = $('<iframe frameborder="0" src="' + url + '" id="jqxInnerDemoContent" style="border-collapse: collapse; margin-top: 10px; margin-left: 10px; width: 700px;"></iframe>');
                if (getBrowser().browser == 'chrome') {
                    iframe = $('<iframe frameborder="0" src="' + url + '" id="jqxInnerDemoContent" style="border-collapse: collapse; margin: 0px !important; padding: 0px !important; width: 700px;"></iframe>');
                }

                $("#innerDemoContent").html('');
                $("#innerDemoContent").append(iframe);
            }
            catch (error) {
            }
        }
        else {
            var iframe = $('<iframe frameborder="0" src="' + url + '" id="jqxInnerDemoContent" style="border-collapse: collapse; margin-top: 10px; margin-left: 10px; width: 700px;"></iframe>');
            if (getBrowser().browser == 'chrome') {
                iframe = $('<iframe frameborder="0" src="' + url + '" id="jqxInnerDemoContent" style="border-collapse: collapse; margin: 0px !important; padding: 0px !important; width: 700px;"></iframe>');
            }

            $("#innerDemoContent").html('');
            $("#innerDemoContent").append(iframe);
        }
        adjust();
        iframe.height(940);
    }
    return false;
}
function saveImageAs(imgOrURL) {
    if (typeof imgOrURL == 'object')
        imgOrURL = imgOrURL.src;
    window.win = open(imgOrURL);
    setTimeout('win.document.execCommand("SaveAs")', 500);
}
function adjust() {
    this.adjustFramePosition();
}

function adjustFramePosition() {
    var iframe = $('#jqxInnerDemoContent');
    if (!iframe || iframe.length == 0)
        return;

    var offset = iframe.offset();
    if (parseFloat(offset.left) != parseInt(offset.left)) {
        iframe[0].style.marginLeft = (iframe[0].style.marginLeft == '0.5px') ? '0px' : '0.5px';
    }
}