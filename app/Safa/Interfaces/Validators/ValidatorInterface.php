<?php


namespace App\Safa\Interfaces\Validators;


interface ValidatorInterface
{
    public function required(array $inputs): ValidatorInterface;

    public function matchDateFormat($input, string $format): ValidatorInterface;

    public function has(array $inputs): bool;

    public function string(array $inputs): ValidatorInterface;

    public function validate(): bool;
}
