<?php

echo "<pre>";


$out = [];
foreach (get_declared_classes() as $c) {
    $out[$c] = [
        'parent' =>  get_parent_class($c),
        'vars' => get_class_vars($c),
        'methods' => get_class_methods($c),
    ];

    $out[$c]['method_params'] = [];
    foreach (get_class_methods($c) as $m) {
        $r = new ReflectionMethod($c, $m);
        $params = $r->getParameters();
        
        
        $out[$c]['method_params'][$m] = [];
        foreach ($params as $param) {
            $out[$c]['method_params'][$m][$param->getName()] = [
                'defaultValue' => $param->isDefaultValueAvailable() ? var_export($param->getDefaultValue(), true) : 'NOT_DEFAULT_VALUE',
                'isOptional' => $param->isOptional() ? 'true': 'false',
                'isPassedByReference' => $param->isPassedByReference() ? 'true': 'false',
                //'defaultValueConstantName' => $param->isOptional() ? $param->getDefaultValueConstantName() : '',
                 
            ];

        }

         
    }

    
}

print_r($out);
