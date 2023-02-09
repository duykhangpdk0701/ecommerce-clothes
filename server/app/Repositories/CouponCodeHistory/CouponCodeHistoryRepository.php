<?php

namespace App\Repositories\CouponCodeHistory;

use App\Models\CouponCodeHistory;
use App\Repositories\BaseRepository;
use App\Repositories\CouponCode\CouponCodeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Session;

/**
 * The repository for Coupon Code History Model
 */
class CouponCodeHistoryRepository extends BaseRepository implements CouponCodeHistoryRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    const ORDER_TYPE_DESC = 'DESC';
    const ORDER_TYPE_ASC = 'ASC';
    const ITEM_PER_PAGE = 10;

    /**
     * @inheritdoc
     */
    public function __construct(
        CouponCodeHistory $model
    )
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function getCouponCodeHistory(array $params = [])
    {
        $qb = $this->model->query();
        foreach ($params as $k => $v) {
            $qb->where($k, $v);
        }
        return $qb->get();
    }

    /**
     * Update coupon history
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        try {
            DB::beginTransaction();

            $result = tap($model)->update($data);;

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    /**
     * @param null $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');

        $couponCodeId = Arr::get($searchParams, 'coupon_code');

        $dtColumns = Arr::get($searchParams, 'columns');
        $dtOrders = Arr::get($searchParams, 'order');

        $query = $this->model->query();

        if ($couponCodeId)
            $query->where('coupon_code_id', $couponCodeId);

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(
                function ($q) use ($keyword) {
                    $q->where('id', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('created_at', 'LIKE', '%' . $keyword . '%')
                        ->orWhereHas('customer', function ($q) use ($keyword) {
                            $q->where('name', 'LIKE', '%' . $keyword . '%');
                        })
                        ->orWhereHas('orderDetail.order', function ($q) use ($keyword) {
                            $q->where('order_code', 'LIKE', '%' . $keyword . '%');
                        });
                }
            );
        }

        if ($dtColumns && $dtOrders) {
            foreach ($dtOrders as $dtOrder) {
                $colIndex = $dtOrder['column'];
                $col = $dtColumns[$colIndex];
                if ($col['orderable'] === "true") {
                    $orderDirection = $dtOrder['dir'];
                    $orderName = $col['data'];
                    $query->orderBy($orderName, $orderDirection);
                }
            }
        }

        $query->orderByDesc('created_at');
        $query->with(['customer', 'orderDetail.order']);

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    public function getModel(): string
    {
        return CouponCodeHistory::class;
    }
}
