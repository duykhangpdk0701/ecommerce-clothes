<?php

namespace App\Repositories\CouponCodeEvent;

use App\Repositories\RepositoryInterface;

/**
 * The repository interface for the Coupon Code Model
 */
interface CouponCodeEventRepositoryInterface extends RepositoryInterface
{
    public function getCoupon($id);

    public function saveRandomCode($post);

    /**
     * Get coupon code
     * @param array $params
     * @return mixed
     */
    public function getCouponCode(array $params = []): mixed;

    /**
     * @param $code
     * @return mixed
     */
    public function findCouponByCode($code): mixed;
}
