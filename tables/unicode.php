<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="utf-8">
    <title>Unicode Table</title>
    
    <style> 
	
.clear {
	clear: both;
}

.wrapper {
	margin: 10px auto;
}

.char {
	float:left;
	width: 80px;
	text-align: center;
	margin: 5px;	
	background: #dff6f0;
}

.char .symbol {
	text-align: center;
	vertical-align: middle;
	font-size: 48px;
	line-height: 60px;
	height: 60px;
	background: #bae8e8;
	color: #272343;
}
.char .description {
	height: 20px;
	background: #272343;
	color: #bae8e8;
}
</style>
    
</head>
<body>
	
    <main><?php 
echo "<div class='wrapper'>";
for($j = 0; $j < 64 ; $j++) {

	for($i = $j*(65536/64); $i < (($j+1)*(65536/64))  ; $i++) {
		echo "<div class='char'><div class='symbol'>".mb_chr($i, "utf8")."</div> <div class='description' title='$i'>U+".strtoupper(str_pad(dechex($i), 5, "0", STR_PAD_LEFT ))."</div></div>";
	}
}
echo "</div>"; 
?></main>

    
    
</body>
</html>



