<?php


use App\Acl\Acl;
use App\Models\Address;
use App\Models\Item;
use App\Models\ItemStock;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\QuoteDetail;
use App\Models\User;


if (!defined('ROLE_SUPER_ADMIN')) define('ROLE_SUPER_ADMIN', Acl::ROLE_SUPER_ADMIN);
if (!defined('ROLE_ADMIN')) define('ROLE_ADMIN', Acl::ROLE_ADMIN);
if (!defined('ROLE_STAFF')) define('ROLE_STAFF', Acl::ROLE_STAFF);
if (!defined('ROLE_SHIPPER')) define('ROLE_SHIPPER', Acl::ROLE_SHIPPER);

if (!defined('CONST_ENABLE')) define('CONST_ENABLE', '1');
if (!defined('CONST_DISABLE')) define('CONST_DISABLE', '0');
if (!defined('COUNTRY_VN')) define('COUNTRY_VN', '233');

//Status notification
if (!defined('NOTIFICATION_SUCCESS')) define('NOTIFICATION_SUCCESS', 'success');
if (!defined('NOTIFICATION_ERROR')) define('NOTIFICATION_ERROR', 'error');
if (!defined('NOTIFICATION_ERRORS')) define('NOTIFICATION_ERRORS', 'errors');

//payment method
if (!defined('FEE_TYPE_PERCENT')) define('FEE_TYPE_PERCENT', PaymentMethod::FEE_TYPE_PERCENT);
if (!defined('FEE_TYPE_PRICE')) define('FEE_TYPE_PRICE', PaymentMethod::FEE_TYPE_PRICE);

//Stock Statuses
if (!defined('CONST_STOCK_IN_STOCK')) define('CONST_STOCK_IN_STOCK', ItemStock::STOCK_IN_STOCK);
if (!defined('CONST_STOCK_PRE_ORDER')) define('CONST_STOCK_PRE_ORDER', ItemStock::STOCK_PRE_ORDER);
if (!defined('CONST_STOCK_OUT_OF_STOCK')) define('CONST_STOCK_OUT_OF_STOCK', ItemStock::STOCK_OUT_OF_STOCK);
if (!defined('CONST_STOCK_SOME_DAYS')) define('CONST_STOCK_SOME_DAYS', ItemStock::STOCK_SOME_DAYS);
if (!defined('CONST_STOCK_RECEIVING')) define('CONST_STOCK_RECEIVING', ItemStock::STOCK_RECEIVING);
if (!defined('CONST_STOCK_RECEIVED')) define('CONST_STOCK_RECEIVED', ItemStock::STOCK_RECEIVED);
if (!defined('CONST_STOCK_STATUSES')) define('CONST_STOCK_STATUSES', ItemStock::$stockStatuses);

//ITEM ORDER TYPES
if (!defined('ITEM_ORDER_TRENDING')) define('ITEM_ORDER_TRENDING', Item::ORDER_TRENDING);
if (!defined('ITEM_ORDER_NEW')) define('ITEM_ORDER_NEW', Item::ORDER_NEW);
if (!defined('ITEM_ORDER_OLD')) define('ITEM_ORDER_OLD', Item::ORDER_OLD);
if (!defined('ITEM_ORDER_MOST_POPULAR')) define('ITEM_ORDER_MOST_POPULAR', Item::ORDER_MOST_POPULAR);
if (!defined('ITEM_ORDER_LATEST_LISTING')) define('ITEM_ORDER_LATEST_LISTING', Item::ORDER_LATEST_LISTING);
if (!defined('ITEM_ORDER_FEATURED_ITEMS')) define('ITEM_ORDER_FEATURED_ITEMS', Item::ORDER_FEATURED_ITEMS);
if (!defined('ITEM_ORDER_PRICE_DESC')) define('ITEM_ORDER_PRICE_DESC', Item::ORDER_PRICE_DESC);
if (!defined('ITEM_ORDER_PRICE_ASC')) define('ITEM_ORDER_PRICE_ASC', Item::ORDER_PRICE_ASC);
if (!defined('ITEM_ORDER_TYPES')) define('ITEM_ORDER_TYPES', Item::$orderTypes);

