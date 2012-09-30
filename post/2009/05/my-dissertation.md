# 关于论文

- date: 2009-05-05

--------------------------


五一前终于把弄了将近半年的论文搞定了，说是搞定其实还有很多后续工作。寒假后就开始实现我的想法，但由于只有一个人无法尽善尽美，尤其是性能问题很是困扰我。四月中旬开始写论文，熬了几个通宵在五一前终于写完了初稿。

给老板看后，他觉得我介绍成分偏多，自己做的没怎么写。我敢保证他没仔细看，也可能是不太了解我所做的吧。再者，我确实很少涉及具体的技术细节，因为这样看着不太像论文，更像一个项目需求分析。论文其实也就表达了我一个想法，但没有完全实现，如果融入web2.0元素，工作是巨大的，添加一个好友的模块就够我烦的了。所以我觉得只要把中心意思表达出来，具体做网站的细节可以不用谈。

我论文做的是地图分享，虽然这个名字很土，但确实是一种分享。我做的和[GeoCommons](http://geocommons.com/)有点像，其实我想做的是GeoCommons+[Mapufacture](http://mapufacture.com/)这样一个现在称之为NeoGeography的东西。

GeoCommons是一个空间数据仓库，可支持多种数据，包括shapefile、kml、CSV、GeoRSS等，上传后就变成了一个数据源，然后在制作地图的时候就可以添加这些数据源，这就是他的finder和maker。但并不能对上传的数据源进行修改，只能添加一些描述信息。就是说GeoCommons并不是一个数据编辑工具，而是着重于数据共享和数据表现。GeoCommons可以下载这些数据源，格式包括shapefile、kml、CSV。GeoCommons还有一个特色就是专题地图的制作，确实这样能很方便的制作专题地图，但是对于一般用户来说这并不是必需的。

反过头来看看Mapufacture，如果说GeoCommons的程度偏高，那么Mapufacture是实实在在的贫民化。他也有finder和maker两步，但finder只有一种途径feed，这是GeoCommons所没有的，先将feed上传，然后根据文中的内容对其进行地理编码。虽然这样比较方便，但这要取决于地理编码模块，我上传自己blog的rss，但一条也没有编码。maker有点相似，可添加之前上传的feed制作成地图。Mapufacture同样存在问题，无法修改上传的feed，而且整个网站使用起来并不是那么方便。

所以我想将这两个网站合并，建成一个地图分享网站。首先提出图层和地图的概念，这个概念两个网站都有但有所不同。图层是数据源，主要是空间数据的载体，每个图层只能有一种空间类型。将图层从地图中划分出来是为了更好的分享，这样数据可以是多来源的，在建立地图的时候选择性更多。图层可支持多种数据，包括shapefile、kml、GeoRSS、RSS，上传后可编辑，尤其针对RSS，可以手动让用户添加，但必须操作简单。地图主要用于数据展示，可以添加多个图层，可以改变元素的表现，但不能修改元素本身。

其次是如何分发数据，用户如何将自己制作的地图分享与他人。站内通过好友，而外链我的选择是GeoRSS，以RSS为载体是一种很好的选择，而且可以通过这种形式半自动的添加geotag。虽然kml已经被广泛使用，但kml更多使用在地理数据层面上，承载的内容并没有RSS丰富。只考虑到用户简单需求的话，用GeoRSS-Simple就可以解决了。

感觉自己做的论文不太学术，太应用了。不过现在GIS界都在往这方面发展，NeoGeography的提出也不过几年，大家都在探索阶段，现在最火的还是服务。将来可能数据已经不是问题，大家通过简单的编辑工具来制作地图，而平台本身只需要提供强大的过滤引擎和搜索引擎，那么谁都可以用这些数据。好了继续去做我的实例。