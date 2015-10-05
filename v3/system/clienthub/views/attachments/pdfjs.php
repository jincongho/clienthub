<!DOCTYPE html>
<!--
Copyright 2012 Mozilla Foundation

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
-->
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?=$title; ?></title>
    <base href="<?=base_url('/assets/pdfjs/web')."/"; ?>" />

<!--#if FIREFOX || MOZCENTRAL-->
<!--#include viewer-snippet-firefox-extension.html-->
<!--#endif-->

    <link rel="stylesheet" href="viewer.css"/>

<!--#if !(FIREFOX || MOZCENTRAL || CHROME)-->
    <script type="text/javascript" src="compatibility.js"></script>
<!--#endif-->

<!--#if !PRODUCTION-->
    <script type="text/javascript" src="../external/webL10n/l10n.js"></script>
<!--#endif-->

<!--#if !PRODUCTION-->
    <script type="text/javascript" src="../src/core.js"></script>
    <script type="text/javascript" src="../src/util.js"></script>
    <script type="text/javascript" src="../src/api.js"></script>
    <script type="text/javascript" src="../src/metadata.js"></script>
    <script type="text/javascript" src="../src/canvas.js"></script>
    <script type="text/javascript" src="../src/obj.js"></script>
    <script type="text/javascript" src="../src/function.js"></script>
    <script type="text/javascript" src="../src/charsets.js"></script>
    <script type="text/javascript" src="../src/cidmaps.js"></script>
    <script type="text/javascript" src="../src/colorspace.js"></script>
    <script type="text/javascript" src="../src/crypto.js"></script>
    <script type="text/javascript" src="../src/evaluator.js"></script>
    <script type="text/javascript" src="../src/fonts.js"></script>
    <script type="text/javascript" src="../src/glyphlist.js"></script>
    <script type="text/javascript" src="../src/image.js"></script>
    <script type="text/javascript" src="../src/metrics.js"></script>
    <script type="text/javascript" src="../src/parser.js"></script>
    <script type="text/javascript" src="../src/pattern.js"></script>
    <script type="text/javascript" src="../src/stream.js"></script>
    <script type="text/javascript" src="../src/worker.js"></script>
    <script type="text/javascript" src="../external/jpgjs/jpg.js"></script>
    <script type="text/javascript" src="../src/jpx.js"></script>
    <script type="text/javascript" src="../src/jbig2.js"></script>
    <script type="text/javascript" src="../src/bidi.js"></script>
    <script type="text/javascript">PDFJS.workerSrc = '../src/worker_loader.js';</script>
<!--#endif-->

<!--#if GENERIC || CHROME-->
<!--#include viewer-snippet.html-->
<!--#endif-->

