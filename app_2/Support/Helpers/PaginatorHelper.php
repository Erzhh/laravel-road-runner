<?php

namespace Support\Helpers;

trait PaginatorHelper
{
    private int $per_page = 15;

    public function getPerPage($perPage)
    {
        if ($perPage)
            $this->per_page = $perPage;
    }
}
