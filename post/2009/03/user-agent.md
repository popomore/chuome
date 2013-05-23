# 闲谈userAgent

- pubdate: 2009-03-06

--------------------------


这两天把《ppk on javasript》看完了，这本书不太适合做大学教材，也不太适合初学者，总觉得ppk是在讲浏览器界和JS的界的八卦。他不单纯讲技术，还包括一些设计方法，还有一些[cref 164 争议的地方]。

在谈到浏览器的兼容性时，回忆到了浏览器大战那个时候。一说到浏览器大战，一般都会想到windows捆绑ie战胜了Netscape，虽然事实却是如此，但其中也有一些小八卦，userAgent就是其中的一个。用户代理是指一些使用特定网络协议的客户端，浏览器就是其中之一，但还包括爬虫，email客户端，手机等等。

浏览器在发送HTTP请求的时候，在请求包头会带有userAgent的字符串来证明用户代理的真身。早在1995年，Netscape强盛一时，与他的老对手Mosaic展开竞争，那是IE才发布了1.0。那时浏览器的开发五花八门，并没有正规的协议和标准，所以一个页面在不同的浏览器中可能会面目全非。有个被ppk称为“笨蛋”的人想出一个办法，因为Netscape的userAgent是以Moziila开头的，而Mosaic的是以Mosaic开头的，所以通过辨认字符串开头来辨认浏览器。因为当时Netscape比较先进，而且用户市场比较大，所以很多web开发者都去适应Netscape这个浏览器。

IE也想进入这个市场，也想出了一个办法，既然你是通过userAgent字符串来辨认的，那我索性把userAgent也改成Moziila算了。IE通过这种方法绕过了浏览器检测，用户使用它就没有问题了。如果IE没这么做，那么很多网站都会面目全非，那用户还会去用它么？就像不久前的firefox，一上只支持IE6的网站就不成样子。

最终由于种种原因，IE战胜了Netscape，但这并没有结束，直至今日浏览器大战任在展开。IE，firefox，opera，safari，还有刚进入的chrome，他们都沿用了以Moziila开头的userAgent字符串。不仅如此，由于现在IE的市场占有量超过一半以上，其他浏览器竞相模仿。因为IE的userAgent中会包含“MSIE + 版本号”的字符串，很多浏览器照葫芦画瓢，模仿IE以前的手段，也在字符串中加入MSIE。随便找一条

> Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 4.0; en) Opera 8.51

其中含有MSIE6.0，但还能辨认出是opera。ppk在书中有一条

> Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2)

他称为是safari1.3.2，我没有验证过，但这条中完全无法与IE区分。

现在大多数浏览器都是以Moziila开头（[opera在5.0以后有部分是以opera开头的](http://www.botsvsbrowsers.com/category/8/index.html)），后面一般是版本号，但这两个字符串已经没有任何意义，这种方面到挺一致的，怎么不在其他地方更加支持一点标准。如果你也想知道自己浏览器的userAgent可以点[这里](https://dl.getdropbox.com/u/358534/jsdemo/userAgent.html)。

### 我现在在用的浏览器userAgent：

chrome 1.0.154.48
Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US) AppleWebKit/525.19 (KHTML, like Gecko) Chrome/1.0.154.48 Safari/525.19

IE6
Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322)

Firefox/3.0.6
Mozilla/5.0 (Windows; U; Windows NT 5.2; zh-CN; rv:1.9.0.6) Gecko/2009011913


safari4 beta 528.16
Mozilla/5.0 (Windows; U; Windows NT 5.2; zh-CN) AppleWebKit/528.16 (KHTML, like Gecko) Version/4.0 Safari/528.16

Opera/9.64
Opera/9.64 (Windows NT 5.2; U; Edition IBIS; zh-cn) Presto/2.1.1

