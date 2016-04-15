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
function validEmail(v) {
    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    return (v.match(r) == null) ? false : true;
}
function pager(){
    var show_per_page = 40;  
    var number_of_items = $('#catalogoTable tbody tr:visible').length; 
    var number_of_pages = Math.ceil(number_of_items/show_per_page);  
    $('#current_page').val(0);  
    $('#show_per_page').val(show_per_page);  
    var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
    var current_link = 0;
    while(number_of_pages > current_link){
        navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
        current_link++;
    }
    navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';
    $('.page_navigation').html(navigation_html);
    $('.page_navigation .page_link:first').addClass('active_page');
    $("#catalogoTable tbody>tr").css('display', 'none');
    $("#catalogoTable tbody>tr").slice(0, show_per_page).css('display', 'table-row');
}

function areaAdd(def){
    var id_area=$("#aa").val();
    var motiv=$("#mu").val();
    if(id_area == def || motiv == 16){
        $("#areeMsg").fadeIn('fast');
        $("#area_add").fadeOut('fast');
        return false; 
    }else{
        $("#areeMsg").fadeOut('fast');
        $("#area_add").fadeIn('fast');
        var area = $( "#aa option:selected" ).text();
        var motivTxt = $( "#mu option:selected" ).text();
        $("#aree").append('<div class="areeList" data-area="'+id_area+'" data-motiv="'+motiv+'"><div class="areeListRecord"><i class="fa fa-times"></i> <label>'+area+'</label></div><div class="areeListRecord"><label>'+motivTxt+'</label></div></div>');
        $("#area_add, #areeWrap, #areeListCanc").fadeIn('slow');
        areeFunc();
    }
    $(".areeListRecord > i").click(function(){
        $(this).parent().parent().remove();
        areeFunc();
    });
}

function areeFunc(){
    var areeNum = $('.areeList').length;
    if (areeNum == 0) {$("#areeWrap,#area_add").fadeOut('slow');}
}
