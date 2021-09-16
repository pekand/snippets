

def run_command1():
    print("run_command1")
    import os
    os.system("ls -la")

#########

def run_command2():
    print("run_command2")
    import subprocess
    subprocess.run(["ls", "-l"])


#########

def run_command3():
    print("run_command3")
    import subprocess
    p = subprocess.Popen('ls', shell=True, stdout=subprocess.PIPE, stderr=subprocess.STDOUT)
    for line in p.stdout.readlines():
        print (line)
    retval = p.wait()

#########

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

#run_command1()
#run_command2()
#run_command3()
run_command_pipe()
