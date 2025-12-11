<?php


/*
	#[\NoDiscard] Attribute
	By adding the #[\NoDiscard] attribute to a function, PHP will check whether the returned value is consumed and emit a warning if it is not. 
	This allows improving the safety of APIs where the returned value is important, but it's easy to forget using the return value by accident.
	The associated (void) cast can be used to indicate that a value is intentionally unused.
*/

// PHP 8.5
#[\NoDiscard]
function getPhpVersion(): string
{
    return 'PHP 8.5';
}

getPhpVersion();
// Warning: The return value of function getPhpVersion() should
// either be used or intentionally ignored by casting it as (void)

// PHP 8.4
function getPhpVersion(): string
{
    return 'PHP 8.4';
}

getPhpVersion(); // No warning

