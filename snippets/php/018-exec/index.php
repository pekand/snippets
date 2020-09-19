<?php
    $text = "";
    if (isset($_GET['code'])) {
        $param = $_GET['code'];
        $param = base64_decode($param);
        $param = gzuncompress($param);
        $text = $param;
    } else if (isset($_POST['code'])) {
        $text = $_POST['code'];
        $param = gzcompress($text, 9);
        $param = base64_encode($param);
        $param = urlencode($param);
        header("Location: ".$_SERVER['REQUEST_URI']."?code=".$param);
        die();
    }
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Eval php</title>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <style type="text/css">
        .content{width: 1100px; margin: 0 auto;margin-bottom: 200px;}
        textarea{width: 100%;height:200px}
        .hash{color: green}
        .opp{color: red}
        table {width: 100%;border-collapse: collapse;}
        th{text-align: left;}
        td{border: 1px solid gray;text-align: center;}
    </style>
  </head>
  <body>
    <div class="content">
        <h1>Eval php</h1>

        <hr>

        <form method="post" action=".">
            <textarea name="code"><?php echo htmlspecialchars($text); ?></textarea>
            <input type="submit" value="Evaluate" name="send">
        </form>

        <hr>

        <div><?php
            try {
                $response = @eval($text);
            } catch (ParseError $e) {
                echo 'Caught exception: '.$e->getMessage()."<br>";
                $num = $e->getLine();
                $lines = explode("\n", $text);
                $line = $lines[$num-1];
                echo 'Line('.$num.'): ' . $line;
            }
        ?></div>
    </div>
  </body>
</html>
