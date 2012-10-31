# google

- date: 2008-10-31

--------------------------

最近在做的事是关于WMS与google map整合的事，最头疼的还是投影。本来能很好的显示出来，但换个投影地图就不知道跑到哪里去了。就算能显示出来，叠在google map也不知道哪跟哪了。所以还是先研究下google map坐标系。

google map使用的是被定义为EPSG：900913 的[Spherical Mercator](http://crschmidt.net/%7Ecrschmidt/spherical_mercator.html)，他必须以米为单位。墨卡托投影是圆柱投影，投影结果使得两极极度变形，所以google放弃纬度85度以上的部分。经转换后，地球变成了一个正方形，范围计算如下

```
maxextent = [-20037508.342789244, -20037508.342789244, 20037508.342789244, 20037508.342789244]
20037508.342789244 = 2 * 6378137 / 2.0 （6378137为地球长半径）
```

使用这投影是为了更好的分割，因为 google map 默认将每个tile切分成 (256 * 256)，所以整个地图需要是正方形的。那么开始切分了，初始化阶段也就是level为0，整个地图为一张 (256 * 256) 的图片。那么level为1时，地图扩大一倍变成了 (512 * 512)，也就是说变成了4张 (256 * 256) 的图片，以此类推，这样形成四叉树的结构。图片是按照z/x/y.extension的形式存储的，z为缩放级别，xy为坐标，google map的坐标原点是在左上角。

[![](http://i.msdn.microsoft.com/Bb259689.5cff54de-5133-4369-8680-52d2723eb756%28en-us,MSDN.10%29.jpg)](http://i.msdn.microsoft.com/Bb259689.5cff54de-5133-4369-8680-52d2723eb756%28en-us,MSDN.10%29.jpg)

那么有人要说level是怎么确定的呢？其实这就是比例尺，但跟通常意义上的比例尺不同，他称为resolution。比例尺是说实际物体跟地图之间的比例关系。而resolution是指单位像素所代表的单元格（units/pixel）。就像上面所说的初始的比例尺应该是

```
initialResolution = 20037508.342789244 * 2 / 256 = 156543.03392804062
```

每个像素代表 156543.03392804062 米。那么每增加一级，resolution 就减一半,level 为1时，resolution 就为 78271.516964020309。

google map除了有tile坐标系还有[像素坐标系](http://code.google.com/apis/maps/documentation/overlays.html#Google_Maps_Coordinates)，他的坐标原点设在地图的左上脚，位于(-180W，85N) 左右。横坐标为X，纵坐标为Y，google map api也有相应的类GPoint。在level0时，像素坐标为 (256 * 256)，也就是一张tile的像素值。level1时tile扩大一倍，像素坐标也扩大一倍，为(512 * 512)。

可以参考以下表格

level | tile | pixel | resolution
------ | ----- | ------ | --------
0 | 1 * 1(256 * 256) | 256 * 256 | 156543.03392804062
1 | 2 * 2(256 * 256) | 512 * 512 | 78271.516964020309
2 | 4 * 4(256 * 256) | 1024 * 1024 | 39135.758482010155
… | … | … | ...
n | 2^n * 2^n(256 * 256) | 256 * 2^n * 256 * 2^n | 156543.03392804062/2^n


根据上面的对比，就很容易将pixel和tile进行转换。那么经纬度呢？当然这个也是必须的，google map api提供了经纬度和像素值之间的转换。如果想知道具体怎么转的可以看一下[墨卡托投影](http://www.blogoutdoor.com/user1/8860/archives/2007/36455.html)的细节。如果需要的话可以下载这个python的[转换工具](http://www.maptiler.org/google-maps-coordinate-system-projection-epsg-900913-3785/globalmaptiles.py)
