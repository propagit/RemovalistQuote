var OxO5ee6=["Verdana","innerHTML","Unicode","innerText","\x3Cspan style=\x27font-family:","\x27\x3E","\x3C/span\x3E","selfont","length","checked","value","charstable1","charstable2","fontFamily","style","display","block","none"];var editor=Window_GetDialogArguments(window); function getchar(obj){var Ox258;var Ox29e=getFontValue()||OxO5ee6[0x0];if(!obj[OxO5ee6[0x1]]){return ;} ; Ox258=obj[OxO5ee6[0x1]] ;if(Ox29e==OxO5ee6[0x2]){ Ox258=obj[OxO5ee6[0x3]] ;} else {if(Ox29e!=OxO5ee6[0x0]){ Ox258=OxO5ee6[0x4]+Ox29e+OxO5ee6[0x5]+obj[OxO5ee6[0x1]]+OxO5ee6[0x6] ;} ;} ; editor.PasteHTML(Ox258) ; Window_CloseDialog(window) ;}  ; function cancel(){ Window_CloseDialog(window) ;}  ; function getFontValue(){var Oxc2=document.getElementsByName(OxO5ee6[0x7]);for(var i=0x0;i<Oxc2[OxO5ee6[0x8]];i++){if(Oxc2.item(i)[OxO5ee6[0x9]]){return Oxc2.item(i)[OxO5ee6[0xa]];} ;} ;}  ; function sel_font_change(){var Ox2a1=getFontValue()||OxO5ee6[0x0];var Ox2a2=Window_GetElement(window,OxO5ee6[0xb],true);var Ox2a3=Window_GetElement(window,OxO5ee6[0xc],true); Ox2a2[OxO5ee6[0xe]][OxO5ee6[0xd]]=Ox2a1 ; Ox2a2[OxO5ee6[0xe]][OxO5ee6[0xf]]=(Ox2a1!=OxO5ee6[0x2]?OxO5ee6[0x10]:OxO5ee6[0x11]) ; Ox2a3[OxO5ee6[0xe]][OxO5ee6[0xf]]=(Ox2a1==OxO5ee6[0x2]?OxO5ee6[0x10]:OxO5ee6[0x11]) ;}  ;