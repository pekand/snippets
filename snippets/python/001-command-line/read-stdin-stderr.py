
def run_pipe(cmd, data):
    print("run_command4")
    from subprocess import Popen, PIPE, STDOUT
    p = Popen(cmd, stdout=PIPE, stdin=PIPE, stderr=PIPE)
    b = data.encode("utf-8")
    stdout_data, stderr_data = p.communicate(input=b)
    return [stdout_data.decode("utf-8"), stderr_data.decode("utf-8")]

def run_command_pipe():
    stdout_data, stderr_data = run_pipe(['python','stdin.py'], 'message1\nmessage1\nmessage1')
    print(stdout_data, end='')
    print(stderr_data, end='')

#########

def run_command_pipe2(cmd):
    import subprocess
    proc = subprocess.Popen(cmd,stdout=subprocess.PIPE)
    while True:
      line = proc.stdout.readline()
      if not line:
        break
      print("test:", line.rstrip())

#########



run_command_pipe2(['python','stdin.py'])
