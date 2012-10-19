# dropbox+utorrent实现远程bt下载

- date: 2010-02-28

--------------------------


> 此文没有任何技术含量,只是一个应用的tip


不知道你有没有想过在公司下载种子，家里的电脑就能直接下载了呢，其实要做到这样很简单，只需以下简单几步。这里要用到[dropbox](http://www.dropbox.com/)和[utorrent](http://www.utorrent.com/downloads)，如果没注册dropbox还可以[帮我扩展点容量](https://www.dropbox.com/referrals/NTM1ODUzNDk)。




1. 首先在两台电脑上都安装dropbox，并新建一个目录存放种子，我建了一个torrent的目录。/My dropbox/torrent.。


2. 建完后，你只需将种子放入这个文件夹下，那么两边都会有这个文件


3. 现在只需让bt客户端去加载种子就可以了，我用utorrent是因为小巧而且便携，并且他自带了这个功能。在设置->目录的下部，勾选自动载入torrent于，选择你刚建的那个目录。
![utorrent](../../uploads/2010/02/a.png)


4. 现在你只要将种子考入该文件夹，bt就会自动下载。你也可以将这个dropbox的文件夹与其他人共享，那么其他人传的种子都会自动下载。


5. 其他bt客户端如果支持该功能也可以使用，但我并没有试过是否真正可行。


就像一开始说的，本文没有技术含量，全归功于dropbox。我在很早以前就[介绍过dropbox](http://chuo.me/2008/11/dropbox/)，希望能探索出更多使用dropbox的方法。
