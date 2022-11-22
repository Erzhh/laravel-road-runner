<?php

namespace App\Support\Exceptions;

use Core\DTO;

class Error extends DTO
{
    public string $code = '';
    public string $source = '';
    public string $title = '';
    public string $detail = '';

}
