import sys
import fileinput

for line in fileinput.input():
    print("l:"+line.rstrip("\n"))    
print("finish");    
print("error1\nerror2", end='', file=sys.stderr)
