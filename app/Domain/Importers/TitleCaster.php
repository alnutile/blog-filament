<?php

namespace App\Domain\Importers;

use Spatie\LaravelData\Support\DataProperty;

class TitleCaster implements \Spatie\LaravelData\Casts\Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): mixed
    {
        return str($value)->remove("'")->trim()->toString();
    }
}
