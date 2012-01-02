#!/bin/bash
#
# file: /etc/init.d/fastcgi
# fastcgi启动脚本
#

piddir=/var/run/fastcgi-php.pid
user=popomore
group=popomore

function start {
	pid=`cat $piddir`
	if [ "$pid" == "" ]; then
		/usr/bin/spawn-fcgi -a 127.0.0.1 -p 9000 -C 2 -u $user -g $group -f /usr/bin/php5-cgi -P $piddir
	else
		echo "spawn-fcgi: now is running"	
	fi
}

function stop {
	pid=`cat $piddir`
	if [ "$pid" == "" ];then
		echo "spawn-fcgi: no running"	
	else
		killall php5-cgi
		echo "spawn-fcgi: $pid was killed"
		echo -n "" > $piddir
	fi
}

if [ "$1" == "start" ]; then
	start
	echo "spawn-fcgi: start completed"
elif [ "$1" == "restart" ]; then
	stop
	start	
	echo "spawn-fcgi: restart completed"
elif [ "$1" == "stop" ]; then
	stop
	echo "spawn-fcgi: stop completed"
fi