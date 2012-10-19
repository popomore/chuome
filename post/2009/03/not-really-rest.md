# 伪REST

- date: 2009-03-15

--------------------------


不久前[月光推荐了本书](http://www.williamlong.info/archives/1728.html)——《RESTful Web Services》，我也正好在看这书。不知道月光是没啥写出来了还是深有感触才写了这篇什么都没说的文章，[怪不得有人跟他掐架](http://maozzz.com/blog/2009/williamlong-freedom-responsibility/)，我保持中立说我自己的事。

我也是刚开始接触REST，但这东西早已有耳闻，现在也算有点小收获，写一些自己的理解。


### 资源统一定位

REST最重要的一点就是将资源用URL的形式暴露出来，由于[cref 397 URL的特性]可以指定一个特定的资源，任何一个资源都可以用一个URL来表示（如果考虑到301重定向，也可以有两个或多个表示）。但资源的URL不是胡乱定义的，而是基于一定规则有一定含义的URL。如果我想表达某个用户，那么URL可以写成


> http://host/user/id，如我的豆瓣（http://www.douban.com/people/popomore/）


其中每一级都是有含义的，host代表首页（S3中就是桶列表）；host/user代表一个用户的目录，其中包含了所有的用户（S3中就是一个独立的桶）；host/user/id代表了一个用户，根据ID来指定所以这是唯一的（S3中就是桶中的一个对象）。根据上述说法，那么我的豆瓣就可以用http://www.douban.com/people/popomore/来表示，而且是唯一的。

但有些网站比较奇怪，包括豆瓣，他们的用户一级是无效的，比如你输入http://www.douban.com/people，就会返回一个404页面。按我的理解应该返回所有的用户，但这对于网站来说可能没有意义，用户需要看所有人的列表来干什么。那么索性可以把这一级去掉，将用户名直接放在域名后面，就像twitter一样，http://twitter.com/popomore。这是我的看法，我觉得应该让每一层都有所含义，而不是为了说明什么，如果是这样可以将URL写成这样http://www.douban.com/my/name/is/popomore。

REST用这种方式的URL来表示资源对于搜索引擎也是很友好的，很多搜索引擎无法辨识或者辨识不好请求字符串，就是URL后面带问号的（不了解的看[cref 397 这里]）。以前都是通过加入不同的参数来请求资源，人可以很聪明，而搜索引擎并不是，他可能把后面的参数都去掉而都当成了一个东西。所以REST这种资源的统一定位有利于SEO。


### 统一方法接口


资源用URL暴露之后，那么要对其进行操作。和以往的RPC不同，REST支持CRUD方法，通过HTTP的GET,POST,PUT,DELETE方法分别获取，创建，修改，删除资源。这句话其实已经说烂了，每篇关于REST的文章肯定会说这句话，因为这是精髓。

作为轻量级的web service，与SOAP有很大的不同，其实我也没用过SOAP，但他是基于XML-RPC的，且多用于programmable web。REST对于任何资源一视同仁，只有四种方法，而不是在参数后面加上方法的名字，也不是在URL上加上方法的名字。按照上面说的每一个URL只代表一个资源，并不应该包含任何操作，如http://www.douban.com/people/popomore/create这URL是错误的，他表示的是一种行为，创建一个叫popomore的用户，但这种行为应该放到HTTP方法中。如http://www.douban.com/people/popomore?method=create也是错误的，这种是RPC方法，根据不同的参数调用不同的方法。而REST这种CRUD方法为所有资源提供了相同的接口，服务器端直接分发处理。


### PUT和POST


上面提到了4种方法，而PUT和POST比较相近。POST是用来创建资源，PUT是用来更新资源的，如果把PUT看作是对空对象的跟新，那么也就是创建了这个对象。但这两者还是有根本区别的

PUT只作用于对象本身，如对http://www.douban.com/people/popomore/发送PUT请求，就是对这个用户名进行修改，改成其他名字。但如果这个用户不存在，那么该URL本身就是无效的，那么就无法指定资源发送PUT请求。

POST是作用于对象列表，S3中的桶，可以对http://www.douban.com/people/发送POST请求来新建用户，而不是直接对用户本身发送POST请求，这与PUT有本质的区别。


### 对人和机器一视同仁


REST开放统一接口还有另一个原因，就是同时支持human web和programmable web。human web是指认为人们通过浏览器浏览网页的方式，programmable web是一些机器或者程序通过web service来获取数据的方式，而现在这两种同时支持相同接口，可以减少开发成本。

但是human web有一个缺点，**HTML4的表单只支持两种方式GET和POST**，这也是一点困扰，所以现在只能用POST来模拟PUT和DELETE，所以对于human web来说REST是不完整的。


### 伪REST


现在很多网站都标榜自己的网站，开放的API是REST，但有很多都有缺陷，不是真正的REST，是**伪REST**。Roy T. Fielding就在抱怨[为什么有那么多API说自己是REST](http://roy.gbiv.com/untangled/2008/rest-apis-must-be-hypertext-driven)，刚才所说的human web也不是完全的REST。

豆瓣中把书，电影，音乐都定义成subject，在分类中才是book，movie，music。一般来看应该把对象定义在对象列表之下，比如要找某本书应该是http://www.douban.com/book/id，而不是http://www.douban.com/subject/id，这个URL就无法辨认是书，电影还是音乐。

豆瓣中如果想读一本书，当点击想读时会把请求发向http://www.douban.com/subject/id/?interest=wish&ck=BIqy，这是很明显的RPC方法，如果是在读interest就为do，读过就是collect。能不能想个更REST的方法呢？这些动作都是由用户发出的，也就是说这些是每个用户所拥有的而且并不相同，那么可以把这些作为一个子集。


> http://www.douban.com/people/popomore/wish
http://www.douban.com/people/popomore/do
http://www.douban.com/people/popomore/collect


点击某个按钮时就对其中一个链接发送POST请求，新建一个资源，这个资源可以重定向到原来这本书的链接。如果需要所有用户想读的书就可以向http://www.douban.com/people/popomore/wish发送GET请求，获取书籍的列表。可能这个方法不是很好，但可以继续改进做出跟RESTful的东西。
