<?php

namespace App\Repositories\PaymentMethod;

use App\Models\PaymentMethod;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 * The repository for SysDistrict Model
 */
class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    const ITEM_PER_PAGE = 10;

    /**
     * @inheritdoc
     */
    public function __construct(PaymentMethod $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return PaymentMethod::class;
    }

    /**
     * Get active payment method
     * @return mixed
     */
    public function getPaymentMethodActive()
    {
        return $this->model->where('status', $this->model::ACTIVE)->whereNotIn('key', [$this->model::KEY_ORDER_ONLINE])->get();
    }

    public function getPaymentMethodCustomer()
    {
        return $this->model->where('status', $this->model::ACTIVE)->get();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function findByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }

    /**
     * @param null $searchParams
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');

        $dtColumns = Arr::get($searchParams, 'columns');
        $dtOrders = Arr::get($searchParams, 'order');

        $query = $this->model->query();

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(
                function ($q) use ($keyword) {
                    $q->where('id', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('key', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('created_at', 'LIKE', '%' . $keyword . '%');
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

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @inheritdoc
     */
    public function toggleStatus($model)
    {
        return $model->update(['status' => !$model->status]);
    }
}
