# Linode 安装 docker

- pubdate: 2015-03-03

---

最近在整理服务器，发现每次都重新搞一下成本太高，而且到重装系统的时候很容易忘记一些细节。Docker 让这一切变得非常方便，懂行人不要说大材小用，但真的很有用。

如果你还不知道 [Docker](https://www.docker.com/)，可以先看看[这本书](http://dockerpool.com/static/books/docker_practice/)。

## 安装系统

1. "Deploy an Image" 添加系统
2. kernel 选择最新的 (3.18.5-x86_64-linode52)
3. 安装 Ubuntu 14.04 LTS Disk，官方只提供了 [Ubuntu 和 CentOS 的安装说明](https://www.linode.com/docs/applications/containers/docker)
4. 设置 root 密码
5. 重启

## 设置账号

我不喜欢使用 root 账号直接操作，一般都会创建一个 admin 账号，如 popomore

1. root 登录 ssh root@ip
2. 添加用户 popomore，`adduser popomore` 输入用户密码后创建成功
3. 给用户赋予 sudo 权限，修改 /etc/sudoers 添加 `popomore ALL=(ALL) ALL`
4. 将用户添加到 docker 分组，这样可以[不用 sudo 运行 docker](http://askubuntu.com/questions/477551/how-can-i-use-docker-without-sudo) 了。

    ```
    sudo groupadd docker 
    sudo gpasswd -a popomore docker
    ```

6. 重启 docker，`sudo service docker restart`。

## 安装 docker

根据[官方文档](https://www.linode.com/docs/applications/containers/docker)安装 docker。

```
sudo apt-key adv —keyserver keyserver.ubuntu.com —recv-keys 36A1D7869245C8950F966E92D8576A8BA88D21E9
echo "deb http://get.docker.io/ubuntu docker main" | sudo tee /etc/apt/sources.list.d/docker.list
sudo apt-get update
sudo apt-get install lxc-docker
```

安装后可以直接使用 docker 命令了。

## 创建 Dockerfile

简单介绍一下这个博客的搭建，先创建一个 [Dockerfile](https://github.com/popomore/chuome/blob/master/conf/Dockerfile)。

这个博客是通过 nico 编译生成的静态文件，只有两个功能

1. nginx 服务
2. webhook 监听 master 变更重新编译

我使用 supervisor 启动应用，这样不管什么命令都能成功守护进程，而且非常方便。

**注意 nginx 的配置文件需要[将 daemon 关掉](https://github.com/popomore/chuome/blob/master/conf/nginx.conf#L4)。**

## 结论

使用 docker 确实方便很多，总觉得自己的服务器干净了很多（处女座去死）。

docker 初学者继续学习中。 
