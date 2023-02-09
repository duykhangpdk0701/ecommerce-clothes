<?php

namespace App\Providers;

use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\CouponCode\CouponCodeRepository;
use App\Repositories\CouponCode\CouponCodeRepositoryInterface;
use App\Repositories\CouponCodeEvent\CouponCodeEventRepository;
use App\Repositories\CouponCodeEvent\CouponCodeEventRepositoryInterface;
use App\Repositories\CouponCodeHistory\CouponCodeHistoryRepository;
use App\Repositories\CouponCodeHistory\CouponCodeHistoryRepositoryInterface;
use App\Repositories\Item\ItemRepositoryInterface;
use App\Repositories\ItemCategory\ItemCategoryRepository;
use App\Repositories\ItemCategory\ItemCategoryRepositoryInterface;
use App\Repositories\ItemColor\ItemColorRepository;
use App\Repositories\ItemColor\ItemColorRepositoryInterface;
use App\Repositories\ItemPersonType\ItemPersonTypeRepository;
use App\Repositories\ItemPersonType\ItemPersonTypeRepositoryInterface;
use App\Repositories\ItemSize\ItemSizeRepository;
use App\Repositories\ItemSize\ItemSizeRepositoryInterface;
use App\Repositories\ItemStock\ItemStockRepository;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\ItemStockPrice\ItemStockPriceRepository;
use App\Repositories\ItemStockPrice\ItemStockPriceRepositoryInterface;
use App\Repositories\ItemVariant\ItemVariantRepository;
use App\Repositories\ItemVariant\ItemVariantRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepository;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Repositories\OrderStatus\OrderStatusRepository;
use App\Repositories\OrderStatus\OrderStatusRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepository;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Quote\QuoteRepository;
use App\Repositories\Quote\QuoteRepositoryInterface;
use App\Repositories\QuoteDetail\QuoteDetailRepository;
use App\Repositories\QuoteDetail\QuoteDetailRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Item\ItemRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->singleton(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->singleton(ItemCategoryRepositoryInterface::class, ItemCategoryRepository::class);
        $this->app->singleton(ItemColorRepositoryInterface::class, ItemColorRepository::class);
        $this->app->singleton(ItemSizeRepositoryInterface::class, ItemSizeRepository::class);
        $this->app->singleton(ItemPersonTypeRepositoryInterface::class, ItemPersonTypeRepository::class);
        $this->app->singleton(ItemRepositoryInterface::class, ItemRepository::class);
        $this->app->singleton(ItemVariantRepositoryInterface::class, ItemVariantRepository::class);
        $this->app->singleton(ItemStockRepositoryInterface::class, ItemStockRepository::class);
        $this->app->singleton(ItemStockPriceRepositoryInterface::class, ItemStockPriceRepository::class);
        $this->app->singleton(AddressRepositoryInterface::class, AddressRepository::class);

        $this->app->singleton(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->singleton(OrderStatusRepositoryInterface::class, OrderStatusRepository::class);
        $this->app->singleton(OrderDetailRepositoryInterface::class, OrderDetailRepository::class);
        $this->app->singleton(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->singleton(CouponCodeEventRepositoryInterface::class, CouponCodeEventRepository::class);
        $this->app->singleton(CouponCodeRepositoryInterface::class, CouponCodeRepository::class);
        $this->app->singleton(CouponCodeHistoryRepositoryInterface::class, CouponCodeHistoryRepository::class);
        $this->app->singleton(QuoteRepositoryInterface::class, QuoteRepository::class);
        $this->app->singleton(QuoteDetailRepositoryInterface::class, QuoteDetailRepository::class);
        $this->app->singleton(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
