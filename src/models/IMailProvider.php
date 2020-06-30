<?php

namespace App\Models;

interface IMailProvider {
    function send($titulo);
}

