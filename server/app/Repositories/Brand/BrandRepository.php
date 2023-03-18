<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Mod;

/**
 * The repository for Brand Model
 */
class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{

    /**
     * @inheritdoc
     */
    protected Model $model;
    const PER_PAGE = 100;

    /**
     * @inheritdoc
     */
    public function __construct(Brand $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return Brand::class;
    }

    /**
     * @inheritdoc
     */
    public function serverFilterFor(array $searchParams): Collection
    {
        $isShow = Arr::get($searchParams, 'is_show', false);
        $query = $this->model->query();

        if ($isShow) {
            $query->where('status', true);
        }
        return $query->get();
    }


    /**
     * @inheritDoc
     */
    public function serverPaginationFilterFor($searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');

        $query = $this->model->query();
        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @inheritdoc
     */
    public function serverPaginationFilterForApi(array $searchParams): LengthAwarePaginator
    {
        $isShow = Arr::get($searchParams, 'is_show', true);
        $limit = Arr::get($searchParams, 'limit', self::PER_PAGE);

        $query = $this->model->query();

        if ($isShow) {
            $query->where('status', true);
        }
        return $query->paginate($limit);
    }

    public function toggleStatus($model)
    {
        $brand = $model->update(["status" => !$model->status]);
        $this->resetCache();
        return $brand;
    }

    /**
     * Reset all the caches store for this resource
     *
     * @return void
     */
    function resetCache(): void
    {
        Cache::forget(Brand::CACHE_SUB_NAVBAR);
    }

    /**
     * @inheritdoc
     */
    public function create($data): mixed
    {
        $data['slug'] = Str::slug($data['slug'], '-');

        if (!$data['slug']) {
            $data['slug'] = $this->generateSlug($data['name']);
        }

        $this->resetCache();

        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        $data['slug'] = $this->generateSlug($data['name'], $model->id);

        $this->resetCache();

        return $model->update($data);
    }

    /**
     * @inheritdoc
     */
    public function destroy($model): bool
    {
        if ($model->items->count()) {
            session()->flash(NOTIFICATION_ERROR, __('error.brand.delete', ['name' => 'items']));
            return $model;
        }
        $model->delete();
        $this->resetCache();
        return session()->flash(NOTIFICATION_SUCCESS, __('success.brand.delete', ['brand' => $model->name]));
    }

    public function checkSlugExist($slug, $id = null)
    {
        return $this->model->where('id', '!=', $id)->where('slug', $slug)->first();
    }

    /**
     * Generate slug
     */
    function generateSlug($name, $id = null): string
    {
        $slug = Str::slug($name, '-');
        $checkSlug = $this->checkSlugExist($slug, $id);
        while ($checkSlug) {
            $slug = $slug . '-1';
            $checkSlug = $this->checkSlugExist($slug, $id);
        }
        return $slug;
    }


}
