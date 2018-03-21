import re

parsedList = []
parsedList2 = []
outputFile ="processed_format.txt"
with open("user_accounts.txt", 'r') as infile:
	all_records = infile.read()
	parsedList = all_records.split("),(")

infile.close()
j=0
for i in parsedList:
	temp=re.sub("\(|\)|'",'',i)
	tempList= temp.split(",")
	#print("Reading: ",tempList)
	parsedData = "['{}', '{}', '{}', '{}', '{}']".format(tempList[2], tempList[0].split('@')[0], tempList[1],tempList[0], tempList[6], )
	#print("Adding: ", parsedData)
	parsedList2.append(parsedData)
	j+=1

with open(outputFile, 'w') as outfile:
	outfile.write("<?php")
	outfile.write(" $user_array = [")
	for k in range(len(parsedList2)):
		outfile.write(parsedList2[k])
		if ((k+1) < len(parsedList2)):
			outfile.write(",")
	outfile.write("]; ")
	outfile.write("?>")
outfile.close()		