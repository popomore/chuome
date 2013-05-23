# blogger再次被封

- pubdate: 2009-05-16

--------------------------


我使用blogger也算很长时间了，[cref 391 最近才搬到wordpress上来]，也算是脱离了苦海。因为blogger屡次被伟大的墙挡住去路，这堵墙比柏林墙更具有杀伤力，因为他处于无形，而且又在暗处。

今天发现blogger打不开了，比以往更严重的是连blogger这个域名也无法进入。blogger有个好处就是编辑与发布分离，也就是说用户可以通过blogger.com进入撰写，修改或设置，而通过blogspot.com来发布博客，其他人只需登入blogspot.com的二级域名即可访问。而以往“墙”只封blogspot.com这个域名段，blogger可以进入，用户仍然可以撰写修改文章，只是其他人看不到了，可以当作个日记本。但这次则是将blogger.com也封锁了，至此google的blogger以被完全屏蔽，就连。

题外话，就在今年3月也发生过类似问题，google的最后一个代理IP被封锁。一般用户可将自己域名通过CNAME指向ghs.google.com，就可以代替blogspot.com。但ghs.google.com早早的被封，所以一般通过A记录指向一个IP，app engine有同样适用。但那几天所有的IP都被封锁，用户无法通过自定义域名去指向blogspot。不过这个时间不长，现在还存在[可以使用的IP](http://www.jmj.hk/post/408.html)。

这种方式可以无视GFW，但是原来的blogspot.com无法被重定向了。现在使用自己的二级域名依然能访问blogger，就是写文章时要挂代理了。
