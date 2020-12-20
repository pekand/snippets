<?php

(true && true);
(true || true);
(true and true);
(true or true);
(true xor true);
(!true);




/*
non-associative    clone new                                                clone and new
right              **                                                       arithmetic
right              ++ -- ~ (int) (float) (string) (array) (object) (bool) @ types and increment/decrement
non-associative    instanceof                                               types
right              !                                                        logical
left               * / %                                                    arithmetic
left               + - .                                                    arithmetic and string
left               << >>                                                    bitwise
non-associative    < <= > >=                                                comparison
non-associative    == != === !== <> <=>                                     comparison
left               &                                                        bitwise and references
left               ^                                                        bitwise
left               |                                                        bitwise
left               &&                                                       logical
left               ||                                                       logical
right              ??                                                       null coalescing
left               ? :                                                      ternary
right              = += -= *= **= /= .= %= &= |= ^= <<= >>=                 assignment
right              yield from                                               yield from
right              yield                                                    yield
left               and                                                      logical
left               xor                                                      logical
left               or                                                       logical
*/