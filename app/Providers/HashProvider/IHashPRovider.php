<?php

namespace App\Providers\HashProvider;

interface IHashProvider {
  function generateHash($payload): string;
  function compareHash($payload, $hashed): bool;
}

