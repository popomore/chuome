# Wakoopa推出linux版本

- date: 2009-05-15

--------------------------


wakoopa是一个记录软件使用情况的网站，通过一个桌面的程序给最近使用的软件或上过的网站自动添加记录。这个网站能很好的给出最近的使用情况，比如会告诉用户最近一个星期哪几种软件使用率最高，最近使用了什么新的软件等等。

wakoopa有一点想法很好，将所有网站都作为一种软件，这也很复合SaaS的理念，将google，facebook都视为与office，qq一样的软件来管理。用户还能对每个软件进行评价，并且分享他们所使用的情况。

wakoopa的基础就是桌面程序，所以跨平台是必须的。之前，wakoopa已经发布了windows和mac两个版本，以及现在发布的linux，以及基本覆盖了所有的系统，真正成为了一个平台。我实验室的电脑用的是windows，寝室的是ubuntu，所以以前只有一台在记录，搞得我晚上的一些行动并不会被记录进去，所以才急切着盼望这个版本。

**ubuntu安装wakoopa**

1、将` http://apt.wakoopa.com all main添加到source中`

2、sudo wget -O - http://apt.wakoopa.com/pubkey.txt | sudo apt-key add -

3、sudo apt-get update  （注意要使用apt-get，我使用aptitude有问题）

4、sudo apt-get install wakoopa
