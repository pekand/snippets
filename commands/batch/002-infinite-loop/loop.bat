@echo off
setlocal enabledelayedexpansion

set /a count=1

:loop
echo !count!
timeout /t 1 >nul
set /a count+=1
goto loop