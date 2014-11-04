# 配置 jshint

- pubdate: 2014-11-05

---

代码风格一直是程序员热议的话题，「是否要分号」「缩进用空格还是 tab」这样的话题真是呵呵了，想必在我有生之年无法终结了。但对于我们开发者来说(无论公司项目还是开源项目)，有一套规范还是有必要的。

我对代码风格说不上较真，但还是有一定的偏好，看到风格迥异的代码就不想去改了，我在开发中使用 jshint 来校验代码风格。

## 收集规范

首先你得有套规范，得去[官网](http://www.jshint.com/docs/options/)自己收集一下(天杀的竟然要翻墙)，然后创建一个 `.jshintrc` 放在项目根目录，比如 [father](https://github.com/popomore/father/blob/master/.jshintrc)，也可以拿别人的配置作为参考。

## 配置

建议每个仓库都单独存放一个 `.jshintrc`，这样一个仓库不管任何人来都能保持风格相同。对于个人开发者来说也可以创建一个全局的 `.jshintrc`，这样个人仓库就不需要重复创建了。

在 `package.json` 添加 jshint 的依赖

```
{
  "devDependencies": {
    "jshint": "*"
  }
}
```

添加到 `Makefile` 中，在跑测试用例的时候就会先校验代码风格，看个[例子](https://github.com/popomore/father/blob/master/Makefile)

```
jshint:
	node_modules/.bin/jshint .

test: jshint
  node_modules/.bin/mocha
```

如果是 Windows 可以考虑使用 scripts，在 `package.json` 添加

```
{
"scripts": {
  "test": "jshint . && mocha"
}
```

执行 `npm test`

## 忽略文件

当执行 `jshint .` 会扫描所有文件，你当然不希望他去扫描整个 node_modules，你可以使用 `.jshintignore` 忽略一些文件和目录。

```
coverage
node_modules
test
```

看个[例子](https://github.com/popomore/father/blob/master/.jshintignore)

## 编辑器

完成上面的配置已经能保证提交后检测代码风格了，但有些人会觉得这太晚了，我也是这么觉得的。所以我**非常疯狂的在编辑器设置保存即校验**，每次修改保存都会校验一下，让我从内心沉处觉得应该写出优雅的代码。

如果你用 Sublime 可以选择 SublimeLinter，他包含非常多的插件和校验的方法。

## 总结

你需要配置的文件

```
package.son
Makefile
.jshintrc
.jshintignore
```

能保证团队的代码风格统一，也能让别人向你贡献代码时了解你的代码风格。

