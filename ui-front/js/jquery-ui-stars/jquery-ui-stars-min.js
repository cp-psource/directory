/*!
 * jQuery UI Stars v3.0.1
 * http://plugins.jquery.com/project/Star_Rating_widget
 *
 * Copyright (c) 2010 Marek "Orkan" Zajac (orkans@gmail.com)
 * Dual licensed under the MIT and GPL licenses.
 * http://docs.jquery.com/License
 *
 * $Rev: 164 $
 * $Date:: 2010-05-01 #$
 * $Build: 35 (2010-05-01)
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *
 */
 !function(e){e.widget("ui.stars",{options:{inputType:"radio",split:0,disabled:!1,cancelTitle:"Cancel Rating",cancelValue:0,cancelShow:!0,disableValue:!0,oneVoteOnly:!1,showTitles:!1,captionEl:null,callback:null,starWidth:16,cancelClass:"ui-stars-cancel",starClass:"ui-stars-star",starOnClass:"ui-stars-star-on",starHoverClass:"ui-stars-star-hover",starDisabledClass:"ui-stars-star-disabled",cancelHoverClass:"ui-stars-cancel-hover",cancelDisabledClass:"ui-stars-cancel-disabled"},_create:function(){var s=this,a=this.options,t=0;function l(e,t){if(-1!=e){var l=t?a.starHoverClass:a.starOnClass,c=t?a.starOnClass:a.starHoverClass;s.$stars.eq(e).prevAll("."+a.starClass).addBack().removeClass(c).addClass(l),s.$stars.eq(e).nextAll("."+a.starClass).removeClass(a.starHoverClass+" "+a.starOnClass),s._showCap(a.id2title[e])}else i()}function i(){s.$stars.removeClass(a.starOnClass+" "+a.starHoverClass),s._showCap("")}this.element.data("former.stars",this.element.html()),a.isSelect="select"==a.inputType,this.$form=e(this.element).closest("form"),this.$selec=a.isSelect?e("select",this.element):null,this.$rboxs=a.isSelect?e("option",this.$selec):e(":radio",this.element),this.$stars=this.$rboxs.map((function(l){var i={value:this.value,title:(a.isSelect?this.text:this.title)||this.value,isDefault:a.isSelect&&this.defaultSelected||this.defaultChecked};if(0==l&&(a.split="number"!=typeof a.split?0:a.split,a.val2id=[],a.id2val=[],a.id2title=[],a.name=a.isSelect?s.$selec.get(0).name:this.name,a.disabled=a.disabled||(a.isSelect?e(s.$selec).attr("disabled"):e(this).attr("disabled"))),i.value==a.cancelValue)return a.cancelTitle=i.title,null;a.val2id[i.value]=t,a.id2val[t]=i.value,a.id2title[t]=i.title,i.isDefault&&(a.checked=t,a.value=a.defaultValue=i.value,a.title=i.title);var c=e("<div/>").addClass(a.starClass),n=e("<a/>").attr("title",a.showTitles?i.title:"").text(i.value);if(a.split){var r=t%a.split,o=Math.floor(a.starWidth/a.split);c.width(o),n.css("margin-left","-"+r*o+"px")}return t++,c.append(n).get(0)})),a.items=t,a.isSelect?this.$selec.remove():this.$rboxs.remove(),this.$cancel=e("<div/>").addClass(a.cancelClass).append(e("<a/>").attr("title",a.showTitles?a.cancelTitle:"").text(a.cancelValue)),a.cancelShow&=!a.disabled&&!a.oneVoteOnly,a.cancelShow&&this.element.append(this.$cancel),this.element.append(this.$stars),void 0===a.checked&&(a.checked=-1,a.value=a.defaultValue=a.cancelValue,a.title=""),this.$value=e("<input type='hidden' name='"+a.name+"' value='"+a.value+"' />"),this.element.append(this.$value),this.$stars.on("click.stars",(function(e){if(!a.forceSelect&&a.disabled)return!1;var t=s.$stars.index(this);a.checked=t,a.value=a.id2val[t],a.title=a.id2title[t],s.$value.attr({disabled:a.disabled?"disabled":"",value:a.value}),l(t,!1),s._disableCancel(),!a.forceSelect&&s.callback(e,"star")})).on("mouseover.stars",(function(){if(a.disabled)return!1;l(s.$stars.index(this),!0)})).on("mouseout.stars",(function(){if(a.disabled)return!1;l(s.options.checked,!1)})),this.$cancel.on("click.stars",(function(e){if(!a.forceSelect&&(a.disabled||a.value==a.cancelValue))return!1;a.checked=-1,a.value=a.cancelValue,a.title="",s.$value.val(a.value),a.disableValue&&s.$value.attr({disabled:"disabled"}),i(),s._disableCancel(),!a.forceSelect&&s.callback(e,"cancel")})).on("mouseover.stars",(function(){if(s._disableCancel())return!1;s.$cancel.addClass(a.cancelHoverClass),i(),s._showCap(a.cancelTitle)})).on("mouseout.stars",(function(){if(s._disableCancel())return!1;s.$cancel.removeClass(a.cancelHoverClass),s.$stars.triggerHandler("mouseout.stars")})),this.$form.on("reset.stars",(function(){!a.disabled&&s.on("select",a.defaultValue)})),e(window).on("unload",(function(){s.$cancel.off(".stars"),s.$stars.off(".stars"),s.$form.off(".stars"),s.$selec=s.$rboxs=s.$stars=s.$value=s.$cancel=s.$form=null})),this._trigger("select",null,{value:a.value}),a.disabled&&this.disable()},_disableCancel:function(){var e=this.options,s=e.disabled||e.oneVoteOnly||e.value==e.cancelValue;return s?this.$cancel.removeClass(e.cancelHoverClass).addClass(e.cancelDisabledClass):this.$cancel.removeClass(e.cancelDisabledClass),this.$cancel.css("opacity",s?.5:1),s},_disableAll:function(){var e=this.options;this._disableCancel(),e.disabled?this.$stars.filter("div").addClass(e.starDisabledClass):this.$stars.filter("div").removeClass(e.starDisabledClass)},_showCap:function(e){var s=this.options;s.captionEl&&s.captionEl.text(e)},value:function(){return this.options.value},select:function(e){var s=this.options,a=e==s.cancelValue?this.$cancel:this.$stars.eq(s.val2id[e]);s.forceSelect=!0,a.triggerHandler("click.stars"),s.forceSelect=!1},selectID:function(e){var s=this.options,a=-1==e?this.$cancel:this.$stars.eq(e);s.forceSelect=!0,a.triggerHandler("click.stars"),s.forceSelect=!1},enable:function(){this.options.disabled=!1,this._disableAll()},disable:function(){this.options.disabled=!0,this._disableAll()},destroy:function(){return this.$form.off(".stars"),this.$cancel.off(".stars").remove(),this.$stars.off(".stars").remove(),this.$value.remove(),this.element.off(".stars").html(this.element.data("former.stars")).removeData("stars"),this},callback:function(e,s){var a=this.options;a.callback&&a.callback(this,s,a.value,e),a.oneVoteOnly&&!a.disabled&&this.disable()}}),e.extend(e.ui.stars,{version:"3.0.1"})}(jQuery);