<?php

namespace App\Repositories\Order;

use App\Acl\Acl;
use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository for Role Model
 */
class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;
    const ITEM_PER_PAGE = 10;

    /**
     * @inheritdoc
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return Order::class;
    }

    /**
     * get all orders
     * @return mixed
     */
    public function all(): Collection
    {
        return $this->model->withCount('orderItems as num_orderItems')
            ->whereHas('orderDetails')->get();
    }

    /**
     * @inheritDoc
     */
    public function find($id): mixed
    {
        return $this->model->where('id', $id)
            ->withCount('orderDetails', 'orderItems')
            ->withSum('orderDetails as sum_order_details', 'quantity')
            ->withSum('orderItems as sum_order_items', 'quantity')
            ->first();
    }

    /**
     * @param null $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $orderCode = Arr::get($searchParams, 'order_code', '');
        $phoneNumber = Arr::get($searchParams, 'phone_number', '');
        $orderBy = Arr::get($searchParams, 'order_by', '');
        $fromDate = Arr::get($searchParams, 'from_date', 0);
        $toDate = Arr::get($searchParams, 'to_date', 0);
        $orderStatus = Arr::get($searchParams, 'order_status', '');
        $staff = Arr::get($searchParams, 'staff', '');
        $shipperId = Arr::get($searchParams, 'shipper_id', '');
        $startDate = '';
        $endDate = '';

        if ($fromDate) {
            $startDate = Carbon::parse($fromDate)->startOfDay();
        }

        if ($toDate) {
            $endDate = Carbon::parse($toDate)->endOfDay();
        }

        $query = $this->model->query();

        //Why I do dis ??? vutch
        $offlineOrder = $query->whereNotNull('staff_id');

        $query->withCount('orderItems as num_orderItems');

        if (auth()->user()->hasRole(Acl::ROLE_STAFF) && $offlineOrder) {
            $query->where('staff_id', auth()->user()->id);
        }

        if ($orderCode) {
            $query->where('order_code', $orderCode);
        }

        if ($phoneNumber) {
            $query->where('shipping_phone', 'like', '%' . $phoneNumber . '%');
        }

        if ($fromDate && $toDate === null) {
            $query->whereBetween('created_at', [$startDate, Carbon::now()]);
        }

        if ($toDate && $fromDate === null) {
            $query->whereBetween('created_at', [Carbon::now(), $endDate]);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }


        if ($orderStatus) {
            $query->where('order_status_id', ($orderStatus));
        }

        if ($staff) {
            $query->where('staff_id', $staff);
        }

        if ($shipperId) {
            $query->where('shipper_id', $shipperId);
        }

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->where('order_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_address', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('payment_method', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('payment_fee', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_price', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_discount', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_shipping', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_payment_fee', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('customer', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('staff', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('couponCode', function ($q) use ($keyword) {
                        $q->where('code', 'LIKE', '%' . $keyword . '%');
                    });
            });
        }
        $query->orderByDesc('created_at');
        $query->with([
            'couponCode',
            'paymentMethod',
            'orderDetails',
            'staff',
            'customer'
        ]);
        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
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
     * @inheritdoc
     */
    function getLatest(): Collection
    {
        return $this->model->latest()->first();
    }

    /**
     * @inheritdoc
     */
    function getOrder(array $params = []): Collection
    {
        $qb = $this->model->query();
        foreach ($params as $k => $v) {
            $qb->where($k, $v);
        }
        return $qb->get();
    }

    /**
     * Update order info
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        try {
            DB::beginTransaction();
            $result = $model->update($data);;

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    /**
     * Get array ID of order
     *
     * @param $id
     * @return mixed
     */
    public function getOrderIdByUser($id)
    {
        return $this->model->select('id')->whereNotNull('staff_id')->where('staff_id', $id)->get()->toArray();
    }

    /**
     * @param null $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilterForUser($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $orderBy = Arr::get($searchParams, 'order_by', '');
        $fromDate = Arr::get($searchParams, 'from_date', 0);
        $toDate = Arr::get($searchParams, 'to_date', 0);
        $orderStatus = Arr::get($searchParams, 'order_status', '');
        $dtColumns = Arr::get($searchParams, 'columns');
        $dtOrders = Arr::get($searchParams, 'order', 'desc');
        $orderBy = Arr::get($searchParams, 'order_by');

        $query = $this->model->query();

        $query->withCount('orderItems as num_orderItems');


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

        if ($orderStatus) {
            switch ($orderStatus) {
                case ORDER_STT_PENDING:
                    $query->whereIn('order_status_id', [ORDER_STT_DRAFT, ORDER_STT_PENDING, ORDER_STT_PROCESSING, ORDER_STT_SHIPPED]);
                    break;
                default:
                    $query->where('order_status_id', $orderStatus);
                    break;
            }
        }

        if (auth()->user()->id) {
            $query->where('customer_id', auth()->user()->id);
        }

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->where('order_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_address', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('payment_method', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('payment_fee', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_price', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_discount', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_shipping', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_payment_fee', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('customer', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('staff', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('couponCode', function ($q) use ($keyword) {
                        $q->where('code', 'LIKE', '%' . $keyword . '%');
                    });
            });
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
        $query->with([
            'couponCode',
            'paymentMethod',
            'orderDetails',
        ]);
        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @param null $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilterForApi($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $withItems = Arr::get($searchParams, 'with_items', false);
        $keyword = Arr::get($searchParams, 'search', '');
        $orderStatus = Arr::get($searchParams, 'order_status', '');

        $query = $this->model->where('customer_id', auth()->id());

        if ($withItems) {
            $query->with('getOrderItems');
        }

        switch ($orderStatus) {
            case ORDER_STT_COMPLETED:
                $query->where('order_status_id', $orderStatus);
                break;
            case ORDER_STT_CANCELED:
                $query->where('order_status_id', $orderStatus);
                break;
            case ORDER_STT_PENDING:
                $query->whereIn('order_status_id', [ORDER_STT_DRAFT, ORDER_STT_PENDING, ORDER_STT_PROCESSING, ORDER_STT_SHIPPED]);
                break;
        }
        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->where('order_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('shipping_address', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('payment_method', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('payment_fee', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_price', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_discount', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_shipping', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_payment_fee', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('customer', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('staff', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('couponCode', function ($q) use ($keyword) {
                        $q->where('code', 'LIKE', '%' . $keyword . '%');
                    });
            });
        }

        $query->withSum('orderDetails as number_order_items', 'quantity');
        $query->with([
            'couponCode',
            'paymentMethod',
            'orderDetails',
            'orderDetails.item',
            'orderDetails.itemVariant'
        ]);
        $query->orderByDesc('created_at');

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @inheritdoc
     */
    public function getOrderDetailForApi($orderCode)
    {
        $order = $this->model->where('order_code', $orderCode)
            ->where('customer_id', auth()->id())
            ->withSum('orderDetails as number_order_items', 'quantity')
            ->first();
        if (!empty($order)) {
            $order->load(
                'couponCode',
                'paymentMethod',
                'orderDetails',
                'orderDetails.item',
                'orderDetails.itemVariant'
            );
            return $order;
        }
        return false;
    }
}
