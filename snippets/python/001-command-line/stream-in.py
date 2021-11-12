import sys
import fileinput

#stream-in.py < test.txt

for line in fileinput.input():
    print("STREAMIN:"+line.rstrip())    
print("finish");    
print("error1\nerror2", end='', file=sys.stderr)

