# Node 小报三月六日

- pubdate: 2015-03-06

---

Atom [内置了对 babel 的支持](http://blog.atom.io/2015/02/04/built-in-6to5.html)，有使用这个编辑器的同学不妨试一下。

io.js 以开放的管理方式吸引了很多的活跃贡献者，看看[中文版的 roadmap](http://roadmap.iojs.org/cn/)。

io.js 建了个 [NG 仓库](https://github.com/iojs/NG/issues)对未来的展望，里面对一些新特性讨论的非常激烈。

[Google 开源了基于 HTTP/2 的通用 RPC 框架：gRPC](http://googledevelopers.blogspot.com/2015/02/introducing-grpc-new-open-source-http2.html)，而且已经支持多种语言，不妨[尝试下 Node](https://github.com/grpc/grpc-common/tree/master/node)。

[jQuery 官方](http://plugins.jquery.com/) 建议把 plugin [迁移至 npm](http://plugins.jquery.com/)，官方已经不能发布了。从 [npm 的规划](https://github.com/npm/npm/wiki/Roadmap)来看会把一部分重心放到浏览器模块来。

ES6 即将被发布，[并将被命名为 ES2015](https://esdiscuss.org/topic/javascript-2015#content-47)(ES6 == ES2015)，以后可能就以年来发布版本了。

随着 ES6 发布的临近，各 AST 解析器的库都开始支持，并[发起了 estree 项目](https://github.com/estree/estree)，这是一个 AST 的规范，继承原来 SpiderMonkey API，并新增 ES6 的规范，从成员可以看出他的重要性。

* Dave Herman (Mozilla)
* Ingvar Stepanyan ([Acorn](https://github.com/marijnh/acorn))
* Mike Sherov ([Esprima](https://github.com/jquery/esprima))
* Michael Ficarra ([@michaelficarra](https://github.com/michaelficarra))
* Sebastian McKenzie ([Babel](https://github.com/babel/babel))
* Kyle Simpson ([@getify](https://github.com/getify))

还有另一个规范 [Shift AST](https://github.com/shapesecurity/shift-spec) 是和 [SpiderMonkey 不兼容的](https://github.com/estree/estree/issues/30)，但我相信两个团队的目标是相同的。

这个 PPT 有关于 [Javascript 的新方向](https://github.com/tc39/tc39-notes/blob/master/es6/2015-01/JSExperimentalDirections.pdf)，大家不妨看看。Sane mode 会去除一些 JS 的糟粕，Sound Mode 会给 JS 增加类型，V8 已经计划实现了。
