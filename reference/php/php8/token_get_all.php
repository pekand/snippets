<?php

echo "<pre><h1>token_get_all</h1>";

$tokens = token_get_all('<?php echo; ?>');

foreach ($tokens as $token) {
    if (is_array($token)) {
        echo htmlspecialchars("Line {$token[2]}: ". token_name($token[0]). " ('{$token[1]}')". PHP_EOL);
    }
}
