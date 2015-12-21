function areeFunc(){
    var areeNum = $('.areeList').length;
    if(areeNum>1){$("#areeListCanc").text("Rimuovi l'ultima area inserita"); }
    else if (areeNum == 0) {$("#areeListCanc").parent().fadeOut('slow');$(".clear").remove();}
    else{$("#areeListCanc").text("Annulla inserimento area"); }
}