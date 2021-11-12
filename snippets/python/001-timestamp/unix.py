import time

print("microtime="+str(time.time()))
print("seconds="+str(int(time.time())))

from datetime import datetime

print("datetime-unix-mixro="+str(datetime.now().timestamp()))

