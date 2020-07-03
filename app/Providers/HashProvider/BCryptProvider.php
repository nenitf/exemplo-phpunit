<?php

namespace App\Providers\HashProvider;

class BCryptProvider implements IHashProvider{
    function generateHash($payload): string {
        return 'generetedhash';
    }
    function compareHash($payload, $hashed): bool {
        return true;
    }
}

