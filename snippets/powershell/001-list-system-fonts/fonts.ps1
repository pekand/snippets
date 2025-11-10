param([string]$OutFile = "fonts.html",[int]$FontSize = 28,[string]$Sample = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.")
$reg = 'HKLM:\SOFTWARE\Microsoft\Windows NT\CurrentVersion\Fonts'
$props = Get-ItemProperty -Path $reg
$fontEntries = $props.PSObject.Properties | Where-Object { $_.Name -notmatch '^PS' } | ForEach-Object {
$name = $_.Name -replace '\s*\(.*\)$',''
[PSCustomObject]@{ Name = $name; File = $_.Value }
}
$fontEntries = $fontEntries | Sort-Object Name -Unique
$encode = { param($s) if($null -eq $s) { return '' } $s -replace '&','&amp;' -replace '<','&lt;' -replace '>','&gt;' -replace '"','&quot;' }
$html = "<!doctype html><html><head><meta charset='utf-8'><title>Installed fonts</title><style>body{font-family:Segoe UI,Arial,sans-serif;padding:20px;} .sample{margin:14px 0;padding:8px;border-bottom:1px solid #eee;} .fontname{font-size:12px;color:#666;margin-bottom:6px}</style></head><body><h1>Installed fonts ($($fontEntries.Count))</h1>"
foreach($f in $fontEntries){
$safeName = & $encode $f.Name
$safeSample = & $encode $Sample
$html += "<div class='sample'><div class='fontname'>" + $safeName + "</div><div style='font-family:" + $f.Name + ";font-size:" + $FontSize + "px;'>" + $safeSample + "</div></div>"
}
$html += "</body></html>"
Set-Content -Path $OutFile -Value $html -Encoding UTF8
Write-Output "Wrote $OutFile with $($fontEntries.Count) fonts."
Start-Process $OutFile