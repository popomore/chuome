# 关于GeoJSON

- date: 2009-03-19

--------------------------


很早就知道有[GeoJSON](http://geojson.org/)这个东西，但一直没有关注。最近搞论文搞的头痛，论文搞的是GeoRSS，想做类似地图服务的。发现客户端和服务器端通信用XML成本太高，其实GeoJSON是个很好的解决方案，可以节省很多带宽。

那么我就来讨论下GeoJSON吧，先来看个例子


{ "type": "FeatureCollection",
"features": [
{ "type": "Feature",
"geometry": {
        "type": "Point",
        "coordinates": [102.0, 0.5]
      },
"properties": {"prop0": "value0"}
},
{ "type": "Feature",
"geometry": {
"type": "LineString",
"coordinates": [
[102.0, 0.0], [103.0, 1.0], [104.0, 0.0], [105.0, 1.0]
]
},
"properties": {
"prop0": "value0",
"prop1": 0.0
}
},
{ "type": "Feature",
"geometry": {
"type": "Polygon",
"coordinates": [
[ [100.0, 0.0], [101.0, 0.0], [101.0, 1.0],
[100.0, 1.0], [100.0, 0.0] ]
]
},
"properties": {
"prop0": "value0",
"prop1": {"this": "that"}
}
}
]
}


JSON是源于javascript对象，javascript对象（Object）就是用大括号括起来，中间以键/值的形式表现并用逗号分割，“键”就是对象的属性，而“值”就是该属性的值。javascript中还有个数组（Array），用中括号括起来，中间只有单个的值并用逗号分割。不管是对象还是数组，其中的值可以是任何元素（对象，数组，字符串，数字等），这就是此中结构的灵活之处。JSON与XML很相似，也具有层次结构，是一种轻量级的解决方案。

GeoJSON保留了JSON的结构，但增加了一些约束条件。




1. GeoJSON总是由一个对象组成，这个对象可以为要素集合（featurecollectioni），要素（feature）或者几何体（ geometry）。


2. GeoJSON对象**必须**包含一个type属性，type的值可为 "Point", "MultiPoint", "LineString", "MultiLineString", "Polygon", "MultiPolygon", "GeometryCollection", "Feature", or "FeatureCollection"。


3. Geometry对象是那些type值为 "Point", "MultiPoint", "LineString", "MultiLineString", "Polygon", "MultiPolygon", "GeometryCollection"的GeoJSON对象。Geometry对象除了GeometryCollection外**必须**包含一个coordinates属性，其中包含一个点列表。


4. Feature对象是type值为"Feature"的GeoJSON对象。Feature对象**必须**包含一个geometry属性，其值为一个Geometry对象。Feature对象**必须**含有一个properties属性，其值可为一个JSON对象。


5. GeometryCollection对象是type值为"GeometryCollection"的GeoJSON对象。代表一个几何型集合，与FeatureCollection不同的是他包含的是Geometry对象，而不是Feature对象。GeometryCollection对象**必须**含有一个geometries属性，其中包含一组Geometry对象。


6. GeoJSON对象可以有一个"bbox"属性，是"[minx,miny,maxx,maxy]"的结构，他表示了该对象的显示范围。


如上面的例子，由大括号括起来的都是GeoJSON对象，例子中是一个FeatureCollection对象，他包含了一组Feature对象，还可以添加这个集合的其他属性。每个Feature对像都包含一个Geometry对象和一个属性（JSON对象），Geometry对象有所不同，类型不同，coordinates的数据结构也不同。


1. **点**，表示点只需要经度和纬度，用中括号括起来代表一个点坐标。


{ "type": "Point", "coordinates": [100.0, 0.0] }





2. **线**，由一系列点组成，在一组有序点外面再括一个中括号。


{ "type": "LineString", "coordinates": [ [100.0, 0.0], [101.0, 1.0] ] }





3. **面**，在线的外面再加一个中括号，面列表中的线收尾必须一致。但为什么未免还要加个呢？为了表示面中的洞，第一项表示外围的圈，第二项（如果有的话）表示内围的圈。


{ "type": "Polygon",
"coordinates": [
[ [100.0, 0.0], [101.0, 0.0], [101.0, 1.0], [100.0, 1.0], [100.0, 0.0] ]
]
}





4. 除了以上还有多点，多线，多面就不多讲了，可以[自己去看看](http://geojson.org/geojson-spec.html)。


GeoJSON基本上就这些内容，跟详细的可以去[这里](http://geojson.org/geojson-spec.html)。GeoJSON只是为更好数据通信提供一个标准，现在已有[超过20个项目支持了GeoJSON](http://wiki.geojson.org/Users)，包括客户端的和服务器端的，而且[大多数语言都支持JSON](http://www.json.org/json-zh.html)。如果你喜欢这种更轻量级的解决方案，那么就加入进来吧。

一个OpenLayers的[简单例子](http://openlayers.org/dev/examples/vector-formats.html)：


//初始化map
var featurecollection = 'geojson对象';
var geojson = new OpenLayers.Format.GeoJSON(); //获得一个geojson的模板
var layer = new OpenLayers.Layer.Vector();
layer.addFeatures(geojson.read(featurecollection)); //用模板来解析这个geojson对象
map.addLayer(layer);
