# 下拉框是使用CSS还是JS？

- pubdate: 2009-03-02

--------------------------


今天在看[《ppk谈javascript》](http://www.douban.com/subject/3022779/)的时候，ppk谈到结构、表现和行为分离，受到很大启发。其实之前也听到这种说法，html+css+js这三种东西分别代表不同的层面，不过我只是按照自己的理解去这么多，但做着做着就会发现自己又把他们掺和在一起了。

在谈到行为和表现分离时，ppk举了个例子说到下拉框。下拉框已经是很多网站的标配，把鼠标放在菜单栏上子菜单就会出现，离开后子菜单就会隐藏。虽说只是一个小小的功能，可以用JS实现，也可以用CSS实现，但到底哪种好却说不上来，个人喜好不同吧。

从可访问性上来说，用CSS来实现更加适合。当有些浏览器不支持js，或者禁止使用脚本时，那么js就无用武之地，而用CSS则不会遇到这个问题。相反，有些喜欢用键盘的人来说，他们是通过键盘来获取焦点，而CSS是鼠标选择器，所以不会理睬这种操作。最后ppk也没有给出一个明确的回答，但他倾向于CSS。到底使用哪种做法完全凭程序员的喜好、网站的用户群以及浏览器的支持度。

说道行为和表现分离，鼠标经过这种操作应该属于行为，但现在CSS也支持行为，将来CSS3中还支持动画，这不知道算不算越权行为。web开发其实很难真正分清你是干什么的，他是干什么的，很多东西会交织在一起。其实最后追求的还是可用性，这样做的目的也是将事情做的更好，而不是让你一刀齐，干干净净地划清界限。

PS：看到这个的时候买上去网上查，但是网上都是一些实现的方法，很少有探讨的帖子。在google上翻了十几页无果后觉得，可能我们都是技术性人才，只追求结果，也可能技术贴的PR比较高。
