<?php

namespace App\Repositories\Address;

use App\Models\Address;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * @inheritdoc
     */
    public function __construct(Address $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * Get Address model
     *
     * @return string
     */
    public function getModel(): string
    {
        return Address::class;
    }

    /**
     * @inheritdoc
     */
    public function create($data): mixed
    {
        $address = $this->model->create([
            'user_id' => auth()->id(),
            'phone'=> $data['phone'],
            'name' => $data['name'],
            'city_id' => $data['city_id'],
            'district_id' => $data['district_id'],
            'ward_id' => $data['ward_id'],
            'address' => $data['address']
        ]);
        return $this->setAsDefault($address);
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        if (auth()->id() === $model->user_id) {
            return $model->update($data);
        }
        return false;
    }

    /**
     * @inheritdoc
     * @param $model
     * @return bool
     */
    public function destroy($model): bool
    {
        if (auth()->id() === $model->user_id && $model->status !== CONST_ENABLE) {
            return $model->delete();
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function setAsDefault($model): mixed
    {
        if (auth()->id() === $model->user_id) {
            $modelExist = $this->findActiveByUserId(auth()->id());
            if ($modelExist) {
                $modelExist->update(['status' => CONST_DISABLE]);
            }
            return $model->update(['status' => CONST_ENABLE]);
        }
        return false;
    }

    /**
     *find active user by id
     * @param int $user_id
     * @return mixed
     *
     */
    public function findActiveByUserId(int $user_id): mixed
    {
        $result = $this->model->where('status', CONST_ENABLE)->where('user_id', $user_id)->first();
        if (!empty($result)) {
            return $result;
        }
        return false;
    }

    public function findByUserId(int $user_id): mixed
    {
        return $this->model->where('user_id', $user_id)->get();

    }


}
