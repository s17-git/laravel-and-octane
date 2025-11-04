<?php

namespace App\Application\User\Data;


class AuthorData
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $email = null
    ) {}
}