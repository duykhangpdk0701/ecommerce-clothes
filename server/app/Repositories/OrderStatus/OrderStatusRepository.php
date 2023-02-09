<?php

namespace App\Repositories\OrderStatus;

use App\Models\OrderStatus;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * The repository for Role Model
 */
class OrderStatusRepository extends BaseRepository implements OrderStatusRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * @inheritdoc
     */
    public function __construct(OrderStatus $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return OrderStatus::class;
    }

    /**
     * @inheritdoc
     */
    public function create($data) :string
    {
        $data['slug'] = $this->generateSlug($data['name']);

        return $this->model->create($data);
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
    public function checkOrderStatusByOrderFlow($orderStatusBefore, $orderStatusAfter)
    {
        switch ($orderStatusBefore) {
            //Normal order.
            case ORDER_STT_DRAFT :
            case ORDER_STT_PENDING :
                $arr = [
                    ORDER_STT_PENDING,
                    ORDER_STT_PROCESSING,
                    ORDER_STT_SHIPPED,
                    ORDER_STT_COMPLETED,
                    ORDER_STT_CANCELED,
                ];

                if (in_array($orderStatusAfter, $arr)) {
                    return true;
                }
                return false;
            case ORDER_STT_PROCESSING :
                $arr = [
                    ORDER_STT_SHIPPED,
                    ORDER_STT_COMPLETED,
                    ORDER_STT_CANCELED,
                ];

                if (in_array($orderStatusAfter, $arr)) {
                    return true;
                }
                return false;
            case ORDER_STT_ALLOCATED:
            case ORDER_STT_SHIPPED :
                $arr = [
                    ORDER_STT_COMPLETED,
                    ORDER_STT_CANCELED,
                ];

                if (in_array($orderStatusAfter, $arr)) {
                    return true;
                }
                return false;
            case ORDER_STT_COMPLETED :
                $arr = [
                    ORDER_STT_CANCELED,
                ];

                if (in_array($orderStatusAfter, $arr)) {
                    return true;
                }
                return false;
        }
    }

    /**
     * @param $orderStatus
     * @return int|void
     */
    public function checkOrderStatusToCancel($orderStatus)
    {
        switch ($orderStatus) {
            //Khi order chua tao orderItem
            case ORDER_STT_DRAFT :
            case ORDER_STT_PENDING :
            case ORDER_STT_PROCESSING:
                return ORDER_WITH_OUT_ORDER_ITEM;
            //Khi order da tao orderItem
            case ORDER_STT_ALLOCATED:
            case ORDER_STT_SHIPPED:
            case ORDER_STT_COMPLETED:
                return ORDER_WITH_ORDER_ITEM;
        }
    }
}
