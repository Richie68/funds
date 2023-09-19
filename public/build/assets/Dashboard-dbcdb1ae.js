import{k as m,l as w,o as i,f as x,a as n,w as l,u as a,F as u,O as b,Z as v,b as t,d,j as g,i as k,m as F,p as N,t as r,c as A,g as D,q as S}from"./app-1f4a2ae8.js";import{_ as V}from"./AuthenticatedLayout-e5292a05.js";import{l as j}from"./lodash-24870d0c.js";import{L as B}from"./LoaderComponent-e9191c18.js";import"./ApplicationLogo-d9b3b1e5.js";import"./_plugin-vue_export-helper-c27b6911.js";const E=t("title",null,"Funds Demo App | Ricardo Rojas",-1),L={class:"flex justify-between font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"},R={class:"px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto"},C={class:"relative flex items-center mb-2"},T={class:"text-gray-800 dark:text-white ml-4"},M={class:"font-semibold"},O={class:"flow-root"},q={class:"-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"},U={class:"inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"},Z={class:"min-w-full divide-y divide-gray-300 bg-white"},z=t("thead",null,[t("tr",null,[t("th",{scope:"col",class:"py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3"},"Name"),t("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"},"Fund Manager"),t("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"},"Aliases"),t("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"},"Start Date"),t("th",{scope:"col",class:"relative py-3.5 pl-3 pr-4 sm:pr-3"}," Edit ")])],-1),G={class:"bg-white"},H={class:"whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3"},I={class:"whitespace-nowrap px-3 py-4 text-sm text-gray-500"},J={class:"whitespace-nowrap px-3 py-4 text-sm text-gray-500"},K={class:"whitespace-nowrap px-3 py-4 text-sm text-gray-500"},P={class:"relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3"},et={__name:"Dashboard",props:{funds:Array},setup(f){const h=f;m(null);let o=m(null),c=m(!1);const _=s=>s.map(e=>e.name).join(" | "),y=s=>{c.value=!0,b.get(route("dashboard"),{search:s},{preserveState:!0,replace:!0,onSuccess:()=>{c.value=!1}})};return w(o,j.debounce(function(s){y(s)},500)),(s,p)=>(i(),x(u,null,[n(a(v),null,{default:l(()=>[E]),_:1}),n(V,null,{header:l(()=>[t("h2",L,[d(" Funds List "),n(a(g),{href:s.route("fund.create"),class:"text-sm bg-gray-700 text-white hover:bg-gray-500 dark:bg-white py-1 px-3 dark:text-gray-800 rounded dark:hover:bg-gray-200"},{default:l(()=>[d(" New Fund ")]),_:1},8,["href"])])]),default:l(()=>[t("div",R,[t("div",C,[k(t("input",{"onUpdate:modelValue":p[0]||(p[0]=e=>N(o)?o.value=e:o=e),class:"border-wine rounded-sm px-2 outline-none focus:border-main-dark focus:ring-main-dark",placeholder:"Search...",type:"search"},null,512),[[F,a(o)]]),t("div",T,[d(" Total Records: "),t("span",M,r(a(h).funds.length),1)]),a(c)?(i(),A(B,{key:0,class:"absolute right-0 ml-5 text-gray-800 dark:text-white"})):D("",!0)]),t("div",O,[t("div",q,[t("div",U,[t("table",Z,[z,t("tbody",G,[(i(!0),x(u,null,S(a(h).funds,e=>(i(),x("tr",{key:e.id,class:"even:bg-gray-50"},[t("td",H,r(e.name),1),t("td",I,r(e.manager.name),1),t("td",J,r(_(e.aliases)),1),t("td",K,r(e.start),1),t("td",P,[n(a(g),{href:s.route("fund.show",e.uuid),class:"text-gray-600 hover:text-gray-900"},{default:l(()=>[d("Edit")]),_:2},1032,["href"])])]))),128))])])])])])])]),_:1})],64))}};export{et as default};