<?php

declare(strict_types=1);

namespace App\Dto;

use App\Dto\Interfaces\BasicDtoInterface;
use App\Exceptions\Security\PropertyNotFoundException;
use App\Helpers\StringConverter;

trait FactoryMethod
{
    /**
     * @throws PropertyNotFoundException
     */
    public function __set(string $key, mixed $value): void
    {
        $property = $this->getProperty($key);

        $this->{$property} = $value;
    }

    /**
     * @throws PropertyNotFoundException
     */
    public function __get(string $key): mixed
    {
        return $this->{$this->getProperty($key)};
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toModelProperties(): array
    {
        $array = [];

        foreach (get_object_vars($this) as $key => $value) {
            $array[StringConverter::camelCaseToSnake($key)] = $value;
        }

        return $array;
    }

    /**
     * @throws PropertyNotFoundException
     */
    public static function make(array $data): BasicDtoInterface
    {
        $dto = new self();

        foreach ($data as $key => $value) {
            if (in_array($key, $dto::EXCLUDED_FIELDS, true)) {
                continue;
            }
            $dto->__set($key, $value);
        }

        return $dto;
    }

    /**
     * @throws PropertyNotFoundException
     */
    private function getProperty(string $key): string
    {
        $property = StringConverter::camelize($key);
        if (!property_exists($this, $property)) {
            $className = get_class($this);

            throw new PropertyNotFoundException("Property {$property} not found in {$className}");
        }
        return $property;
    }
}
