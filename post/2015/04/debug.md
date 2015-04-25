# 使用 debug 调试代码

- pubdate: 2015-04-25

---

> 调试模块和日志模块不要混淆，而且日志模块也有很多功能，这里所说的日志都是调试信息

很多人使用传统的 `console.log` 来调试代码，也有不少人喜欢断点调试，本文会介绍如何使用 [debug](https://github.com/visionmedia/debug) 这个模块来调试。

## 现有的方式

`console.log` 很简单，不管是在浏览器端还是服务端的代码都可以这样调试，把期望的值打印出来，这是最直观的做法。

但有时候你会发现有些对象是无法用字符串展示的，比如一个有原型链的对象。这时需要使用 [node-inspector](https://github.com/node-inspector/node-inspector) 来调试，使用方式和 chrome 类似。

但这种方式对服务器并不友好，服务器部署的应用如何来调试呢？

## debug 的使用

debug 的 API 和 console 一致，请查看官方文档。在使用前需要先 require 模块，然后指定命名空间。

index.js

```js
require('./a');
require('./b');
```

a.js

```js
var debug = require('debug')('a');
debug('string %s', 'a');
```

b.js

```js
var debug = require('debug')('b');
debug('object %j', {b: 1});
```

建三个文件，`index.js` 依赖 `a.js` 和 `b.js`，这两个文件会打印日志。从代码看和 `console.log` 没什么区别，但是很好用。

在正常执行的时候并不会输出日志，这是一个空方法，线上运行也不会影响性能，如果希望调试可通过环境变量开启。

```
$ DEBUG=* node index.js
  a string a +0ms
  b object {"b":1} +4ms
```

使用 `DEBUG=*` 输出所有 debug 日志，你会看到不同命名空间的颜色不同。

## 命名空间

这是 debug 很有用的特性，你可以通过环境变量来控制输出哪些日志，不然就淹没在海洋里了。

```
$ DEBUG=a node index.js
  a string a +0ms
```

可以通过命名空间的方式去组织你的模块，如下面的 a 模块

```
| - package.json
| - a1.js (a:a1)
| - a2.js (a:a2)
| - node_modules
  | - b
    | - b1.js (b:b1)
    | - b1.js (b:b2)
    ` - package.json
```

括号后面为命名空间，一般模块的一级命名空间为模块名，之后以文件名命名，如果文件太多可以分多层。现在可以随意查看日志了，只需要通过环境变量。

比如可以通过 `DEBUG=a:a1,b:b1` 来指定显示 `a1.js` 和 `b1.js` 两个文件的日志。也可以部分模块匹配 `DEBUG=a*` 显示 a 模块的所有文件的日志。

## 服务器调试

服务器上启动和终端不同，一般都是通过脚本启动后端运行，所以日志会被重定向到一个文件中。但 debug 模块是输出到 stderr，在应用启动时需要检测这个文件有没有错误输出。

```
DEBUG=* node app.js >stdout.log 2>stderr.log &
[ -s stderr.log ] && exit 1
```

如果 stderr.log 有日志则退出，这应该是一个比较安全的启动方案，但这样就无法查看日志了。

debug 模块提供了 DEBUG_FD 的环境变量，可以将这些日志输出到其他文件，如

```
DEBUG=* DEBUG_FD=3 node app.js >stdout.log 2>stderr.log 3>debug.log &
```

这样你不需要改动启动脚本，每次启动改变 DEBUG 环境变量就能在 debug.log 里查看对应的日志了。

# 结论

任何调试方案都不是银弹，只有自己摸索出适合自己的。当然我也会使用 console.log 和 node-inspector 来调试，只是在不同的场景下。


互勉