

dotnet restore
:start
rem csc /target:exe /out:Snippets.exe Snippets.cs && Snippets.exe

msbuild Snippets.csproj && .\bin\Debug\netcoreapp3.1\Snippets.exe

pause
goto start
