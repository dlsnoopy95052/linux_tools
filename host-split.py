import sys
import os

argN = sys.argv

if (len(argN) != 4):
    print("Wrong syntax")
    exit()
splitL = int(argN[2])
fileT = argN[3]
try:
    print("openning file", argN[1])
    fp1 = open(argN[1])
    fp2 = open("aTempFile.txt", 'w')
    line = fp1.readline()
    if (line == None):
        print("Read nothing")
        fp1.close()
        fp2.close()
        exit()
    cnt = 1
    fileNS = cnt
    fileNE = cnt

    while line:
    
        fp2.writelines(line)
        fileNE = cnt
        fileName = fileT+str(fileNS)+'-'+str(fileNE)+".txt"
    
        if ((cnt % splitL) == 0):
     
            fp2.close()
            os.rename("aTempFile.txt", fileName)
            fp2 = open("aTempFile.txt", 'w')
            fileNS = cnt + 1

        line = fp1.readline()

        if ((line == "") and ((cnt % splitL) == 0)):
            exit()
          
        cnt += 1

    fp2.close()
    os.rename("aTempFile.txt", fileName)

except Exception as e:
    if hasattr(e, 'message'):
        print(e.message)
    else:
        print(e)
 
    fp1.close()
    fp2.close()
    exit()
