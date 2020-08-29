<?php
/**
 * -----------------------------------------
 * Set the library params/global attributes
 * -----------------------------------------
 */
return [
    'guards' => explode(',', env('SYSTEM_GUARDS', 'web')) // set the string to array
];
