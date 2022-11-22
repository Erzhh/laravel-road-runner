<?php

namespace App\Domain\Settings\Errors\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ErrorDTO extends DataTransferObject {

    public int $user_id;
    public int $status = 0;
    public string $message = "Default Error";
    public string $data = "{}";
    public bool $is_send_me = false;
}
