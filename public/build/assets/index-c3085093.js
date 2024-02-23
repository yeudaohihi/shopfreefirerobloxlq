import{r as C,c as le,o as re,a as u,b as g,d as i,w as l,e as v,f as B,g as t,h as c,t as d,F as $,i as I,j as m,k as ce,n as O,l as ie,A as ue}from"./chunk-1f342eb4.js";import"./chunk-e47d8634.js";const de=["onSubmit"],pe={class:"grid grid-cols-1 md:grid-cols-3 gap-3"},_e={for:"form-label"},ge={for:"form-label"},me={class:"grid grid-cols-2 gap-3"},fe={class:"btn btn-sm btn-primary w-full lg:mt-[22px]"},ve=t("i",{class:"fas fa-search"},null,-1),he=t("i",{class:"fas fa-trash"},null,-1),be={key:0},we={style:{background:"transparent"},class:"border border-primary rounded-lg p-[1px]"},ye={class:"text-center text-lg font-bold bg-primary text-white",style:{"margin-top":"-6px"}},xe={class:"p-3"},ke={class:"grid mb-3 gap-3"},Ce=t("i",{class:"fa-solid fa-check-circle"},null,-1),$e=t("i",{class:"fa-solid fa-star"},null,-1),Ie=t("i",{class:"fa-solid fa-check-circle"},null,-1),Se={class:"text-center grid grid-cols-2 gap-3"},Te={class:"col-span-2"},Be={class:"border border-red-500 rounded-lg p-1 font-bold"},Me={class:"text-green-600"},Pe=t("i",{class:"fas fa-credit-card me-2"},null,-1),Ue=["onClick"],Ee=t("i",{class:"fas fa-shopping-cart me-2"},null,-1),je={class:"text-center mt-3"},Ne={class:"list-none"},Fe={class:"inline-block"},Le=["onClick"],Ve={class:"inline-block"},Re={__name:"Index",props:{groupId:{type:String,default:0}},setup(D){const Q=D,y=C({price:"",search:""}),n=C({page:1,limit:16,total_rows:0,total_page:0,visible_pages:[]}),G=le(()=>{const{page:e,total_page:o,visible_pages:s}=n.value,_=5;let w=Math.max(e-Math.floor(_/2),1),x=Math.min(w+_-1,o);return x-w+1<_&&(w=Math.max(x-_+1,1)),Array.from({length:x-w+1},(E,k)=>w+k)}),q=e=>{n.value.page!==e&&(n.value.page=e,f())},z=()=>{n.value.page<=1||(n.value.page--,f())},H=()=>{n.value.page>=n.value.total_page||(n.value.page++,f())},J=C([{label:"Tất cả",value:""},{label:"Dưới 100.000đ",value:"0-100000"},{label:"100.000đ - 200.000đ",value:"100000-200000"},{label:"200.000đ - 500.000đ",value:"200000-500000"},{label:"500.000đ - 1.000.000đ",value:"500000-1000000"},{label:"1.000.000đ - 2.000.000đ",value:"1000000-2000000"},{label:"2.000.000đ - 5.000.000đ",value:"2000000-5000000"},{label:"5.000.000đ - 10.000.000đ",value:"5000000-10000000"},{label:"Trên 10.000.000đ",value:"10000000-0"}]),h=C(!1),S=C([]),f=async()=>{var e,o;h.value=!0;try{const{data:s}=await axios.get("/api/stores/accounts-v2",{params:{...y.value,group_id:Q.groupId,...n.value}});b("page")!==null&&n.value.page!==parseInt(b("page"))&&U("product_id"),n.value.page!==1?te("page",n.value.page):U("page"),S.value=((e=s.data)==null?void 0:e.data)||[],n.value=((o=s.data)==null?void 0:o.meta)||[]}catch(s){Swal.fire("Oops...",$catchMessage(s),"error")}finally{const s=b("product_id");setTimeout(s?()=>{const _=document.getElementById("card_"+s);_&&_.scrollIntoView({behavior:"smooth",block:"center",inline:"center"})}:ee,500),setTimeout(()=>{h.value=!1},600)}},W=()=>{n.value.page=1,f()},X=()=>{y.value={price:"",search:""},n.value.page=1,f()},Y=(e,o="VND",s=2)=>$formatCurrency(e,o,s),P=async e=>{if((await Swal.fire({icon:"question",title:$__t("Bạn chắc chứ?"),text:`${$__t("Bạn sẽ mua nick")} #${e.code} ${$__t("với giá")} ${e.price_str}?`,showCancelButton:!0,confirmButtonText:$__t("Đồng ý"),cancelButtonText:$__t("Hủy")})).isConfirmed===!0){Swal.fire({icon:"info",title:$__t("Đang xử lý!"),html:$__t("Không được tắt trang này, vui lòng đợi trong giây lát!"),timerProgressBar:!0,allowOutsideClick:!1,allowEscapeKey:!1,allowEnterKey:!1,didOpen:()=>{Swal.showLoading()},willClose:()=>{}});try{const{data:s}=await axios.post("/api/stores/accounts-v2/"+e.code+"/buy");Swal.fire("Great!",s.message,"success").then(()=>{window.open("/account/orders/accounts-v2/"+s.data.code,"_self")})}catch(s){Swal.fire("Oops...",$catchMessage(s),"error")}}},T=()=>{const e=["#C70039","#2E4374","#219C90","#EE9322","#5B0888","#004225","#9400FF"];return e[Math.floor(Math.random()*e.length)]},Z=e=>typeof e=="string"||e instanceof String,ee=()=>{window.scrollTo({top:0,behavior:"smooth"})},te=(e,o)=>{if(parseInt(b(e))===parseInt(o))return;const s=new URL(window.location.href);s.searchParams.set(e,o),window.history.pushState({},"",s)},U=e=>{if(b(e)===null)return;const o=new URL(window.location.href);o.searchParams.delete(e),window.history.pushState({},"",o)},b=e=>new URL(window.location.href).searchParams.get(e);window.addEventListener("popstate",()=>{const e=b("page");e&&n.value.page!==parseInt(e)?(n.value.page=parseInt(e),f()):!e&&n.value.page!==1&&(n.value.page=1,f())});const p=e=>$__t(e);return re(()=>{const e=b("page");e&&(n.value.page=parseInt(e)),f()}),(e,o)=>{var A,K;const s=u("a-select-option"),_=u("a-select"),w=u("a-input"),x=u("a-spin"),E=u("a-image"),k=u("a-tag"),ae=u("a-button"),j=u("a-tooltip"),N=u("a-badge-ribbon"),F=u("a-col"),L=u("a-row"),oe=u("a-skeleton"),V=u("a-card"),ne=u("a-empty"),R=u("iconify-icon");return c(),g("section",null,[i(x,{spinning:h.value},{default:l(()=>[t("form",{class:"mb-5 mt-5",onSubmit:ce(W,["prevent"])},[t("div",pe,[t("div",null,[t("label",_e,d(p("Chọn mức giá"))+": ",1),i(_,{value:y.value.price,"onUpdate:value":o[0]||(o[0]=a=>y.value.price=a),placeholder:p("Chọn mức giá"),style:{width:"100%"}},{default:l(()=>[(c(!0),g($,null,I(J.value,a=>(c(),v(s,{key:a.value,value:a.value},{default:l(()=>[m(d(a.label),1)]),_:2},1032,["value"]))),128))]),_:1},8,["value","placeholder"])]),t("div",null,[t("label",ge,d(p("Tìm kiếm"))+": ",1),i(w,{value:y.value.search,"onUpdate:value":o[1]||(o[1]=a=>y.value.search=a),placeholder:p("Tìm kiếm mã sản phẩm, trang phục,..."),style:{width:"100%"}},null,8,["value","placeholder"])]),t("div",me,[t("div",null,[t("button",fe,[ve,m(" "+d(p("Tìm kiếm")),1)])]),t("div",null,[t("button",{class:"btn btn-sm btn-danger w-full lg:mt-[22px]",type:"button",onClick:o[2]||(o[2]=a=>X())},[he,m(" "+d(p("Đặt lại")),1)])])])])],40,de)]),_:1},8,["spinning"]),((A=S.value)==null?void 0:A.length)!==0&&!h.value?(c(),g("div",be,[h.value?(c(),v(L,{key:1,gutter:18},{default:l(()=>[(c(),g($,null,I(16,a=>i(F,{xs:12,sm:8,lg:6,key:a},{default:l(()=>[i(V,{class:"mb-3 h-[303px]"},{default:l(()=>[i(oe,{active:""})]),_:1})]),_:2},1024)),64))]),_:1})):(c(),v(L,{key:0,gutter:18},{default:l(()=>[(c(!0),g($,null,I(S.value,a=>(c(),v(F,{xs:24,md:8,lg:6,key:a.id,class:"mb-2 mt-2 cursor-pointer"},{default:l(()=>[i(N,{color:"red",text:`-${a.discount}%`,class:O({hidden:a.discount<=0}),placement:"start"},{default:l(()=>[i(N,{color:"pink",text:`MS: ${a.code}`,placement:"end"},{default:l(()=>[t("div",we,[i(E,{src:a.image,alt:a.name,width:"100%",height:"sm:200px lg:170px",class:"rounded-t-lg"},null,8,["src","alt"]),t("div",ye,d(a.name),1),t("div",xe,[t("div",ke,[(c(!0),g($,null,I(a.highlights,(r,se)=>(c(),g("div",{key:se,class:"lg:col-span-1"},[Z(r)?(c(),v(k,{key:0,color:T(),class:"w-full font-bold",style:{"white-space":"normal"}},{default:l(()=>[Ce,m(" "+d(r),1)]),_:2},1032,["color"])):(r==null?void 0:r.name)!==void 0&&(r==null?void 0:r.value)!=="undefined"?(c(),v(k,{key:1,color:T(),class:"w-full font-bold",style:{"white-space":"normal"}},{default:l(()=>[$e,m(" "+d(r.name)+": "+d(r.value),1)]),_:2},1032,["color"])):(r==null?void 0:r[0])!==void 0?(c(),v(k,{key:2,color:T(),class:"w-full font-bold",style:{"white-space":"normal"}},{default:l(()=>[Ie,m(" "+d(r[0]),1)]),_:2},1032,["color"])):B("",!0)]))),128))]),t("div",Se,[t("div",Te,[t("div",Be,[m(d(p("Còn lại"))+" ",1),t("span",Me,d(a.amount),1),m(" nick ")])]),i(j,{title:a.discount!==0?`Giá gốc ${Y(a.price)}`:""},{default:l(()=>[i(ae,{type:"dashed",block:"",onClick:r=>P(a),class:"dark:text-white"},{default:l(()=>[Pe,m(" "+d(a.price_str),1)]),_:2},1032,["onClick"])]),_:2},1032,["title"]),i(j,{title:a.name},{default:l(()=>[t("button",{class:"btn btn-sm btn-primary w-full",onClick:r=>P(a)},[Ee,t("span",null,d(p("Mua Ngay")),1)],8,Ue)]),_:2},1032,["title"])])])])]),_:2},1032,["text"])]),_:2},1032,["text","class"])]),_:2},1024))),128))]),_:1}))])):B("",!0),((K=S.value)==null?void 0:K.length)===0&&!h.value?(c(),v(V,{key:1},{default:l(()=>[i(ne,{description:p("Không tìm thấy tài khoản nào trong nhóm này")},null,8,["description"])]),_:1})):B("",!0),t("div",je,[i(x,{spinning:h.value},{default:l(()=>[t("ul",Ne,[t("li",Fe,[t("a",{href:"javascript:void(0)",onClick:o[3]||(o[3]=a=>z()),class:"flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800 dark:text-white rounded mx-[3px] sm:mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all duration-300 relative top-[2px] pl-2"},[i(R,{icon:"material-symbols:arrow-back-ios-rounded"})])]),(c(!0),g($,null,I(G.value,a=>(c(),g("li",{key:a,class:"inline-block"},[t("a",{href:"javascript:void(0)",onClick:r=>q(a),class:O(["flex items-center justify-center w-6 h-6 bg-slate-100 text-slate-800 dark:text-white rounded mx-[3px] sm:mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all duration-300",{"p-active":n.value.page===a}])},d(a!==-1?a:"..."),11,Le)]))),128)),t("li",Ve,[t("a",{href:"javascript:void(0)",onClick:o[4]||(o[4]=a=>H()),class:"flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800 dark:text-white rounded mx-[3px] sm:mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all duration-300 relative top-[2px]"},[i(R,{icon:"material-symbols:arrow-forward-ios-rounded"})])])])]),_:1},8,["spinning"])])])}}},M=ie({});M.use(ue);M.component("account-index",Re);M.mount("#app");
