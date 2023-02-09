<?php

namespace App\Repositories\ItemVariant;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * The repository interface for the Brand Model
 */
interface ItemVariantRepositoryInterface extends RepositoryInterface
{
    /**
     * Paginating, ordering and searching through pages for server side index table
     * @param array $searchParams
     */
    public function serverFilteringFor(array $searchParams);

    /**
     * Find the item variant with eager loading stocks
     *
     * @param Int $id
     * @return Collection
     */
    public function findByIdWithInStocks($id);

    /**
     * Find the item variant with eager loading stocks
     *
     * @param Int $id
     * @return Collection
     */
    public function findByIdWithLowestInStock($id);

    /**
     * Toggle status of the current resource
     *
     * @param $model
     */
    public function toggleStatus($model);
}
