window.onload = function(){toggleMenu();};
function toggleMenu(){
    $('.submenu').hide();
    $("#sessionMenu li").on({
          mouseenter: function() {$(this).find('.submenu').slideDown('fast');}
        , mouseleave: function() {$(this).find('.submenu').slideUp('fast');}
    });
}

 (function ($) {
    $.fn.clickToggle = function (func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function () {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };
 }(jQuery));

function removeCorrela(id){
    if (confirm("Sei sicuro di voler eliminare questa correlazione?")) {
        $.ajax({
            url: 'inc/remove_schede_correlate_script.php',
            type: 'POST',
            data: {id:id},
            success: function(data){
                $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                 .delay(5000)
                 .fadeOut(function(){ $(this).dialog("close"); location.reload(); })
                 ;
            }//success
        });//ajax
    }
}

function removeInfrastruttura(id){
    if (confirm("Sei sicuro di voler eliminare questa correlazione?")) {
        $.ajax({
            url: 'inc/remove_mater_infrastruttura.php',
            type: 'POST',
            data: {id:id},
            success: function(data){
                $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                .delay(5000)
                .fadeOut(function(){ $(this).dialog("close"); location.reload();})
                ;
            }//success
        });//ajax
    }
}

function removeArea(id){
    if (confirm("Sei sicuro di voler eliminare quest'area?")) {
        $.ajax({
            url: 'inc/remove_areaScheda_script.php',
            type: 'POST',
            data: {id:id},
            success: function(data){
                $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                .delay(5000)
                .fadeOut(function(){ $(this).dialog("close"); location.reload(); })
                ;
            }//success
        });//ajax
    }
}

function removeParente(id){
    if (confirm("Sei sicuro di voler eliminare questa correlazione?")) {
        $.ajax({
            url: 'inc/remove_schede_parenti_script.php',
            type: 'POST',
            data: {id:id},
            success: function(data){
                $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                .delay(5000)
                .fadeOut(function(){ $(this).dialog("close"); location.reload();})
                ;
            }//success
        });//ajax
    }
}

function areeFunc(){
    var areeNum = $('.areeList').length;
    if(areeNum>1){$("#areeListCanc").text("Rimuovi l'ultima area inserita"); }
    else if (areeNum == 0) {$("#areeListCanc").parent().fadeOut('slow');$(".clear").remove();}
    else{$("#areeListCanc").text("Annulla inserimento area"); }
}

function addArea(){
    checkLocChecked = $("input[name=localitaCartoCheck]:checked");
    locLength = checkLocChecked.length;
    if (locLength==0){$("#addArea").hide();}else{$("#addArea").show();}
}

function checkLocLi(){ if($("#locTot li").length > 0 ){$("button[name=salvaAree]").show();}else{$("button[name=salvaAree]").hide();}; }

function toggleSezioni(thisObj){
    if(!thisObj.next('div').hasClass('open')){
        $(".main h3").removeClass('act');
        if($(".main h3 i").hasClass('fa-minus-circle')){
            $(".main h3 i").removeClass('fa-minus-circle').addClass('fa-plus-circle');
            thisObj.children('i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
        }
        thisObj.addClass('act');
        $('.sub').slideUp(500).removeClass('open');
        thisObj.next('div').slideDown(500).addClass('open');
    }
}

function initPanZoom() {
    $('#pan').panzoom({
        $zoomIn:$('#zoomin')
        ,$zoomOut:$('#zoomout')
        ,$reset: $("#reset")
        //,contain: true
    });
};