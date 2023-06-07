function OLMap(config) {
    if(!config) config = {}

    //----------
    //Agregando Mapa
    //----------
    var box = new OpenLayers.Bounds();
    box.extend(new OpenLayers.LonLat(-81.6244425, 23.005665));
    box.extend(new OpenLayers.LonLat(-81.4814517, 23.079198));
    var map = new OpenLayers.Map(config.id || "viewmap", {
        autoUpdateSize: true,
        maxExtent: box,
//        zoomMethod:null,
        displayProjection: new OpenLayers.Projection("EPSG:4326"),
        controls:[]
    });

    map.numZoomLevels=config.numZoomLevels || 17;
    map.zoom=config.zoom || 12;
    map.posCenter = map.posCenter || {lon:-81.23297,lat:23.00698};
    //----------
    //agregando capa base Tiles
    //----------
    var layer = new OpenLayers.Layer.OSM(config.titleMap || "Cuba",(config.source || "http://localhost/maps/tiles")+"/${z}/${x}/${y}.png",
        {
            numZoomLevels:map.numZoomLevels,
            isBaseLayer: true,
            tileOptions:{ crossOriginKeyword: null }
        }
    );
    map.addLayer(layer);
    console.log(map.posCenter);
    map.setCenter(
        new OpenLayers.LonLat(map.posCenter.lon, map.posCenter.lat).transform(
            new OpenLayers.Projection("EPSG:4326"),
            map.getProjectionObject()
        ), map.zoom
    );


    map.zoomTo(map.zoom);
//    map.zoomToMaxExtent();
    map.showInfoMap = true;

    var renderer = OpenLayers.Util.getParameters(window.location.href).renderer;
    renderer = (renderer) ? [renderer] : OpenLayers.Layer.Vector.prototype.renderers;

    //----------
    //agregando capas de fondo
    //----------
    map.addLayer(bg = new OpenLayers.Layer.Vector("Info", {
            isBaseLayer: false,
            renderers: renderer,
            styleMap: new OpenLayers.StyleMap(
                {
                    "default": new OpenLayers.Style(
                        {
                            title: '${tooltip}',
                            pointRadius: 2,
                            fillOpacity: .04,
                            strokeOpacity: .5,
                            fillColor: "#0000FF",
                            strokeColor: "black"
                        }, {
                            context: {
                                getFillColor: function (feature) {
                                    // hide the resize handle at the south-east corner
                                    return feature.attributes.fillColor != "" ? '#F3986D' : feature.attributes.graphic;
                                },
                                getStrokeColor: function (feature) {
                                    // hide the resize handle at the south-east corner
                                    return feature.attributes.strokeColor != "" ? '#000000' : feature.attributes.graphic;
                                }

                            }
                        })
                }
            )}
    ));
    //----------
    //agregando capas de trabajo
    //----------
    map.addLayer(map.lw = new OpenLayers.Layer.Vector("Region", {
//            visibility:false,
            isBaseLayer: false,
            renderers: renderer,
            styleMap: new OpenLayers.StyleMap(
                {
                    "default": new OpenLayers.Style(
                        {
                            title: '${tooltip}',
                            pointRadius: 4.5,
                            fillOpacity: .2,
                            strokeOpacity: 0.6,
                            fontColor: "maroon",
                            fontSize: "14px",
                            fontFamily: "Courier New, monospace",
                            fontWeight: "bold",
                            labelAlign: "cm",
                            labelXOffset: "0",
                            labelYOffset: "0",
                            labelOutlineColor: "white",
                            labelOutlineWidth: 2,
                            fillColor: "${getFillColor}",
                            strokeColor: "${getStrokeColor}",
                            label: "${getInfoMap}",
                            fillOpacity: "${getFillOpacity}"
//								labelSelect: false,

                        },
                        {
                            context: {
                                getInfoMap: function (feature) {
                                    return map.showInfoMap && feature.attributes.showAlias && feature.attributes.infoMap ? feature.attributes.infoMap : "";
                                },
                                getFillColor: function (feature) {
                                    return feature.attributes.fillColor == null ? feature.attributes.fillColor = '#F3986D' : feature.attributes.fillColor;
                                },
                                getFillOpacity: function (feature) {
                                    return feature.attributes.fillOpacity == null ? feature.attributes.fillOpacity = 1 : feature.attributes.fillOpacity;
                                },

                                getStrokeColor: function (feature) {
                                    return feature.attributes.strokeColor == null ? feature.attributes.strokeColor = '#000000' : feature.attributes.strokeColor;
                                }

                            }
                        })
                }
            )
        } ))

    map.addLayer(map.nlw = new OpenLayers.Layer.Vector("Punto", {
        isBaseLayer: false,
        renderers: OpenLayers.Layer.Vector.prototype.renderers,
        styleMap: new OpenLayers.StyleMap({
            "default": new OpenLayers.Style({
                pointRadius: 8,
                strokeOpacity: 1,
                fillColor: "blue",
                strokeColor: "aqua",
                externalGraphic: "${getGraphic}",
                graphicWidth: 25, graphicHeight: 28, graphicYOffset: -28,
                label: "${getInfoMap}",
                fontColor: "${getFillColor}",
                fontSize: "12px",
                fontFamily: "Courier New, monospace",
                fontWeight: "bold",
                labelAlign: "cm",
                labelXOffset: "0",
                labelYOffset: "0",
                labelOutlineColor: "white",
                labelOutlineWidth: 2,
                fillOpacity: "${getFillOpacity}"
            }, {
                context: {
                    getGraphic: function (feature, prop) {
                        return feature.renderIntent == "default" && feature.attributes.graphic ? './img/' + feature.attributes.graphic : "./img/marker-icon.png";
                    },
                    getInfoMap: function (feature) {
                        return map.showInfoMap && feature.attributes.showAlias && feature.attributes.infoMap ? feature.attributes.infoMap : "";
                    },
                    getFillColor: function (feature) {
                        return feature.attributes.fillColor == null ? feature.attributes.fillColor = '#000000' : feature.attributes.fillColor;
                    },
                    getFillOpacity: function (feature) {
                        return feature.attributes.fillOpacity == null ? feature.attributes.fillOpacity = 1 : feature.attributes.fillOpacity;
                    },
                    getStrokeColor: function (feature) {
                        return feature.attributes.strokeColor == null ? feature.attributes.strokeColor = '#000000' : feature.attributes.strokeColor;
                    }
                }
            }),
            "select": new OpenLayers.Style({
                pointRadius: 12,
                strokeOpacity:1,
                fillOpacity:.6,
                fillColor: "black",
                strokeColor: "#4378A8",
                externalGraphic: null,
//                                graphicWidth: 32, graphicHeight: 36, graphicYOffset: -20
            }, {
                context: {
                    getGraphic: function(feature,prop) {
                        return feature.renderIntent=="default" && feature.attributes.graphic ? feature.attributes.graphic : "http://localhost/maps/images/marker-icon.png";
                        //return feature.renderIntent=="select" && feature.record.graphic != feature.attributes.graphic ? "http://localhost/maps/images/marker-icon.png" : "";
                    }
                }
            })
        })
    } ));
    //----------
    //agregando controles
    //----------
    map.addControl(new OpenLayers.Control.Zoom());
    map.addControl(new OpenLayers.Control.Navigation());
    map.addControl(new OpenLayers.Control.MousePosition({displayProjection:new OpenLayers.Projection("EPSG:4326")}));
    map.sfc = new OpenLayers.Control.SelectFeature(
        [map.nlw,map.lw],
        {
            active:false,
            clickout: true, toggle: false,
            hover: false, highlightOnly: true,
            multiple: false,
            toggleKey: "ctrlKey", // ctrl key removes from selection
            multipleKey: "shiftKey" // shift key adds to selection
        }
    );
    map.addControl(map.sfc);
    map.dplc= new OpenLayers.Control.DrawFeature(map.lw, OpenLayers.Handler.Polygon);
    map.addControl(map.dplc);
    map.dplc.deactivate();
    map.dptc= new OpenLayers.Control.DrawFeature(map.nlw, OpenLayers.Handler.Point);
    map.addControl(map.dptc);
    map.dptc.deactivate();
    //----------
    //funciones de activacion
    //----------
    map.deactivateControl = function() {
        map.dptc.deactivate();
        map.dplc.deactivate();
    }

    map.activatePoint = function() {
        map.dptc.activate();
        map.dplc.deactivate();
        map.updateSize();
    }

    map.activateSelect = function() {
        map.sfc.activate();
    }
    map.deActivateSelect = function() {
        map.sfc.deactivate();
    }

    map.activatePolygon = function() {
        map.dplc.activate();
        map.dptc.deactivate();
        map.updateSize();
    }
    //----------
    //evento de capas
    //----------
    map.lw.events.on({
        featureselected: function(feature) {
            map.onSelectFeature(feature);
        },
        featureunselected: function(feature) {
            map.onUnSelectFeature(feature);
        },
        featureadded: function(feature) {

            map.onAddFeature(feature);
        },
//            beforefeaturemodified: function(feature) {
//                me.changeStateModify(feature);
//            },
        featuremodified: function(feature) {
            map.onModifyFeature(feature);
        }
    });

    map.nlw.events.on({
        featureselected: function(feature) {
            map.onSelectFeature(feature);
        },
        featureunselected: function(feature) {
            map.onUnSelectFeature(feature);
        },
        featureadded: function(feature) {
            map.onAddFeature(feature);
        },
//            beforefeaturemodified: function(feature) {
//                me.changeStateModify(feature);
//            },
        featuremodified: function(feature) {
            map.onModifyFeature(feature);
        }
    });

    map.onSelectFeature = function() {return true; }
    map.onUnSelectFeature = function() {return true; }
    map.onAddFeature = function() {return true; }
    map.onModifyFeature = function() {return true; }

    //----------
    //json and coordenadas
    //----------
    map.getCoordinates = function(feature) {
        var vs = feature.feature.geometry.getVertices(false);
        var arr = [];
        for(var i in vs) {
            var v = vs[i];
            arr.push(
                new OpenLayers.LonLat(v.x, v.y)
                .transform( map.getProjectionObject(), map.displayProjection)
            )

        }
        return arr;

    }
    map.getStringCoordinates = function(feature) {
        var str = "", cs = map.getCoordinates(feature);
        for(var i in cs) {
            var v = cs[i];
            str = str + v.lon+";"+v.lat+" ";
        }
        str = str.trim();
        return str;

    }

    var geojson = new OpenLayers.Format.GeoJSON();
    map.serialize = function(feature) {
        return geojson.write(feature, true);
    }
    map.deserialize = function(feature) {
        return geojson.read(feature);
    }

    //----------
    //agregando elementos
    //----------
    map.addPoligonByPoints = function(pointList) {
        for(i in arr) {
            var p = arr[i]
        }
        var linearRing = new OpenLayers.Geometry.LinearRing(pointList);
        polygonFeature = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Polygon([linearRing]));
    }
    map.addPoligonByStr = function(str) {

    }
    map.addPoint = function(lon,lat, attrs) {
        var lonlat = new OpenLayers.LonLat(lon, lat).transform( map.displayProjection, map.getProjectionObject())
        var point = new OpenLayers.Geometry.Point(lonlat.lon, lonlat.lat);
        var pointFeature = new OpenLayers.Feature.Vector(point, attrs);
        map.nlw.addFeatures([pointFeature]);
        var feature = {feature:pointFeature}
        return feature;
    }
    map.addPointByStr = function(str, attrs) {
        var arr = str.split(';');
        return map.addPoint(arr[0],arr[1], attrs);
    }

    return map;
}
