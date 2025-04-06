<?php

namespace QuantumTecnology\PerPageTrait;

use Illuminate\Database\Eloquent\Builder;
use QuantumTecnology\PerPageTrait\Enums\PaginationEnum;
use QuantumTecnology\ValidateTrait\Data;

/**
 * @method Builder defaultQuery()
 */
trait PerPageTrait
{
    protected int $perPage;
    protected ?string $paginationType = null;

    public function getPerPage(): int
    {
        $this->perPage = request()->get(
            config('perpage.parameters.per_page'),
            config('perpage.max_per_page')
        );

        if ($this->perPage > config('perpage.max_per_page')) {
            $this->perPage = config('perpage.max_per_page');
        } elseif ($this->perPage < config('perpage.min_per_page')) {
            $this->perPage = config('perpage.min_per_page');
        }

        return $this->perPage;
    }

    public function setPagination(string $pagination): self
    {
        $this->paginationType = $pagination;

        return $this;
    }

    public function result(): Data
    {
        return data([
            'data' => match ($this->paginationType ?? config('perpage.default')) {
                PaginationEnum::PAGINATION_LENGTH => $this->defaultQuery()->paginate($this->getPerPage()),
                PaginationEnum::PAGINATION_SIMPLE => $this->defaultQuery()->simplePaginate($this->getPerPage()),
                default                           => $this->defaultQuery()->get(),
            },
        ]);
    }
}
