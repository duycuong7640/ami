var width_mobile = 0;
var fixedtoc = (function (t) {
    function n(t) {
        return parseInt(t) || 0;
    }
    function e(e) {
        if (!e.length) return 0;
        var i = 0;
        return (
            e.each(function (e) {
                var o = t(this);
                "fixed" == o.css("position") && (i += n(o.outerHeight()));
            }),
            i
        );
    }
    function i(t) {
        t.preventDefault();
    }
    function o(t) {
        return n(t - 2 * fixedtocOption.contentsBorderWidth);
    }
    function c(t) {
        f.isDebug() && console.log(t);
    }
    var r,
        s = (function () {
            var t = function (t, e, i) {
                    fixedtocOption[t] =
                        "int" == i
                            ? n(e)
                            : "float" == i
                            ? (function (t) {
                                  return parseFloat(t) || 0;
                              })(e)
                            : e;
                },
                e = function (t) {
                    switch (t) {
                        case "thin":
                            return 1;
                        case "medium":
                            return 2;
                        case "bold":
                            return 5;
                        default:
                            return 0;
                    }
                };
            return {
                init: function () {
                    (fixedtocOption.scrollDuration = 500),
                        (fixedtocOption.fadeTriggerDuration = 5e3),
                        (fixedtocOption.scrollOffset = n(fixedtocOption.scrollOffset)),
                        (fixedtocOption.fixedOffsetX = n(fixedtocOption.fixedOffsetX)),
                        (fixedtocOption.fixedOffsetY = n(fixedtocOption.fixedOffsetY)),
                        (fixedtocOption.contentsFixedHeight = n(fixedtocOption.contentsFixedHeight)),
                        (fixedtocOption.contentsWidthInPost = n(fixedtocOption.contentsWidthInPost)),
                        (fixedtocOption.contentsHeightInPost = n(fixedtocOption.contentsHeightInPost)),
                        (fixedtocOption.triggerBorderWidth = e(fixedtocOption.triggerBorder)),
                        (fixedtocOption.contentsBorderWidth = e(fixedtocOption.contentsBorder)),
                        (fixedtocOption.triggerSize = n(fixedtocOption.triggerSize));
                },
                set: t,
                update: function (n, e, i) {
                    t(n, e, i);
                },
                remove: function (t) {
                    void 0 !== fixedtocOption[t] && delete fixedtocOption[t];
                },
            };
        })(),
        f = {
            inWidgetProp: void 0,
            showAdminbar: function () {
                return fixedtocOption.showAdminbar;
            },
            isQuickMin: function () {
                return fixedtocOption.isQuickMin;
            },
            isEscMin: function () {
                return fixedtocOption.isEscMin;
            },
            isEnterMax: function () {
                return fixedtocOption.isEnterMax;
            },
            isNestedList: function () {
                return fixedtocOption.isNestedList;
            },
            isColExpList: function () {
                return fixedtocOption.isColExpList;
            },
            showColExpIcon: function () {
                return fixedtocOption.showColExpIcon;
            },
            isAccordionList: function () {
                return fixedtocOption.isAccordionList;
            },
            showTargetHint: function () {
                return !0;
            },
            supportInPost: function () {
                return fixedtocOption.inPost;
            },
            inWidget: function () {
                return !!fixedtocOption.inWidget && (void 0 === this.inWidgetProp && (this.inWidgetProp = !!t("#ft-widget-container").length), this.inWidgetProp);
            },
            fixedWidget: function () {
                return !!this.inWidget() && fixedtocOption.fixedWidget;
            },
            isAutoHeightFixedToPost: function () {
                return 0 == fixedtocOption.contentsFixedHeight;
            },
            isFloat: function () {
                return "none" != fixedtocOption.contentsFloatInPost;
            },
            isAutoHeightInPost: function () {
                return 0 == fixedtocOption.contentsHeightInPost;
            },
            isPositionAtFixed: function (t) {
                return -1 != fixedtocOption.fixedPosition.indexOf(t);
            },
            isDebug: function () {
                return 1 == fixedtocOption.debug;
            },
            isNotBlur: function () {
                var t = navigator.userAgent.toLowerCase();
                return t.indexOf("android") > -1 || t.indexOf("firefox") > -1;
            },
            isMobile: function () {
                return a.data.window.width <= width_mobile;
            },
        },
        a = (function () {
            var i,
                s,
                a = {},
                d = function () {
                    a.scrollTop = r.window.scrollTop();
                },
                g = function () {
                    (a.window = {}), (a.window.width = window.innerWidth), (a.window.height = window.innerHeight);
                },
                l = function () {
                    a.adminbarHeight = f.showAdminbar() ? e(t("#adminbar")) : 0;
                },
                h = function () {
                    a.fixedMenuHeight = e(t(fixedtocOption.fixedMenu));
                },
                x = function () {
                    fixedtocOption.fixedMenu ? (a.fixedHeight = a.adminbarHeight + a.fixedMenuHeight) : (a.fixedHeight = a.adminbarHeight);
                },
                w = function () {
                    a.fixedOffsetTop = a.fixedHeight + fixedtocOption.fixedOffsetY;
                },
                m = function () {
                    a.headingOffset = a.fixedHeight + fixedtocOption.scrollOffset;
                },
                v = function () {
                    (a.headingsTop = []),
                        t.each(r.anchors, function () {
                            var e = t(t(this).attr("href")),
                                i = e.length ? n(e.offset().top - a.headingOffset) : NaN;
                            isNaN(i) || a.headingsTop.push({ headingTop: i, anchorEle: t(this) });
                        });
                },
                O = function () {
                    a.postRect = {};
                    var t = r.postContent.offset(),
                        n = r.postContent.outerWidth(),
                        e = r.postContent.outerHeight();
                    (a.postRect.left = t.left),
                        (a.postRect.top = t.top),
                        (a.postRect.width = n),
                        (a.postRect.right = a.postRect.left + a.postRect.width),
                        (a.postRect.bottom = e + a.postRect.top),
                        (a.postRect.height = a.postRect.bottom - a.postRect.top);
                },
                C = function () {
                    (a.ftocRangeY = {}), f.supportInPost() ? (a.ftocRangeY.top = a.inPostRangeY.bottom) : (a.ftocRangeY.top = a.postRect.top - a.fixedHeight), (a.ftocRangeY.bottom = a.postRect.bottom - a.window.height);
                },
                T = {
                    set: function () {
                        var t;
                        f.isAutoHeightInPost() || fixedtocOption.contentsColexpInit
                            ? (r.container.css("position", "static"), (t = r.containerOuter.outerHeight()), r.container.css("position", ""))
                            : (t = fixedtocOption.contentsHeightInPost),
                            r.containerOuter.css("height", t + "px"),
                            (a.containerOuterHeight = t);
                    },
                    update: function () {
                        function t() {
                            r.containerOuter.css("height", "auto"), r.contents.css("height", "auto"), p.setAuto(), (a.containerOuterHeight = r.containerOuter.outerHeight());
                        }
                        u.location.inPost &&
                            (f.isAutoHeightInPost()
                                ? t()
                                : "collapse" == r.contents.data("colexp")
                                ? t()
                                : (r.containerOuter.css("height", fixedtocOption.contentsHeightInPost + "px"),
                                  r.contents.css("height", fixedtocOption.contentsHeightInPost + "px"),
                                  p.set(o(fixedtocOption.contentsHeightInPost)),
                                  (a.containerOuterHeight = r.containerOuter.outerHeight())));
                    },
                },
                I = function () {
                    (a.inPostRangeY = {}), (a.inPostRangeY.top = 0), (a.inPostRangeY.bottom = r.containerOuter.offset().top + a.containerOuterHeight - a.fixedHeight);
                },
                W = function () {
                    a.inWidgetMinWidth = a.postRect.width + r.widgetContainer.outerWidth();
                },
                b = function () {
                    (a.fixedWidgetRangeY = {}), (a.fixedWidgetRangeY.top = r.widgetContainer.offset().top - a.fixedHeight), (a.fixedWidgetRangeY.bottom = a.ftocRangeY.bottom);
                },
                P = (function () {
                    var t = function () {
                            a.ftocRectInWidget = { left: r.widgetContainer.offset().left, top: a.fixedHeight, width: r.widgetContainer.outerWidth(), height: n() };
                        },
                        n = function () {
                            var t;
                            return "collapse" == r.contents.data("colexp") ? (r.contents.css("height", "auto"), (t = r.contents.outerHeight()), r.contents.css("height", "")) : (t = window.innerHeight - a.fixedHeight), t;
                        };
                    return {
                        set: t,
                        updateOnResize: function () {
                            t();
                        },
                        updateHeight: function () {
                            a.ftocRectInWidget.height = n();
                        },
                    };
                })();
            return {
                data: a,
                ftocRectInWidget: P,
                createOnInit: function () {
                    g(), d(), l(), fixedtocOption.fixedMenu && h(), x(), w(), f.supportInPost() && (T.set(), I()), m(), O(), C(), f.inWidget() && W(), f.fixedWidget() && (b(), P.set()), v(), c(this.data);
                },
                updateOnResize: function () {
                    g(), d(), l(), fixedtocOption.fixedMenu && h(), x(), w(), f.supportInPost() && (T.update(), I()), m(), O(), C(), f.inWidget() && W(), f.fixedWidget() && (b(), P.updateOnResize()), v(), c(a);
                },
                updateOnScroll: function () {
                    d(),
                        fixedtocOption.fixedMenu &&
                            (void 0 === i && (i = a.fixedMenuHeight),
                            h(),
                            i !== a.fixedMenuHeight && (x(), w(), f.supportInPost() && I(), m(), O(), C(), f.inWidget() && W(), f.fixedWidget() && (b(), P.updateOnResize()), v(), (i = a.fixedMenuHeight), c(a)));
                },
                updateInPost: function () {
                    T.update(), I(), m(), v(), O(), C();
                },
                updateOnDocumentHeightChange: function () {
                    (a.document = {}), (a.document.height = Math.round(r.document.height()));
                    a.document.height != s && (fixedtoc.reload(), (s = a.document.height));
                },
            };
        })(),
        d = (function () {
            var t = function () {
                return !(!f.inWidget() || f.isMobile());
            };
            return {
                fixedWidget: function () {
                    return !!f.fixedWidget() && !!t() && a.data.fixedWidgetRangeY.top <= a.data.scrollTop && a.data.fixedWidgetRangeY.bottom > a.data.scrollTop;
                },
                inWidget: t,
                inPost: function () {
                    return !!f.supportInPost() && a.data.inPostRangeY.bottom > a.data.scrollTop;
                },
                fixedToPost: function () {
                    return a.data.ftocRangeY.top <= a.data.scrollTop && a.data.ftocRangeY.bottom > a.data.scrollTop;
                },
            };
        })(),
        u = (function () {
            var n = { fixedWidget: !1, inWidget: !1, inPost: !1, fixedToPost: !1, hidden: !1 },
                e = ["common", "hidden", "fixedToPost", "inPost", "inWidget", "fixedWidget"],
                i = function (t) {
                    function i(n) {
                        for (var i = e.length, o = { location: n, eventType: t }, c = 1; c < i; c++) n != e[c] && r.container.trigger("_ftoc_" + e[c], o);
                        r.container.trigger("ftoc_" + n, o);
                    }
                    function o(t) {
                        for (var i = 1, o = e.length; i < o; i++) void 0 !== t && t == e[i] ? (n[t] = !0) : (n[e[i]] = !1);
                    }
                    d.fixedWidget()
                        ? n.fixedWidget || (o("fixedWidget"), i("fixedWidget"), c(n))
                        : d.inWidget()
                        ? n.inWidget || (o("inWidget"), i("inWidget"), c(n))
                        : d.inPost()
                        ? n.inPost || (o("inPost"), i("inPost"), c(n))
                        : d.fixedToPost()
                        ? n.fixedToPost || (o("fixedToPost"), i("fixedToPost"), c(n))
                        : n.hidden || (o("hidden"), i("hidden"), c(n));
                };
            return {
                location: n,
                register: function (n, i) {
                    -1 != t.inArray(n, e) ? (void 0 !== i._construct && r.container.on("ftoc_" + n, i._construct), "common" != n && void 0 !== i._destruct && r.container.on("_ftoc_" + n, i._destruct)) : c("Not support this event: " + n);
                },
                updateOnResize: function () {
                    i("resize");
                },
                updateOnScroll: function () {
                    i("scroll");
                },
                init: function () {
                    r.container.trigger("ftoc_common"), i("init");
                },
            };
        })(),
        p = {
            set: function (t) {
                var n;
                (n = void 0 !== t ? t : r.contents.height()), r.list.css("height", n - r.header.outerHeight() + "px");
            },
            setAuto: function () {
                r.list.css("height", "auto");
            },
            unset: function () {
                r.list.css("height", "");
            },
        };
    if (f.isColExpList())
        var g = (function () {
            var n = function (n, e) {
                    $currentTarget = void 0 === e ? t(this) : e;
                    var i = $currentTarget.parent(".ft-has-sub");
                    i.length && ($currentTarget.hasClass("ft-anchor") ? d(i, $currentTarget.prev("button")) : o(i, $currentTarget));
                },
                e = function (n, e) {
                    $currentTarget = void 0 === e ? t(this) : e;
                    var i = $currentTarget.parent(".ft-item");
                    i.length && ($currentTarget.hasClass("ft-anchor") ? s(i, $currentTarget.prev("button")) : (o(i, $currentTarget), u(i)));
                },
                o = function (t, n) {
                    t.hasClass("ft-collapse") ? d(t, n) : t.hasClass("ft-expand") && a(t, n);
                },
                s = function (t, n) {
                    u(t), t.hasClass("ft-has-sub") && d(t, n);
                },
                a = function (t, n) {
                    t.removeClass("ft-expand").addClass("ft-collapse"), n.length && n.removeClass("ft-icon-expand").addClass("ft-icon-collapse");
                },
                d = function (t, n) {
                    t.removeClass("ft-collapse").addClass("ft-expand"), n.length && n.removeClass("ft-icon-collapse").addClass("ft-icon-expand");
                },
                u = function (n) {
                    r.hasSubItems.each(function () {
                        ($thisItem = t(this)), $thisItem.get(0) != n.get(0) && ($thisItem.find(n).length || a($thisItem, $thisItem.children("button")));
                    });
                },
                p = function (n) {
                    f.isAccordionList() && u(n.parent(".ft-item"));
                    var e = n.parents(".ft-has-sub");
                    e &&
                        e.each(function () {
                            var n = t(this),
                                e = n.children("button");
                            d(n, e);
                        });
                };
            return {
                _construct: function () {
                    f.showColExpIcon() && f.isAccordionList()
                        ? (r.colExpIcons.on("click", e), r.container.on("ftocAfterScrollToTarget", e))
                        : f.showColExpIcon()
                        ? (r.colExpIcons.on("click", n), r.container.on("ftocAfterScrollToTarget", n))
                        : r.container.on("ftocAfterScrollToTarget", e),
                        f.showColExpIcon() && r.colExpIcons.on("mousedown", i),
                        r.container.on("ftocAfterTargetIndicated", function (t, n) {
                            p(n);
                        }),
                        c("Actived colExpSubList().");
                },
            };
        })();
    var l = (function () {
            var n,
                e = !1,
                o = function (n) {
                    var i = n.attr("href");
                    $targetObj = t(i);
                    $targetObj.target;
                    var o = n.data("index"),
                        c = a.data.headingsTop[o];
                    if (void 0 !== c) {
                        var f = c.headingTop,
                            d = i.substr(1);
                            var widthScreen = $(window).width();
                            var screenTop = 10;
                            if(widthScreen <= 999){
                                //screenTop = 170;phuong
                            }
                        r.headings.removeClass("ft-heading-target"),
                            $targetObj.attr("id", "").addClass("ft-heading-target"),
                            (window.location.hash = i),
                            $targetObj.attr("id", d),
                            t("html, body")
                                .animate(
                                    {                                          
                                        scrollTop: f - screenTop
                                    },
                                    {
                                        duration: fixedtocOption.scrollDuration,
                                        start: function () {
                                            e = !0;
                                        },
                                    }
                                )
                                .promise()
                                .then(function () {
                                    e = !1;
                                    var i = a.data.headingsTop[o].headingTop;
                                    f != i &&
                                        t("html, body").animate({ scrollTop: i}, 100, function () {
                                            var n = a.data.headingsTop[o].headingTop;
                                            i != n && t("html, body").animate({ scrollTop: n }, 1, function () {});
                                        }),
                                        s(n),
                                        r.container.trigger("ftocAfterScrollToTarget", [n, f]);
                                });
                    }
                },
                s = function (t) {
                    if ((d(), (n = t), t.addClass("ft-active"), (u.location.fixedToPost || u.location.fixedWidget) && (t.is(":focus") || e || t.focus()), f.showColExpIcon())) {
                        var i = t.prev();
                        i.length && i.addClass("ft-active");
                    }
                },
                d = function () {
                    if (n && (n.removeClass("ft-active").blur(), f.showColExpIcon())) {
                        var t = n.prev();
                        t.length && t.removeClass("ft-active");
                    }
                };
            return {
                _construct: function () {
                    r.anchors.on("click", function (n) {
                        n.preventDefault();
                        var e = t(n.currentTarget);
                        o(e);
                    }),
                        r.anchors.on("mousedown", i),
                        c("Actived scrollToTarget().");
                },
                activeCurrent: s,
                deactiveAll: function () {
                    (n = void 0), r.anchors.removeClass("ft-active").blur(), f.showColExpIcon() && r.colExpIcons.removeClass("ft-active");
                },
                deactivePrev: d,
            };
        })(),
        h = (function () {
            var n,
                e,
                i = function () {
                    function i() {
                        t.each(o, function (t) {
                            return void 0 === o[t + 1] && this.headingTop <= a.data.ftocRangeY.bottom
                                ? ((n = [this, o[t], t]), (e = a.data.document.height), l.activeCurrent(this.anchorEle), r.container.trigger("ftocAfterTargetIndicated", [this.anchorEle, s]), !1)
                                : this.headingTop <= s && o[t + 1].headingTop > s
                                ? ((n = [this, o[t + 1], t]), (e = a.data.document.height), l.activeCurrent(this.anchorEle), r.container.trigger("ftocAfterTargetIndicated", [this.anchorEle, s]), !1)
                                : void 0;
                        });
                    }
                    var o = a.data.headingsTop,
                        s = a.data.scrollTop;
               
                    if(typeof o[0] != 'undefined'){
                        return o[0].headingTop > s || a.data.ftocRangeY.bottom < s
                            ? (void 0 !== n && l.deactiveAll(), void (n = void 0))
                            : void 0 !== e && e != a.data.document.height
                            ? (i(), void c("Fixed target indicator!!"))
                            : void ((void 0 !== n && n[0].headingTop <= s && n[1].headingTop > s) || i());
                    }else{
                        return null;
                    }
                };
            return {
                _construct: function () {
                    r.window.on("ftocScroll", i).on("ftocResize", i), c("Actived targetIndicator().");
                },
                start: function () {
                    r.window.on("ftocScroll", i).on("ftocResize", i);
                },
                stop: function () {
                    r.window.off("ftocScroll", i).off("ftocResize", i);
                },
            };
        })(),
        x =
            ((function () {
                var n = function () {
                        e();
                    },
                    e = function () {
                        r.list.on("scroll", o), r.list.on("mouseleave", c), r.document.on("click", s), r.window.on("scroll", c);
                    },
                    i = function () {
                        r.body.removeClass("ft-no-scroll"), r.list.off("scroll", o), r.list.off("mouseleave", c), r.document.off("click", s), r.window.off("scroll", c);
                    },
                    o = function () {
                        r.body.addClass("ft-no-scroll");
                    },
                    c = function () {
                        r.body.hasClass("ft-no-scroll") &&
                            (r.list.off("scroll", o),
                            r.body.removeClass("ft-no-scroll"),
                            setTimeout(function () {
                                r.list.on("scroll", o);
                            }, 100));
                    },
                    s = function (n) {
                        t.contains(r.list.get(0), n.target) || c();
                    };
            })(),
            {
                _construct: function () {
                    r.container.addClass("ft-hidden-state"), c("Actived hideToc().");
                },
                _destruct: function () {
                    r.container.removeClass("ft-hidden-state"), c("Deactived hideToc().");
                },
            }),
        w = (function () {
            var t = function () {
                    r.container.addClass("ft-fixed-to-post"),
                        r.container.parent().is(r.body) || r.container.appendTo(r.body),
                        r.minIcon.addClass("fa fa-close"),
                        f.isMobile() && r.container.hasClass("ft-maximize") && r.container.removeClass("ft-maximize").addClass("ft-minimize");
                },
                n = function () {
                    r.container.removeClass("ft-fixed-to-post"), r.minIcon.removeClass("fa fa-close");
                },
                e = (function () {
                    var t = function (t, n) {
                            return n <= t.outerWidth();
                        },
                        n = function (n, e, i) {
                            t(n, i) ? (n.css({ left: "0px", right: "auto" }), s.reverseTransformOrigin(n)) : n.css({ right: e + "px", left: "auto" });
                        },
                        e = function (n, e, i) {
                            t(n, i) ? (n.css({ right: "0px", left: "auto" }), s.reverseTransformOrigin(n)) : n.css({ left: e + "px", right: "auto" });
                        },
                        o = function () {
                            f.isPositionAtFixed("top")
                                ? (r.trigger.css("top", a.data.fixedOffsetTop + "px"), r.contents.css("top", a.data.fixedOffsetTop + "px"))
                                : f.isPositionAtFixed("middle")
                                ? r.contents.css("top", a.data.fixedHeight + "px")
                                : (r.trigger.css("top", ""), r.contents.css("top", ""));
                        };
                    return {
                        set: function () {
                            if ((s.setTransformOrigin(), f.isPositionAtFixed("left"))) {
                                var t = a.data.window.width - a.data.postRect.left + fixedtocOption.fixedOffsetX,
                                    c = a.data.postRect.left - fixedtocOption.fixedOffsetX;
                                n(r.trigger, t, c), n(r.contents, t, c);
                            } else {
                                var d = a.data.postRect.right + fixedtocOption.fixedOffsetX,
                                    u = a.data.window.width - d;
                                e(r.trigger, d, u), e(r.contents, d, u);
                            }
                            o(), i.reset();
                        },
                        unset: function () {
                            r.trigger.css({ left: "", right: "", top: "" }), r.contents.css({ left: "", right: "", top: "" }), s.removeTransformOrigin();
                        },
                    };
                })(),
                i = (function () {
                    var t = function () {
                            r.contents.css("height", "");
                        },
                        n = function () {
                            var n;
                            return (
                                f.isAutoHeightFixedToPost()
                                    ? f.isColExpList()
                                        ? (n = window.innerHeight)
                                        : (p.setAuto(), r.contents.css("height", "auto"), (n = r.contents.outerHeight()), t(), p.unset())
                                    : (n = fixedtocOption.contentsFixedHeight),
                                n
                            );
                        };
                    return {
                        reset: function () {
                            var t,
                                e,
                                i = n();
                            (e = (t = f.isPositionAtFixed("middle") ? a.data.window.height - a.data.fixedHeight : a.data.window.height - a.data.fixedOffsetTop) < i ? t : i), r.contents.css("height", e + "px");
                            var c = o(e);
                            p.set(c);
                        },
                        unset: t,
                    };
                })(),
                s = (function () {
                    var t,
                        n,
                        e = "ft-animate-" + fixedtocOption.inOutEffect + "-in",
                        i = "ft-animate-" + fixedtocOption.inOutEffect + "-inOut";
                    return {
                        inCls: e,
                        in: function () {
                            r.container.addClass(e);
                        },
                        inOut: function () {
                            r.container.removeClass(e + " " + i),
                                r.container.offsetWidth,
                                r.container.addClass(i),
                                setTimeout(function () {
                                    r.container.removeClass(i);
                                }, 1e3);
                        },
                        out: function () {
                            r.container.removeClass(e + " " + i);
                        },
                        setTransformOrigin: function () {
                            var e = fixedtocOption.fixedPosition.match(/(\w+)\-(\w+)/i);
                            if (e) {
                                var i = e[2],
                                    o = e[1];
                                "left" == i ? (i = "right") : "right" == i && (i = "left"), "middle" == o && (o = "center"), (t = "ft-transform-" + i + "-" + o), r.trigger.removeClass(n).addClass(t), r.contents.removeClass(n).addClass(t);
                            }
                        },
                        reverseTransformOrigin: function (e) {
                            (n = t.match(/left/i) ? t.replace("left", "right") : t.replace("right", "left")), e.removeClass(t).addClass(n);
                        },
                        removeTransformOrigin: function () {
                            r.trigger.removeClass(t + " " + n), r.contents.removeClass(t + " " + n);
                        },
                    };
                })();
            return {
                _construct: function () {
                    t(), e.set(), r.window.on("ftocResize", e.set), s.in(), r.container.on("ftocAfterMinMax", s.inOut), c("Actived ftocInOut().");
                },
                _destruct: function () {
                    n(), e.unset(), r.window.off("ftocResize", e.set), i.unset(), p.unset(), s.out(), r.container.off("ftocAfterMinMax", s.inOut), c("Deactived ftocInOut().");
                },
                effectInCls: s.inCls,
            };
        })(),
        m = (function () {
            var n = function () {
                    r.container.removeClass("ft-minimize").addClass("ft-maximize"), r.container.trigger("ftocAfterMinMax"), r.container.trigger("ftocAfterMaximize"), c("Maximized FTOC.");
                },
                e = function () {
                    r.container.removeClass("ft-maximize").addClass("ft-minimize"), r.container.trigger("ftocAfterMinMax"), r.container.trigger("ftocAfterMinimize"), c("Minimized FTOC.");
                },
                o = function (n) {
                    ("touchstart" == n.type && a.data.window.width > 768) || (r.container.hasClass("ft-maximize") && !t.contains(r.container.get(0), n.target) && e());
                },
                s = function (t) {
                    r.container.hasClass("ft-maximize") && 27 == t.keyCode && e();
                },
                d = function (t) {
                    r.container.hasClass("ft-minimize") && 13 == t.keyCode && n();
                };
            return {
                _construct: function (t) {
                    r.trigger.on("click", n),
                        r.minIcon.on("click", e),
                        r.trigger.on("mousedown", i),
                        r.minIcon.on("mousedown", i),
                        f.isQuickMin() && r.document.on("click touchstart", o),
                        f.isEscMin() && r.document.on("keyup", s),
                        f.isEnterMax() && r.document.on("keyup", d),
                        c("Actived minMaxFtoc().");
                },
                _destruct: function (t) {
                    r.trigger.off("click", n),
                        r.minIcon.off("click", e),
                        r.trigger.off("mousedown", i),
                        r.minIcon.off("mousedown", i),
                        f.isQuickMin() && r.document.off("click", o),
                        f.isEscMin() && r.document.off("keyup", s),
                        f.isEnterMax() && r.document.off("keyup", d),
                        c("Deactived minMaxFtoc.");
                },
                isMax: function () {
                    return !!r.container.hasClass("ft-maximize");
                },
                isMin: function () {
                    return !!r.container.hasClass("ft-minimize");
                },
                minimize: e,
            };
        })(),
        v = (function () {
            var t,
                n = "ft-fade-trigger",
                e = "ft-unfade-trigger",
                i = function () {
                    void 0 === t &&
                        (setTimeout(function () {
                            r.container.removeClass(w.effectInCls);
                        }, 500),
                        (t = setTimeout(function () {
                            r.trigger.addClass(n);
                        }, fixedtocOption.fadeTriggerDuration)));
                },
                o = function () {
                    void 0 !== t && (clearTimeout(t), (t = void 0), r.trigger.removeClass(n + " " + e));
                },
                s = function () {
                    void 0 !== t && (clearTimeout(t), r.trigger.removeClass(n).addClass(e));
                },
                f = function () {
                    void 0 !== t && (o(), i());
                },
                a = function () {
                    s();
                },
                d = function () {
                    f();
                };
            return {
                _construct: function () {
                    r.container.hasClass("ft-minimize") && i(), r.trigger.on("mouseenter", s).on("mouseleave", f), r.container.on("ftocAfterMinimize", i).on("ftocAfterMaximize", o), c("Actived fadeTrigger().");
                },
                _destruct: function () {
                    o(), r.trigger.off("mouseenter", a), r.trigger.off("mouseleave", d), r.container.off("ftocAfterMinimize", i), r.container.off("ftocAfterMaximize", o), c("Deactived fadeTrigger().");
                },
                stop: o,
                start: i,
                restart: f,
                mouseLeave: d,
            };
        })(),
        O = {
            start: function (t) {
                f.isNotBlur() || (t && t.length && t.removeClass("ft-unblur").addClass("ft-blur"));
            },
            stop: function (t) {
                t &&
                    t.length &&
                    t.hasClass("ft-blur") &&
                    (t.removeClass("ft-blur").addClass("ft-unblur"),
                    setTimeout(function () {
                        t.removeClass("ft-unblur");
                    }, 500));
            },
            clear: function (t) {
                t && t.length && t.removeClass("ft-blur ft-unblur");
            },
        },
        C = (function () {
            var t,
                n = function () {
                    (t = r.container.siblings(':not("script, style")')), m.isMax() && a() && O.start(t);
                },
                e = function () {
                    m.isMax() && a() ? O.start(t) : O.stop(t);
                },
                i = function () {
                    a() && O.start(t);
                },
                o = function () {
                    O.stop(t);
                },
                s = function (n, e) {
                    a() && r.container.hasClass("ft-maximize") && (m.minimize(), O.stop(t), e.blur());
                },
                f = function () {
                    O.clear(t);
                },
                a = function () {
                    return 0.6 * r.window.width() <= r.contents.outerWidth();
                };
            return {
                _construct: function () {
                    n(), r.window.on("ftocResize", e), r.container.on("ftocAfterMaximize", i), r.container.on("ftocAfterMinimize", o), r.container.on("ftocAfterScrollToTarget", s), c("Actived blurBody().");
                },
                _destruct: function () {
                    f(), r.window.off("ftocResize", e), r.container.off("ftocAfterMaximize", i), r.container.off("ftocAfterMinimize", o), r.container.off("ftocAfterScrollToTarget", s), c("Deactived blurBody().");
                },
            };
        })();
    if (f.fixedWidget())
        var T = (function () {
            var t,
                n = function () {
                    "expand" == r.contents.data("colexp") && O.start(t);
                },
                e = function () {
                    O.start(t);
                },
                i = function () {
                    O.stop(t);
                },
                o = function () {
                    O.clear(t);
                };
            return {
                _construct: function () {
                    (t = r.widget.siblings(".widget")), n(), r.contents.on("ftocAfterExpandContents", e), r.contents.on("ftocAfterCollapseContents", i), c("Actived blurWidgets().");
                },
                _destruct: function () {
                    o(), r.contents.off("ftocAfterExpandContents", e), r.contents.off("ftocAfterCollapseContents", i), c("Deactived blurWidgets().");
                },
            };
        })();
    if (f.inWidget() || f.supportInPost())
        var I = (function () {
            var t,
                n,
                e = !0,
                o = function () {
                    f.isMobile() && e ? (u(0, n), z.reload()) : d() ? p(0, t) : u(0, n), (e = !1);
                },
                s = function () {
                    r.list.show(0), r.minIcon.removeClass("ft-icon-collapse ft-icon-expand");
                },
                a = function (e) {
                    d() ? u(100, n, e) : p(100, t, e);
                },
                d = function () {
                    var t = r.contents.data("colexp");
                    return "expand" == t || void 0 === t;
                },
                u = function (t, n, e) {
                    r.list.hide(t, function () {
                        r.minIcon.removeClass("ft-icon-expand").addClass("ft-icon-collapse"), void 0 !== n && n(e);
                    }),
                        r.contents.data("colexp", "collapse"),
                        r.contents.trigger("ftocAfterCollapseContents"),
                        c("Collapsed contents.");
                },
                p = function (t, n, e) {
                    r.list.show(t, function () {
                        r.minIcon.removeClass("ft-icon-collapse").addClass("ft-icon-expand"), void 0 !== n && n(e);
                    }),
                        r.contents.data("colexp", "expand"),
                        r.contents.trigger("ftocAfterExpandContents"),
                        c("Expanded contents.");
                };
            return {
                construct: function (e, c) {
                    (t = e), (n = c), o(), r.minIcon.on("mousedown", i), r.minIcon.on("click", a);
                },
                destruct: function () {
                    s(), r.minIcon.off("mousedown", i), r.minIcon.off("click", a);
                },
            };
        })();
    if (f.inWidget())
        var W = {
            _construct: function () {
                I.construct(), c("Actived colExpConentsInWidget().");
            },
            _destruct: function () {
                I.destruct(), c("Deactived colExpConentsInWidget().");
            },
        };
    if (f.fixedWidget())
        var b = (function () {
            var t = function () {
                    a.ftocRectInWidget.updateHeight(), A.setFixed();
                },
                n = function () {
                    a.ftocRectInWidget.updateHeight(), A.setFixed();
                };
            return {
                _construct: function () {
                    I.construct(t, n), c("Actived colExpConentsInFixedWidget().");
                },
                _destruct: function () {
                    I.destruct(), c("Deactived colExpConentsInFixedWidget().");
                },
            };
        })();
    if (f.inWidget())
        var P = (function () {
            var t = function () {
                r.container.parent().is(r.widgetContainer) || r.container.appendTo(r.widgetContainer), r.contents.css("height", "auto");
            };
            return {
                _construct: function () {
                    t(), c("Actived displayInWidget().");
                },
                _destruct: function () {
                    r.contents.css("height", ""), c("Deactived displayInWidget().");
                },
                init: t,
            };
        })();
    if (f.fixedWidget())
        var A = (function () {
            var t = function () {
                    P.init();
                },
                n = function () {
                    r.widget.addClass("ft-widget-fixed");
                    var t = a.data.ftocRectInWidget;
                    r.contents.css({ left: t.left, top: t.top, width: t.width + "px", height: t.height + "px" });
                    var n = o(t.height);
                    p.set(n);
                },
                e = function () {
                    r.widget.removeClass("ft-widget-fixed"), r.contents.css({ left: "", top: "", width: "", height: "" });
                };
            return {
                _construct: function () {
                    t(), n(), r.window.on("ftocResize", n), c("Actived fixedInWidget().");
                },
                _destruct: function () {
                    t(), e(), r.window.off("ftocResize", n), p.unset(), c("Deactived fixedInWidget().");
                },
                setFixed: n,
            };
        })();
    if (f.supportInPost())
        var R = (function () {
                var t,
                    n = function () {
                        r.container.parent().is(r.containerOuter) || r.container.appendTo(r.containerOuter), i();
                    },
                    e = function () {
                        r.contents.css("height", ""), p.unset();
                    },
                    i = function () {
                        0 == fixedtocOption.contentsWidthInPost && f.isFloat() ? (r.containerOuter.css("width", ""), (t = r.containerOuter.outerWidth()), r.containerOuter.css("width", t + "px")) : r.containerOuter.css("width", ""),
                            r.containerOuter.css("height", a.data.containerOuterHeight + "px"),
                            r.contents.css("height", a.data.containerOuterHeight + "px");
                        var n = o(a.data.containerOuterHeight);
                        p.set(n);
                    };
                return {
                    _construct: function () {
                        n(), r.window.on("ftocResize", i), c("Actived displayInPost().");
                    },
                    _destruct: function () {
                        e(), r.window.off("ftocResize", i), c("Deactived displayInPost().");
                    },
                };
            })(),
            H = (function () {
                var t = function (t) {
                        n(t);
                    },
                    n = function (t) {
                        void 0 !== t && "click" == t.type && a.updateInPost();
                    };
                return {
                    _construct: function () {
                        I.construct(t, n), c("Actived colExpConentsInFixedWidget().");
                    },
                    _destruct: function () {
                        I.destruct(), c("Deactived colExpConentsInFixedWidget().");
                    },
                };
            })();
    var z = (function () {
        var n = function () {
                a.createOnInit(),
                    f.isColExpList() && u.register("common", g),
                    u.register("common", l),
                    u.register("common", h),
                    u.register("hidden", x),
                    f.fixedWidget() && (u.register("fixedWidget", b), u.register("fixedWidget", A), u.register("fixedWidget", T)),
                    f.inWidget() && (u.register("inWidget", P), u.register("inWidget", W)),
                    f.supportInPost() && (u.register("inPost", R), u.register("inPost", H)),
                    u.register("fixedToPost", w),
                    u.register("fixedToPost", m),
                    u.register("fixedToPost", v),
                    u.register("fixedToPost", C),
                    u.init(),
                    r.window.resize(e),
                    r.window.scroll(i);
            },
            e = function () {
                a.updateOnResize(), u.updateOnResize(), r.window.trigger("ftocResize");
            },
            i = function () {
                a.updateOnDocumentHeightChange(), a.updateOnScroll(), u.updateOnScroll(), r.window.trigger("ftocScroll");
            },
            o = function () {
                c(fixedtocOption), a.updateOnResize(), u.updateOnResize(), r.window.trigger("ftocResize");
            };
        return {
            option: s,
            onReady: function () {
                s.init(),
                    ((r = {
                        window: t(window),
                        document: t(document),
                        body: t("body"),
                        container: t("#ft-container"),
                        trigger: t("#ft-trigger"),
                        contents: t("#ft-contents"),
                        header: t("#ft-header"),
                        minIcon: t("#ft-header-minimize"),
                        list: t("#ft-list"),
                        postContent: t("#ft-postcontent"),
                        headings: t(".ft-heading"),
                    }).anchors = r.list.find(".ft-anchor").not(".ft-otherpage-anchor")),
                    f.isNestedList() && (r.hasSubItems = r.list.find(".ft-has-sub")),
                    f.showColExpIcon() && (r.colExpIcons = r.list.find(".ft-icon-expand, .ft-icon-collapse")),
                    f.inWidget() && ((r.widget = t(".ft-widget")), (r.widgetContainer = t("#ft-widget-container"))),
                    f.supportInPost() && (r.containerOuter = t("#ft-container-outer")),
                    c(r),
                    r.anchors.each(function (n) {
                        t(this).data("index", n);
                    }),
                    r.container.trigger("ftocReady"),
                    n(),
                    setTimeout(o, 100),
                    r.window.load(o),
                    c(fixedtocOption);
            },
            reload: o,
        };
    })();
    return t(document).ready(z.onReady), { option: z.option, reload: z.reload };
})(jQuery);

$(".show-hidden-content").click(function () {
    var show_content = $("#show-content").val();
    if(parseInt(show_content) == parseInt(0)){
        $("#show-content").val("1")

        $("#ft-list").hide()
        $("#ft-header-minimize").hide()
        $("#ft-header-minimize-show").show()
    }else{
        $("#show-content").val("0")

        $("#ft-list").show()
        $("#ft-header-minimize").show()
        $("#ft-header-minimize-show").hide()
    }
});