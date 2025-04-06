<?php

namespace QuantumTecnology\PerPageTrait;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

trait PerPageTrait
{
    protected int $perPage;
    protected bool $paginationEnabled = true;

    public function getPerPage(): int
    {
        $this->perPage = request()->get('per_page', config('perpage.max_per_page'));

        if ($this->perPage > config('perpage.max_per_page')) {
            $this->perPage = config('perpage.max_per_page');
        } elseif ($this->perPage < config('perpage.min_per_page')) {
            $this->perPage = config('perpage.min_per_page');
        }

        return $this->perPage;
    }

    /**
     * @deprecated 2.1.0 This method is deprecated and will be removed in future versions.
     * Use `setPagination()` instead.
     */
    public function disablePagination(): self
    {
        $this->paginationEnabled = false;

        return $this;
    }

    public function result(): LengthAwarePaginator|Collection
    {
        return $this->paginationEnabled ? $this->defaultQuery()->paginate($this->getPerPage()) : $this->defaultQuery()->get();
    }
}
