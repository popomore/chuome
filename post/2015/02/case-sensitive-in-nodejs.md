# 跨平台文件大小写敏感的问题

- pubdate: 2015-02-09

---

文件大小写本身就不是事儿，但当你遇到了那就是一个很深的坑。

各个社区都有自己的规范，比如 [Arale](http://aralejs.org/) 只允许文件名符合 `[a-z\d-]`，虽然比较严格但跨平台基本不会遇到问题。

最近常在讨论的 React 的规范，React 的类都是首字母大写的，工具方法为小写，这才引发了这篇文章的问题。

## Mac 大小写不敏感

我们先来看看在 Mac 平台下引入一个文件的情况

使用 `fs.existsSync` 探测 `package.json` 是否存在，发现大小写返回的结果是相同的，也就是说 `fs` 并不区分大小写。

```
> fs.existsSync('Package.json')
true
> fs.existsSync('package.json')
true
```

那 `require` 呢

```
> require('./package.json')
> require('./Package.json')
> require.cache
{ '/Users/popomore/case/package.json':
   { id: '/Users/popomore/case/package.json',
     exports:
      { name: 'case',
        version: '1.0.0',
        dependencies: [Object],
        devDependencies: [Object],
        main: 'index',
        scripts: [Object],
        repository: [Object],
        publishConfig: [Object],
        spm: [Object] },
     parent:
      { id: 'repl',
        exports: [Object],
        parent: undefined,
        filename: '/Users/popomore/case/repl',
        loaded: false,
        children: [Object],
        paths: [Object] },
     filename: '/Users/popomore/case/package.json',
     loaded: true,
     children: [],
     paths:
      [ '/Users/popomore/case/node_modules',
        '/Users/popomore/node_modules',
        '/Users/node_modules',
        '/node_modules' ] },
  '/Users/popomore/case/Package.json':
   { id: '/Users/popomore/case/Package.json',
     exports:
      { name: 'case',
        version: '1.0.0',
        dependencies: [Object],
        devDependencies: [Object],
        main: 'index',
        scripts: [Object],
        repository: [Object],
        publishConfig: [Object],
        spm: [Object] },
     parent:
      { id: 'repl',
        exports: [Object],
        parent: undefined,
        filename: '/Users/popomore/case/repl',
        loaded: false,
        children: [Object],
        paths: [Object] },
     filename: '/Users/popomore/case/Package.json',
     loaded: true,
     children: [],
     paths:
      [ '/Users/popomore/case/node_modules',
        '/Users/popomore/node_modules',
        '/Users/node_modules',
        '/node_modules' ] } }
```

`require` 同样不区分大小写，但大小写的文件为两个缓存值，但内容是相同的（源自同一个文件），引用值则不同

```
> require('./Package.json') == require('./package.json')
false
```

## 存在的问题

那大小写不敏感会有什么问题呢？在模块依赖分析的时候就会有问题。

a.js

```
require('./B.js');
```

b.js

```
console.log('b');
```

以上两个文件在 Mac 下没问题，在 Linux 下会有问题。

## 解决

大小写敏感这种事本身不应该由应用方来解决，应该交由平台或操作系统解决，但问题就在眼前需要一种解决方案。

[exists-case](https://github.com/popomore/exists-case) 提供了一种解决方案。

因为 `fs.readdir` 获取的文件列表是有大小写的，所以遍历之后就能检查该文件是否存在，有兴趣的同学可以看看源码。

但这本身有性能问题，比 `fs.exists` 慢了一倍，不建议在生成环境使用，可运行下 [benchmark](https://github.com/popomore/exists-case/tree/master/benchmark)。

## 结论

[exists-case](https://github.com/popomore/exists-case) 虽然在某些场景下能解决问题，但大小写敏感问题应该从规范来解决，所以建议没有特殊需求还是都用小写为好。

