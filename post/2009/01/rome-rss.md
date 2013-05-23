# ROME读解－解析过程

- pubdate: 2009-01-06

--------------------------


[ROME](http://wiki.java.net/bin/view/Javawsxml/Rome)是一款能够解析和生成RSS/ATOM的java框架，他支持到目前为止的所有版本(RSS 0.90,RSS 0.91 Netscape,RSS 0.91 Userland,RSS 0.92,RSS 0.93,RSS 0.94,RSS 1.0,RSS 2.0,Atom 0.3,Atom 1.0 )。你可以直接使用这个框架，也可以在这个框架上进行开发，比如自己添加module。

如果只想解析RSS，那么只需以下两句话，返回的是一个SyndFeed对象，这个对象可看作一个中转的模型，可以转换成其他任何版本。

SyndFeedInput input = new SyndFeedInput();
SyndFeed feed = input.build(new XmlReader(feedUrl));

虽然表现的那个简单，其实背后还是有一套强大的解析机制。

1. 实例化一个SyndFeedInput类，用这个来解析RSS并返回SyndFeed
2. 将SyndFeedInput类代理给了WireFeedInput类，SyndFeedInput类的build方法对应于WireFeedInput类的build方法，将所有的解析工作交给了WireFeedInput类。
3. WireFeedInput的一个私有方法将返回一个FeedParsers类，这个类继承了PluginManager类。PluginManager类将从rome.properties文件中载入所有的parser,genarator,converter和modules，FeedParsers类则从中获得能够解析来源文件的解析器（返回WireFeedParser接口）。
4. 用所得的解析器来解析来源文件，最后返回一个WireFeed对象。如果解析RSS的话会返回Channel，而解析ATOM会返回Feed，Channel和Feed都是集成WireFeed的。
5. 最后解析的WireFeed由WireFeedInput返回，用来实例化SyndFeedImpl类（继承SyndFeed接口），其实就是用SyndFeed将WireFeed封装起来，SyndFeed代表着中间模型，而WireFeed为这种版本的模型。
6. SyndFeedImpl类会根据来源文件的类型获得转换器，这个转换器会将WireFeed中间的数据添加到SyndFeed中（就是自己的实例）。
7. 最后SyndFeedImpl类不再是空壳，这个模型将被最后返回。
[![](https://rome.dev.java.net/images/HowRomeWorks.png)](https://rome.dev.java.net/images/HowRomeWorks.png)
这个过程可以对照上图，还是比较形象的。现在解释一下module是什么，其实在看rome的时候一直不清楚此中所说的module到底意味着什么。之后看了[自定义module的过程](http://wiki.java.net/bin/view/Javawsxml/Rome05TutorialSampleModule)，发现module其实就是对应着各种命名空间，可以在RSS中插入其他元素。所以rome支持对其他命名空间的扩展，[GeoRSS](http://georss.org/)就是其中一种扩展。如果对这个感兴趣可以看看[怎么扩展rome](http://wiki.java.net/bin/view/Javawsxml/Rome05TutorialSampleModule)的。



