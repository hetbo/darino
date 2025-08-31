<?php

namespace App\Exceptions;

use App\Models\User;
use Exception;

class EmailNotVerifiedException extends Exception
{
    public function __construct()
    {
        parent::__construct('The user email is not verified.');
    }
}
