<?php

use App\Acl\Acl;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->name('admin.')->group(function () {

    Route::middleware(['auth.admin', 'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_ADMIN . '|' . Acl::ROLE_STAFF . '|' . Acl::PERMISSION_VIEW_MENU_ADMIN . '|' . Acl::ROLE_SHIPPER])->group(function () {
        include('admin/brand.php');
        include('admin/user.php');
        include('admin/itemCategory.php');
        include('admin/itemColor.php');
        include('admin/itemSize.php');
        include('admin/item.php');
        include('admin/itemStock.php');
        include('admin/itemVariant.php');
    });
});
