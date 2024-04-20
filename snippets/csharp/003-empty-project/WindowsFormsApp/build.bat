:start
msbuild WindowsFormsApp.sln /t:Build /p:Configuration=Debug /p:Platform=Win32

pause
goto start