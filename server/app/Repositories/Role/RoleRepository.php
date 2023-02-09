<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * The repository for Role Model
 */
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * @inheritdoc
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function getModel()
    {
        return $this->model;
    }

    /**
     * @inheritdoc
     */
    public function allRolesWithPermissions()
    {
        return $this->model->with('permissions')->get();
    }

    /**
     * @inheritdoc
     */
    public function create($data): mixed
    {
        try {
            DB::beginTransaction();

            $role = $this->model->findOrCreate($data['name']);
            $role->givePermissionTo($data['permissions']);

            DB::commit();

            return $role;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data): bool
    {
        try {
            DB::beginTransaction();

            $role = $this->model->findOrCreate($data['name']);
            $role->syncPermissions($data['permissions']);

            DB::commit();

            return $role;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
