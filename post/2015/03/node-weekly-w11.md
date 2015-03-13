# Node 小报第十一周

- pubdate: 2015-03-14

---

[wycats](https://github.com/wycats) 近期准备带着 [Decorators 提案](https://github.com/wycats/javascript-decorators) 去 TC39 会议，真个非常喜欢注解，尤其是在写 router 的时候。

还有一个 class 的[私有变量](https://github.com/zenparsing/es-private-fields)的提案，这也是 JS 被吐槽最多的功能之一吧。

但是有人提出上述两者的[语法非常类似](https://github.com/babel/babel/issues/974#issuecomment-78122246)，你能分辨的清么？

```
class Class {
  @privateField;
  @decorator
  method(){}
}
```

[jsperf v2](https://github.com/jsperf/jsperf.com) 支持 io.js 并开源了，有兴趣的同学可以自己搭一个性能测试环境了。

上周发了 Strong Mode 和 SoundScript 的 ppt，现在可以看 [v8
 官方的介绍](https://developers.google.com/v8/experiments )了。Strong Mode 比 Strict Mode 更加严格，去除了更多不好的功能，具体看[提案内容](https://docs.google.com/document/d/1Qk0qC4s_XNCLemj42FqfsRLp49nDQMZ1y7fwf5YjaI4/view?pli=1)。

还在找 Windows 的 CI 平台？那么尝试使用下 [ci.appveyor.com](ci.appveyor.com)，让你的 Node 库不至于在 Windows 下挂掉。
