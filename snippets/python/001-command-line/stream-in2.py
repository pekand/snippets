import sys
import fileinput

#stream-in2.py < test.txt

for line in sys.stdin:
    print(line.rstrip())
