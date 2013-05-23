# ubuntu安装lastfm

- pubdate: 2008-12-23

--------------------------


一直在实验室[cref 143 用着last]，windows下的，现在想在寝室也搞个听听。还好last支持linux，于是在官网下了源码准备编译，可是遇到了问题。

－－－－－－－－－－－－－－－－－－－－－－－－－－－－
==> Last.fm Configure
==> Checking for qmake...
==> Checking the installed version of Qt is correct...
./configure: line 40: -v：找不到命令
Your version of Qt seems to be too old, we require Qt 4.3 or above.

It is possible you have Qt3 and Qt4 both installed. Locate your qt4 installation
and ensure it is placed first in the path, eg:

PATH=/opt/qt4/bin:$PATH ./configure

However this configure script is very basic, perhaps we got it wrong..
Try typing the following, perhaps it will build for you :)

qmake -config release && make
－－－－－－－－－－－－－－－－－－－－－－－－－－－－

原来是系统的qt版本太低，发现自己不会升qt，真是菜。还好在小组里找到了[解决办法](http://cn.last.fm/group/Debian+Linux/forum/8592/_/366818)。这样只要使用[apt](http://apt.last.fm/)就能安装了

先需要安装一个公钥,不然无法验证。


$ wget -q http://apt.last.fm/last.fm.repo.gpg -O- | sudo apt-key add -



在/etc/apt/sources.list中添加以下源
deb http://apt.last.fm/ debian stable


$ sudo aptitude update
$ sudo aptitude install lastfm
