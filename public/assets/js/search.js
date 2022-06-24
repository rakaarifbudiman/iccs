/*! X-editable - v1.5.0 
 * In-place editing with Twitter Bootstrap, jQuery UI or pure jQuery
 * http://github.com/vitalets/x-editable
 * Copyright (c) 2013 Vitaliy Potapov; Licensed MIT */
! function (a) {
    "use strict";
    var b = function (b, c) {
        this.options = a.extend({}, a.fn.editableform.defaults, c), this.$div = a(b), this.options.scope || (this.options.scope = this)
    };
    b.prototype = {
        constructor: b,
        initInput: function () {
            this.input = this.options.input, this.value = this.input.str2value(this.options.value), this.input.prerender()
        },
        initTemplate: function () {
            this.$form = a(a.fn.editableform.template)
        },
        initButtons: function () {
            var b = this.$form.find(".editable-buttons");
            b.append(a.fn.editableform.buttons), "bottom" === this.options.showbuttons && b.addClass("editable-buttons-bottom")
        },
        render: function () {
            this.$loading = a(a.fn.editableform.loading), this.$div.empty().append(this.$loading), this.initTemplate(), this.options.showbuttons ? this.initButtons() : this.$form.find(".editable-buttons").remove(), this.showLoading(), this.isSaving = !1, this.$div.triggerHandler("rendering"), this.initInput(), this.$form.find("div.editable-input").append(this.input.$tpl), this.$div.append(this.$form), a.when(this.input.render()).then(a.proxy(function () {
                if (this.options.showbuttons || this.input.autosubmit(), this.$form.find(".editable-cancel").click(a.proxy(this.cancel, this)), this.input.error) this.error(this.input.error), this.$form.find(".editable-submit").attr("disabled", !0), this.input.$input.attr("disabled", !0), this.$form.submit(function (a) {
                    a.preventDefault()
                });
                else {
                    this.error(!1), this.input.$input.removeAttr("disabled"), this.$form.find(".editable-submit").removeAttr("disabled");
                    var b = null === this.value || void 0 === this.value || "" === this.value ? this.options.defaultValue : this.value;
                    this.input.value2input(b), this.$form.submit(a.proxy(this.submit, this))
                }
                this.$div.triggerHandler("rendered"), this.showForm(), this.input.postrender && this.input.postrender()
            }, this))
        },
        cancel: function () {
            this.$div.triggerHandler("cancel")
        },
        showLoading: function () {
            var a, b;
            this.$form ? (a = this.$form.outerWidth(), b = this.$form.outerHeight(), a && this.$loading.width(a), b && this.$loading.height(b), this.$form.hide()) : (a = this.$loading.parent().width(), a && this.$loading.width(a)), this.$loading.show()
        },
        showForm: function (a) {
            this.$loading.hide(), this.$form.show(), a !== !1 && this.input.activate(), this.$div.triggerHandler("show")
        },
        error: function (b) {
            var c, d = this.$form.find(".control-group"),
                e = this.$form.find(".editable-error-block");
            if (b === !1) d.removeClass(a.fn.editableform.errorGroupClass), e.removeClass(a.fn.editableform.errorBlockClass).empty().hide();
            else {
                if (b) {
                    c = b.split("\n");
                    for (var f = 0; f < c.length; f++) c[f] = a("<div>").text(c[f]).html();
                    b = c.join("<br>")
                }
                d.addClass(a.fn.editableform.errorGroupClass), e.addClass(a.fn.editableform.errorBlockClass).html(b).show()
            }
        },
        submit: function (b) {
            b.stopPropagation(), b.preventDefault();
            var c, d = this.input.input2value();
            if (c = this.validate(d)) return this.error(c), this.showForm(), void 0;
            if (!this.options.savenochange && this.input.value2str(d) == this.input.value2str(this.value)) return this.$div.triggerHandler("nochange"), void 0;
            var e = this.input.value2submit(d);
            this.isSaving = !0, a.when(this.save(e)).done(a.proxy(function (a) {
                this.isSaving = !1;
                var b = "function" == typeof this.options.success ? this.options.success.call(this.options.scope, a, d) : null;
                return b === !1 ? (this.error(!1), this.showForm(!1), void 0) : "string" == typeof b ? (this.error(b), this.showForm(), void 0) : (b && "object" == typeof b && b.hasOwnProperty("newValue") && (d = b.newValue), this.error(!1), this.value = d, this.$div.triggerHandler("save", {
                    newValue: d,
                    submitValue: e,
                    response: a
                }), void 0)
            }, this)).fail(a.proxy(function (a) {
                this.isSaving = !1;
                var b;
                b = "function" == typeof this.options.error ? this.options.error.call(this.options.scope, a, d) : "string" == typeof a ? a : a.responseText || a.statusText || "Unknown error!", this.error(b), this.showForm()
            }, this))
        },
        save: function (b) {
            this.options.pk = a.fn.editableutils.tryParseJson(this.options.pk, !0);
            var c, d = "function" == typeof this.options.pk ? this.options.pk.call(this.options.scope) : this.options.pk,
                e = !!("function" == typeof this.options.url || this.options.url && ("always" === this.options.send || "auto" === this.options.send && null !== d && void 0 !== d));
            return e ? (this.showLoading(), c = {
                name: this.options.name || "",
                value: b,
                pk: d
            }, "function" == typeof this.options.params ? c = this.options.params.call(this.options.scope, c) : (this.options.params = a.fn.editableutils.tryParseJson(this.options.params, !0), a.extend(c, this.options.params)), "function" == typeof this.options.url ? this.options.url.call(this.options.scope, c) : a.ajax(a.extend({
                url: this.options.url,
                data: c,
                type: "POST"
            }, this.options.ajaxOptions))) : void 0
        },
        validate: function (a) {
            return void 0 === a && (a = this.value), "function" == typeof this.options.validate ? this.options.validate.call(this.options.scope, a) : void 0
        },
        option: function (a, b) {
            a in this.options && (this.options[a] = b), "value" === a && this.setValue(b)
        },
        setValue: function (a, b) {
            this.value = b ? this.input.str2value(a) : a, this.$form && this.$form.is(":visible") && this.input.value2input(this.value)
        }
    }, a.fn.editableform = function (c) {
        var d = arguments;
        return this.each(function () {
            var e = a(this),
                f = e.data("editableform"),
                g = "object" == typeof c && c;
            f || e.data("editableform", f = new b(this, g)), "string" == typeof c && f[c].apply(f, Array.prototype.slice.call(d, 1))
        })
    }, a.fn.editableform.Constructor = b, a.fn.editableform.defaults = {
        type: "text",
        url: null,
        params: null,
        name: null,
        pk: null,
        value: null,
        defaultValue: null,
        send: "auto",
        validate: null,
        success: null,
        error: null,
        ajaxOptions: null,
        showbuttons: !0,
        scope: null,
        savenochange: !1
    }, a.fn.editableform.template = '<form class="form-inline editableform"><div class="control-group"><div><div class="editable-input"></div><div class="editable-buttons"></div></div><div class="editable-error-block"></div></div></form>', a.fn.editableform.loading = '<div class="editableform-loading"></div>', a.fn.editableform.buttons = '<button type="submit" class="editable-submit">ok</button><button type="button" class="editable-cancel">cancel</button>', a.fn.editableform.errorGroupClass = null, a.fn.editableform.errorBlockClass = "editable-error", a.fn.editableform.engine = "jquery"
}(window.jQuery),
function (a) {
    "use strict";
    a.fn.editableutils = {
        inherit: function (a, b) {
            var c = function () {};
            c.prototype = b.prototype, a.prototype = new c, a.prototype.constructor = a, a.superclass = b.prototype
        },
        setCursorPosition: function (a, b) {
            if (a.setSelectionRange) a.setSelectionRange(b, b);
            else if (a.createTextRange) {
                var c = a.createTextRange();
                c.collapse(!0), c.moveEnd("character", b), c.moveStart("character", b), c.select()
            }
        },
        tryParseJson: function (a, b) {
            if ("string" == typeof a && a.length && a.match(/^[\{\[].*[\}\]]$/))
                if (b) try {
                    a = new Function("return " + a)()
                } catch (c) {} finally {
                    return a
                } else a = new Function("return " + a)();
            return a
        },
        sliceObj: function (b, c, d) {
            var e, f, g = {};
            if (!a.isArray(c) || !c.length) return g;
            for (var h = 0; h < c.length; h++) e = c[h], b.hasOwnProperty(e) && (g[e] = b[e]), d !== !0 && (f = e.toLowerCase(), b.hasOwnProperty(f) && (g[e] = b[f]));
            return g
        },
        getConfigData: function (b) {
            var c = {};
            return a.each(b.data(), function (a, b) {
                ("object" != typeof b || b && "object" == typeof b && (b.constructor === Object || b.constructor === Array)) && (c[a] = b)
            }), c
        },
        objectKeys: function (a) {
            if (Object.keys) return Object.keys(a);
            if (a !== Object(a)) throw new TypeError("Object.keys called on a non-object");
            var b, c = [];
            for (b in a) Object.prototype.hasOwnProperty.call(a, b) && c.push(b);
            return c
        },
        escape: function (b) {
            return a("<div>").text(b).html()
        },
        itemsByValue: function (b, c, d) {
            if (!c || null === b) return [];
            if ("function" != typeof d) {
                var e = d || "value";
                d = function (a) {
                    return a[e]
                }
            }
            var f = a.isArray(b),
                g = [],
                h = this;
            return a.each(c, function (c, e) {
                if (e.children) g = g.concat(h.itemsByValue(b, e.children, d));
                else if (f) a.grep(b, function (a) {
                    return a == (e && "object" == typeof e ? d(e) : e)
                }).length && g.push(e);
                else {
                    var i = e && "object" == typeof e ? d(e) : e;
                    b == i && g.push(e)
                }
            }), g
        },
        createInput: function (b) {
            var c, d, e, f = b.type;
            return "date" === f && ("inline" === b.mode ? a.fn.editabletypes.datefield ? f = "datefield" : a.fn.editabletypes.dateuifield && (f = "dateuifield") : a.fn.editabletypes.date ? f = "date" : a.fn.editabletypes.dateui && (f = "dateui"), "date" !== f || a.fn.editabletypes.date || (f = "combodate")), "datetime" === f && "inline" === b.mode && (f = "datetimefield"), "wysihtml5" !== f || a.fn.editabletypes[f] || (f = "textarea"), "function" == typeof a.fn.editabletypes[f] ? (c = a.fn.editabletypes[f], d = this.sliceObj(b, this.objectKeys(c.defaults)), e = new c(d)) : (a.error("Unknown type: " + f), !1)
        },
        supportsTransitions: function () {
            var a = document.body || document.documentElement,
                b = a.style,
                c = "transition",
                d = ["Moz", "Webkit", "Khtml", "O", "ms"];
            if ("string" == typeof b[c]) return !0;
            c = c.charAt(0).toUpperCase() + c.substr(1);
            for (var e = 0; e < d.length; e++)
                if ("string" == typeof b[d[e] + c]) return !0;
            return !1
        }
    }
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a, b) {
            this.init(a, b)
        },
        c = function (a, b) {
            this.init(a, b)
        };
    b.prototype = {
        containerName: null,
        containerDataName: null,
        innerCss: null,
        containerClass: "editable-container editable-popup",
        defaults: {},
        init: function (c, d) {
            this.$element = a(c), this.options = a.extend({}, a.fn.editableContainer.defaults, d), this.splitOptions(), this.formOptions.scope = this.$element[0], this.initContainer(), this.delayedHide = !1, this.$element.on("destroyed", a.proxy(function () {
                this.destroy()
            }, this)), a(document).data("editable-handlers-attached") || (a(document).on("keyup.editable", function (b) {
                27 === b.which && a(".editable-open").editableContainer("hide")
            }), a(document).on("click.editable", function (c) {
                var d, e = a(c.target),
                    f = [".editable-container", ".ui-datepicker-header", ".datepicker", ".modal-backdrop", ".bootstrap-wysihtml5-insert-image-modal", ".bootstrap-wysihtml5-insert-link-modal"];
                if (a.contains(document.documentElement, c.target) && !e.is(document)) {
                    for (d = 0; d < f.length; d++)
                        if (e.is(f[d]) || e.parents(f[d]).length) return;
                    b.prototype.closeOthers(c.target)
                }
            }), a(document).data("editable-handlers-attached", !0))
        },
        splitOptions: function () {
            if (this.containerOptions = {}, this.formOptions = {}, !a.fn[this.containerName]) throw new Error(this.containerName + " not found. Have you included corresponding js file?");
            for (var b in this.options) b in this.defaults ? this.containerOptions[b] = this.options[b] : this.formOptions[b] = this.options[b]
        },
        tip: function () {
            return this.container() ? this.container().$tip : null
        },
        container: function () {
            var a;
            return this.containerDataName && (a = this.$element.data(this.containerDataName)) ? a : a = this.$element.data(this.containerName)
        },
        call: function () {
            this.$element[this.containerName].apply(this.$element, arguments)
        },
        initContainer: function () {
            this.call(this.containerOptions)
        },
        renderForm: function () {
            this.$form.editableform(this.formOptions).on({
                save: a.proxy(this.save, this),
                nochange: a.proxy(function () {
                    this.hide("nochange")
                }, this),
                cancel: a.proxy(function () {
                    this.hide("cancel")
                }, this),
                show: a.proxy(function () {
                    this.delayedHide ? (this.hide(this.delayedHide.reason), this.delayedHide = !1) : this.setPosition()
                }, this),
                rendering: a.proxy(this.setPosition, this),
                resize: a.proxy(this.setPosition, this),
                rendered: a.proxy(function () {
                    this.$element.triggerHandler("shown", a(this.options.scope).data("editable"))
                }, this)
            }).editableform("render")
        },
        show: function (b) {
            this.$element.addClass("editable-open"), b !== !1 && this.closeOthers(this.$element[0]), this.innerShow(), this.tip().addClass(this.containerClass), this.$form, this.$form = a("<div>"), this.tip().is(this.innerCss) ? this.tip().append(this.$form) : this.tip().find(this.innerCss).append(this.$form), this.renderForm()
        },
        hide: function (a) {
            if (this.tip() && this.tip().is(":visible") && this.$element.hasClass("editable-open")) {
                if (this.$form.data("editableform").isSaving) return this.delayedHide = {
                    reason: a
                }, void 0;
                this.delayedHide = !1, this.$element.removeClass("editable-open"), this.innerHide(), this.$element.triggerHandler("hidden", a || "manual")
            }
        },
        innerShow: function () {},
        innerHide: function () {},
        toggle: function (a) {
            this.container() && this.tip() && this.tip().is(":visible") ? this.hide() : this.show(a)
        },
        setPosition: function () {},
        save: function (a, b) {
            this.$element.triggerHandler("save", b), this.hide("save")
        },
        option: function (a, b) {
            this.options[a] = b, a in this.containerOptions ? (this.containerOptions[a] = b, this.setContainerOption(a, b)) : (this.formOptions[a] = b, this.$form && this.$form.editableform("option", a, b))
        },
        setContainerOption: function (a, b) {
            this.call("option", a, b)
        },
        destroy: function () {
            this.hide(), this.innerDestroy(), this.$element.off("destroyed"), this.$element.removeData("editableContainer")
        },
        innerDestroy: function () {},
        closeOthers: function (b) {
            a(".editable-open").each(function (c, d) {
                if (d !== b && !a(d).find(b).length) {
                    var e = a(d),
                        f = e.data("editableContainer");
                    f && ("cancel" === f.options.onblur ? e.data("editableContainer").hide("onblur") : "submit" === f.options.onblur && e.data("editableContainer").tip().find("form").submit())
                }
            })
        },
        activate: function () {
            this.tip && this.tip().is(":visible") && this.$form && this.$form.data("editableform").input.activate()
        }
    }, a.fn.editableContainer = function (d) {
        var e = arguments;
        return this.each(function () {
            var f = a(this),
                g = "editableContainer",
                h = f.data(g),
                i = "object" == typeof d && d,
                j = "inline" === i.mode ? c : b;
            h || f.data(g, h = new j(this, i)), "string" == typeof d && h[d].apply(h, Array.prototype.slice.call(e, 1))
        })
    }, a.fn.editableContainer.Popup = b, a.fn.editableContainer.Inline = c, a.fn.editableContainer.defaults = {
        value: null,
        placement: "top",
        autohide: !0,
        onblur: "cancel",
        anim: !1,
        mode: "popup"
    }, jQuery.event.special.destroyed = {
        remove: function (a) {
            a.handler && a.handler()
        }
    }
}(window.jQuery),
function (a) {
    "use strict";
    a.extend(a.fn.editableContainer.Inline.prototype, a.fn.editableContainer.Popup.prototype, {
        containerName: "editableform",
        innerCss: ".editable-inline",
        containerClass: "editable-container editable-inline",
        initContainer: function () {
            this.$tip = a("<span></span>"), this.options.anim || (this.options.anim = 0)
        },
        splitOptions: function () {
            this.containerOptions = {}, this.formOptions = this.options
        },
        tip: function () {
            return this.$tip
        },
        innerShow: function () {
            this.$element.hide(), this.tip().insertAfter(this.$element).show()
        },
        innerHide: function () {
            this.$tip.hide(this.options.anim, a.proxy(function () {
                this.$element.show(), this.innerDestroy()
            }, this))
        },
        innerDestroy: function () {
            this.tip() && this.tip().empty().remove()
        }
    })
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (b, c) {
        this.$element = a(b), this.options = a.extend({}, a.fn.editable.defaults, c, a.fn.editableutils.getConfigData(this.$element)), this.options.selector ? this.initLive() : this.init(), this.options.highlight && !a.fn.editableutils.supportsTransitions() && (this.options.highlight = !1)
    };
    b.prototype = {
        constructor: b,
        init: function () {
            var b, c = !1;
            if (this.options.name = this.options.name || this.$element.attr("id"), this.options.scope = this.$element[0], this.input = a.fn.editableutils.createInput(this.options), this.input) {
                switch (void 0 === this.options.value || null === this.options.value ? (this.value = this.input.html2value(a.trim(this.$element.html())), c = !0) : (this.options.value = a.fn.editableutils.tryParseJson(this.options.value, !0), this.value = "string" == typeof this.options.value ? this.input.str2value(this.options.value) : this.options.value), this.$element.addClass("editable"), "textarea" === this.input.type && this.$element.addClass("editable-pre-wrapped"), "manual" !== this.options.toggle ? (this.$element.addClass("editable-click"), this.$element.on(this.options.toggle + ".editable", a.proxy(function (a) {
                    if (this.options.disabled || a.preventDefault(), "mouseenter" === this.options.toggle) this.show();
                    else {
                        var b = "click" !== this.options.toggle;
                        this.toggle(b)
                    }
                }, this))) : this.$element.attr("tabindex", -1), "function" == typeof this.options.display && (this.options.autotext = "always"), this.options.autotext) {
                    case "always":
                        b = !0;
                        break;
                    case "auto":
                        b = !a.trim(this.$element.text()).length && null !== this.value && void 0 !== this.value && !c;
                        break;
                    default:
                        b = !1
                }
                a.when(b ? this.render() : !0).then(a.proxy(function () {
                    this.options.disabled ? this.disable() : this.enable(), this.$element.triggerHandler("init", this)
                }, this))
            }
        },
        initLive: function () {
            var b = this.options.selector;
            this.options.selector = !1, this.options.autotext = "never", this.$element.on(this.options.toggle + ".editable", b, a.proxy(function (b) {
                var c = a(b.target);
                c.data("editable") || (c.hasClass(this.options.emptyclass) && c.empty(), c.editable(this.options).trigger(b))
            }, this))
        },
        render: function (a) {
            return this.options.display !== !1 ? this.input.value2htmlFinal ? this.input.value2html(this.value, this.$element[0], this.options.display, a) : "function" == typeof this.options.display ? this.options.display.call(this.$element[0], this.value, a) : this.input.value2html(this.value, this.$element[0]) : void 0
        },
        enable: function () {
            this.options.disabled = !1, this.$element.removeClass("editable-disabled"), this.handleEmpty(this.isEmpty), "manual" !== this.options.toggle && "-1" === this.$element.attr("tabindex") && this.$element.removeAttr("tabindex")
        },
        disable: function () {
            this.options.disabled = !0, this.hide(), this.$element.addClass("editable-disabled"), this.handleEmpty(this.isEmpty), this.$element.attr("tabindex", -1)
        },
        toggleDisabled: function () {
            this.options.disabled ? this.enable() : this.disable()
        },
        option: function (b, c) {
            return b && "object" == typeof b ? (a.each(b, a.proxy(function (b, c) {
                this.option(a.trim(b), c)
            }, this)), void 0) : (this.options[b] = c, "disabled" === b ? c ? this.disable() : this.enable() : ("value" === b && this.setValue(c), this.container && this.container.option(b, c), this.input.option && this.input.option(b, c), void 0))
        },
        handleEmpty: function (b) {
            this.options.display !== !1 && (this.isEmpty = void 0 !== b ? b : "function" == typeof this.input.isEmpty ? this.input.isEmpty(this.$element) : "" === a.trim(this.$element.html()), this.options.disabled ? this.isEmpty && (this.$element.empty(), this.options.emptyclass && this.$element.removeClass(this.options.emptyclass)) : this.isEmpty ? (this.$element.html(this.options.emptytext), this.options.emptyclass && this.$element.addClass(this.options.emptyclass)) : this.options.emptyclass && this.$element.removeClass(this.options.emptyclass))
        },
        show: function (b) {
            if (!this.options.disabled) {
                if (this.container) {
                    if (this.container.tip().is(":visible")) return
                } else {
                    var c = a.extend({}, this.options, {
                        value: this.value,
                        input: this.input
                    });
                    this.$element.editableContainer(c), this.$element.on("save.internal", a.proxy(this.save, this)), this.container = this.$element.data("editableContainer")
                }
                this.container.show(b)
            }
        },
        hide: function () {
            this.container && this.container.hide()
        },
        toggle: function (a) {
            this.container && this.container.tip().is(":visible") ? this.hide() : this.show(a)
        },
        save: function (a, b) {
            if (this.options.unsavedclass) {
                var c = !1;
                c = c || "function" == typeof this.options.url, c = c || this.options.display === !1, c = c || void 0 !== b.response, c = c || this.options.savenochange && this.input.value2str(this.value) !== this.input.value2str(b.newValue), c ? this.$element.removeClass(this.options.unsavedclass) : this.$element.addClass(this.options.unsavedclass)
            }
            if (this.options.highlight) {
                var d = this.$element,
                    e = d.css("background-color");
                d.css("background-color", this.options.highlight), setTimeout(function () {
                    "transparent" === e && (e = ""), d.css("background-color", e), d.addClass("editable-bg-transition"), setTimeout(function () {
                        d.removeClass("editable-bg-transition")
                    }, 1700)
                }, 10)
            }
            this.setValue(b.newValue, !1, b.response)
        },
        validate: function () {
            return "function" == typeof this.options.validate ? this.options.validate.call(this, this.value) : void 0
        },
        setValue: function (b, c, d) {
            this.value = c ? this.input.str2value(b) : b, this.container && this.container.option("value", this.value), a.when(this.render(d)).then(a.proxy(function () {
                this.handleEmpty()
            }, this))
        },
        activate: function () {
            this.container && this.container.activate()
        },
        destroy: function () {
            this.disable(), this.container && this.container.destroy(), this.input.destroy(), "manual" !== this.options.toggle && (this.$element.removeClass("editable-click"), this.$element.off(this.options.toggle + ".editable")), this.$element.off("save.internal"), this.$element.removeClass("editable editable-open editable-disabled"), this.$element.removeData("editable")
        }
    }, a.fn.editable = function (c) {
        var d = {},
            e = arguments,
            f = "editable";
        switch (c) {
            case "validate":
                return this.each(function () {
                    var b, c = a(this),
                        e = c.data(f);
                    e && (b = e.validate()) && (d[e.options.name] = b)
                }), d;
            case "getValue":
                return 2 === arguments.length && arguments[1] === !0 ? d = this.eq(0).data(f).value : this.each(function () {
                    var b = a(this),
                        c = b.data(f);
                    c && void 0 !== c.value && null !== c.value && (d[c.options.name] = c.input.value2submit(c.value))
                }), d;
            case "submit":
                var g, h = arguments[1] || {},
                    i = this,
                    j = this.editable("validate");
                return a.isEmptyObject(j) ? (g = this.editable("getValue"), h.data && a.extend(g, h.data), a.ajax(a.extend({
                    url: h.url,
                    data: g,
                    type: "POST"
                }, h.ajaxOptions)).success(function (a) {
                    "function" == typeof h.success && h.success.call(i, a, h)
                }).error(function () {
                    "function" == typeof h.error && h.error.apply(i, arguments)
                })) : "function" == typeof h.error && h.error.call(i, j), this
        }
        return this.each(function () {
            var d = a(this),
                g = d.data(f),
                h = "object" == typeof c && c;
            return h && h.selector ? (g = new b(this, h), void 0) : (g || d.data(f, g = new b(this, h)), "string" == typeof c && g[c].apply(g, Array.prototype.slice.call(e, 1)), void 0)
        })
    }, a.fn.editable.defaults = {
        type: "text",
        disabled: !1,
        toggle: "click",
        emptytext: "Empty",
        autotext: "auto",
        value: null,
        display: null,
        emptyclass: "editable-empty",
        unsavedclass: "editable-unsaved",
        selector: null,
        highlight: "#FFFF80"
    }
}(window.jQuery),
function (a) {
    "use strict";
    a.fn.editabletypes = {};
    var b = function () {};
    b.prototype = {
        init: function (b, c, d) {
            this.type = b, this.options = a.extend({}, d, c)
        },
        prerender: function () {
            this.$tpl = a(this.options.tpl), this.$input = this.$tpl, this.$clear = null, this.error = null
        },
        render: function () {},
        value2html: function (b, c) {
            a(c)[this.options.escape ? "text" : "html"](a.trim(b))
        },
        html2value: function (b) {
            return a("<div>").html(b).text()
        },
        value2str: function (a) {
            return a
        },
        str2value: function (a) {
            return a
        },
        value2submit: function (a) {
            return a
        },
        value2input: function (a) {
            this.$input.val(a)
        },
        input2value: function () {
            return this.$input.val()
        },
        activate: function () {
            this.$input.is(":visible") && this.$input.focus()
        },
        clear: function () {
            this.$input.val(null)
        },
        escape: function (b) {
            return a("<div>").text(b).html()
        },
        autosubmit: function () {},
        destroy: function () {},
        setClass: function () {
            this.options.inputclass && this.$input.addClass(this.options.inputclass)
        },
        setAttr: function (a) {
            void 0 !== this.options[a] && null !== this.options[a] && this.$input.attr(a, this.options[a])
        },
        option: function (a, b) {
            this.options[a] = b
        }
    }, b.defaults = {
        tpl: "",
        inputclass: null,
        escape: !0,
        scope: null,
        showbuttons: !0
    }, a.extend(a.fn.editabletypes, {
        abstractinput: b
    })
}(window.jQuery),
function (a) {
    "use strict";
    var b = function () {};
    a.fn.editableutils.inherit(b, a.fn.editabletypes.abstractinput), a.extend(b.prototype, {
        render: function () {
            var b = a.Deferred();
            return this.error = null, this.onSourceReady(function () {
                this.renderList(), b.resolve()
            }, function () {
                this.error = this.options.sourceError, b.resolve()
            }), b.promise()
        },
        html2value: function () {
            return null
        },
        value2html: function (b, c, d, e) {
            var f = a.Deferred(),
                g = function () {
                    "function" == typeof d ? d.call(c, b, this.sourceData, e) : this.value2htmlFinal(b, c), f.resolve()
                };
            return null === b ? g.call(this) : this.onSourceReady(g, function () {
                f.resolve()
            }), f.promise()
        },
        onSourceReady: function (b, c) {
            var d;
            if (a.isFunction(this.options.source) ? (d = this.options.source.call(this.options.scope), this.sourceData = null) : d = this.options.source, this.options.sourceCache && a.isArray(this.sourceData)) return b.call(this), void 0;
            try {
                d = a.fn.editableutils.tryParseJson(d, !1)
            } catch (e) {
                return c.call(this), void 0
            }
            if ("string" == typeof d) {
                if (this.options.sourceCache) {
                    var f, g = d;
                    if (a(document).data(g) || a(document).data(g, {}), f = a(document).data(g), f.loading === !1 && f.sourceData) return this.sourceData = f.sourceData, this.doPrepend(), b.call(this), void 0;
                    if (f.loading === !0) return f.callbacks.push(a.proxy(function () {
                        this.sourceData = f.sourceData, this.doPrepend(), b.call(this)
                    }, this)), f.err_callbacks.push(a.proxy(c, this)), void 0;
                    f.loading = !0, f.callbacks = [], f.err_callbacks = []
                }
                var h = a.extend({
                    url: d,
                    type: "get",
                    cache: !1,
                    dataType: "json",
                    success: a.proxy(function (d) {
                        f && (f.loading = !1), this.sourceData = this.makeArray(d), a.isArray(this.sourceData) ? (f && (f.sourceData = this.sourceData, a.each(f.callbacks, function () {
                            this.call()
                        })), this.doPrepend(), b.call(this)) : (c.call(this), f && a.each(f.err_callbacks, function () {
                            this.call()
                        }))
                    }, this),
                    error: a.proxy(function () {
                        c.call(this), f && (f.loading = !1, a.each(f.err_callbacks, function () {
                            this.call()
                        }))
                    }, this)
                }, this.options.sourceOptions);
                a.ajax(h)
            } else this.sourceData = this.makeArray(d), a.isArray(this.sourceData) ? (this.doPrepend(), b.call(this)) : c.call(this)
        },
        doPrepend: function () {
            null !== this.options.prepend && void 0 !== this.options.prepend && (a.isArray(this.prependData) || (a.isFunction(this.options.prepend) && (this.options.prepend = this.options.prepend.call(this.options.scope)), this.options.prepend = a.fn.editableutils.tryParseJson(this.options.prepend, !0), "string" == typeof this.options.prepend && (this.options.prepend = {
                "": this.options.prepend
            }), this.prependData = this.makeArray(this.options.prepend)), a.isArray(this.prependData) && a.isArray(this.sourceData) && (this.sourceData = this.prependData.concat(this.sourceData)))
        },
        renderList: function () {},
        value2htmlFinal: function () {},
        makeArray: function (b) {
            var c, d, e, f, g = [];
            if (!b || "string" == typeof b) return null;
            if (a.isArray(b)) {
                f = function (a, b) {
                    return d = {
                        value: a,
                        text: b
                    }, c++ >= 2 ? !1 : void 0
                };
                for (var h = 0; h < b.length; h++) e = b[h], "object" == typeof e ? (c = 0, a.each(e, f), 1 === c ? g.push(d) : c > 1 && (e.children && (e.children = this.makeArray(e.children)), g.push(e))) : g.push({
                    value: e,
                    text: e
                })
            } else a.each(b, function (a, b) {
                g.push({
                    value: a,
                    text: b
                })
            });
            return g
        },
        option: function (a, b) {
            this.options[a] = b, "source" === a && (this.sourceData = null), "prepend" === a && (this.prependData = null)
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.abstractinput.defaults, {
        source: null,
        prepend: !1,
        sourceError: "Error when loading list",
        sourceCache: !0,
        sourceOptions: null
    }), a.fn.editabletypes.list = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("text", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.abstractinput), a.extend(b.prototype, {
        render: function () {
            this.renderClear(), this.setClass(), this.setAttr("placeholder")
        },
        activate: function () {
            this.$input.is(":visible") && (this.$input.focus(), a.fn.editableutils.setCursorPosition(this.$input.get(0), this.$input.val().length), this.toggleClear && this.toggleClear())
        },
        renderClear: function () {
            this.options.clear && (this.$clear = a('<span class="editable-clear-x"></span>'), this.$input.after(this.$clear).css("padding-right", 24).keyup(a.proxy(function (b) {
                if (!~a.inArray(b.keyCode, [40, 38, 9, 13, 27])) {
                    clearTimeout(this.t);
                    var c = this;
                    this.t = setTimeout(function () {
                        c.toggleClear(b)
                    }, 100)
                }
            }, this)).parent().css("position", "relative"), this.$clear.click(a.proxy(this.clear, this)))
        },
        postrender: function () {},
        toggleClear: function () {
            if (this.$clear) {
                var a = this.$input.val().length,
                    b = this.$clear.is(":visible");
                a && !b && this.$clear.show(), !a && b && this.$clear.hide()
            }
        },
        clear: function () {
            this.$clear.hide(), this.$input.val("").focus()
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.abstractinput.defaults, {
        tpl: '<input type="text">',
        placeholder: null,
        clear: !0
    }), a.fn.editabletypes.text = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("textarea", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.abstractinput), a.extend(b.prototype, {
        render: function () {
            this.setClass(), this.setAttr("placeholder"), this.setAttr("rows"), this.$input.keydown(function (b) {
                b.ctrlKey && 13 === b.which && a(this).closest("form").submit()
            })
        },
        activate: function () {
            a.fn.editabletypes.text.prototype.activate.call(this)
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.abstractinput.defaults, {
        tpl: "<textarea></textarea>",
        inputclass: "input-large",
        placeholder: null,
        rows: 7
    }), a.fn.editabletypes.textarea = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("select", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.list), a.extend(b.prototype, {
        renderList: function () {
            this.$input.empty();
            var b = function (c, d) {
                var e;
                if (a.isArray(d))
                    for (var f = 0; f < d.length; f++) e = {}, d[f].children ? (e.label = d[f].text, c.append(b(a("<optgroup>", e), d[f].children))) : (e.value = d[f].value, d[f].disabled && (e.disabled = !0), c.append(a("<option>", e).text(d[f].text)));
                return c
            };
            b(this.$input, this.sourceData), this.setClass(), this.$input.on("keydown.editable", function (b) {
                13 === b.which && a(this).closest("form").submit()
            })
        },
        value2htmlFinal: function (b, c) {
            var d = "",
                e = a.fn.editableutils.itemsByValue(b, this.sourceData);
            e.length && (d = e[0].text), a.fn.editabletypes.abstractinput.prototype.value2html.call(this, d, c)
        },
        autosubmit: function () {
            this.$input.off("keydown.editable").on("change.editable", function () {
                a(this).closest("form").submit()
            })
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.list.defaults, {
        tpl: "<select></select>"
    }), a.fn.editabletypes.select = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("checklist", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.list), a.extend(b.prototype, {
        renderList: function () {
            var b;
            if (this.$tpl.empty(), a.isArray(this.sourceData)) {
                for (var c = 0; c < this.sourceData.length; c++) b = a("<label>").append(a("<input>", {
                    type: "checkbox",
                    value: this.sourceData[c].value
                })).append(a("<span>").text(" " + this.sourceData[c].text)), a("<div>").append(b).appendTo(this.$tpl);
                this.$input = this.$tpl.find('input[type="checkbox"]'), this.setClass()
            }
        },
        value2str: function (b) {
            return a.isArray(b) ? b.sort().join(a.trim(this.options.separator)) : ""
        },
        str2value: function (b) {
            var c, d = null;
            return "string" == typeof b && b.length ? (c = new RegExp("\\s*" + a.trim(this.options.separator) + "\\s*"), d = b.split(c)) : d = a.isArray(b) ? b : [b], d
        },
        value2input: function (b) {
            this.$input.prop("checked", !1), a.isArray(b) && b.length && this.$input.each(function (c, d) {
                var e = a(d);
                a.each(b, function (a, b) {
                    e.val() == b && e.prop("checked", !0)
                })
            })
        },
        input2value: function () {
            var b = [];
            return this.$input.filter(":checked").each(function (c, d) {
                b.push(a(d).val())
            }), b
        },
        value2htmlFinal: function (b, c) {
            var d = [],
                e = a.fn.editableutils.itemsByValue(b, this.sourceData),
                f = this.options.escape;
            e.length ? (a.each(e, function (b, c) {
                var e = f ? a.fn.editableutils.escape(c.text) : c.text;
                d.push(e)
            }), a(c).html(d.join("<br>"))) : a(c).empty()
        },
        activate: function () {
            this.$input.first().focus()
        },
        autosubmit: function () {
            this.$input.on("keydown", function (b) {
                13 === b.which && a(this).closest("form").submit()
            })
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.list.defaults, {
        tpl: '<div class="editable-checklist"></div>',
        inputclass: null,
        separator: ","
    }), a.fn.editabletypes.checklist = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("password", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.text), a.extend(b.prototype, {
        value2html: function (b, c) {
            b ? a(c).text("[hidden]") : a(c).empty()
        },
        html2value: function () {
            return null
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.text.defaults, {
        tpl: '<input type="password">'
    }), a.fn.editabletypes.password = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("email", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.text), b.defaults = a.extend({}, a.fn.editabletypes.text.defaults, {
        tpl: '<input type="email">'
    }), a.fn.editabletypes.email = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("url", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.text), b.defaults = a.extend({}, a.fn.editabletypes.text.defaults, {
        tpl: '<input type="url">'
    }), a.fn.editabletypes.url = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("tel", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.text), b.defaults = a.extend({}, a.fn.editabletypes.text.defaults, {
        tpl: '<input type="tel">'
    }), a.fn.editabletypes.tel = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("number", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.text), a.extend(b.prototype, {
        render: function () {
            b.superclass.render.call(this), this.setAttr("min"), this.setAttr("max"), this.setAttr("step")
        },
        postrender: function () {
            this.$clear && this.$clear.css({
                right: 24
            })
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.text.defaults, {
        tpl: '<input type="number">',
        inputclass: "input-mini",
        min: null,
        max: null,
        step: null
    }), a.fn.editabletypes.number = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("range", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.number), a.extend(b.prototype, {
        render: function () {
            this.$input = this.$tpl.filter("input"), this.setClass(), this.setAttr("min"), this.setAttr("max"), this.setAttr("step"), this.$input.on("input", function () {
                a(this).siblings("output").text(a(this).val())
            })
        },
        activate: function () {
            this.$input.focus()
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.number.defaults, {
        tpl: '<input type="range"><output style="width: 30px; display: inline-block"></output>',
        inputclass: "input-medium"
    }), a.fn.editabletypes.range = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("time", a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.abstractinput), a.extend(b.prototype, {
        render: function () {
            this.setClass()
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.abstractinput.defaults, {
        tpl: '<input type="time">'
    }), a.fn.editabletypes.time = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (c) {
        if (this.init("select2", c, b.defaults), c.select2 = c.select2 || {}, this.sourceData = null, c.placeholder && (c.select2.placeholder = c.placeholder), !c.select2.tags && c.source) {
            var d = c.source;
            a.isFunction(c.source) && (d = c.source.call(c.scope)), "string" == typeof d ? (c.select2.ajax = c.select2.ajax || {}, c.select2.ajax.data || (c.select2.ajax.data = function (a) {
                return {
                    query: a
                }
            }), c.select2.ajax.results || (c.select2.ajax.results = function (a) {
                return {
                    results: a
                }
            }), c.select2.ajax.url = d) : (this.sourceData = this.convertSource(d), c.select2.data = this.sourceData)
        }
        if (this.options.select2 = a.extend({}, b.defaults.select2, c.select2), this.isMultiple = this.options.select2.tags || this.options.select2.multiple, this.isRemote = "ajax" in this.options.select2, this.idFunc = this.options.select2.id, "function" != typeof this.idFunc) {
            var e = this.idFunc || "id";
            this.idFunc = function (a) {
                return a[e]
            }
        }
        this.formatSelection = this.options.select2.formatSelection, "function" != typeof this.formatSelection && (this.formatSelection = function (a) {
            return a.text
        })
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.abstractinput), a.extend(b.prototype, {
        render: function () {
            this.setClass(), this.isRemote && this.$input.on("select2-loaded", a.proxy(function (a) {
                this.sourceData = a.items.results
            }, this)), this.isMultiple && this.$input.on("change", function () {
                a(this).closest("form").parent().triggerHandler("resize")
            })
        },
        value2html: function (c, d) {
            var e, f = "",
                g = this;
            this.options.select2.tags ? e = c : this.sourceData && (e = a.fn.editableutils.itemsByValue(c, this.sourceData, this.idFunc)), a.isArray(e) ? (f = [], a.each(e, function (a, b) {
                f.push(b && "object" == typeof b ? g.formatSelection(b) : b)
            })) : e && (f = g.formatSelection(e)), f = a.isArray(f) ? f.join(this.options.viewseparator) : f, b.superclass.value2html.call(this, f, d)
        },
        html2value: function (a) {
            return this.options.select2.tags ? this.str2value(a, this.options.viewseparator) : null
        },
        value2input: function (b) {
            if (this.$input.data("select2") ? this.$input.val(b).trigger("change", !0) : (this.$input.val(b), this.$input.select2(this.options.select2)), this.isRemote && !this.isMultiple && !this.options.select2.initSelection) {
                var c = this.options.select2.id,
                    d = this.options.select2.formatSelection;
                if (!c && !d) {
                    var e = {
                        id: b,
                        text: a(this.options.scope).text()
                    };
                    this.$input.select2("data", e)
                }
            }
        },
        input2value: function () {
            return this.$input.select2("val")
        },
        str2value: function (b, c) {
            if ("string" != typeof b || !this.isMultiple) return b;
            c = c || this.options.select2.separator || a.fn.select2.defaults.separator;
            var d, e, f;
            if (null === b || b.length < 1) return null;
            for (d = b.split(c), e = 0, f = d.length; f > e; e += 1) d[e] = a.trim(d[e]);
            return d
        },
        autosubmit: function () {
            this.$input.on("change", function (b, c) {
                c || a(this).closest("form").submit()
            })
        },
        convertSource: function (b) {
            if (a.isArray(b) && b.length && void 0 !== b[0].value)
                for (var c = 0; c < b.length; c++) void 0 !== b[c].value && (b[c].id = b[c].value, delete b[c].value);
            return b
        },
        destroy: function () {
            this.$input.data("select2") && this.$input.select2("destroy")
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.abstractinput.defaults, {
        tpl: '<input type="hidden">',
        select2: null,
        placeholder: null,
        source: null,
        viewseparator: ", "
    }), a.fn.editabletypes.select2 = b
}(window.jQuery),
function (a) {
    var b = function (b, c) {
        return this.$element = a(b), this.$element.is("input") ? (this.options = a.extend({}, a.fn.combodate.defaults, c, this.$element.data()), this.init(), void 0) : (a.error("Combodate should be applied to INPUT element"), void 0)
    };
    b.prototype = {
        constructor: b,
        init: function () {
            this.map = {
                day: ["D", "date"],
                month: ["M", "month"],
                year: ["Y", "year"],
                hour: ["[Hh]", "hours"],
                minute: ["m", "minutes"],
                second: ["s", "seconds"],
                ampm: ["[Aa]", ""]
            }, this.$widget = a('<span class="combodate"></span>').html(this.getTemplate()), this.initCombos(), this.$widget.on("change", "select", a.proxy(function () {
                this.$element.val(this.getValue())
            }, this)), this.$widget.find("select").css("width", "auto"), this.$element.hide().after(this.$widget), this.setValue(this.$element.val() || this.options.value)
        },
        getTemplate: function () {
            var b = this.options.template;
            return a.each(this.map, function (a, c) {
                c = c[0];
                var d = new RegExp(c + "+"),
                    e = c.length > 1 ? c.substring(1, 2) : c;
                b = b.replace(d, "{" + e + "}")
            }), b = b.replace(/ /g, "&nbsp;"), a.each(this.map, function (a, c) {
                c = c[0];
                var d = c.length > 1 ? c.substring(1, 2) : c;
                b = b.replace("{" + d + "}", '<select class="' + a + '"></select>')
            }), b
        },
        initCombos: function () {
            var b = this;
            a.each(this.map, function (a) {
                var c, d, e = b.$widget.find("." + a);
                e.length && (b["$" + a] = e, c = "fill" + a.charAt(0).toUpperCase() + a.slice(1), d = b[c](), b["$" + a].html(b.renderItems(d)))
            })
        },
        initItems: function (a) {
            var b, c = [];
            if ("name" === this.options.firstItem) {
                b = moment.relativeTime || moment.langData()._relativeTime;
                var d = "function" == typeof b[a] ? b[a](1, !0, a, !1) : b[a];
                d = d.split(" ").reverse()[0], c.push(["", d])
            } else "empty" === this.options.firstItem && c.push(["", ""]);
            return c
        },
        renderItems: function (a) {
            for (var b = [], c = 0; c < a.length; c++) b.push('<option value="' + a[c][0] + '">' + a[c][1] + "</option>");
            return b.join("\n")
        },
        fillDay: function () {
            var a, b, c = this.initItems("d"),
                d = -1 !== this.options.template.indexOf("DD");
            for (b = 1; 31 >= b; b++) a = d ? this.leadZero(b) : b, c.push([b, a]);
            return c
        },
        fillMonth: function () {
            var a, b, c = this.initItems("M"),
                d = -1 !== this.options.template.indexOf("MMMM"),
                e = -1 !== this.options.template.indexOf("MMM"),
                f = -1 !== this.options.template.indexOf("MM");
            for (b = 0; 11 >= b; b++) a = d ? moment().date(1).month(b).format("MMMM") : e ? moment().date(1).month(b).format("MMM") : f ? this.leadZero(b + 1) : b + 1, c.push([b, a]);
            return c
        },
        fillYear: function () {
            var a, b, c = [],
                d = -1 !== this.options.template.indexOf("YYYY");
            for (b = this.options.maxYear; b >= this.options.minYear; b--) a = d ? b : (b + "").substring(2), c[this.options.yearDescending ? "push" : "unshift"]([b, a]);
            return c = this.initItems("y").concat(c)
        },
        fillHour: function () {
            var a, b, c = this.initItems("h"),
                d = -1 !== this.options.template.indexOf("h"),
                e = (-1 !== this.options.template.indexOf("H"), -1 !== this.options.template.toLowerCase().indexOf("hh")),
                f = d ? 1 : 0,
                g = d ? 12 : 23;
            for (b = f; g >= b; b++) a = e ? this.leadZero(b) : b, c.push([b, a]);
            return c
        },
        fillMinute: function () {
            var a, b, c = this.initItems("m"),
                d = -1 !== this.options.template.indexOf("mm");
            for (b = 0; 59 >= b; b += this.options.minuteStep) a = d ? this.leadZero(b) : b, c.push([b, a]);
            return c
        },
        fillSecond: function () {
            var a, b, c = this.initItems("s"),
                d = -1 !== this.options.template.indexOf("ss");
            for (b = 0; 59 >= b; b += this.options.secondStep) a = d ? this.leadZero(b) : b, c.push([b, a]);
            return c
        },
        fillAmpm: function () {
            var a = -1 !== this.options.template.indexOf("a"),
                b = (-1 !== this.options.template.indexOf("A"), [
                    ["am", a ? "am" : "AM"],
                    ["pm", a ? "pm" : "PM"]
                ]);
            return b
        },
        getValue: function (b) {
            var c, d = {},
                e = this,
                f = !1;
            return a.each(this.map, function (a) {
                if ("ampm" !== a) {
                    var b = "day" === a ? 1 : 0;
                    return d[a] = e["$" + a] ? parseInt(e["$" + a].val(), 10) : b, isNaN(d[a]) ? (f = !0, !1) : void 0
                }
            }), f ? "" : (this.$ampm && (d.hour = 12 === d.hour ? "am" === this.$ampm.val() ? 0 : 12 : "am" === this.$ampm.val() ? d.hour : d.hour + 12), c = moment([d.year, d.month, d.day, d.hour, d.minute, d.second]), this.highlight(c), b = void 0 === b ? this.options.format : b, null === b ? c.isValid() ? c : null : c.isValid() ? c.format(b) : "")
        },
        setValue: function (b) {
            function c(b, c) {
                var d = {};
                return b.children("option").each(function (b, e) {
                    var f, g = a(e).attr("value");
                    "" !== g && (f = Math.abs(g - c), ("undefined" == typeof d.distance || f < d.distance) && (d = {
                        value: g,
                        distance: f
                    }))
                }), d.value
            }
            if (b) {
                var d = "string" == typeof b ? moment(b, this.options.format) : moment(b),
                    e = this,
                    f = {};
                d.isValid() && (a.each(this.map, function (a, b) {
                    "ampm" !== a && (f[a] = d[b[1]]())
                }), this.$ampm && (f.hour >= 12 ? (f.ampm = "pm", f.hour > 12 && (f.hour -= 12)) : (f.ampm = "am", 0 === f.hour && (f.hour = 12))), a.each(f, function (a, b) {
                    e["$" + a] && ("minute" === a && e.options.minuteStep > 1 && e.options.roundTime && (b = c(e["$" + a], b)), "second" === a && e.options.secondStep > 1 && e.options.roundTime && (b = c(e["$" + a], b)), e["$" + a].val(b))
                }), this.$element.val(d.format(this.options.format)))
            }
        },
        highlight: function (a) {
            a.isValid() ? this.options.errorClass ? this.$widget.removeClass(this.options.errorClass) : this.$widget.find("select").css("border-color", this.borderColor) : this.options.errorClass ? this.$widget.addClass(this.options.errorClass) : (this.borderColor || (this.borderColor = this.$widget.find("select").css("border-color")), this.$widget.find("select").css("border-color", "red"))
        },
        leadZero: function (a) {
            return 9 >= a ? "0" + a : a
        },
        destroy: function () {
            this.$widget.remove(), this.$element.removeData("combodate").show()
        }
    }, a.fn.combodate = function (c) {
        var d, e = Array.apply(null, arguments);
        return e.shift(), "getValue" === c && this.length && (d = this.eq(0).data("combodate")) ? d.getValue.apply(d, e) : this.each(function () {
            var d = a(this),
                f = d.data("combodate"),
                g = "object" == typeof c && c;
            f || d.data("combodate", f = new b(this, g)), "string" == typeof c && "function" == typeof f[c] && f[c].apply(f, e)
        })
    }, a.fn.combodate.defaults = {
        format: "DD-MM-YYYY HH:mm",
        template: "D / MMM / YYYY   H : mm",
        value: null,
        minYear: 1970,
        maxYear: 2015,
        yearDescending: !0,
        minuteStep: 5,
        secondStep: 1,
        firstItem: "empty",
        errorClass: null,
        roundTime: !0
    }
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (c) {
        this.init("combodate", c, b.defaults), this.options.viewformat || (this.options.viewformat = this.options.format), c.combodate = a.fn.editableutils.tryParseJson(c.combodate, !0), this.options.combodate = a.extend({}, b.defaults.combodate, c.combodate, {
            format: this.options.format,
            template: this.options.template
        })
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.abstractinput), a.extend(b.prototype, {
        render: function () {
            this.$input.combodate(this.options.combodate), "bs3" === a.fn.editableform.engine && this.$input.siblings().find("select").addClass("form-control"), this.options.inputclass && this.$input.siblings().find("select").addClass(this.options.inputclass)
        },
        value2html: function (a, c) {
            var d = a ? a.format(this.options.viewformat) : "";
            b.superclass.value2html.call(this, d, c)
        },
        html2value: function (a) {
            return a ? moment(a, this.options.viewformat) : null
        },
        value2str: function (a) {
            return a ? a.format(this.options.format) : ""
        },
        str2value: function (a) {
            return a ? moment(a, this.options.format) : null
        },
        value2submit: function (a) {
            return this.value2str(a)
        },
        value2input: function (a) {
            this.$input.combodate("setValue", a)
        },
        input2value: function () {
            return this.$input.combodate("getValue", null)
        },
        activate: function () {
            this.$input.siblings(".combodate").find("select").eq(0).focus()
        },
        autosubmit: function () {}
    }), b.defaults = a.extend({}, a.fn.editabletypes.abstractinput.defaults, {
        tpl: '<input type="text">',
        inputclass: null,
        format: "YYYY-MM-DD",
        viewformat: null,
        template: "D / MMM / YYYY",
        combodate: null
    }), a.fn.editabletypes.combodate = b
}(window.jQuery),
function (a) {
    "use strict";
    if (a.extend(a.fn.editableContainer.Popup.prototype, {
            containerName: "poshytip",
            innerCss: "div.tip-inner",
            defaults: a.fn.poshytip.defaults,
            initContainer: function () {
                this.handlePlacement(), a.extend(this.containerOptions, {
                    showOn: "none",
                    content: "",
                    alignTo: "target"
                }), this.call(this.containerOptions)
            },
            show: function (b) {
                this.$element.addClass("editable-open"), b !== !1 && this.closeOthers(this.$element[0]), this.$form = a("<div>"), this.renderForm();
                var c = a("<label>").text(this.options.title || this.$element.data("title") || this.$element.data("originalTitle")),
                    d = a("<div>").append(c).append(this.$form);
                this.call("update", d), this.call("show"), this.tip().addClass(this.containerClass), this.$form.data("editableform").input.activate()
            },
            innerHide: function () {
                this.call("hide")
            },
            innerDestroy: function () {
                this.call("destroy")
            },
            setPosition: function () {
                this.container().refresh(!1)
            },
            handlePlacement: function () {
                var b, c, d = 0,
                    e = 0;
                switch (this.options.placement) {
                    case "top":
                        b = "center", c = "top", e = 5;
                        break;
                    case "right":
                        b = "right", c = "center", d = 10;
                        break;
                    case "bottom":
                        b = "center", c = "bottom", e = 5;
                        break;
                    case "left":
                        b = "left", c = "center", d = 10
                }
                a.extend(this.containerOptions, {
                    alignX: b,
                    offsetX: d,
                    alignY: c,
                    offsetY: e
                })
            }
        }), a.fn.editableContainer.defaults = a.extend({}, a.fn.editableContainer.defaults, {
            className: "tip-yellowsimple"
        }), a.Poshytip) {
        var b = /^url\(["']?([^"'\)]*)["']?\);?$/i,
            c = /\.png$/i,
            d = !!window.createPopup && "undefined" == document.documentElement.currentStyle.minWidth;
        a.Poshytip.prototype.refresh = function (e) {
            if (!this.disabled) {
                var f;
                if (e) {
                    if (!this.$tip.data("active")) return;
                    f = {
                        left: this.$tip.css("left"),
                        top: this.$tip.css("top")
                    }
                }
                this.$tip.css({
                    left: 0,
                    top: 0
                }).appendTo(document.body), void 0 === this.opacity && (this.opacity = this.$tip.css("opacity"));
                var g = this.$tip.css("background-image").match(b),
                    h = this.$arrow.css("background-image").match(b);
                if (g) {
                    var i = c.test(g[1]);
                    d && i ? (this.$tip.css("background-image", "none"), this.$inner.css({
                        margin: 0,
                        border: 0,
                        padding: 0
                    }), g = i = !1) : this.$tip.prepend('<table class="fallback" border="0" cellpadding="0" cellspacing="0"><tr><td class="tip-top tip-bg-image" colspan="2"><span></span></td><td class="tip-right tip-bg-image" rowspan="2"><span></span></td></tr><tr><td class="tip-left tip-bg-image" rowspan="2"><span></span></td><td></td></tr><tr><td class="tip-bottom tip-bg-image" colspan="2"><span></span></td></tr></table>').css({
                        border: 0,
                        padding: 0,
                        "background-image": "none",
                        "background-color": "transparent"
                    }).find(".tip-bg-image").css("background-image", 'url("' + g[1] + '")').end().find("td").eq(3).append(this.$inner), i && !a.support.opacity && (this.opts.fade = !1)
                }
                h && !a.support.opacity && (d && c.test(h[1]) && (h = !1, this.$arrow.css("background-image", "none")), this.opts.fade = !1);
                var j = this.$tip.find("table.fallback");
                if (d) {
                    this.$tip[0].style.width = "", j.width("auto").find("td").eq(3).width("auto");
                    var k = this.$tip.width(),
                        l = parseInt(this.$tip.css("min-width"), 10),
                        m = parseInt(this.$tip.css("max-width"), 10);
                    !isNaN(l) && l > k ? k = l : !isNaN(m) && k > m && (k = m), this.$tip.add(j).width(k).eq(0).find("td").eq(3).width("100%")
                } else j[0] && j.width("auto").find("td").eq(3).width("auto").end().end().width(document.defaultView && document.defaultView.getComputedStyle && parseFloat(document.defaultView.getComputedStyle(this.$tip[0], null).width) || this.$tip.width()).find("td").eq(3).width("100%");
                if (this.tipOuterW = this.$tip.outerWidth(), this.tipOuterH = this.$tip.outerHeight(), this.calcPos(), h && this.pos.arrow && (this.$arrow[0].className = "tip-arrow tip-arrow-" + this.pos.arrow, this.$arrow.css("visibility", "inherit")), e) {
                    this.asyncAnimating = !0;
                    var n = this;
                    this.$tip.css(f).animate({
                        left: this.pos.l,
                        top: this.pos.t
                    }, 200, function () {
                        n.asyncAnimating = !1
                    })
                } else this.$tip.css({
                    left: this.pos.l,
                    top: this.pos.t
                })
            }
        }
    }
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("dateui", a, b.defaults), this.initPicker(a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.abstractinput), a.extend(b.prototype, {
        initPicker: function (b, c) {
            this.options.viewformat || (this.options.viewformat = this.options.format), this.options.viewformat = this.options.viewformat.replace("yyyy", "yy"), this.options.format = this.options.format.replace("yyyy", "yy"), this.options.datepicker = a.extend({}, c.datepicker, b.datepicker, {
                dateFormat: this.options.viewformat
            })
        },
        render: function () {
            this.$input.datepicker(this.options.datepicker), this.options.clear && (this.$clear = a('<a href="#"></a>').html(this.options.clear).click(a.proxy(function (a) {
                a.preventDefault(), a.stopPropagation(), this.clear()
            }, this)), this.$tpl.parent().append(a('<div class="editable-clear">').append(this.$clear)))
        },
        value2html: function (c, d) {
            var e = a.datepicker.formatDate(this.options.viewformat, c);
            b.superclass.value2html.call(this, e, d)
        },
        html2value: function (b) {
            if ("string" != typeof b) return b;
            var c;
            try {
                c = a.datepicker.parseDate(this.options.viewformat, b)
            } catch (d) {}
            return c
        },
        value2str: function (b) {
            return a.datepicker.formatDate(this.options.format, b)
        },
        str2value: function (b) {
            if ("string" != typeof b) return b;
            var c;
            try {
                c = a.datepicker.parseDate(this.options.format, b)
            } catch (d) {}
            return c
        },
        value2submit: function (a) {
            return this.value2str(a)
        },
        value2input: function (a) {
            this.$input.datepicker("setDate", a)
        },
        input2value: function () {
            return this.$input.datepicker("getDate")
        },
        activate: function () {},
        clear: function () {
            this.$input.datepicker("setDate", null)
        },
        autosubmit: function () {
            this.$input.on("mouseup", "table.ui-datepicker-calendar a.ui-state-default", function () {
                var b = a(this).closest("form");
                setTimeout(function () {
                    b.submit()
                }, 200)
            })
        }
    }), b.defaults = a.extend({}, a.fn.editabletypes.abstractinput.defaults, {
        tpl: '<div class="editable-date"></div>',
        inputclass: null,
        format: "yyyy-mm-dd",
        viewformat: null,
        datepicker: {
            firstDay: 0,
            changeYear: !0,
            changeMonth: !0,
            showOtherMonths: !0
        },
        clear: "&times; clear"
    }), a.fn.editabletypes.dateui = b
}(window.jQuery),
function (a) {
    "use strict";
    var b = function (a) {
        this.init("dateuifield", a, b.defaults), this.initPicker(a, b.defaults)
    };
    a.fn.editableutils.inherit(b, a.fn.editabletypes.dateui), a.extend(b.prototype, {
        render: function () {
            this.$input.datepicker(this.options.datepicker), a.fn.editabletypes.text.prototype.renderClear.call(this)
        },
        value2input: function (b) {
            this.$input.val(a.datepicker.formatDate(this.options.viewformat, b))
        },
        input2value: function () {
            return this.html2value(this.$input.val())
        },
        activate: function () {
            a.fn.editabletypes.text.prototype.activate.call(this)
        },
        toggleClear: function () {
            a.fn.editabletypes.text.prototype.toggleClear.call(this)
        },
        autosubmit: function () {}
    }), b.defaults = a.extend({}, a.fn.editabletypes.dateui.defaults, {
        tpl: '<input type="text"/>',
        inputclass: null,
        datepicker: {
            showOn: "button",
            buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
            buttonImageOnly: !0,
            firstDay: 0,
            changeYear: !0,
            changeMonth: !0,
            showOtherMonths: !0
        },
        clear: !1
    }), a.fn.editabletypes.dateuifield = b
}(window.jQuery);
