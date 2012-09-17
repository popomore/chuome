for file in `ls *.markdown`; do
	title=`cat $file | grep 'title:' | awk '{print $2}'`
	old=`cat $file | grep 'slug:' | awk -F"\'" '{print $2}'`
	new=`echo $file | sed -e 's/[0-9]*-[0-9]*-[0-9]*-\([a-z0-9-]*\)\.markdown$/\1/g'`
	year=${file:0:4}
	month=${file:5:2}
	moreread=true
	while read line; do
		if [ "$line" == "---" ]; then
			if $moreread; then
				moreread=false
			else
				echo "# $title" >> tmp
				echo "" >> tmp
				echo "- date: ${file:0:10}" >> tmp
				echo "" >> tmp
				echo "--------------------------" >> tmp
				echo "" >> tmp				
				moreread=true
			fi
			continue
		fi
		if $moreread; then
			echo $line >> tmp
		fi
	done < $file
	cat tmp > ${new}.md
	rm tmp $file
	##if [ "$old" != "" ]; then
	#	echo "http://chuo.me/$year/$month/$old,http://chuo.me/$year/$month/$new"
	#fi
done