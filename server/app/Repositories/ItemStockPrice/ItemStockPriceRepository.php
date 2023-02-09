<?php

namespace App\Repositories\ItemStockPrice;

use App\Models\ItemStockPrice;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * The repository for Item Stock Price Model
 */
class ItemStockPriceRepository extends BaseRepository implements ItemStockPriceRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * @return string
     */
    public function getModel(): string
    {
        return ItemStockPrice::class;
    }

    /**
     * @inheritdoc
     */
    public function __construct(ItemStockPrice $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}