<!--#if B2G-->
<!--#include viewer-snippet-b2g.html-->
<!--#endif-->

    <script type="text/javascript" src="debugger.js"></script>
    <script type="text/javascript">
    /* -*- Mode: Java; tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */
    /* vim: set shiftwidth=2 tabstop=2 autoindent cindent expandtab: */
    /* Copyright 2012 Mozilla Foundation
     *
     * Licensed under the Apache License, Version 2.0 (the "License");
     * you may not use this file except in compliance with the License.
     * You may obtain a copy of the License at
     *
     *     http://www.apache.org/licenses/LICENSE-2.0
     *
     * Unless required by applicable law or agreed to in writing, software
     * distributed under the License is distributed on an "AS IS" BASIS,
     * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
     * See the License for the specific language governing permissions and
     * limitations under the License.
     */
     "use strict";function getFileName(e){var t=e.indexOf("#"),n=e.indexOf("?"),r=Math.min(t>0?t:e.length,n>0?n:e.length);return e.substring(e.lastIndexOf("/",r)+1,r)}function scrollIntoView(e,t){var n=e.offsetParent,r=e.offsetTop;while(n.clientHeight==n.scrollHeight){r+=n.offsetTop,n=n.offsetParent;if(!n)return}t&&(r+=t.top),n.scrollTop=r}function updateViewarea(){if(!PDFView.initialized)return;var e=PDFView.getVisiblePages(),t=e.views;PDFView.renderHighestPriority();var n=PDFView.page,r=e.first;for(var i=0,s=t.length,o=!1;i<s;++i){var u=t[i];if(u.percent<100)break;if(u.id===PDFView.page){o=!0;break}}o||(n=t[0].id),PDFView.isFullscreen||(updateViewarea.inProgress=!0,PDFView.page=n,updateViewarea.inProgress=!1);var a=PDFView.currentScale,f=PDFView.currentScaleValue,l=f==a?a*100:f,c=r.id,h="#page="+c;h+="&zoom="+l;var p=PDFView.pages[c-1],d=p.getPagePoint(PDFView.container.scrollLeft,PDFView.container.scrollTop-r.y);h+=","+Math.round(d[0])+","+Math.round(d[1]);var v=PDFView.store;v.set("exists",!0),v.set("page",c),v.set("zoom",l),v.set("scrollLeft",Math.round(d[0])),v.set("scrollTop",Math.round(d[1]));var m=PDFView.getAnchorUrl(h);document.getElementById("viewBookmark").href=m}function selectScaleOption(e){var t=document.getElementById("scaleSelect").options,n=!1;for(var r=0;r<t.length;r++){var i=t[r];if(i.value!=e){i.selected=!1;continue}i.selected=!0,n=!0}return n}var kDefaultURL="<?=$fileurl; ?>",kDefaultScale="auto",kDefaultScaleDelta=1.1,kUnknownScale=0,kCacheSize=20,kCssUnits=96/72,kScrollbarPadding=40,kMinScale=.25,kMaxScale=4,kImageDirectory='<?=base_url("assets/pdfjs")?>/images/web/',kSettingsMemory=20,RenderingStates={INITIAL:0,RUNNING:1,PAUSED:2,FINISHED:3},mozL10n=document.mozL10n||document.webL10n,Cache=function(t){var n=[];this.push=function(r){var i=n.indexOf(r);i>=0&&n.splice(i),n.push(r),n.length>t&&n.shift().destroy()}},ProgressBar=function(){function t(e,t,n){return Math.min(Math.max(e,t),n)}function n(e,t){this.div=document.querySelector(e+" .progress"),this.height=t.height||100,this.width=t.width||100,this.units=t.units||"%",this.div.style.height=this.height+this.units}return n.prototype={updateBar:function(){if(this._indeterminate){this.div.classList.add("indeterminate");return}var t=this.width*this._percent/100;this._percent>95?this.div.classList.add("full"):this.div.classList.remove("full"),this.div.classList.remove("indeterminate"),this.div.style.width=t+this.units},get percent(){return this._percent},set percent(e){this._indeterminate=isNaN(e),this._percent=t(e,0,100),this.updateBar()}},n}(),Settings=function(){function n(e){var n=null,r;if(!t)return;n=localStorage.getItem("database")||"{}",n=JSON.parse(n),"files"in n||(n.files=[]),n.files.length>=kSettingsMemory&&n.files.shift();for(var i=0,s=n.files.length;i<s;i++){var o=n.files[i];if(o.fingerprint==e){r=i;break}}typeof r!="number"&&(r=n.files.push({fingerprint:e})-1),this.file=n.files[r],this.database=n}var t=function(){try{return"localStorage"in window&&window.localStorage!==null&&localStorage}catch(t){return!1}}();return n.prototype={set:function(n,r){if(!("file"in this))return!1;var i=this.file;i[n]=r;var s=JSON.stringify(this.database);t&&localStorage.setItem("database",s)},get:function(t,n){return"file"in this?this.file[t]||n:n}},n}(),cache=new Cache(kCacheSize),currentPageNumber=1,PDFView={pages:[],thumbnails:[],currentScale:kUnknownScale,currentScaleValue:null,initialBookmark:document.location.hash.substring(1),startedTextExtraction:!1,pageText:[],container:null,thumbnailContainer:null,initialized:!1,fellback:!1,pdfDocument:null,sidebarOpen:!1,pageViewScroll:null,thumbnailViewScroll:null,isFullscreen:!1,previousScale:null,pageRotation:0,initialize:function(){var t=this.container=document.getElementById("viewerContainer");this.pageViewScroll={},this.watchScroll(t,this.pageViewScroll,updateViewarea);var n=this.thumbnailContainer=document.getElementById("thumbnailView");this.thumbnailViewScroll={},this.watchScroll(n,this.thumbnailViewScroll,this.renderHighestPriority.bind(this)),this.initialized=!0},watchScroll:function(t,n,r){n.down=!0,n.lastY=t.scrollTop,t.addEventListener("scroll",function(i){var s=t.scrollTop,o=n.lastY;s>o?n.down=!0:s<o&&(n.down=!1),n.lastY=s,r()},!0)},setScale:function(t,n,r){if(t==this.currentScale)return;var i=this.pages;for(var s=0;s<i.length;s++)i[s].update(t*kCssUnits);!r&&this.currentScale!=t&&this.pages[this.page-1].scrollIntoView(),this.currentScale=t;var o=document.createEvent("UIEvents");o.initUIEvent("scalechange",!1,!1,window,0),o.scale=t,o.resetAutoSettings=n,window.dispatchEvent(o)},parseScale:function(t,n,r){if("custom"==t)return;var i=parseFloat(t);this.currentScaleValue=t;if(i){this.setScale(i,!0,r);return}var s=this.container,o=this.pages[this.page-1],u=(s.clientWidth-kScrollbarPadding)/o.width*o.scale/kCssUnits,a=(s.clientHeight-kScrollbarPadding)/o.height*o.scale/kCssUnits;switch(t){case"page-actual":i=1;break;case"page-width":i=u;break;case"page-height":i=a;break;case"page-fit":i=Math.min(u,a);break;case"auto":i=Math.min(1,u)}this.setScale(i,n,r),selectScaleOption(t)},zoomIn:function(){var t=(this.currentScale*kDefaultScaleDelta).toFixed(2);t=Math.min(kMaxScale,t),this.parseScale(t,!0)},zoomOut:function(){var t=(this.currentScale/kDefaultScaleDelta).toFixed(2);t=Math.max(kMinScale,t),this.parseScale(t,!0)},set page(e){var t=this.pages,n=document.getElementById("pageNumber"),r=document.createEvent("UIEvents");r.initUIEvent("pagechange",!1,!1,window,0);if(!(0<e&&e<=t.length)){r.pageNumber=this.page,window.dispatchEvent(r);return}t[e-1].updateStats(),currentPageNumber=e,r.pageNumber=e,window.dispatchEvent(r);if(updateViewarea.inProgress)return;if(this.loading&&e==1)return;t[e-1].scrollIntoView()},get page(){return currentPageNumber},get supportsPrinting(){var e=document.createElement("canvas"),t="mozPrintCallback"in e;return Object.defineProperty(this,"supportsPrinting",{value:t,enumerable:!0,configurable:!0,writable:!1}),t},get supportsFullscreen(){var e=document.documentElement,t=e.requestFullScreen||e.mozRequestFullScreen||e.webkitRequestFullScreen;return Object.defineProperty(this,"supportsFullScreen",{value:t,enumerable:!0,configurable:!0,writable:!1}),t},initPassiveLoading:function(){PDFView.loadingBar||(PDFView.loadingBar=new ProgressBar("#loadingBar",{})),window.addEventListener("message",function(t){var n=t.data;if(!(typeof n=="object"&&"pdfjsLoadAction"in n))return;switch(n.pdfjsLoadAction){case"progress":PDFView.progress(n.loaded/n.total);break;case"complete":if(!n.data){PDFView.error(mozL10n.get("loading_error",null,"An error occurred while loading the PDF."),t);break}PDFView.open(n.data,0)}}),FirefoxCom.requestSync("initPassiveLoading",null)},setTitleUsingUrl:function(t){this.url=t;try{document.title=decodeURIComponent(getFileName(t))||t}catch(n){document.title=t}},open:function(t,n,r){var i={password:r};typeof t=="string"?(this.setTitleUsingUrl(t),i.url=t):t&&"byteLength"in t&&(i.data=t),PDFView.loadingBar||(PDFView.loadingBar=new ProgressBar("#loadingBar",{})),this.pdfDocument=null;var s=this;s.loading=!0,PDFJS.getDocument(i).then(function(t){s.load(t,n),s.loading=!1},function(i,o){if(o&&o.name==="PasswordException"&&o.code==="needpassword"){var u=mozL10n.get("request_password",null,"PDF is protected by a password:");r=prompt(u);if(r&&r.length>0)return PDFView.open(t,n,r)}var a=document.getElementById("loading");a.textContent=mozL10n.get("loading_error_indicator",null,"Error");var f={message:i};s.error(mozL10n.get("loading_error",null,"An error occurred while loading the PDF."),f),s.loading=!1},function(t){s.progress(t.loaded/t.total)})},download:function(){function t(){FirefoxCom.request("download",{originalUrl:n})}var n=this.url.split("#")[0];n+="#pdfjs.action=download",window.open(n,"_parent")},fallback:function(){},navigateTo:function(t){typeof t=="string"&&(t=this.destinations[t]);if(!(t instanceof Array))return;var n=t[0],r=n instanceof Object?this.pagesRefMap[n.num+" "+n.gen+" R"]:n+1;r>this.pages.length&&(r=this.pages.length);if(r){this.page=r;var i=this.pages[r-1];i.scrollIntoView(t)}},getDestinationHash:function(t){if(typeof t=="string")return PDFView.getAnchorUrl("#"+escape(t));if(t instanceof Array){var n=t[0],r=n instanceof Object?this.pagesRefMap[n.num+" "+n.gen+" R"]:n+1;if(r){var i=PDFView.getAnchorUrl("#page="+r),s=t[1];if(typeof s=="object"&&"name"in s&&s.name=="XYZ"){var o=t[4]||this.currentScale;i+="&zoom="+o*100;if(t[2]||t[3])i+=","+(t[2]||0)+","+(t[3]||0)}return i}}return""},getAnchorUrl:function(t){return t},error:function(t,n){var r=mozL10n.get("error_build",{build:PDFJS.build},"PDF.JS Build: {{build}}")+"\n";n&&(r+=mozL10n.get("error_message",{message:n.message},"Message: {{message}}"),n.stack?r+="\n"+mozL10n.get("error_stack",{stack:n.stack},"Stack: {{stack}}"):(n.filename&&(r+="\n"+mozL10n.get("error_file",{file:n.filename},"File: {{file}}")),n.lineNumber&&(r+="\n"+mozL10n.get("error_line",{line:n.lineNumber},"Line: {{line}}"))));var i=document.getElementById("loadingBox");i.setAttribute("hidden","true");var s=document.getElementById("errorWrapper");s.removeAttribute("hidden");var o=document.getElementById("errorMessage");o.textContent=t;var u=document.getElementById("errorClose");u.onclick=function(){s.setAttribute("hidden","true")};var a=document.getElementById("errorMoreInfo"),f=document.getElementById("errorShowMore"),l=document.getElementById("errorShowLess");f.onclick=function(){a.removeAttribute("hidden"),f.setAttribute("hidden","true"),l.removeAttribute("hidden")},l.onclick=function(){a.setAttribute("hidden","true"),f.removeAttribute("hidden"),l.setAttribute("hidden","true")},f.removeAttribute("hidden"),l.setAttribute("hidden","true"),a.value=r,a.rows=r.split("\n").length-1},progress:function(t){var n=Math.round(t*100);PDFView.loadingBar.percent=n},load:function(t,n){function r(e,t){e.onAfterDraw=function(){t.setImage(e.canvas)}}this.pdfDocument=t;var i=document.getElementById("errorWrapper");i.setAttribute("hidden","true");var s=document.getElementById("loadingBox");s.setAttribute("hidden","true");var o=document.getElementById("loading");o.textContent="";var u=document.getElementById("thumbnailView");u.parentNode.scrollTop=0;while(u.hasChildNodes())u.removeChild(u.lastChild);"_loadingInterval"in u&&clearInterval(u._loadingInterval);var a=document.getElementById("viewer");while(a.hasChildNodes())a.removeChild(a.lastChild);var f=t.numPages,l=t.fingerprint,c=null;document.getElementById("numPages").textContent=mozL10n.get("page_of",{pageCount:f},"of {{pageCount}}"),document.getElementById("pageNumber").max=f,PDFView.documentFingerprint=l;var h=PDFView.store=new Settings(l);if(h.get("exists",!1)){var p=h.get("page","1"),d=h.get("zoom",PDFView.currentScale),v=h.get("scrollLeft","0"),m=h.get("scrollTop","0");c="page="+p+"&zoom="+d+","+v+","+m}this.pageRotation=0;var g=this.pages=[];this.pageText=[],this.startedTextExtraction=!1;var y={},b=this.thumbnails=[],w=[];for(var E=1;E<=f;E++)w.push(t.getPage(E));var S=this,x=PDFJS.Promise.all(w);x.then(function(e){for(var t=1;t<=f;t++){var i=e[t-1],s=new PageView(a,i,t,n,i.stats,S.navigateTo.bind(S)),o=new ThumbnailView(u,i,t);r(s,o),g.push(s),b.push(o);var l=i.ref;y[l.num+" "+l.gen+" R"]=t}S.pagesRefMap=y});var T=t.getDestinations();T.then(function(e){S.destinations=e}),PDFJS.Promise.all([x,T]).then(function(){t.getOutline().then(function(e){S.outline=new DocumentOutlineView(e)}),S.setInitialView(c,n)}),t.getMetadata().then(function(e){var t=e.info,n=e.metadata;S.documentInfo=t,S.metadata=n;var r;n&&n.has("dc:title")&&(r=n.get("dc:title")),!r&&t&&t.Title&&(r=t.Title),r&&(document.title=r+" - "+document.title)})},setInitialView:function(t,n){this.currentScale=0,this.currentScaleValue=null,this.initialBookmark?(this.setHash(this.initialBookmark),this.initialBookmark=null):t?this.setHash(t):n&&(this.parseScale(n,!0),this.page=1),PDFView.currentScale===kUnknownScale&&this.parseScale(kDefaultScale,!0)},renderHighestPriority:function(){var t=this.getVisiblePages(),n=this.getHighestPriority(t,this.pages,this.pageViewScroll.down);if(n){this.renderView(n,"page");return}if(this.sidebarOpen){var r=this.getVisibleThumbs(),i=this.getHighestPriority(r,this.thumbnails,this.thumbnailViewScroll.down);i&&this.renderView(i,"thumbnail")}},getHighestPriority:function(t,n,r){var i=t.views,s=i.length;if(s===0)return!1;for(var o=0;o<s;++o){var u=i[o].view;if(!this.isViewFinished(u))return u}if(r){var a=t.last.id;if(n[a]&&!this.isViewFinished(n[a]))return n[a]}else{var f=t.first.id-2;if(n[f]&&!this.isViewFinished(n[f]))return n[f]}return!1},isViewFinished:function(t){return t.renderingState===RenderingStates.FINISHED},renderView:function(t,n){var r=t.renderingState;switch(r){case RenderingStates.FINISHED:return!1;case RenderingStates.PAUSED:PDFView.highestPriorityPage=n+t.id,t.resume();break;case RenderingStates.RUNNING:PDFView.highestPriorityPage=n+t.id;break;case RenderingStates.INITIAL:PDFView.highestPriorityPage=n+t.id,t.draw(this.renderHighestPriority.bind(this))}return!0},search:function(){function i(e,t){e.href="#"+t,e.onclick=function(){return PDFView.page=t,!1}}var t=250,n=this.lastSearch,r=Date.now();if(n&&r-n<t){this.searchTimer||(this.searchTimer=setTimeout(function(){PDFView.search()},t-(r-n)));return}this.searchTimer=null,this.lastSearch=r;var s=document.getElementById("searchResults"),o=document.getElementById("searchTermsInput");s.removeAttribute("hidden"),s.textContent="";var u=o.value;if(!u)return;u=u.replace(/\s-/g,"").toLowerCase();var a=PDFView.pageText,f=!1;for(var l=0,c=a.length;l<c;l++){var h=a[l].replace(/\s-/g,"").toLowerCase(),p=h.indexOf(u);if(p<0)continue;var d=l+1,v=a[l].substr(p,50),m=document.createElement("a");i(m,d),m.textContent="Page "+d+": "+v,s.appendChild(m),f=!0}if(!f){s.textContent="";var g=document.createElement("div");g.classList.add("noResults"),g.textContent=mozL10n.get("search_terms_not_found",null,"(Not found)"),s.appendChild(g)}},setHash:function(t){if(!t)return;if(t.indexOf("=")>=0){var n=PDFView.parseQueryString(t);if("nameddest"in n){PDFView.navigateTo(n.nameddest);return}if("page"in n){var r=n.page|0||1;if("zoom"in n){var i=n.zoom.split(","),s=i[0],o=parseFloat(s);o&&(s=o/100);var u=[null,{name:"XYZ"},i[1]|0,i[2]|0,s],a=this.pages[r-1];a.scrollIntoView(u)}else this.page=r}}else/^\d+$/.test(t)?this.page=t:PDFView.navigateTo(unescape(t))},switchSidebarView:function(t){var n=document.getElementById("thumbnailView"),r=document.getElementById("outlineView"),i=document.getElementById("searchView"),s=document.getElementById("viewThumbnail"),o=document.getElementById("viewOutline"),u=document.getElementById("viewSearch");switch(t){case"thumbs":s.classList.add("toggled"),o.classList.remove("toggled"),u.classList.remove("toggled"),n.classList.remove("hidden"),r.classList.add("hidden"),i.classList.add("hidden"),PDFView.renderHighestPriority();break;case"outline":s.classList.remove("toggled"),o.classList.add("toggled"),u.classList.remove("toggled"),n.classList.add("hidden"),r.classList.remove("hidden"),i.classList.add("hidden");if(o.getAttribute("disabled"))return;break;case"search":s.classList.remove("toggled"),o.classList.remove("toggled"),u.classList.add("toggled"),n.classList.add("hidden"),r.classList.add("hidden"),i.classList.remove("hidden");var a=document.getElementById("searchTermsInput");a.focus(),this.extractText()}},extractText:function(){function t(n){e.pages[n].pdfPage.getTextContent().then(function(i){e.pageText[n]=i,e.search(),n+1<e.pages.length&&t(n+1)})}if(this.startedTextExtraction)return;this.startedTextExtraction=!0;var e=this;t(0)},getVisiblePages:function(){return this.getVisibleElements(this.container,this.pages,!0)},getVisibleThumbs:function(){return this.getVisibleElements(this.thumbnailContainer,this.thumbnails)},getVisibleElements:function(t,n,r){var i=0,s,o=t.scrollTop;for(var u=1,a=n.length;u<=a;++u){s=n[u-1],i=s.el.offsetTop;if(i+s.el.clientHeight>o)break;i+=s.el.clientHeight}var f=[];if(this.isFullscreen){var l=this.pages[this.page-1];return f.push({id:l.id,view:l}),{first:l,last:l,views:f}}var c=o+t.clientHeight,h,p,d,v;for(;u<=a&&i<c;++u)s=n[u-1],v=s.el.clientHeight,i=s.el.offsetTop,h=i+v,p=Math.max(0,o-i)+Math.max(0,h-c),d=Math.floor((v-p)*100/v),f.push({id:s.id,y:i,view:s,percent:d}),i=h;var m=f[0],g=f[f.length-1];return r&&f.sort(function(e,t){var n=e.percent-t.percent;return Math.abs(n)>.001?-n:e.id-t.id}),{first:m,last:g,views:f}},parseQueryString:function(t){var n=t.split("&"),r={};for(var i=0,s=n.length;i<n.length;++i){var o=n[i].split("="),u=o[0],a=o.length>1?o[1]:null;r[unescape(u)]=unescape(a)}return r},beforePrint:function(){if(!this.supportsPrinting){var t=mozL10n.get("printing_not_supported",null,"Warning: Printing is not fully supported by this browser.");this.error(t);return}var n=document.querySelector("body");n.setAttribute("data-mozPrintCallback",!0);for(var r=0,i=this.pages.length;r<i;++r)this.pages[r].beforePrint()},afterPrint:function(){var t=document.getElementById("printContainer");while(t.hasChildNodes())t.removeChild(t.lastChild)},fullscreen:function(){var t=document.fullscreen||document.mozFullScreen||document.webkitIsFullScreen;if(t)return!1;var n=document.getElementById("viewerContainer");if(document.documentElement.requestFullScreen)n.requestFullScreen();else if(document.documentElement.mozRequestFullScreen)n.mozRequestFullScreen();else{if(!document.documentElement.webkitRequestFullScreen)return!1;n.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT)}this.isFullscreen=!0;var r=this.pages[this.page-1];return this.previousScale=this.currentScaleValue,this.parseScale("page-fit",!0),setTimeout(function(){r.scrollIntoView()},0),!0},exitFullscreen:function(){this.isFullscreen=!1,this.parseScale(this.previousScale),this.page=this.page},rotatePages:function(t){this.pageRotation=(this.pageRotation+360+t)%360;for(var n=0,r=this.pages.length;n<r;n++){var i=this.pages[n];i.update(i.scale,this.pageRotation)}for(var n=0,r=this.thumbnails.length;n<r;n++){var s=this.thumbnails[n];s.updateRotation(this.pageRotation)}var o=this.pages[this.page-1];this.parseScale(this.currentScaleValue,!0),this.renderHighestPriority(),setTimeout(function(){o.scrollIntoView()},0)}},PageView=function(t,n,r,i,s,o){function f(e,t){function n(e,t){e.href=PDFView.getDestinationHash(t),e.onclick=function(){return t&&PDFView.navigateTo(t),!1}}function r(e,n){var r=t.convertToViewportRectangle(n.rect);r=PDFJS.Util.normalizeRect(r);var i=document.createElement(e);return i.style.left=Math.floor(r[0])+"px",i.style.top=Math.floor(r[1])+"px",i.style.width=Math.ceil(r[2]-r[0])+"px",i.style.height=Math.ceil(r[3]-r[1])+"px",i}function i(e,n){var i=document.createElement("section");i.className="annotComment";var s=r("img",n),e=n.type,o=t.convertToViewportRectangle(n.rect);o=PDFJS.Util.normalizeRect(o),s.src=kImageDirectory+"annotation-"+e.toLowerCase()+".svg",s.alt=mozL10n.get("text_annotation_type",{type:e},"[{{type}} Annotation]");var u=document.createElement("div");u.setAttribute("hidden",!0);var a=document.createElement("h1"),f=document.createElement("p");u.style.left=Math.floor(o[2])+"px",u.style.top=Math.floor(o[1])+"px",a.textContent=n.title;if(!n.content&&!n.title)u.setAttribute("hidden",!0);else{var l=document.createElement("span"),c=n.content.split("\n");for(var h=0,p=c.length;h<p;++h){var d=c[h];l.appendChild(document.createTextNode(d)),h<p-1&&l.appendChild(document.createElement("br"))}f.appendChild(l),s.addEventListener("mouseover",function(){u.removeAttribute("hidden")},!1),s.addEventListener("mouseout",function(){u.setAttribute("hidden",!0)},!1)}return u.appendChild(a),u.appendChild(f),i.appendChild(s),i.appendChild(u),i}e.getAnnotations().then(function(e){for(var t=0;t<e.length;t++){var s=e[t];switch(s.type){case"Link":var o=r("a",s);o.href=s.url||"",s.url||n(o,"dest"in s?s.dest:null),a.appendChild(o);break;case"Text":var u=i(s.name,s);u&&a.appendChild(u);break;case"Widget":PDFView.fallback()}}})}this.id=r,this.pdfPage=n,this.rotation=0,this.scale=i||1,this.viewport=this.pdfPage.getViewport(this.scale,this.pdfPage.rotate),this.renderingState=RenderingStates.INITIAL,this.resume=null;var u=document.createElement("a");u.name=""+this.id;var a=this.el=document.createElement("div");a.id="pageContainer"+this.id,a.className="page",a.style.width=this.viewport.width+"px",a.style.height=this.viewport.height+"px",t.appendChild(u),t.appendChild(a),this.destroy=function(){this.update(),this.pdfPage.destroy()},this.update=function(t,n){this.renderingState=RenderingStates.INITIAL,this.resume=null,typeof n!="undefined"&&(this.rotation=n),this.scale=t||this.scale;var r=(this.rotation+this.pdfPage.rotate)%360,i=this.pdfPage.getViewport(this.scale,r);this.viewport=i,a.style.width=i.width+"px",a.style.height=i.height+"px";while(a.hasChildNodes())a.removeChild(a.lastChild);a.removeAttribute("data-loaded"),delete this.canvas,this.loadingIconDiv=document.createElement("div"),this.loadingIconDiv.className="loadingIcon",a.appendChild(this.loadingIconDiv)},Object.defineProperty(this,"width",{get:function(){return this.viewport.width},enumerable:!0}),Object.defineProperty(this,"height",{get:function(){return this.viewport.height},enumerable:!0}),this.getPagePoint=function(t,n){return this.viewport.convertToPdfPoint(t,n)},this.scrollIntoView=function(t){if(!t){scrollIntoView(a);return}var n=0,r=0,i=0,s=0,o,u,f=0;switch(t[1].name){case"XYZ":n=t[2],r=t[3],f=t[4];break;case"Fit":case"FitB":f="page-fit";break;case"FitH":case"FitBH":r=t[2],f="page-width";break;case"FitV":case"FitBV":n=t[2],f="page-height";break;case"FitR":n=t[2],r=t[3],i=t[4]-n,s=t[5]-r,o=(this.container.clientWidth-kScrollbarPadding)/i/kCssUnits,u=(this.container.clientHeight-kScrollbarPadding)/s/kCssUnits,f=Math.min(o,u);break;default:return}f&&f!==PDFView.currentScale?PDFView.parseScale(f,!0,!0):PDFView.currentScale===kUnknownScale&&PDFView.parseScale(kDefaultScale,!0,!0);var l=[this.viewport.convertToViewportPoint(n,r),this.viewport.convertToViewportPoint(n+i,r+s)];setTimeout(function(){var t=PDFView.currentScale,n=Math.min(l[0][0],l[1][0]),r=Math.min(l[0][1],l[1][1]),i=Math.abs(l[0][0]-l[1][0]),s=Math.abs(l[0][1]-l[1][1]);scrollIntoView(a,{left:n,top:r,width:i,height:s})},0)},this.draw=function(t){function h(e){c.renderingState=RenderingStates.FINISHED,c.loadingIconDiv&&(a.removeChild(c.loadingIconDiv),delete c.loadingIconDiv),e&&PDFView.error(mozL10n.get("rendering_error",null,"An error occurred while rendering the page."),e),c.stats=n.stats,c.updateStats(),c.onAfterDraw&&c.onAfterDraw(),cache.push(c),t()}this.renderingState!==RenderingStates.INITIAL&&error("Must be in new state before drawing"),this.renderingState=RenderingStates.RUNNING;var r=document.createElement("canvas");r.id="page"+this.id,r.mozOpaque=!0,a.appendChild(r),this.canvas=r;var i=null;PDFJS.disableTextLayer||(i=document.createElement("div"),i.className="textLayer",a.appendChild(i));var s=i?new TextLayerBuilder(i):null,o=this.scale,u=this.viewport;r.width=u.width,r.height=u.height;var l=r.getContext("2d");l.save(),l.fillStyle="rgb(255, 255, 255)",l.fillRect(0,0,r.width,r.height),l.restore();var c=this,p={canvasContext:l,viewport:this.viewport,textLayer:s,continueCallback:function(t){if(PDFView.highestPriorityPage!=="page"+c.id){c.renderingState=RenderingStates.PAUSED,c.resume=function(){c.renderingState=RenderingStates.RUNNING,t()};return}t()}};this.pdfPage.render(p).then(function(){h(null)},function(t){h(t)}),f(this.pdfPage,this.viewport),a.setAttribute("data-loaded",!0)},this.beforePrint=function(){var t=this.pdfPage,n=t.getViewport(1),r=this.canvas=document.createElement("canvas");r.width=n.width,r.height=n.height,r.style.width=n.width+"pt",r.style.height=n.height+"pt";var i=document.getElementById("printContainer");i.appendChild(r);var s=this;r.mozPrintCallback=function(e){var r=e.context,i={canvasContext:r,viewport:n};t.render(i).then(function(){e.done(),s.pdfPage.destroy()},function(t){console.error(t),"abort"in object?e.abort():e.done(),s.pdfPage.destroy()})}},this.updateStats=function(){if(PDFJS.pdfBug&&Stats.enabled){var t=this.stats;Stats.add(this.id,t)}}},ThumbnailView=function(t,n,r){function g(){var e=document.createElement("canvas");e.id="thumbnail"+r,e.mozOpaque=!0,e.width=c,e.height=h,e.className="thumbnailImage",e.setAttribute("aria-label",mozL10n.get("thumb_page_canvas",{page:r},"Thumbnail of Page {{page}}")),v.setAttribute("data-loaded",!0),m.appendChild(e);var t=e.getContext("2d");return t.save(),t.fillStyle="rgb(255, 255, 255)",t.fillRect(0,0,c,h),t.restore(),t}var i=document.createElement("a");i.href=PDFView.getAnchorUrl("#page="+r),i.title=mozL10n.get("thumb_page_title",{page:r},"Page {{page}}"),i.onclick=function(){return PDFView.page=r,!1};var s=0,o=(s+n.rotate)%360,u=n.getViewport(1,o),a=this.width=u.width,f=this.height=u.height,l=a/f;this.id=r;var c=98,h=c/this.width*this.height,p=this.scaleX=c/a,d=this.scaleY=h/f,v=this.el=document.createElement("div");v.id="thumbnailContainer"+r,v.className="thumbnail";var m=document.createElement("div");m.className="thumbnailSelectionRing",m.style.width=c+"px",m.style.height=h+"px",v.appendChild(m),i.appendChild(v),t.appendChild(i),this.hasImage=!1,this.renderingState=RenderingStates.INITIAL,this.updateRotation=function(e){s=e,o=(s+n.rotate)%360,u=n.getViewport(1,o),a=this.width=u.width,f=this.height=u.height,l=a/f,h=c/this.width*this.height,p=this.scaleX=c/a,d=this.scaleY=h/f,v.removeAttribute("data-loaded"),m.textContent="",m.style.width=c+"px",m.style.height=h+"px",this.hasImage=!1,this.renderingState=RenderingStates.INITIAL,this.resume=null},this.drawingRequired=function(){return!this.hasImage},this.draw=function(t){this.renderingState!==RenderingStates.INITIAL&&error("Must be in new state before drawing"),this.renderingState=RenderingStates.RUNNING;if(this.hasImage){t();return}var r=this,i=g(),s=n.getViewport(p,o),u={canvasContext:i,viewport:s,continueCallback:function(e){if(PDFView.highestPriorityPage!=="thumbnail"+r.id){r.renderingState=RenderingStates.PAUSED,r.resume=function(){r.renderingState=RenderingStates.RUNNING,e()};return}e()}};n.render(u).then(function(){r.renderingState=RenderingStates.FINISHED,t()},function(n){r.renderingState=RenderingStates.FINISHED,t()}),this.hasImage=!0},this.setImage=function(t){if(this.hasImage||!t)return;this.renderingState=RenderingStates.FINISHED;var n=g();n.drawImage(t,0,0,t.width,t.height,0,0,n.canvas.width,n.canvas.height),this.hasImage=!0}},DocumentOutlineView=function(t){function r(e,t){e.href=PDFView.getDestinationHash(t.dest),e.onclick=function(n){return PDFView.navigateTo(t.dest),!1}}var n=document.getElementById("outlineView");while(n.firstChild)n.removeChild(n.firstChild);if(!t){var i=document.createElement("div");i.classList.add("noOutline"),i.textContent=mozL10n.get("no_outline",null,"No Outline Available"),n.appendChild(i);return}var s=[{parent:n,items:t}];while(s.length>0){var o=s.shift(),u,a=o.items.length;for(u=0;u<a;u++){var f=o.items[u],l=document.createElement("div");l.className="outlineItem";var c=document.createElement("a");r(c,f),c.textContent=f.title,l.appendChild(c);if(f.items.length>0){var h=document.createElement("div");h.className="outlineItems",l.appendChild(h),s.push({parent:h,items:f.items})}o.parent.appendChild(l)}}},CustomStyle=function(){function r(){}var t=["ms","Moz","Webkit","O"],n={};return r.getProp=function(r,i){if(arguments.length==1&&typeof n[r]=="string")return n[r];i=i||document.documentElement;var s=i.style,o,u;if(typeof s[r]=="string")return n[r]=r;u=r.charAt(0).toUpperCase()+r.slice(1);for(var a=0,f=t.length;a<f;a++){o=t[a]+u;if(typeof s[o]=="string")return n[r]=o}return n[r]="undefined"},r.setProp=function(t,n,r){var i=this.getProp(t);i!="undefined"&&(n.style[i]=r)},r}(),TextLayerBuilder=function(t){this.textLayerDiv=t,this.beginLayout=function(){this.textDivs=[],this.textLayerQueue=[]},this.endLayout=function(){function l(){if(n.length===0){clearInterval(i),s=!0,t.textLayerDiv=r=a=f=null;return}var e=n.shift();r.appendChild(e),f.font=e.style.fontSize+" sans-serif";var o=f.measureText(e.textContent).width;if(o>0){var u=e.dataset.canvasWidth/o;CustomStyle.setProp("transform",e,"scale("+u+", 1)"),CustomStyle.setProp("transformOrigin",e,"0% 0%")}}function h(){if(s){window.removeEventListener("scroll",h,!1);return}clearInterval(i),clearTimeout(c),c=setTimeout(function(){i=setInterval(l,o)},u)}var t=this,n=this.textDivs,r=this.textLayerDiv,i=null,s=!1,o=0,u=500,a=document.createElement("canvas"),f=a.getContext("2d");i=setInterval(l,o);var c=null;window.addEventListener("scroll",h,!1)},this.appendText=function(t,n,r){var i=document.createElement("div"),s=r*t.geom.vScale;i.dataset.canvasWidth=t.canvasWidth*t.geom.hScale,i.dataset.fontName=n,i.style.fontSize=s+"px",i.style.left=t.geom.x+"px",i.style.top=t.geom.y-s+"px",i.textContent=PDFJS.bidi(t,-1),i.dir=t.direction,this.textDivs.push(i)}};document.addEventListener("DOMContentLoaded",function(t){PDFView.initialize();var n=PDFView.parseQueryString(document.location.search.substring(1)),r=n.file||kDefaultURL;!window.File||!window.FileReader||!window.FileList||!window.Blob?document.getElementById("openFile").setAttribute("hidden","true"):document.getElementById("fileInput").value=null;var i=document.location.hash.substring(1),s=PDFView.parseQueryString(i);"disableWorker"in s&&(PDFJS.disableWorker=s.disableWorker==="true");var o=navigator.language;"locale"in s&&(o=s.locale),mozL10n.language.code=o;if("textLayer"in s)switch(s.textLayer){case"off":PDFJS.disableTextLayer=!0;break;case"visible":case"shadow":case"hover":var u=document.getElementById("viewer");u.classList.add("textLayer-"+s.textLayer)}if("pdfBug"in s){PDFJS.pdfBug=!0;var a=s.pdfBug,f=a.split(",");PDFBug.enable(f),PDFBug.init()}PDFView.supportsPrinting||document.getElementById("print").classList.add("hidden"),PDFView.supportsFullscreen||document.getElementById("fullscreen").classList.add("hidden"),PDFJS.LogManager.addLogger({warn:function(){PDFView.fallback()}});var l=document.getElementById("mainContainer"),c=document.getElementById("outerContainer");l.addEventListener("transitionend",function(e){if(e.target==l){var t=document.createEvent("UIEvents");t.initUIEvent("resize",!1,!1,window,0),window.dispatchEvent(t),c.classList.remove("sidebarMoving")}},!0),document.getElementById("sidebarToggle").addEventListener("click",function(){this.classList.toggle("toggled"),c.classList.add("sidebarMoving"),c.classList.toggle("sidebarOpen"),PDFView.sidebarOpen=c.classList.contains("sidebarOpen"),PDFView.renderHighestPriority()}),document.getElementById("viewThumbnail").addEventListener("click",function(){PDFView.switchSidebarView("thumbs")}),document.getElementById("viewOutline").addEventListener("click",function(){PDFView.switchSidebarView("outline")}),document.getElementById("viewSearch").addEventListener("click",function(){PDFView.switchSidebarView("search")}),document.getElementById("searchButton").addEventListener("click",function(){PDFView.search()}),document.getElementById("previous").addEventListener("click",function(){PDFView.page--}),document.getElementById("next").addEventListener("click",function(){PDFView.page++}),document.querySelector(".zoomIn").addEventListener("click",function(){PDFView.zoomIn()}),document.querySelector(".zoomOut").addEventListener("click",function(){PDFView.zoomOut()}),document.getElementById("fullscreen").addEventListener("click",function(){PDFView.fullscreen()}),document.getElementById("openFile").addEventListener("click",function(){document.getElementById("fileInput").click()}),document.getElementById("print").addEventListener("click",function(){window.print()}),document.getElementById("download").addEventListener("click",function(){PDFView.download()}),document.getElementById("searchTermsInput").addEventListener("keydown",function(e){e.keyCode==13&&PDFView.search()}),document.getElementById("pageNumber").addEventListener("change",function(){PDFView.page=this.value}),document.getElementById("scaleSelect").addEventListener("change",function(){PDFView.parseScale(this.value)}),document.getElementById("page_rotate_ccw").addEventListener("click",function(){PDFView.rotatePages(-90)}),document.getElementById("page_rotate_cw").addEventListener("click",function(){PDFView.rotatePages(90)}),PDFView.open(r,0)},!0),window.addEventListener("resize",function(t){PDFView.initialized&&(document.getElementById("pageWidthOption").selected||document.getElementById("pageFitOption").selected||document.getElementById("pageAutoOption").selected)&&PDFView.parseScale(document.getElementById("scaleSelect").value),updateViewarea()}),window.addEventListener("hashchange",function(t){PDFView.setHash(document.location.hash.substring(1))}),window.addEventListener("change",function(t){var n=t.target.files;if(!n||n.length==0)return;var r=new FileReader;r.onload=function(t){var n=t.target.result,r=new Uint8Array(n);PDFView.open(r,0)};var i=n[0];r.readAsArrayBuffer(i),PDFView.setTitleUsingUrl(i.name),document.getElementById("viewBookmark").setAttribute("hidden","true"),document.getElementById("download").setAttribute("hidden","true")},!0),window.addEventListener("localized",function(t){document.getElementsByTagName("html")[0].dir=mozL10n.language.direction},!0),window.addEventListener("scalechange",function(t){var n=document.getElementById("customScaleOption");n.selected=!1;if(!t.resetAutoSettings&&(document.getElementById("pageWidthOption").selected||document.getElementById("pageFitOption").selected||document.getElementById("pageAutoOption").selected)){updateViewarea();return}var r=selectScaleOption(""+t.scale);r||(n.textContent=Math.round(t.scale*1e4)/100+"%",n.selected=!0),updateViewarea()},!0),window.addEventListener("pagechange",function(t){var n=t.pageNumber;if(document.getElementById("pageNumber").value!=n){document.getElementById("pageNumber").value=n;var r=document.querySelector(".thumbnail.selected");r&&r.classList.remove("selected");var i=document.getElementById("thumbnailContainer"+n);i.classList.add("selected");var s=PDFView.getVisibleThumbs(),o=s.views.length;if(o>0){var u=s.first.id,a=o>1?s.last.id:u;(n<=u||n>=a)&&scrollIntoView(i)}}document.getElementById("previous").disabled=n<=1,document.getElementById("next").disabled=n>=PDFView.pages.length},!0),window.addEventListener("DOMMouseScroll",function(e){if(e.ctrlKey){e.preventDefault();var t=e.detail,n=t>0?"zoomOut":"zoomIn";for(var r=0,i=Math.abs(t);r<i;r++)PDFView[n]()}},!1),window.addEventListener("keydown",function(t){var n=!1,r=(t.ctrlKey?1:0)|(t.altKey?2:0)|(t.shiftKey?4:0)|(t.metaKey?8:0);if(r==1||r==8)switch(t.keyCode){case 61:case 107:case 187:PDFView.zoomIn(),n=!0;break;case 173:case 109:case 189:PDFView.zoomOut(),n=!0;break;case 48:PDFView.parseScale(kDefaultScale,!0),n=!0}if(n){t.preventDefault();return}var i=document.activeElement;if(i&&i.tagName=="INPUT")return;var s=document.getElementById("controls");while(i){if(i===s&&!PDFView.isFullscreen)return;i=i.parentNode}if(r==0)switch(t.keyCode){case 37:case 75:case 80:PDFView.page--,n=!0;break;case 39:case 74:case 78:PDFView.page++,n=!0;break;case 32:PDFView.isFullscreen&&(PDFView.page++,n=!0);break;case 82:PDFView.rotatePages(90)}if(r==4)switch(t.keyCode){case 82:PDFView.rotatePages(-90)}n&&t.preventDefault()}),window.addEventListener("beforeprint",function(t){PDFView.beforePrint()}),window.addEventListener("afterprint",function(t){PDFView.afterPrint()}),function(){function t(e){var t=document.fullscreen||document.mozFullScreen||document.webkitIsFullScreen;t||PDFView.exitFullscreen()}window.addEventListener("fullscreenchange",t,!1),window.addEventListener("mozfullscreenchange",t,!1),window.addEventListener("webkitfullscreenchange",t,!1)}()
    </script>
  </head>

  <body>
    <div id="outerContainer">

      <div id="sidebarContainer">
        <div id="toolbarSidebar" class="splitToolbarButton toggled">
          <button id="viewThumbnail" class="toolbarButton group toggled" title="Show Thumbnails" tabindex="1" data-l10n-id="thumbs">
             <span data-l10n-id="thumbs_label">Thumbnails</span>
          </button>
          <button id="viewOutline" class="toolbarButton group" title="Show Document Outline" tabindex="2" data-l10n-id="outline">
             <span data-l10n-id="outline_label">Document Outline</span>
          </button>
          <button id="viewSearch" class="toolbarButton group hidden" title="Search Document" tabindex="3" data-l10n-id="search_panel">
             <span data-l10n-id="search_panel_label">Search Document</span>
          </button>
        </div>
        <div id="sidebarContent">
          <div id="thumbnailView">
          </div>
          <div id="outlineView" class="hidden">
          </div>
          <div id="searchView" class="hidden">
            <div id="searchToolbar">
              <input id="searchTermsInput" class="toolbarField">
              <button id="searchButton" class="textButton toolbarButton" data-l10n-id="search">Find</button>
            </div>
            <div id="searchResults"></div>
          </div>
        </div>
      </div>  <!-- sidebarContainer -->

      <div id="mainContainer">
        <div class="toolbar">
          <div id="toolbarContainer">

            <div id="toolbarViewer">
              <div id="toolbarViewerLeft">
                <button id="sidebarToggle" class="toolbarButton" title="Toggle Sidebar" tabindex="4" data-l10n-id="toggle_slider">
                  <span data-l10n-id="toggle_slider_label">Toggle Sidebar</span>
                </button>
                <div class="toolbarButtonSpacer"></div>
                <div class="splitToolbarButton">
                  <button class="toolbarButton pageUp" title="Previous Page" id="previous" tabindex="5" data-l10n-id="previous">
                    <span data-l10n-id="previous_label">Previous</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton pageDown" title="Next Page" id="next" tabindex="6" data-l10n-id="next">
                    <span data-l10n-id="next_label">Next</span>
                  </button>
                </div>
                <label id="pageNumberLabel" class="toolbarLabel" for="pageNumber" data-l10n-id="page_label">Page: </label>
                <input type="number" id="pageNumber" class="toolbarField pageNumber" value="1" size="4" min="1" tabindex="7">
                </input>
                <span id="numPages" class="toolbarLabel"></span>
              </div>
              <div id="toolbarViewerRight">
                <input id="fileInput" class="fileInput" type="file" oncontextmenu="return false;" style="visibility: hidden; position: fixed; right: 0; top: 0" />


                <button id="fullscreen" class="toolbarButton fullscreen" title="Fullscreen" tabindex="11" data-l10n-id="fullscreen">
                  <span data-l10n-id="fullscreen_label">Fullscreen</span>
                </button>

                <button id="openFile" class="toolbarButton openFile" title="Open File" tabindex="12" data-l10n-id="open_file">
                   <span data-l10n-id="open_file_label">Open</span>
                </button>

                <button id="print" class="toolbarButton print" title="Print" tabindex="13" data-l10n-id="print">
                  <span data-l10n-id="print_label">Print</span>
                </button>

                <button id="download" class="toolbarButton download" title="Download" tabindex="14" data-l10n-id="download">
                  <span data-l10n-id="download_label">Download</span>
                </button>
                <!-- <div class="toolbarButtonSpacer"></div> -->
                <a href="#" id="viewBookmark" class="toolbarButton bookmark" title="Current view (copy or open in new window)" tabindex="15" data-l10n-id="bookmark"><span data-l10n-id="bookmark_label">Current View</span></a>
              </div>
              <div class="outerCenter">
                <div class="innerCenter" id="toolbarViewerMiddle">
                  <div class="splitToolbarButton">
                    <button class="toolbarButton zoomOut" title="Zoom Out" tabindex="8" data-l10n-id="zoom_out">
                      <span data-l10n-id="zoom_out_label">Zoom Out</span>
                    </button>
                    <div class="splitToolbarButtonSeparator"></div>
                    <button class="toolbarButton zoomIn" title="Zoom In" tabindex="9" data-l10n-id="zoom_in">
                      <span data-l10n-id="zoom_in_label">Zoom In</span>
                     </button>
                  </div>
                  <span id="scaleSelectContainer" class="dropdownToolbarButton">
                     <select id="scaleSelect" title="Zoom" oncontextmenu="return false;" tabindex="10" data-l10n-id="zoom">
                      <option id="pageAutoOption" value="auto" selected="selected" data-l10n-id="page_scale_auto">Automatic Zoom</option>
                      <option id="pageActualOption" value="page-actual" data-l10n-id="page_scale_actual">Actual Size</option>
                      <option id="pageFitOption" value="page-fit" data-l10n-id="page_scale_fit">Fit Page</option>
                      <option id="pageWidthOption" value="page-width" data-l10n-id="page_scale_width">Full Width</option>
                      <option id="customScaleOption" value="custom"></option>
                      <option value="0.5">50%</option>
                      <option value="0.75">75%</option>
                      <option value="1">100%</option>
                      <option value="1.25">125%</option>
                      <option value="1.5">150%</option>
                      <option value="2">200%</option>
                    </select>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <menu type="context" id="viewerContextMenu">
          <menuitem label="Rotate Counter-Clockwise" id="page_rotate_ccw"
                    data-l10n-id="page_rotate_ccw" ></menuitem>
          <menuitem label="Rotate Clockwise" id="page_rotate_cw"
                    data-l10n-id="page_rotate_cw" ></menuitem>
        </menu>

        <div id="viewerContainer">
          <div id="viewer" contextmenu="viewerContextMenu"></div>
        </div>

        <div id="loadingBox">
          <div id="loading"></div>
          <div id="loadingBar"><div class="progress"></div></div>
        </div>

        <div id="errorWrapper" hidden='true'>
          <div id="errorMessageLeft">
            <span id="errorMessage"></span>
            <button id="errorShowMore" onclick="" oncontextmenu="return false;" data-l10n-id="error_more_info">
              More Information
            </button>
            <button id="errorShowLess" onclick="" oncontextmenu="return false;" data-l10n-id="error_less_info" hidden='true'>
              Less Information
            </button>
          </div>
          <div id="errorMessageRight">
            <button id="errorClose" oncontextmenu="return false;" data-l10n-id="error_close">
              Close
            </button>
          </div>
          <div class="clearBoth"></div>
          <textarea id="errorMoreInfo" hidden='true' readonly="readonly"></textarea>
        </div>
      </div> <!-- mainContainer -->

    </div> <!-- outerContainer -->
    <div id="printContainer"></div>
  </body>
</html>
