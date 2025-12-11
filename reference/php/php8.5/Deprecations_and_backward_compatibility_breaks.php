<?php

/*

Deprecations and backward compatibility breaks

-The backtick operator as an alias for shell_exec() has been deprecated.
-Non-canonical cast names (boolean), (integer), (double), and (binary) have been deprecated. Use (bool), (int), (float), and (string) instead, respectively.
-The disable_classes INI setting has been removed as it causes various engine assumptions to be broken.
-Terminating case statements with a semicolon instead of a colon has been deprecated.
-Using null as an array offset or when calling array_key_exists() is now deprecated. Use an empty string instead.
-It is no longer possible to use "array" and "callable" as class alias names in class_alias().
-The __sleep() and __wakeup() magic methods have been soft-deprecated. The __serialize() and __unserialize() magic methods should be used instead.
-A warning is now emitted when casting NAN to other types.
-Destructuring non-array values (other than null) using [] or list() now emits a warning.
-A warning is now emitted when casting floats (or strings that look like floats) to int if they cannot be represented as one.

 */

// PHP 8.5
// PHP 8.4
