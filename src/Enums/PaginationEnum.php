<?php

namespace QuantumTecnology\PerPageTrait\Enums;

use Illuminate\Support\Collection;
use QuantumTecnology\EnumBasicsExtension\BaseEnum;

abstract class PaginationEnum extends BaseEnum
{
    public const PAGINATION_NONE   = 'none';
    public const PAGINATION_SIMPLE = 'simple';
    public const PAGINATION_LENGTH = 'length';

    /**
     * Return available types.
     */
    public static function paginations(): Collection
    {
        return new Collection(static::filterConstants('PAGINATION'));
    }
}
