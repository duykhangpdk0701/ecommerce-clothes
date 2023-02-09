<?php

namespace App\Repositories\Item;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

/**
 * The repository interface for the Brand Model
 */
interface ItemRepositoryInterface extends RepositoryInterface
{
    /**
     * Paginating, ordering and searching through pages for server side index table
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;

    /**
     * Paginating, ordering and searching through pages for server side index table for the mobile
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringForApi(array $searchParams): LengthAwarePaginator;

    /**
     * Filtering the item based on request
     *
     * @param Array $searchParams
     * @return Query
     */
    public function itemFilter($searchParams);

    /**
     * Find the item by $id and eager load the relationships for admin pages
     *
     * @param Array $searchParams
     * @return Query
     */
    public function findWithVariants($id);

    /**
     * Find the Item by its slug
     *
     * @param string $slug
     * @param boolean $withRelation
     * @return Collection
     */
    public function findBySlug($slug, bool $withRelation = false): mixed;
}
