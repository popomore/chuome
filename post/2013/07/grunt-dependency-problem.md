# 记录

- pubdate: 2013-07-11

---

这件事由一个 issue 而起，https://github.com/spmjs/spm-build/issues/24

安装 `spm-build` 的时候报了一个错

```
npm ERR! Error: No compatible version found: underscore.string@'>=2.2.0rc <2.3.0-'
npm ERR! Valid install targets:
npm ERR! ["0.9.2","1.0.0","1.1.3","1.1.4","1.1.5","1.1.6","2.0.0","2.1.0","2.1.1","2.3.0","2.3.1","2.2.0-rc"]
```

排查后发现是 grunt 的依赖库 underscore.string 为 `~2.2.0rc`，而 underscore.string 在 npm 的版本是 `2.2.0-rc` 而不是 `2.2.0rc`，而且在 `>=2.2.0rc <2.3.0` 之间没有其他包。不明真相的群众去 grunt 社区搜结果，还真有[很多反馈](https://github.com/gruntjs/grunt/pull/836)，不断有人 +1 让 grunt 修复这个问题。

事情总是扑朔迷离来得更有意思，`2.2.0-rc` 也被删除了，而且在 `~2.2.0` 已经没有可用的包了，使用方已经完全无法自己解决这个问题，剩下的只有等待。

可喜的是 underscore.string 的作者 [epeli](https://github.com/epeli) 出现了，他[解释到](https://github.com/epeli/underscore.string/issues/219#issuecomment-20733229)正在 republish `2.2.0rc`，但 npm 报错。

现在是下午3点，于是所有东半球的人都在等西半球的人起床。

等待等不来希望，最后[一个人的建议](https://github.com/epeli/underscore.string/issues/219#issuecomment-20734212)解决了这个问题，underscore.string publish `2.2.1`。

探究出错的原因？可能是因为 npm 服务器由于[某个 bug](https://github.com/isaacs/node-semver/issues/39) 的原因把 `2.2.0rc` 转成了 `2.2.0-rc`。

这件事让我感受到了开源的魅力，全世界的人很真实的和我们一起工作，一起解决问题。
