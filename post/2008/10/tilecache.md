# tilecache缓存地图

- pubdate: 2008-10-31

--------------------------


今天算是这几天来最开心的一天，因为困扰着我的问题终于解决了，当然只是一小部分。

我最终的目的就是将shapefile格式直接缓存在硬盘，然后用户访问时服务器直接获取图片就行了。由于我最后的论文是要用到geoserver的，然后就懒得看AGS，不用浪费那么多时间。geoserver提到的[缓存工具](http://geoserver.org/display/GEOSDOC/TileCache%20Tutorial)共有两个：[tilecache](http://tilecache.org/)和[geowebcache](http://geowebcache.org/)。geowebcache是java写的，整合进geoserer中。tilecache则是python写的一个小程序，最近又很喜欢python，所以就拿这个练练手。

tilecache是由[MetaCarta Labs](http://labs.metacarta.com/)开发的用来缓存地图，配合openlayers使地图显示更快。可以把tilecache想成一个中间件，WMS服务器不用自己缓存地图，tilecache可以帮他完成。tilecache支持多种服务器和多种OGC服务标准，以及支持多种请求方式和格式。

tilecache的[配置](http://bbs.esrichina-bj.cn/ESRI/viewthread.php?tid=33843)可以看ESRI论坛的教程，因为我是用ubuntu和apache的，可能配置上有些不同，但使用大致还是相同的。tilecache中有一个tilecache.cfg文件，这是个配置文件，当有用户请求时，tilecache会载入这个文件。下面是我的配置文件，

[cache]
type=GoogleDisk ＃默认是Disk，googledisk是以z/x/y.extension的方式存储
base=/tmp/tilecache ＃缓存的路径

[google] ＃图层的名称
type=WMSLayer ＃
url=http://192.168.1.106:8080/geoserver/wms ＃wms的url
layers=topp:states ＃wms所拥有的图层
extension=png
resolutions=156543.033900000,78271.516950000,39135.758475000,19567.879237500,9783.939618750,4891.969809375,2445.984904688,1222.992452344,611.496226172,305.748113086,152.874056543,76.437028271,38.218514136,19.109257068,9.554628534,4.777314267,2.388657133,1.194328567,0.59716428337097171575,0.298582142 ＃划分比例尺，不明白的可以看看[[google map的坐标系统]]
srs=EPSG:900913 ＃google map的投影
bbox=-20037508.3427892,-20037508.3427892,20037508.3427892,20037508.3427892 ＃显示的范围

如果不使用resolutions，也可以用maxResolution设定最大的比例尺，系统会根据level自动声称resolutions，但如果同时设置，resolutions会覆盖level。bbox和resolutions要根据不同的投影来计算，之前我就是犯了这个错误，用900913，但bbox设成了-180,-90,180,90,地图怎么也显示不出来。

接下来就用openlayers来显示，创建一个map，在option中resolutions和bbox都要和配置文件中的相同，单位要是米。

var options = {
resolutions:[156543.033900000,78271.516950000,39135.758475000,19567.879237500,9783.939618750,4891.969809375,2445.984904688,1222.992452344,611.496226172,305.748113086,152.874056543,76.437028271,38.218514136,19.109257068,9.554628534,4.777314267,2.388657133,1.194328567,0.59716428337097171575,0.298582142],
projection: new OpenLayers.Projection("EPSG:900913"),
units: "m",
maxExtent: new OpenLayers.Bounds(-20037508.34, -20037508.34,20037508.34,20037508.34),
};
map = new OpenLayers.Map('map',options);

添加google地图
var googleMap = new OpenLayers.Layer.Google(
"Google 卫星图",
{
type: G_SATELLITE_MAP,
sphericalMercator: true
}
);
map.addLayer(googleMap);

添加一个tilecache的WMS
wms= new OpenLayers.Layer.WMS(
"wms",
"http://localhost/tilecache/tilecache.py",
{
layers: 'google',
srs: 'EPSG:900913',
format: 'image/png',
transparent: true
},
{
maxExtent: new OpenLayers.Bounds(-14206537.827649845,2721171.5119208517,-7133550.0444934964,6549529.8947561011),
reproject: true,
opacity: 0.4,
isBaseLayer: false
}
);
map.addLayer(wms);

如果以能成功显示的话，那么恭喜你，你已经可以成功叠加了google map和tilecache生成的WMS，你也可以去缓存查看已缓存的图片。现在可以用openlayers的另一个类直接访问缓存，可用firebug来看下图片的请求地址，是以http://localhost/tilecache/tilecache.py/1.0.0/google/z/x/y.extension的形式。
tms = new OpenLayers.Layer.TMS(
"google",
"http://localhost/tilecache/tilecache.py/",
{
serviceVersion: "1.0.0",
layername: "google",
type: "png",
opacity: 0.4,
maxExtent: new OpenLayers.Bounds(-14206537.827649845,2721171.5119208517,-7133550.0444934964,6549529.8947561011),
isBaseLayer: false
}
);
map.addLayer(tms);

但这不是我的最终目的，我是想先缓存完图片然后再访问，而不是边访问边缓存。tilecache也想到了这点，他有一个小工具tilecache_seed.py，可以帮你完成这个工作。
python tilecache_seed.py "http://localhost/tilecache/tilecache.py" google 5 10 -14206537.827649845,2721171.5119208517,-7133550.0444934964,6549529.8947561011
上面代码是说将配置文件中图层名为google，在-14206537.827649845,2721171.5119208517,-7133550.0444934964,6549529.8947561011这个范围中的缩放等级为5到10的缓存起来，最后直接用OpenLayers.Layer.TMS访问就可以了。
