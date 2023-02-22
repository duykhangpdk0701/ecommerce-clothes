<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $permissions = [];
        $roles = [];
        if ($this->relationLoaded('roles')) {
            $roles = array_map(
                function ($role) {
                    return $role['name'];
                },
                $this->roles->toArray()
            );
        }
        if ($this->relationLoaded('permissions')) {
            $permissions = array_map(
                function ($permission) {
                    return $permission['name'];
                },
                $this->getAllPermissions()->toArray()
            );
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->token,
            'roles' => array_map(
                function ($role) {
                    return $role['name'];
                },
                $this->roles->toArray()
            ),
            'permissions' => array_map(
                function ($permission) {
                    return $permission['name'];
                },
                $this->getAllPermissions()->toArray()
            ),
            'role' => isset($this->roles[0]) ? $this->roles[0]->name : '',
            'avatar' => $this->avatar,
            'reset_password_at' => $this->reset_password_at,
            'profile' => new UserProfileResource($this->userProfile),
            'multiple_address' => AddressResource::collection($this->addresses),
            'address_default' => new AddressResource($this->getAddressApplied())
        ];

    }
}
