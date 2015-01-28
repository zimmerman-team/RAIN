/*!
 * Response   Responsive design toolkit
 * @link      http://responsejs.com
 * @author    Ryan Van Etten (c) 2011-2012
 * @license   MIT
 * @version   0.7.8
 * @requires  jQuery 1.7+
 *            -or- ender build jeesh (ender.jit.su)
 *            -or- zepto 0.8+ (zeptojs.com)
 */
!function(a,b,c){var d=a.jQuery||a.Zepto||a.ender||a.elo;"undefined"!=typeof module&&module.exports?module.exports=c(d):a[b]=c(d)}(this,"Response",function(a){function b(a){throw new TypeError(a?U+"."+a:U)}function c(a){return"number"==typeof a&&a===a}function d(a,b,c){var d,e=a.length,f=[];for(d=0;e>d;d++)f[d]=b.call(c,a[d],d,a);return f}function e(a){return"string"==typeof a?h(a.split(" ")):hb(a)?h(a):[]}function f(a,b,c){if(null==a)return a;for(var d=0,e=a.length;e>d;)b.call(c||a[d],a[d],d++,a);return a}function g(a,b,c){var d,e=[],f=a.length,g=0;for(b=b||"",c=c||"";f>g;)d=a[g++],null==d||e.push(b+d+c);return e}function h(a,b,c){var d,e,f,g=0,h=0,i=[],j="function"==typeof b;if(!a)return i;for(c=(f=!0===c)?null:c,d=a.length;d>h;h++)e=a[h],f===!(j?b.call(c,e,h,a):b?typeof e===b:e)&&(i[g++]=e);return i}function i(a,b){var d,e;if(!a||!b)return a;if("function"!=typeof b&&c(e=b.length)){for(d=0;e>d;d++)void 0===b[d]||(a[d]=b[d]);a.length>d||(a.length=d)}else for(d in b)gb.call(b,d)&&void 0!==b[d]&&(a[d]=b[d]);return a}function j(a,b,d){return null==a?a:("object"==typeof a&&!a.nodeType&&c(a.length)?f(a,b,d):b.call(d||a,a),a)}function k(a){return function(b,c){var d=a();return b=d>=(b||0),c?b&&c>=d:b}}function l(a){var b=X.devicePixelRatio;return null==a?b||(l(2)?2:l(1.5)?1.5:l(1)?1:0):isFinite(a)?b&&b>0?b>=a:(a="only all and (min--moz-device-pixel-ratio:"+a+")",Db(a).matches?!0:!!Db(a.replace("-moz-","")).matches):!1}function m(a){return a.replace(yb,"$1").replace(xb,function(a,b){return b.toUpperCase()})}function n(a){return"data-"+(a?a.replace(yb,"$1").replace(wb,"$1-$2").toLowerCase():a)}function o(a){var b;return a&&"string"==typeof a?"true"===a?!0:"false"===a?!1:"undefined"===a?b:"null"===a?null:(b=parseFloat(a))===+b?b:a:a}function p(a){return a?1===a.nodeType?a:a[0]&&1===a[0].nodeType?a[0]:!1:!1}function q(a,b){var c,d=arguments.length,e=p(this),g={},h=!1;if(d){if(hb(a)&&(h=!0,a=a[0]),"string"==typeof a){if(a=n(a),1===d)return g=e.getAttribute(a),h?o(g):g;if(this===e||2>(c=this.length||1))e.setAttribute(a,b);else for(;c--;)c in this&&q.apply(this[c],arguments)}else if(a instanceof Object)for(c in a)a.hasOwnProperty(c)&&q.call(this,c,a[c]);return this}return e.dataset&&DOMStringMap?e.dataset:(f(e.attributes,function(a){a&&(c=String(a.name).match(yb))&&(g[m(c[1])]=a.value)}),g)}function r(a){return this&&"string"==typeof a&&(a=e(a),j(this,function(b){f(a,function(a){a&&b.removeAttribute(n(a))})})),this}function s(a){return q.apply(a,db.call(arguments,1))}function t(a,b){return r.call(a,b)}function u(a){for(var b,c=[],d=0,e=a.length;e>d;)(b=a[d++])&&c.push("["+n(b.replace(vb,"").replace(".","\\."))+"]");return c.join()}function v(b){return a(u(e(b)))}function w(){return window.pageXOffset||Z.scrollLeft}function x(){return window.pageYOffset||Z.scrollTop}function y(a,b){var c=a.getBoundingClientRect?a.getBoundingClientRect():{};return b="number"==typeof b?b||0:0,{top:(c.top||0)-b,left:(c.left||0)-b,bottom:(c.bottom||0)+b,right:(c.right||0)+b}}function z(a,b){var c=y(p(a),b);return!!c&&c.right>=0&&c.left<=Eb()}function A(a,b){var c=y(p(a),b);return!!c&&c.bottom>=0&&c.top<=Fb()}function B(a,b){var c=y(p(a),b);return!!c&&c.bottom>=0&&c.top<=Fb()&&c.right>=0&&c.left<=Eb()}function C(a){var b={img:1,input:1,source:3,embed:3,track:3,iframe:5,audio:5,video:5,script:5},c=b[a.nodeName.toLowerCase()]||-1;return 4>c?c:null!=a.getAttribute("src")?5:-5}function D(a,c,d){var e;return a&&null!=c||b("store"),d="string"==typeof d&&d,j(a,function(a){e=d?a.getAttribute(d):0<C(a)?a.getAttribute("src"):a.innerHTML,null==e?t(a,c):s(a,c,e)}),P}function E(a,b){var c=[];return a&&b&&f(e(b),function(b){c.push(s(a,b))},a),c}function F(a,b){return"string"==typeof a&&"function"==typeof b&&(kb[a]=b,lb[a]=1),P}function G(a){return _.on("resize",a),P}function H(a,b){var c,d,e=Bb.crossover;return"function"==typeof a&&(c=b,b=a,a=c),d=a?""+a+e:e,_.on(d,b),P}function I(a){return j(a,function(a){$(a),G(a)}),P}function J(a){return j(a,function(a){"object"==typeof a||b("create @args");var c,d=zb(Q).configure(a),e=d.verge,g=d.breakpoints,h=Ab("scroll"),i=Ab("resize");g.length&&(c=g[0]||g[1]||!1,$(function(){function a(){d.reset(),f(d.$e,function(a,b){d[b].decideValue().updateDOM()}).trigger(g)}function b(){f(d.$e,function(a,b){B(d[b].$e,e)&&d[b].updateDOM()})}var g=Bb.allLoaded,j=!!d.lazy;f(d.target().$e,function(a,b){d[b]=zb(d).prepareData(a),(!j||B(d[b].$e,e))&&d[b].updateDOM()}),d.dynamic&&(d.custom||qb>c)&&G(a,i),j&&(_.on(h,b),d.$e.one(g,function(){_.off(h,b)}))}))}),P}function K(a){return T[U]===P&&(T[U]=V),"function"==typeof a&&a.call(T,P),P}function L(a,b,c){f(["inX","inY","inViewport"],function(d){(c||!b[d])&&(b[d]=function(b,c){return a(h(this,function(a){return!!a&&!c===P[d](a,b)}))})})}function M(a,b){return"function"==typeof a&&a.fn&&((b||void 0===a.fn.dataset)&&(a.fn.dataset=q),(b||void 0===a.fn.deletes)&&(a.fn.deletes=r),L(a,a.fn,b)),P}function N(b,c){return b=arguments.length?b:a,M(b,c)}if("function"!=typeof a)try{console.log("Response was unable to run due to missing dependency.")}catch(O){}var P,Q,R,S,T=this,U="Response",V=T[U],W="init"+U,X=window,Y=document,Z=Y.documentElement,$=a.domReady||a,_=a(X),ab=X.screen,bb=Array.prototype,cb=Object.prototype,db=bb.slice,eb=bb.concat,fb=cb.toString,gb=cb.hasOwnProperty,hb=Array.isArray||function(a){return"[object Array]"===fb.call(a)},ib={width:[0,320,481,641,961,1025,1281],height:[0,481],ratio:[1,1.5,2]},jb={},kb={},lb={},mb={all:[]},nb=1,ob=ab.width,pb=ab.height,qb=ob>pb?ob:pb,rb=ob+pb-qb,sb=function(){return ob},tb=function(){return pb},ub=/[^a-z0-9_\-\.]/gi,vb=/^[\W\s]+|[\W\s]+$|/g,wb=/([a-z])([A-Z])/g,xb=/-(.)/g,yb=/^data-(.+)$/,zb=Object.create||function(a){function b(){}return b.prototype=a,new b},Ab=function(a,b){return b=b||U,a.replace(vb,"")+"."+b.replace(vb,"")},Bb={allLoaded:Ab("allLoaded"),crossover:Ab("crossover")},Cb=X.matchMedia||X.msMatchMedia,Db=Cb||function(){return{}},Eb=function(a,b,c){var d=b.clientWidth,e=a.innerWidth;return c&&e>d&&!0===c("(min-width:"+e+"px)").matches?function(){return a.innerWidth}:function(){return b.clientWidth}}(X,Z,Cb),Fb=function(a,b,c){var d=b.clientHeight,e=a.innerHeight;return c&&e>d&&!0===c("(min-height:"+e+"px)").matches?function(){return a.innerHeight}:function(){return b.clientHeight}}(X,Z,Cb);return R=k(Eb),S=k(Fb),jb.band=k(sb),jb.wave=k(tb),Q=function(){function c(a){return"string"==typeof a?a.toLowerCase().replace(ub,""):""}var j=Bb.crossover,k=Math.min;return{$e:0,mode:0,breakpoints:null,prefix:null,prop:"width",keys:[],dynamic:null,custom:0,values:[],fn:0,verge:null,newValue:0,currValue:1,aka:null,lazy:null,i:0,uid:null,reset:function(){for(var a=this.breakpoints,b=a.length,c=0;!c&&b--;)this.fn(a[b])&&(c=b);return c!==this.i&&(_.trigger(j).trigger(this.prop+j),this.i=c||0),this},configure:function(a){i(this,a);var j,l,m,n,o,p=!0,q=this.prop;if(this.uid=nb++,this.verge=isFinite(this.verge)?this.verge:k(qb,500),this.fn=kb[q]||b("create @fn"),"boolean"!=typeof this.dynamic&&(this.dynamic=!("device"===q.substring(0,6))),this.custom=lb[q],l=this.prefix?h(d(e(this.prefix),c)):["min-"+q+"-"],m=1<l.length?l.slice(1):0,this.prefix=l[0],o=this.breakpoints,hb(o)?(f(o,function(a){if(!a&&0!==a)throw"invalid breakpoint";p=p&&isFinite(a)}),o=p?o.sort(function(a,b){return a-b}):o,o.length||b("create @breakpoints")):o=ib[q]||ib[q.split("-").pop()]||b("create @prop"),this.breakpoints=p?h(o,function(a){return qb>=a}):o,this.keys=g(this.breakpoints,this.prefix),this.aka=null,m){for(n=[],j=m.length;j--;)n.push(g(this.breakpoints,m[j]));this.aka=n,this.keys=eb.apply(this.keys,n)}return mb.all=mb.all.concat(mb[this.uid]=this.keys),this},target:function(){return this.$e=a(u(mb[this.uid])),D(this.$e,W),this.keys.push(W),this},decideValue:function(){for(var a=null,b=this.breakpoints,c=b.length,d=c;null==a&&d--;)this.fn(b[d])&&(a=this.values[d]);return this.newValue="string"==typeof a?a:this.values[c],this},prepareData:function(b){if(this.$e=a(b),this.mode=C(b),this.values=E(this.$e,this.keys),this.aka)for(var c=this.aka.length;c--;)this.values=i(this.values,E(this.$e,this.aka[c]));return this.decideValue()},updateDOM:function(){return this.currValue===this.newValue?this:(this.currValue=this.newValue,0<this.mode?this.$e[0].setAttribute("src",this.newValue):null==this.newValue?this.$e.empty&&this.$e.empty():this.$e.html?this.$e.html(this.newValue):(this.$e.empty&&this.$e.empty(),this.$e[0].innerHTML=this.newValue),this)}}}(),kb.width=R,kb.height=S,kb["device-width"]=jb.band,kb["device-height"]=jb.wave,kb["device-pixel-ratio"]=l,P={deviceMin:function(){return rb},deviceMax:function(){return qb},noConflict:K,chain:N,bridge:M,create:J,addTest:F,datatize:n,camelize:m,render:o,store:D,access:E,target:v,object:zb,crossover:H,action:I,resize:G,ready:$,affix:g,sift:h,dpr:l,deletes:t,scrollX:w,scrollY:x,deviceW:sb,deviceH:tb,device:jb,inX:z,inY:A,route:j,merge:i,media:Db,wave:S,band:R,map:d,each:f,inViewport:B,dataset:s,viewportH:Fb,viewportW:Eb},$(function(){var b,c=s(Y.body,"responsejs");c&&(b=!!X.JSON&&JSON.parse,b?c=b(c):a.parseJSON&&(c=a.parseJSON(c)),c&&c.create&&J(c.create)),Z.className=Z.className.replace(/(^|\s)(no-)?responsejs(\s|$)/,"$1$3")+" responsejs "}),P});