<?php

if (!function_exists('checkPermission')) {

    /**
     * Check permission from current user
     *
     * @param string $permission
     * @return bool
     */
    function checkPermission($permission)
    {
        return auth()->user()->hasPermissionTo($permission);
    }
}

if (!function_exists('checkPermissions')) {

    /**
     * Check permissions from current user
     *
     * @param array $permissions
     * @return bool
     */
    function checkPermissions($permissions)
    {
        return auth()->user()->hasAnyPermission($permissions);
    }
}

if (!function_exists('checkOldArray')) {

    /**
     * Check old input name array from current user
     *
     * @param mixed $value
     * @param string $oldInputName
     * @param array $default
     * @return bool
     */
    function checkOldArray($value, $oldInputName, $default = null)
    {
        $array = old($oldInputName, $default);
        return $array && in_array($value, $array) ? 'selected' : '';
    }
}

if (!function_exists('logView')) {
    function logView($record)
    {
        $userId = '';
        $userEmail = '';

        if (auth()->check()) {
            $userId = auth()->user()->id;
            $userEmail = auth()->user()->email;
        }

        $tracking = uniqid();

        if (session()->get('tracking_id')) {
            $tracking = session()->get('tracking_id');
        } else {
            session()->put('tracking_id', $tracking);
        }

        $record->views()->firstOrCreate([
            'tracking' => $tracking,
            'user_id' => $userId,
        ], [
            'tracking' => $tracking,
            'user_id' => $userId,
            'user_email' => $userEmail,
            'user_activity' => '',
            'ip' => request()->ip(),
            'forwarded_ip' => request()->getClientIp(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
