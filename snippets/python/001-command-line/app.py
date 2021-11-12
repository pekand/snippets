
def readFile(file):
    text=''
    with open (file, "r") as file1:
        for line in file1:
            text+=line 
    return text

#########

def run_command1(cmd):
    print("run system command")
    import os
    os.system(cmd)

#########

def run_command2(cmd):
    print("run command with parameter")
    import subprocess
    subprocess.run(cmd)


#########

def run_command3(cmd):
    print("run command and get out and err")
    import subprocess
    p = subprocess.Popen(cmd, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    for line in p.stdout.readlines():
        print ("STROUT:"+line.decode("utf-8").rstrip())
    for line in p.stderr.readlines():
        print ("STRERR:"+line.decode("utf-8").rstrip())
    retval = p.wait()

######### Pipe text ro stream and get output

def run_pipe(cmd, data):
    print("run command, send data to comand, read stdout and stderr from command")
    from subprocess import Popen, PIPE, STDOUT
    p = Popen(cmd, stdout=PIPE, stdin=PIPE, stderr=PIPE)
    b = data.encode("utf-8")
    stdout_data, stderr_data = p.communicate(input=b)
    return [stdout_data.decode("utf-8"), stderr_data.decode("utf-8")]

def run_command_pipe(cmd, data):
    stdout_data, stderr_data = run_pipe(cmd, data)
    print("STROUT:"+stdout_data, end='')
    print("STRERR:"+stderr_data, end='')
    return [stdout_data, stderr_data]

#########

run_command1('ls -l')
run_command2(['ls','-l'])
run_command3(['python','stream-out-error.py'])
stdout_data, stderr_data = run_command_pipe(['python','stream-in.py'], readFile("test.txt"))
