# ubuntu下使用jiwai和twitter

- date: 2009-02-20

--------------------------


我同时在使用[jiwai](http://jiwai.de/)和[twitter](http://twitter.com/)，这两个都是[cref 150 时下流行的微博客]。我一般都写jiwai，然后同步到twitter，但我也要看twitter好友的消息，所以我两个都要用到。而且需要同时在ubuntu和win下使用，所以跨平台也是很重要的。下面说一下我的解决方案吧。

1、直接使用web


如果要跨平台，那么想都不用想直接在网页上更新是成本最小的。不管什么系统总会有浏览器，先不管浏览器的兼容性，但更新消息绝对是没问题的。但这种方式是最不能让人接受的，微博客的好处就是他无处不在，桌面客户端，手机等各种平台都可以使用，用户是不会守着浏览器过一辈子的。

2、gtalk之类的IM

jiwai绑定了多种IM，包括QQ、MSN、Gtalk等。我选择了gtalk，其他偶尔用用，只要给IM发送"on"就能自动切换。我选择gtalk是因为我喜欢他的简洁，而且聊天记录可以保存到gmail。ubuntu下我是用pidgin来当gtalk的客户端，当然还有MSN。但这种方式也有不便，回复别人等操作都需要手工来执行，有点命令行的感觉。对一些geek来说可能这就足够了，但对于广大用户还是不够的。

3、firefox插件

如果你使用firefox，那么这觉得是一个很好的组合，[TwitterFox](https://addons.mozilla.org/zh-CN/firefox/addon/5081)和[JiwaiFox](http://17th.name/2009/02/15/jiwaifox/)。他们都是firefox的扩展，使用很方便，只要ff一直开着就行。其实这组我用了很久，直到我实在受不了他没有retweet的功能，迫不得已迁走。不过[现在twitterfox已经有retweet的功能](http://twitterfox.net/)，可以考虑回来。

4、pidgin插件

之前第二条我说过用pidgin来通过gtalk来写jiwai。[现在twitter也可以](http://www.downloadsquad.com/2009/01/18/how-to-add-twitter-and-facebook-support-to-pidgin-for-windows/)，只需安装一个插件[pidgin-twitter](http://honeyplanet.jp/pidgin-twitter/index.html.en)，无论是windows还是linux。安装后在pidgin中启用他，然后用gtalk添加twitter@twitter.com账户，双击这个账户就可以看到tweets了。

5、Adobe AIR


Adobe AIR刚发布的时候并没有觉得他很试用，到有点“你干嘛来趟这浑水”的味道。但现在Adobe AIR的跨平台使我兴奋不已，因为我可以在任何地方使用他，而且开发者只需专心他们的应用。在Adobe AIR上有一个很好的twitter客户端[twhirl](http://www.twhirl.org/)，不仅漂亮，而且功能强大，并且集成了其他的一些应用[TwitPic](http://twitpic.com/)等。jiwai也在Adobe AIR上开发一个客户端[ijiwai](http://labs.geowhy.org/ijiwai/)，虽然还不成熟，存在很多[bug](http://jiwai.de/popomore/statuses/15238639)，但还是值得期待的。今天从[tsing](http://jiwai.de/tsing/)同学那里知道了[山寨twhirl](http://www.douban.com/group/topic/5279422/)，用twhirl直接登入jiwai，还能用到twhirl的功能，真是两全其美。


这些就是我使用jiwai和twitter客户端的心路历程，也许将来我还是会换，那是另外一个故事。

