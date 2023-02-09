<?php

namespace App\Repositories\ItemPersonType;

use App\Models\ItemPersonType;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * The repository for Item Person Type Model
 */
class ItemPersonTypeRepository extends BaseRepository implements ItemPersonTypeRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * @inheritdoc
     */
    public function __construct(ItemPersonType $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return ItemPersonType::class;
    }

    /**
     * @inheritDoc
     */
    public function findByCode($code)
    {
        return $this->model->where('code', $code)->first();
    }
}
