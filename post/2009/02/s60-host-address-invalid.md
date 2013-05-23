# S60关于主机地址无效

- pubdate: 2009-02-23

--------------------------


前些天google出了google sync，然后我用我的N76[测试了一下](http://www.williamlong.info/archives/1690.html)。S60只能同步gmail里的contacts，但是不能同步google calendar，这个让我很绝望。不过S60 3rd还是有解决方法的，可以[安装calsync60来同步日历](http://www.web20share.com/2009/02/mobile-sync-google-sync-ovi-hozom-calsyncs60.html)。

一开始同步一切正常，但几天后再次同步却出现“主机地址无效”的错误。一开始以为google的地址改了，或者改成“http”，但还是不对。一度以为服务器错误，但搜下却没有相关的消息。

后来在google帮助中[找到了答案](http://www.google.com/support/forum/p/Google+Mobile/thread?tid=56660ee25a581b3f&hl=en)，nokia的缓存会覆盖syncML数据，XML中存在乱码无法被解析。于是我删除了原来同步的账户，再新建一个就可以了，这里还有[相关的讨论](http://www.scheduleworld.com/jforum/posts/list/2207.page)。

