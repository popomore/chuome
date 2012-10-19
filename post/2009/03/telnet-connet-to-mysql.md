# Telnet连接mysql数据库

- date: 2009-03-28

--------------------------

最近在用hibernate，图个新鲜学学MYSQL。以前都在本机上所以比较方便，这次装在了其他机子上，所以试试远程连接是什么样的。

### telnet连接

mysql装在win2003上，我的XP去连接的时候出现了一个错误

    telnet 192.168.1.103
    Failure in initializing the telnet session. Shell process may not have been launched,    
    Telnet Server has closed the connection.

服务器拒绝了连接，因为[telnet依赖与一个服务](http://www.itnewsgroups.net/group/microsoft.public.windows.server.general/topic6769.aspx)Secondary Logon。去服务中打开这个服务，当然telnet服务也要打开，这样就能连接其他主机了。

### mysql权限

虽然已经连接到了主机，但进入mysql还是需要权限的，所以先给要访问的数据库分配一个用户以及权限

```
GRANT ALL PRIVILEGES ON TO monty@localhost IDENTIFIED BY 'something'
```

这句还是挺好理解的，把所有权限付给所有数据库，用户是localhost上的monty，密码是smonthing。现在要远程访问，只需吧localhost换成你所在的ip就可以了

```
GRANT ALL PRIVILEGES ON chuome.* TO popo@192.168.1.103 IDENTIFIED BY '123'
```

不过telnet还是不安全，下次试试SSH
