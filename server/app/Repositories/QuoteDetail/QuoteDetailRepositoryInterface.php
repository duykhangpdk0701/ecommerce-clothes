<?php

namespace App\Repositories\QuoteDetail;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * The repository interface for the SysDistrict Model
 */
interface QuoteDetailRepositoryInterface extends RepositoryInterface
{
    /**
     * @return Collection
     */
    public function all() :Collection;

    /**
     * @param $data
     * @return mixed
     */
    public function create($data) : mixed;

    /**
     * @param $model
     * @param mixed $data
     * @return mixed
     */
    public function update($model, $data) : bool;

    /**
     * @param $model
     * @return bool
     */
    public function destroy($model) : bool;

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id) : mixed;

    /**
     * @param $quoteId
     * @return mixed
     */
    public function getWithItemAndSize($quoteId);

    /**
     * @param $quoteDetailId
     * @return mixed
     */
    public function findItemWithQuote($quoteDetailId);

    /**
     * @param $quoteId
     * @param $coupon
     * @return mixed
     */
    public function countCouponInQuote($quoteId, $coupon);
}
