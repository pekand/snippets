<?php

echo "<pre>";

echo strtolower("AAAAÁÁÁÁ").PHP_EOL; // -> 'aaaaÁÁÁÁ'
echo strtoupper("aaaaáááá").PHP_EOL; // -> 'AAAAáááá'
echo mb_strtolower("AAAAÁÁÁÁ", 'utf8').PHP_EOL; // -> 'aaaaáááá'
echo mb_strtoupper("aaaaáááá", 'utf8').PHP_EOL; // -> 'AAAAÁÁÁÁ'
