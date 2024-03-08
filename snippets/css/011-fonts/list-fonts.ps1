# list fonts
# powershell -ExecutionPolicy Bypass -File list-fonts.ps1

[System.Reflection.Assembly]::LoadWithPartialName("System.Drawing")
$stringArray = (New-Object System.Drawing.Text.InstalledFontCollection).Families

foreach ($item in $stringArray) {
    # Print the current item
    Write-Output $item.Name
}