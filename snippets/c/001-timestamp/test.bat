@echo off

FOR /F "tokens=* USEBACKQ" %%F IN (`timestamp.exe`) DO ( SET output=%%F )
echo %output%
pause
