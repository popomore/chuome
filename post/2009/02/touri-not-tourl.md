# File类请使用toURI()而不是toURL()

- pubdate: 2009-02-20

--------------------------


File类存在两个看起来很相似的方法toURI()和toURL()，这两个方法都是将文件转换成一个链接，可以网络访问。只是URI和URL的应用范围不同，URI来的更广。

那么为什么要使用toURI()而不是toURL()呢？如果要将文件转换成一个URL的话，这样来得更简单。因为toURL()存在bug。

[在File转化成URI的时候](http://www.jroller.com/santhosh/entry/converting_file_to_url)，会将链接中的特殊字符如#或！等编码，而toURL()确不会。

如将“C:Documents and Settingstest.xsl”进行转化
toURI()得到的是：file:/C:/Documents%20and%20Settings/test.xsl
toURL()得到的是：file:/C:/Documents and Settings/test.xsl

也就是说toURI()将空格都转译成了%20，而toURL()什么都没管。sun也有人提到了这个bug（[4273532](http://bugs.sun.com/bugdatabase/view_bug.do?bug_id=4273532)，[6179468)](http://bugs.sun.com/bugdatabase/view_bug.do?bug_id=6179468)。

虽说在浏览器中没有转译不会有问题，因为有的浏览器已经自动转译了。但很多程序或者组件对于这样的路径都会抛出异常，认为是有错误的，[这个bug中就有实实在在的例子](http://bugs.sun.com/bugdatabase/view_bug.do?bug_id=4273532)。

所以要将File转换成URL的话，请使用file.toURI().toURL()，而不是file.toURL()。
