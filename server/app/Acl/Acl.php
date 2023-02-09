<?php

namespace App\Acl;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class Acl
{
    const ROLE_SUPER_ADMIN = 'super admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_STAFF = 'staff';
    const ROLE_SHIPPER = 'shipper';
    const ROLE_CUSTOMER = 'customer';

    const PERMISSION_ASSIGNEE = 'assignee';

    const PERMISSION_VIEW_API_DOCUMENTATION = 'view api docs';

    const PERMISSION_VIEW_MENU_PERMISSION = 'view menu permission';
    const PERMISSION_VIEW_MENU_DASHBOARD = 'view menu dashboard';
    const PERMISSION_VIEW_MENU_ADMIN = 'view menu admin';
    const PERMISSION_VIEW_MENU_STAFF = 'view menu partner';
    const PERMISSION_VIEW_MENU_ROLE_PERMISSION = 'view menu role-permission';
    const PERMISSION_VIEW_MENU_ACCOUNT = 'view menu account';

    const PERMISSION_PERMISSION_MANAGE = 'manage permission';

    const PERMISSION_USER_MANAGE = 'manage user';
    const PERMISSION_USER_LIST = 'user list';
    const PERMISSION_USER_ADD = 'user add';
    const PERMISSION_USER_EDIT = 'user edit';
    const PERMISSION_USER_DELETE = 'user delete';

    const PERMISSION_CUSTOMER_MANAGE = 'manage customer';
    const PERMISSION_CUSTOMER_LIST = 'customer list';
    const PERMISSION_CUSTOMER_ADD = 'customer add';
    const PERMISSION_CUSTOMER_EDIT = 'customer edit';
    const PERMISSION_CUSTOMER_DELETE = 'customer delete';

    const PERMISSION_BRAND_LIST = 'brand list';
    const PERMISSION_BRAND_ADD = 'brand add';
    const PERMISSION_BRAND_EDIT = 'brand edit';
    const PERMISSION_BRAND_DELETE = 'brand delete';

    const PERMISSION_ITEM_CATEGORY_LIST = 'item category list';
    const PERMISSION_ITEM_CATEGORY_ADD = 'item category add';
    const PERMISSION_ITEM_CATEGORY_EDIT = 'item category edit';
    const PERMISSION_ITEM_CATEGORY_DELETE = 'item category delete';

    const PERMISSION_ITEM_SIZE_LIST = 'item size list';
    const PERMISSION_ITEM_SIZE_ADD = 'item size add';
    const PERMISSION_ITEM_SIZE_EDIT = 'item size edit';
    const PERMISSION_ITEM_SIZE_DELETE = 'item size delete';

    const PERMISSION_ITEM_COLOR_LIST = 'item color list';
    const PERMISSION_ITEM_COLOR_ADD = 'item color add';
    const PERMISSION_ITEM_COLOR_EDIT = 'item color edit';
    const PERMISSION_ITEM_COLOR_DELETE = 'item color delete';

    const PERMISSION_ITEM_LIST = 'item list';
    const PERMISSION_ITEM_ADD = 'item add';
    const PERMISSION_ITEM_EDIT = 'item edit';
    const PERMISSION_ITEM_DELETE = 'item delete';

    const PERMISSION_ITEM_STOCK_LIST = 'item stock list';
    const PERMISSION_ITEM_STOCK_ADD = 'item stock add';
    const PERMISSION_ITEM_STOCK_EDIT = 'item stock edit';
    const PERMISSION_ITEM_STOCK_DELETE = 'item stock delete';

    const PERMISSION_ORDER_LIST = 'order list';
    const PERMISSION_ORDER_ADD = 'order add';
    const PERMISSION_ORDER_EDIT = 'order edit';
    const PERMISSION_ORDER_DELETE = 'order delete';

    const PERMISSION_COUPON_MANAGE = 'manage customer';
    const PERMISSION_COUPON_LIST = 'coupon list';
    const PERMISSION_COUPON_ADD = 'coupon add';
    const PERMISSION_COUPON_EDIT = 'coupon edit';
    const PERMISSION_COUPON_DELETE = 'coupon delete';

    /**
     * @param array $exclusives Exclude some permissions from the list
     * @return array
     */
    public static function permissions(array $exclusives = []): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) use ($exclusives) {
                return !in_array($value, $exclusives) && Str::startsWith($key, 'PERMISSION_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function menuPermissions(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'PERMISSION_VIEW_MENU_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    /**
     * @return array
     */
    public static function roles(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $roles = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'ROLE_');
            });

            return array_values($roles);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }
}
