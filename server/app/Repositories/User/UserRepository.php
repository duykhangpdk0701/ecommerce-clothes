<?php

namespace App\Repositories\User;

use App\Acl\Acl;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * The repository for User Model
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    const DEFAULT_NAME_ADDRESS = 'Default';

    /**
     * @inheritdoc
     */
    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return User::class;
    }

    /**
     * @inheritdoc
     */
    public function allWithRoles(): Collection|array
    {
        return $this->model->with('roles')->get();
    }

    /**
     * @inheritdoc
     */
    public function create($data): mixed
    {
        try {
            DB::beginTransaction();

            $data['password'] = Hash::make($data['password']);

            $data['name'] = $data['last_name'] . ' ' . $data['first_name'];

            $user = $this->model->create($data);

            $user->userProfile()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone']
            ]);

            $user->addresses()->create([
                'city_id' => $data['city_id'],
                'district_id' => $data['district_id'],
                'ward_id' => $data['ward_id'] ?? NULL,
                'address' => $data['address'],
                'name' => 'Default',
                'status' => CONST_ENABLE
            ]);

            $user->syncRoles($data['role']);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data): bool
    {
        try {
            DB::beginTransaction();

            $user = $model->update($data);

            if (isset($data['role'])) {
                $model->syncRoles([$data['role']]);
            }

            if (isset($data['first_name'])) {
                $model->userProfile()->update([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name']
                ]);
                $data['name'] = $data['last_name'] . ' ' . $data['first_name'];
                $model->update(['name' => $data['name']]);
            }

            if (isset($data['phone'])) {
                $model->userProfile()->update([
                    'phone' => $data['phone']
                ]);
            }

            if (isset($data['city_id'])) {
                $model->addresses()->updateOrCreate(
                    [
                        'status' => STATUS_ADDRESS_APPLIED
                    ],
                    [
                        'name' => self::DEFAULT_NAME_ADDRESS,
                        'city_id' => $data['city_id'],
                        'district_id' => $data['district_id'],
                        'ward_id' => $data['ward_id'] ?? NULL,
                        'address' => $data['address']
                    ]
                );
            }

            if (isset($data['avatar']) && $data['avatar']) {
                $model
                    ->addMediaFromRequest('avatar')
                    ->toMediaCollection(USER_COLLECTION_AVATAR);
            }

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function resetPassword($model, $data)
    {
        try {
            DB::beginTransaction();

            $data['password'] = Hash::make($data['password']);

            $user = $model->update($data);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function registerCustomer($data)
    {
        try {
            DB::beginTransaction();

            $password = Hash::make($data['password']);
            $data['name'] = $data['last_name'] . ' ' . $data['first_name'];

            $user = $this->model->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $password,
            ]);

            $user->userProfile()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name']
            ]);

            $user->assignRole(Acl::ROLE_CUSTOMER);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Check exist user by email
     * @param $email
     * @return mixed
     *
     */
    public function checkExistUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Create or update user login socical api.
     */
    public function handleLoginSocialiteApi($user, $oauth_type)
    {
        try {
            DB::beginTransaction();

            $nameConvertToArray = explode(' ', $user->name);

            if (count($nameConvertToArray) === 1) {
                $first_name = $nameConvertToArray[0];
                $last_name = '';
            } elseif (count($nameConvertToArray) > 1) {
                $first_name = $nameConvertToArray[1];
                for ($i = 2; $i < count($nameConvertToArray); $i++) {
                    $first_name .= ' ' . $nameConvertToArray[$i];
                }
                $last_name = $nameConvertToArray[0];
            }

            $userExisted = $this->model->where(function ($query) use ($user, $oauth_type) {
                $query->where('oauth_type', $oauth_type)
                    ->where('oauth_id', $user->id)
                    ->where('email', $user->email);
            })->orWhere('email', $user->email)->first();

            if ($userExisted) {
                $userExisted->update([
                    'name' => $user->name,
                    'oauth_id' => $user->id,
                    'oauth_type' => $oauth_type,
                    'access_token' => $user->token
                ]);

                $userExisted->userProfile()->update([
                    'first_name' => $first_name,
                    'last_name' => $last_name
                ]);

                $userResult = $userExisted;
            } else {
                $newUser = $this->model->create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id' => $user->id,
                    'oauth_type' => $oauth_type,
                    'access_token' => $user->token,
                    'password' => Hash::make($user->id)
                ]);

                $newUser->userProfile()->create([
                    'first_name' => $first_name,
                    'last_name' => $last_name
                ]);

                $newUser->assignRole(ACL::ROLE_CUSTOMER);

                $userResult = $newUser;
            }

            if (isset($user->avatar)) {
                $url = $user->avatar;
                $filename = time() . '.png';

                $userResult->addMediaFromUrl($url)->usingFileName($filename)
                    ->toMediaCollection(USER_COLLECTION_AVATAR);
            }

            DB::commit();

            return $userResult;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
