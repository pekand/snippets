<!DOCTYPE html>
<html>
<head>
    <title>Snippets</title>
</head>
<body>
    <style type="text/css">
        * {
            color: black;
            margin: 0px;
            padding: 0px;
            font-size:32px;
            font-family:monospace;
        }

        a {
            text-decoration: none;
        }

        body {
            background:#48C0B8;
        }

        main {
            padding-top: 200px;
            width:800px;
            margin: 0px auto;
        }

        h1  {
            margin: 30px 0px;
        }
        table {
            border-collapse: collapse;
        }

        tr {

        }

        td {
            width:300px;
        }
    </style>
    <main>
        <h1>Commands</h1>
        <table>
            <?php 
                
                $files = array_diff(scandir("."), array('.', '..'));

                foreach($files as $file){
                    if(in_array($file, ['index.php'])){
                        continue;
                    }
                    echo '<tr><td><a href="'.$file.'">'.$file.'</a></td><td></td></tr>';
                }
            ?>
        </table>
    </main>
</body>
</html>
