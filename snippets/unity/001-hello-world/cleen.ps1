Write-Host "Cleaning Unity Project..." -ForegroundColor Cyan

$folders = @("Library", "Temp", "Obj", "Build", "Logs", "UserSettings")

foreach ($folder in $folders) {
    if (Test-Path $folder) {
        Write-Host "Removing $folder..." -ForegroundColor Yellow
        Remove-Item -Path $folder -Recurse -Force
    }
}

# Also clean up generated IDE files
Get-ChildItem -Path . -Include *.csproj, *.sln -Recurse | Remove-Item -Force

Write-Host "Clean Complete! Your project is now tiny and ready for backup." -ForegroundColor Green