//ITEM MEDIA TYPES
if (!defined('ITEM_MEDIA_TYPE_NORMAL')) define('ITEM_MEDIA_TYPE_NORMAL', Item::MEDIA_TYPE_NORMAL);
if (!defined('ITEM_MEDIA_TYPE_ZOOM')) define('ITEM_MEDIA_TYPE_ZOOM', Item::MEDIA_TYPE_ZOOM);

//ITEM MEDIA COLLECTIONS
if (!defined('ITEM_MEDIA_COLLECTION_THUMBNAIL')) define('ITEM_MEDIA_COLLECTION_THUMBNAIL', Item::THUMBNAIL_COLLECTION);
if (!defined('ITEM_MEDIA_THUMBNAIL_RESIZE')) define('ITEM_MEDIA_THUMBNAIL_RESIZE', Item::THUMBNAIL_RESIZE_NAME);
if (!defined('ITEM_MEDIA_THUMBNAIL_RESIZE_ZOOM')) define('ITEM_MEDIA_THUMBNAIL_RESIZE_ZOOM', Item::THUMBNAIL_RESIZE_ZOOM_NAME);
if (!defined('ITEM_MEDIA_COLLECTION_DETAIL')) define('ITEM_MEDIA_COLLECTION_DETAIL', Item::DETAIL_COLLECTION);

//USER MEDIA COLLECTIONS
if (!defined('USER_COLLECTION_AVATAR')) define('USER_COLLECTION_AVATAR', User::COLLECTION_AVATAR);

//Address
if (!defined('STATUS_ADDRESS_APPLIED')) define('STATUS_ADDRESS_APPLIED', Address::STATUS_ADDRESS_APPLIED);

//Order status
if (!defined('ORDER_STT_DRAFT')) define('ORDER_STT_DRAFT', OrderStatus::STT_DRAFT);
if (!defined('ORDER_STT_PENDING')) define('ORDER_STT_PENDING', OrderStatus::STT_PENDING);
if (!defined('ORDER_STT_PROCESSING')) define('ORDER_STT_PROCESSING', OrderStatus::STT_PROCESSING);
if (!defined('ORDER_STT_SHIPPED')) define('ORDER_STT_SHIPPED', OrderStatus::STT_SHIPPED);
if (!defined('ORDER_STT_COMPLETED')) define('ORDER_STT_COMPLETED', OrderStatus::STT_COMPLETED);
if (!defined('ORDER_STT_CANCELED')) define('ORDER_STT_CANCELED', OrderStatus::STT_CANCELED);
if (!defined('ORDER_STT_DENIED')) define('ORDER_STT_DENIED', OrderStatus::STT_DENIED);
if (!defined('ORDER_STT_CANCELED_REVERSAL')) define('ORDER_STT_CANCELED_REVERSAL', OrderStatus::STT_CANCELED_REVERSAL);
if (!defined('ORDER_STT_FAILED')) define('ORDER_STT_FAILED', OrderStatus::STT_FAILED);
if (!defined('ORDER_STT_REFUNDED')) define('ORDER_STT_REFUNDED', OrderStatus::STT_REFUNDED);
if (!defined('ORDER_STT_REVERSED')) define('ORDER_STT_REVERSED', OrderStatus::STT_REVERSED);
if (!defined('ORDER_STT_CHARGEBACK')) define('ORDER_STT_CHARGEBACK', OrderStatus::STT_CHARGEBACK);
if (!defined('ORDER_STT_EXPIRED')) define('ORDER_STT_EXPIRED', OrderStatus::STT_EXPIRED);
if (!defined('ORDER_STT_PROCESSED')) define('ORDER_STT_PROCESSED', OrderStatus::STT_PROCESSED);
if (!defined('ORDER_STT_VOIDED')) define('ORDER_STT_VOIDED', OrderStatus::STT_VOIDED);
if (!defined('ORDER_STT_ALLOCATED')) define('ORDER_STT_ALLOCATED', OrderStatus::STT_ALLOCATED);
if (!defined('ORDER_STT_PARTIAL_CANCELED')) define('ORDER_STT_PARTIAL_CANCELED', OrderStatus::STT_PARTIAL_CANCELED);
if (!defined('ORDER_STATUS_LIST')) define('ORDER_STATUS_LIST', OrderStatus::$orderStatusList);

if (!defined('QUANTITY_ADD_CART_DEFAULT')) define('QUANTITY_ADD_CART_DEFAULT', QuoteDetail::QUANTITY_ADD_CART_DEFAULT);
