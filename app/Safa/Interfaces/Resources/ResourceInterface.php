<?php


namespace App\Safa\Interfaces\Resources;


interface ResourceInterface
{
    public function get($input);

    public function all(): ?array;
}
