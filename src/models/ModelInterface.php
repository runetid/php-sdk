<?php

namespace runetid\sdk\models;

interface ModelInterface
{

    public function load(\ArrayAccess|array $data): self;

    public function toArray(): array;
}