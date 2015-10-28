/*
    #########################################################################################
    controls
    #########################################################################################
*/
var navigate, drawpoly, drawbox, drawline, edit, save, del, ruota, sposta, panel;
var editControl, ctrlPolygonRegular, ctrlPolyOptions, ctrlDragFeature, ctrlModifyFeature, ctrlSelectFeatureOptions, ctrlSelectFeature, ctrlPoint, ctrlPath, ctrlPolygon
/////////////////////////////////////////////////////////////////////////////////////////////
function setActiveLyr(flag){
   //console.log(flag);return false;//ok
    objOLC.ControlState.saveActiveControl(editableLyr);
    if(flag == 1)
        editableLyr = poly;
    else
        editableLyr = line;
    console.log(editableLyr);return false;
    swapPanel(editableLyr);
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function swapPanel(lyr){
    if(!lyr instanceof OpenLayers.Layer.Vector){alert(lyr.name + ": livello non trovato");return false;}
    featurePartLength = 0;

    if(typeof panel != 'undefined'){   
      try{
        panel.activateControl(navigate);
        panel.controls[1].destroy();
        panel.controls[2].destroy();
        panel.controls[3].destroy();
        panel.controls[4].destroy();
        panel.controls[5].destroy();
        panel.controls[6].destroy();
        panel.controls[7].destroy();
        panel.controls[8].destroy();
        panel.controls[0].destroy();
        panel.destroy();
        }
      catch(err){};
      panel = null;
    }

    navigate = new OpenLayers.Control.Navigation({title:"pan"});
    panel = new OpenLayers.Control.Panel({div:document.getElementById("panel")}, {defaultControl: navigate});
    
    save = new OpenLayers.Control.Button({
         title: "Salva modifiche",
         trigger: function() {
            if(edit.feature) {edit.selectControl.unselectAll();}
            saveStrategy.save();
            // alert('saved');
         },
         displayClass: "olControlSaveFeatures"
    });
    
    del = new DeleteFeature(lyr, {title: "Elimina geometria"});
    
    ctrlPolyOptions ={ 'sides': 4,'irregular': false};
    drawbox = new OpenLayers.Control.DrawFeature(lyr, OpenLayers.Handler.RegularPolygon, {
       handlerOptions: ctrlPolyOptions, 
       'displayClass': 'olControlDrawFeaturePolygonRegular'
    });
    
    sposta = new OpenLayers.Control.ModifyFeature.DRAG(editableLyr, {title: "Sposta geometria",displayClass: "olControlDragFeature"});
    edit = new OpenLayers.Control.ModifyFeature(editableLyr, {
        title: "Modifica geometria",
        displayClass: "olControlModifyFeature",
        vertexRenderIntent: "vertex", 
        deleteCodes:[46,68]
    });
    
    ctrlSelectFeatureOptions = { 
      clickout: true, 
      toggle: true, 
      multiple: true, 
      hover: false, 
      toggleKey: "ctrlKey", 
      multipleKey: "altKey", 
      box: true 
    };
    
    ctrlSelectFeature = new OpenLayers.Control.SelectFeature([line, poly], ctrlSelectFeatureOptions);
    
     drawpoly = new OpenLayers.Control.DrawFeature(poly, OpenLayers.Handler.Polygon,{title: "Disegna poligono",displayClass:"olControlDrawFeaturePolygon"});

    drawline = new OpenLayers.Control.DrawFeature(line, OpenLayers.Handler.Path, {
      title: "Disegna linea",
      displayClass: "olControlDrawFeaturePath"
    });
    
    ruota = new OpenLayers.Control.ModifyFeature.ROTATE(lyr, {
        title: "Ruota geometria",
        displayClass: "olControlRotateFeature"
    });

    sposta = new OpenLayers.Control.ModifyFeature.DRAG(lyr, {
        title: "Sposta geometria",
        displayClass: "olControlDragFeature"
    });
    
    panel.addControls([
        navigate,
        save,
        del,
        drawline,
        drawpoly,
        drawbox,
        edit,
        ctrlSelectFeature,
        sposta,
        ruota
    ]);

    var selectStyle = OpenLayers.Util.extend({}, OpenLayers.Feature.Vector.style['select']);

    edit.deleteCodes = [46, 68, 75];

    map.addControl(panel);
    panel.redraw();

    ctrlSelectFeature["box"] = false;
    ctrlSelectFeature["multiple"] = false;

    panel.activateControl(navigate);

    editableLayer = lyr;

    //if(lyr.aktControl){objOLC.ControlState.setActiveControl(lyr);}else{panel.activateControl(navigate);}
    try{
       editableLayer.events.on({ 
            sketchmodified : function(evt){}
       });}
    catch(err){}
       editableLayer.events.on({
            sketchmodified: function(evt){
              try{
                featurePartLength = partLength(evt.feature.geometry).toFixed(3);//.components.length;
                msg = evt.feature.geometry.getLength().toFixed(3);
                window.status = featurePartLength + ", " + (parseFloat(msg)-parseFloat(featurePartLength)).toFixed(3);
                
              }
              catch(err){window.status = err.message;}
            }
        });
        navigate.events.register("activate", navigate, function(){secondnavigate.deactivate();});
        navigate.events.register("deactivate", navigate, function(){secondnavigate.activate();});
     }

var objOLC = {};

objOLC.ControlState = {

    setActiveControl : function (lyr){
        var ctrlArr = lyr.aktControl;

        var oCtrls = map.controls;
        for(var i=0;i<oCtrls.length;i++)
            if(oCtrls[i].CLASS_NAME.replace(/OpenLayers.Control./,"") == ctrlArr[1] && oCtrls[i].displayClass == ctrlArr[2] && ctrlArr[3])
            {   panel.activateControl(oCtrls[i]);
                break;
            }
    },

    saveActiveControl : function (lyr){
        var oCtrls = map.controls;
        var ctrlArr = [6, oCtrls[6].CLASS_NAME.replace(/OpenLayers.Control./,""), oCtrls[6].displayClass, oCtrls[6].active];
        for(var i=3;i<oCtrls.length;i++)
                if(oCtrls[i].active && (oCtrls[i].CLASS_NAME.replace(/OpenLayers.Control./,"")!="MousePosition"))
                    ctrlArr[0] = [ i, oCtrls[i].CLASS_NAME.replace(/OpenLayers.Control./,""), oCtrls[i].displayClass, oCtrls[i].active];
        lyr.aktControl = ctrlArr[0];
    },

    CLASS_NAME : "objOLC.ControlState"
 }

function partLength(obj)
{
    var length = 0.0;
    if ( obj.components && (obj.components.length > 2)) {
        for(var i=1, len=obj.components.length; i<len-1; i++) {
            length += obj.components[i-1].distanceTo(obj.components[i]);
        }
    }
    return length;
}
