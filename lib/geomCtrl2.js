/*
    #########################################################################################
    controls
    #########################################################################################
*/
var ctrlNavigation, editControl, ctrlPolygonRegular, ctrlPolyOptions, ctrlDragFeature, ctrlModifyFeature, ctrlSelectFeatureOptions, ctrlSelectFeature, ctrlPoint, ctrlPath, ctrlPolygon

function setActiveLyr(flag)
{
    //objOLC.ControlState.saveActiveControl(editableLyr);
    if(flag == 1)
        editableLyr = targetLyr;
    else
        editableLyr = sourceLyr;

    swapPanel(editableLyr);
}

function swapPanel(lyr)
{
    if(!lyr instanceof OpenLayers.Layer.Vector)
    //if( (typeof lyr.isVector == 'undefined') || lyr.isVector == false)
    {   alert(lyr.name + " ist kein Vektorlayer");
        return false;
    }

    featurePartLength = 0;

    if(typeof editControl != 'undefined')
    {   try{
        editControl.activateControl(ctrlNavigation);
        editControl.controls[1].destroy();
        editControl.controls[2].destroy();
        editControl.controls[3].destroy();
        editControl.controls[4].destroy();
        editControl.controls[5].destroy();
        editControl.controls[6].destroy();
        editControl.controls[7].destroy();
        editControl.controls[0].destroy();
        editControl.destroy();
        }catch(err){};
        editControl = null;
    }

    ctrlNavigation = new OpenLayers.Control.Navigation();
    editControl = new OpenLayers.Control.Panel({defaultControl: ctrlNavigation});

    ctrlPolyOptions =
        { 'sides'       : 4,
          'radius'      : 0,
          'snapAngle'   : 45,
          'irregular'   : false
        };

    ctrlPolygonRegular = new OpenLayers.Control.DrawFeature(lyr, OpenLayers.Handler.RegularPolygon, {handlerOptions: ctrlPolyOptions, 'displayClass': 'olControlDrawFeaturePolygonRegular'});
    ctrlDragFeature   = new OpenLayers.Control.DragFeature(lyr);
    ctrlModifyFeature = new OpenLayers.Control.ModifyFeature(lyr, {vertexRenderIntent: "vertex", deleteCodes:[46,68]});
    ctrlSelectFeatureOptions = { clickout: true, toggle: true, multiple: true, hover: false, toggleKey: "ctrlKey", multipleKey: "altKey", box: true };
    ctrlSelectFeature = new OpenLayers.Control.SelectFeature([sourceLyr, targetLyr], ctrlSelectFeatureOptions);
    ctrlPoint   = new OpenLayers.Control.DrawFeature(lyr, OpenLayers.Handler.Point,    {'displayClass': 'olControlDrawFeaturePoint'});
    ctrlPath    = new OpenLayers.Control.DrawFeature(lyr, OpenLayers.Handler.Path,     {'displayClass': 'olControlDrawFeaturePath'});
    ctrlPolygon = new OpenLayers.Control.DrawFeature(lyr, OpenLayers.Handler.Polygon,  {'displayClass': 'olControlDrawFeaturePolygon'});

    editControl.addControls([
        ctrlNavigation,
        ctrlPoint,
        ctrlPath,
        ctrlPolygon,
        ctrlPolygonRegular,
        ctrlModifyFeature,
        ctrlSelectFeature,
        ctrlDragFeature
    ]);

/*
    OpenLayers.Feature.Vector.style['select']['label']    = 'yellow';
    OpenLayers.Feature.Vector.style['select']['fillColor']    = 'yellow';
    OpenLayers.Feature.Vector.style['select']['strokeColor']  = 'yellow';
    //OpenLayers.Feature.Vector.style['vertex']  = new OpenLayers.Style({"pointRadius":10, strokeColor:"#00FF00"});
    OpenLayers.Feature.Vector.style['select']['vertex']  = new OpenLayers.Style({"pointRadius":10, strokeColor:"#00FF00"});
    //OpenLayers.Feature.Vector.style['select']['pointRadius']  = 4;
*/
    var selectStyle = OpenLayers.Util.extend({}, OpenLayers.Feature.Vector.style['select']);
    //ctrlSelectFeature.selectStyle = selectStyle;

    //ctrlModifyFeature.virtualStyle = OpenLayers.Util.extend({}, new OpenLayers.StyleMap({select:{"pointRadius":10, strokeColor:"#00FF00"}}));
    //ctrlModifyFeature.virtualStyle = selectStyle;
    ctrlModifyFeature.deleteCodes = [46, 68, 75];

    //ctrlDragFeature.onComplete = projectDraggedFeature;

    map.addControl(editControl);
    editControl.redraw();

    ctrlSelectFeature["box"] = false;
    ctrlSelectFeature["multiple"] = false;

    editControl.activateControl(ctrlNavigation);

    editableLayer = lyr;

    if(lyr.aktControl){
        objOLC.ControlState.setActiveControl(lyr);
    }
    else{
        editControl.activateControl(ctrlNavigation);
    }

    try{
        editableLayer.events.un({ sketchmodified : function(evt){}});
    }catch(err){
        //console.log(err.message);
    }
    editableLayer.events.on({
        sketchmodified: function(evt)
        {
            try{ //LÃ¤nge und partLength 2 move
                featurePartLength = partLength(evt.feature.geometry).toFixed(3);//.components.length;
                msg = evt.feature.geometry.getLength().toFixed(3);
                window.status = featurePartLength + ", " + (parseFloat(msg)-parseFloat(featurePartLength)).toFixed(3);
                //document.getElementById("TextArea2").value = featurePartLength + ", " + (parseFloat(msg)-parseFloat(featurePartLength)).toFixed(3);
            }catch(err){
                window.status = err.message;
            }
        }
    });
    ctrlNavigation.events.register("activate", ctrlNavigation, function(){secondCtrlNavigation.deactivate();});
    ctrlNavigation.events.register("deactivate", ctrlNavigation, function(){secondCtrlNavigation.activate();});
}

var objOLC = {};

objOLC.ControlState = {

    setActiveControl : function (lyr){
        var ctrlArr = lyr.aktControl;

        var oCtrls = map.controls;
        for(var i=0;i<oCtrls.length;i++)
            if(oCtrls[i].CLASS_NAME.replace(/OpenLayers.Control./,"") == ctrlArr[1] && oCtrls[i].displayClass == ctrlArr[2] && ctrlArr[3])
            {   editControl.activateControl(oCtrls[i]); //oCtrls[i].active = true;
                break;
            }
    },
/*
    saveActiveControl : function (lyr){
        var oCtrls = map.controls;
        var ctrlArr = [6, oCtrls[6].CLASS_NAME.replace(/OpenLayers.Control./,""), oCtrls[6].displayClass, oCtrls[6].active];
        for(var i=3;i<oCtrls.length;i++)
                if(oCtrls[i].active && (oCtrls[i].CLASS_NAME.replace(/OpenLayers.Control./,"")!="MousePosition"))
                    ctrlArr[0] = [ i, oCtrls[i].CLASS_NAME.replace(/OpenLayers.Control./,""), oCtrls[i].displayClass, oCtrls[i].active];
        lyr.aktControl = ctrlArr[0];
    },
*/    
    CLASS_NAME : "objOLC.ControlState"
}

//objOLC.ControlState.setActiveControl(_aktLayer);
//objOLC.ControlState.saveActiveControl(_aktLayer);

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