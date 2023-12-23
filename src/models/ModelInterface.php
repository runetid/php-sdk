<?php

namespace runetid\sdk\models;

interface ModelInterface
{

    public function load(array $data): self;

    public function toArray(): array;
}