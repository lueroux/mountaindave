(()=>{var e={1419:e=>{e.exports=function(e){const t=window.pageXOffset||document.documentElement.scrollLeft,o=function(e){const t=document.body,o=document.documentElement,n=e.getBoundingClientRect(),r=o.clientHeight,i=Math.max(t.scrollHeight,t.offsetHeight,o.clientHeight,o.scrollHeight,o.offsetHeight),c=n.bottom-r/2-n.height/2,s=i-r;return Math.min(c+window.pageYOffset,s)}(e);window.scrollTo(t,o)}}},t={};function o(n){var r=t[n];if(void 0!==r)return r.exports;var i=t[n]={exports:{}};return e[n](i,i.exports,o),i.exports}o.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return o.d(t,{a:t}),t},o.d=(e,t)=>{for(var n in t)o.o(t,n)&&!o.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{"use strict";var e=o(1419),t=o.n(e);const n=window.mc4wp_submitted_form,r=window.mc4wp.forms;if(n){const e=document.getElementById(n.element_id);!function(e,o,i,c){const s=Date.now(),d=document.body.clientHeight;i&&e.setData(c),window.scrollY<=10&&n.auto_scroll&&t()(e.element),window.addEventListener("load",(function(){r.trigger("submitted",[e]),i?r.trigger("error",[e,i]):(r.trigger("success",[e,c]),r.trigger(o,[e,c]),"updated_subscriber"===o&&r.trigger("subscribed",[e,c,!0]));const l=Date.now()-s;n.auto_scroll&&l>1e3&&l<2e3&&document.body.clientHeight!==d&&t()(e.element)}))}(r.getByElement(e),n.event,n.errors,n.data)}})()})();