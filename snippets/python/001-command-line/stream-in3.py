import sys
import fileinput

#stream-in3.py < test.txt

data = sys.stdin.readlines()
for line in data:
    print(line.rstrip())
