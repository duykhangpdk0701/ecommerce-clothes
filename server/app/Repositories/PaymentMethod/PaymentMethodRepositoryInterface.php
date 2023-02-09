<?php

namespace App\Repositories\PaymentMethod;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the SysDistrict Model
 */
interface PaymentMethodRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function findByKey($key);

    /**
     * Get active payment method
     * @return mixed
     */
    public function getPaymentMethodActive();

    public function getPaymentMethodCustomer();

    /**
     * Filter the request from the performance
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;

    /*
    * Toggle status of the current resource
    *
    * @param $model
    */
    public function toggleStatus($model);
}
