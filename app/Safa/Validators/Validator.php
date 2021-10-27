<?php
/**
 * NOTE: decide whether u need the validator to continue check over inputs even if one fails,
 *or not.
 * current implementation does, if u don't want to go further if one condition fails,
 * simply add a check in every function if($this->result){DO IMPLEMENTATION}
 */

namespace App\Safa\Validators;


use App\Safa\Classes\Constants;
use App\Safa\Interfaces\Resources\ResourceInterface;
use App\Safa\Interfaces\Validators\ValidatorInterface;

class Validator implements ValidatorInterface
{
    private $resource;
    private $result = true;

    public function __construct(ResourceInterface $resource)
    {
        $this->resource = $resource;
    }

    public function required(array $inputs): ValidatorInterface
    {
        if ($this->result) {
            foreach ($inputs as $input) {
                $value = $this->resource->get($input);
                if (is_bool($value)) {
                    if (!isset($value)) {
                        $this->result = false;
                    }
                } else {
                    if (empty($value)) {
                        $this->result = false;
                        break;
                    }
                }
            }
        }
        return $this;
    }

    public function matchDateFormat($input, string $format = Constants::DEFAULT_DATE_FORMAT): ValidatorInterface
    {
        if (!\DateTime::createFromFormat($format, trim($this->resource->get($input)))) {
            $this->result = false;
        }
        return $this;
    }

    public function has(array $inputs): bool
    {
        foreach ($inputs as $input) {
            $value = $this->resource->get($input);
            if (!isset($value)) {
                return false;
            }
        }
        return true;
    }

    public function validate(): bool
    {
        return (bool)$this->result;
    }

    public function string(array $inputs): ValidatorInterface
    {
        if ($this->result) {
            foreach ($inputs as $key) {
                if (!is_string($this->resource->get($key))) {
                    $this->result = false;
                    break;
                }
            }
        }
        return $this;
    }

}
