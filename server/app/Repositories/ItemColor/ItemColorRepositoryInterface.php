<?php

namespace App\Repositories\ItemColor;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the ItemColor Model
 */
interface ItemColorRepositoryInterface extends RepositoryInterface
{
  /**
   * Filter the request from the performance
   *
   * @param array $searchParams
   * @return LengthAwarePaginator
   */
  public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;

  /**
   * Filter the request from the api
   *
   * @param array $searchParams
   * @return LengthAwarePaginator
   */
  public function serverPaginationFilterForApi(array $searchParams): LengthAwarePaginator;
}
