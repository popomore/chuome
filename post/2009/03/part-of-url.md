# 截肢URL

- date: 2009-03-12

--------------------------

对于URL大家都不会陌生，每天上网地址栏上都会显示一串字符，那就是URL——统一资源定位符。其实URL是来源于URI——通用资源标志符，URI可以定义各种资源，使得各种资源都有一对一的标识，而URL只是其中的一种。URN也是URI的一种，像ISBN（国际标准书号）就是URN的一个例子，用来标识每一本书。

用过FTP的朋友肯定见过如下链接：

> ftp://用户名:密码@地址:端口

使用浏览器输入这个链接就可以进入目录，而不用其他FTP工具。因为浏览器支持FTP协议，所以这样的行为才被认可。FTP也是URL的一种，只是协议于最常见的超链接不同。

在地址栏中常见如下的链接，各个部分代表着不同的意义。

> http://chuo.me:80/2009/03/migrate-from-blogger-to-wordpress?q=search#anchor

而在java和js中获取同一个部分有略微不同

### java

servlet作用于服务器，所以还能获取remoteHost和remotePort，即发出请求的主机名和端口，而与js对应的是本服务器的名称和端口。

链接的path是由getRequestURI()返回的，而在servlet中path是由ContextPath，ServletPath以及PathInfo组成。

ContextPath是在服务器配置的，就是整个项目的根目录。如果使用的是tomcat，则可在catalina下找到相应的映射文件。可用getContextPath()获取。

ServletPath是项目的配置文件，一般在web-inf的web.xml文件中，是将请求的path映射到相应的servlet上。可用getServletPath()获取。

PathInfo是除了前面两个到querystring的中间部分。可用getPathInfo()获取 。

java的getQueryString()方法有点奇怪，他只能获取请求字符串，但不能获取锚点，我还没有找到获取锚点的方法，请求赐教。

### js


js只能作用于客户端，所有获取的主机名和端口就是地址栏所显示的，js还有一个属性location.host表示主机名加端口。

上表中，js返回的query值是对的，而java则不对。如果js只想获取请求字符串，可用到location.hash属性，hash就代表锚点。请求字符串可通过以下方法获得：

```
var loc = window.location;
var querystring = loc.search.replace(loc.hash,'');
```