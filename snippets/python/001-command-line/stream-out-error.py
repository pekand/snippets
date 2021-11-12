import sys
import fileinput

for i in range(1, 100):
    print(i)  
print("finish");    
print("error1\nerror2", end='', file=sys.stderr)

