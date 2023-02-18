<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Repositories\ItemPersonType\ItemPersonTypeRepositoryInterface;
use Illuminate\Http\Request;

class ItemPersonTypeController extends Controller
{
    protected ItemPersonTypeRepositoryInterface $itemPersonTypeRepository;

    public function __construct(ItemPersonTypeRepositoryInterface $itemPersonTypeRepository)
    {
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_COLOR_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_COLOR_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_COLOR_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_COLOR_DELETE)->only("destroy");

        $this->itemPersonTypeRepository = $itemPersonTypeRepository;
    }
}
