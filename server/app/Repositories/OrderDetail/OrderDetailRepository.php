<?php

namespace App\Repositories\OrderDetail;

use App\Acl\Acl;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * The repository for Role Model
 */
class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    const ITEM_PER_PAGE = 10;

    /**
     * @inheritdoc
     */
    public function __construct(OrderDetail $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return OrderDetail::class;
    }

    /**
     * Generate slug
     *
     * @param string $name
     */
    function generateSlug($name)
    {
        $slug = Str::slug($name, '-');
        $checkSlug = $this->findBySlug($slug);
        while ($checkSlug) {
            $slug = $slug . '-1';
            $checkSlug = $this->findBySlug($slug);
        }
        return $slug;
    }

    /**
     * @param array $params
     * @return Collection | array
     */

    public function getOrderDetail(array $params = []): Collection|array
    {
        $qb = $this->model->query();
        foreach ($params as $k => $v) {
            $qb->where($k, $v);
        }
        return $qb->get();
    }

    public function getSumQuantityOrderDetail($orderId)
    {
        return $this->model->where(['order_id' => $orderId])->first()->sum('quantity');
    }

    /**
     * @param null $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');

        $orderBy = Arr::get($searchParams, 'order_by', '');
        $fromDate = Arr::get($searchParams, 'from_date', 0);
        $toDate = Arr::get($searchParams, 'to_date', 0);


        $query = $this->model->query();

        $query->whereRelation('order', 'customer_id', auth()->user()->id);

        if ($fromDate > 0 && $toDate === 0) {
            $query->where('created_at', $fromDate);
        }

        if ($fromDate === 0 && $toDate > 0) {
            $query->where('created_at', $toDate);
        }

        if ($fromDate === $toDate) {
            $query->where('created_at', 'like', '%' . $fromDate . '%');
        }

        if ($fromDate > 0 && $toDate > 0) {
            $query->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate);
        }


        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $statusValue = '';
                $status = collect(OrderStatus::$orderStatusList)->where('name', $keyword)->first();
                if (!empty($status)) {
                    $statusValue = $status['id'];
                }

                $q->where('size_value', 'LIKE', '%' . $keyword . '%')
                    ->where('price', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('order', function ($q) use ($keyword) {
                        $q->where('order_code', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('item', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('order', function ($q) use ($keyword) {
                        $q->where('order_status_id', 'LIKE', '%' . $keyword . '%');
                    });
            });
        }
        $query->orderByDesc('created_at');
        $query->with(['order']);

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }
}
