# git 多密钥管理

- pubdate: 2015-05-09

---

在使用 git 的时候可能碰到这种场景：不同的平台配了不同的密钥，本地希望自动适配，比如 github 用 github 的私钥，gitlab 用 gitlab 的私钥。

如果你通过 Google 搜索[「git 多密钥」](https://www.google.com/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#newwindow=1&q=git+%E5%A4%9A%E5%AF%86%E9%92%A5)就能找到答案。

## ssh config

一般都是通过修改 `~/.ssh/config` 来配置，比如

```
Host gitlab.com
    IdentityFile ~/.ssh/id_rsa.gitlab
    User git
 
Host github.com
    IdentityFile ~/.ssh/id_rsa.github
    User git
```

这样就能满足上述的需求，对于个人开发来说足够了，因为每个平台不太会用多对密钥。

但并不适用于所有场景。

## 项目权限管理

假如一个公司使用 gitlab 来托管代码，代码库设有不同权限，然后给开发者分配不同的权限。公司还需要一套自动化脚本来部署，所以需要获取所有仓库的权限。

你可能有两个选择？

1. 简单粗暴的方式可以获取 git 仓库的用户密码，使用这个来 clone 代码。

2. 使用 [deploy key](http://doc.gitlab.com/ce/ssh/README.html) 优雅的完成任务。

当然选择后者，deploy key 为只读权限非常安全。在 gitlab 中可以添加 deploy key，但这个 key 是全局唯一的，无法添加已经存在的 key，不过可以在仓库中可以 enable 已有的 key。

在大公司中可能有更为复杂的权限管理，权限分级无法仅使用一个 key，比如 A 系统使用 key1 和 key2，B 系统使用 key2 和 key3，C 系统使用 key3。

这时你会发现使用 ssh config 会很费事。

## 使用 [Gitx](https://github.com/popomore/gitx)

这时你也可能想到了，我运行 git 的时候是否能直接指定一个私钥？

```
$ git -i ~/.ssh/id_rsa clone git@github.com:popomore/test-id.git
```

当然 git 是没法这么玩的，但你可以使用 gitx。

## 实现原理

如果你刚刚已经到仓库看了源码应该已经发现怎么实现了，关键在于 `GIT_SSH` 环境变量。这个环境变量可以指定 git 所使用的 ssh，于是我们就可以改写 ssh，查看 ssh 的帮助文档发现可使用 -i 指定私钥。

```
$ GIT_SSH=custom_ssh git -i ~/.ssh/id_rsa clone git@github.com:popomore/test-id.git
```

custom_ssh

```
ssh -i private.key "$@"
```

上面是简单的实现，跨平台当然需要用 Node 啦，看源码去吧少年。