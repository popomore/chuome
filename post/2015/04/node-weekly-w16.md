# Node 小报第十六周

- pubdate: 2015-04-18

---

> 一个月多事，旅游工作，竟没怎么关注业界。

io.js [即将发布 2.0](https://github.com/iojs/io.js/commit/e61ee49c7a2f577eb1338ee35f8768d79010ebc9)，其中将[升级 V8 到 4.2](https://github.com/iojs/io.js/issues/1393)，又会增加很多 ES6 特性

- Classes 和 Object literals 将会默认打开
- 支持 Rest parameters，Computed property names 和 Unicode escapes 使用 --harmony 参数

```js
'use strict';

class Dude {
  constructor() {
    this.rnd = Math.random()
  }

  toString() {
    return 'Whoooooooa dude!'
  }
}

class Whoa extends Dude {
  constructor() {
    super()
    console.log(`
      Java me up scotty!
      ${ JSON.stringify(process.versions) }
      ${ JSON.stringify(this.derp('foo', 'bar')) }
      ${ this }
    `)
  }

  derp(...args) {
    return {
        [this.rnd]: 'eh?'
      , [args[0]]: args[1]
    }
  }
}

new Whoa()
```

**这是什么语言！！**

在写子类的时候要千万注意，必须[在 super() 调用之后才能操作 this](https://github.com/babel/babel/issues/1131#issuecomment-89155194)，不要掉坑里了。

```
class Foo extends Bar {
  constructor() {
    // what is the internal representation of `this`? unknown
    super();
    // the internal representation of `this` is whatever the superclass provided
  }
}
```

Airbnb 的 style guide 提供了 [ES6 的版本](https://github.com/airbnb/javascript/tree/es6)，现在开始写 ES6 就可以规范你的代码了。

Facebook 推出了一个 IDE —— [Nuclide](http://nuclide.io/)，感觉是配合 React 的效率工具，看来是一盘很大的棋。

TC39 三月[会议纪要](https://github.com/rwaldron/tc39-notes/tree/master/es6/2015-03)，[上一篇列了一些 ES7 的提案](/2015/04/es7.html)