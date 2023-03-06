<?php

namespace App\Repositories\Quote;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * The repository interface for the SysDistrict Model
 */
interface QuoteRepositoryInterface extends RepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param $data
     * @return mixed
     */
    public function create($data): mixed;

    /**
     * @param $model
     * @param mixed $data
     * @return mixed
     */
    public function update($model, $data): mixed;

    /**
     * @param $model
     * @return bool
     */
    public function destroy($model): bool;

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id):mixed;

    public function getQuoteWithRelation($id);

    public function getQuoteByUser($userId);
}
