<?php

namespace App\Repositories\Quote;

use App\Acl\Acl;
use App\Models\Quote;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\QuoteDetail\QuoteDetailRepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/**
 * The repository for SysDistrict Model
 */
class QuoteRepository extends BaseRepository implements QuoteRepositoryInterface
{

    protected QuoteDetailRepositoryInterface $quoteDetailRepository;

    protected PaymentMethodRepositoryInterface $paymentMethodRepository;

    protected ItemStockRepositoryInterface $itemStockRepository;

    const ROLE_SUPER_ADMIN = 1;

    /**
     * QuoteRepository constructor.
     * @param Quote $model
     * @param PaymentMethodRepositoryInterface $paymentMethodRepository
     * @throws BindingResolutionException
     */
    public function __construct(
        Quote                            $model,
        PaymentMethodRepositoryInterface $paymentMethodRepository
    )
    {
        $this->model = $model;
        $this->paymentMethodRepository = $paymentMethodRepository;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return Quote::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|void
     */
    public function all(): Collection
    {
        return $this->model->get();
    }

    /**
     * @param $data
     * @return mixed|void
     */
    public function create($data): mixed
    {
        try {
            DB::beginTransaction();

            $fillData = [
                'ip' => request()->ip(),
                'forwarded_ip' => request()->getClientIp(),
                'status' => $this->model::STT_DRAFT,
                'total_price' => $data->price ?? 0,
                'total' => $data->price ?? 0,
                'user_agent' => request()->header('User-Agent'),
            ];

            if (!empty($data['customer_id'])) {
                $fillData['customer_id'] = $data['customer_id'];
            }

            if (!empty(request()->input('customer_id'))) {
                $fillData['customer_id'] = request()->input('customer_id');
            }

            if (!empty($data['customer_id'])) {
                $fillData['customer_id'] = $data['customer_id'];
            }

            if (auth()->check()) {
                $fillData['created_by'] = auth()->user()->id;
                $fillData['updated_by'] = auth()->user()->id;
            } else {
                $fillData['created_by'] = User::role(Acl::ROLE_SUPER_ADMIN)->first()->id;
            }


            if (auth()->check() && auth()->user()->hasAnyRole(Acl::ROLE_STAFF, Acl::ROLE_ADMIN, Acl::ROLE_SUPER_ADMIN)) {
                $fillData['staff_id'] = auth()->user()->id;
            } else {
                $fillData['staff_id'] = self::ROLE_SUPER_ADMIN;
            }

            $result = $this->model->create($fillData);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $quote_id
     * @param $item
     * @return mixed
     */
    public function updateWithStock($quote_id, $item)
    {
        try {
            DB::beginTransaction();

            $quote = $this->find($quote_id);

            $data = [
                'total_price' => $quote->total_price + $item->price,
                'total' => $quote->total + $item->price
            ];

            $result = tap($quote)->update($data);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function updateQuoteCode($id)
    {
        try {
            DB::beginTransaction();

            $data = ['quote_code' => $this->model::QUOTE_PREFIX . date('Ymd') . '-' . str_pad(($id + 1), 4, '0', STR_PAD_LEFT)];

            $this->find($id)->update($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $model
     * @param mixed $data
     * @return mixed|void
     */
    public function update($model, $data): mixed
    {
        try {
            DB::beginTransaction();

            if (auth()->check()) {
                $data['updated_by'] = auth()->user()->id;
            } else {
                $data['updated_by'] = User::role(Acl::ROLE_SUPER_ADMIN)->first()->id;
                $data['staff_id'] = self::ROLE_SUPER_ADMIN;
            }

            if (request()->input('customer_id')) {
                $data['customer_id'] = request()->input('customer_id');
            }

            if (request()->input('billing_name')) {
                $data['shipping_name'] = request()->input('billing_name');
                $data['shipping_address'] = request()->input('billing_address');
                $data['shipping_city_id'] = request()->input('billing_city_id');
                $data['shipping_district_id'] = request()->input('billing_district_id');
                $data['shipping_ward_id'] = request()->input('billing_ward_id');
                $data['shipping_phone'] = request()->input('billing_phone');
                $data['status'] = $this->model::STT_PENDING;
            }

            if (isset($data['payment_method_id'])) {
                $paymentMethod = $this->paymentMethodRepository->find($data['payment_method_id']);
                $data['payment_method'] = $paymentMethod->key;
                if ($paymentMethod->fee_type === FEE_TYPE_PERCENT) {
                    $data['total'] = $model->total + ($model->total * $paymentMethod->fee / 100);
                } else {
                    $data['total'] = $model->total + $paymentMethod->fee;
                }

                if (auth()->check() && auth()->user()->hasAnyRole(Acl::ROLE_STAFF, Acl::ROLE_ADMIN, Acl::ROLE_SUPER_ADMIN)) {
                    $data['status'] = $this->model::STT_ORDER;
                } else {
                    $data['status'] = $this->model::STT_PENDING;
                }
            }
            $result = $model->update($data);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $model
     * @return bool|void
     */
    public function destroy($model): bool
    {
        try {
            DB::beginTransaction();

            $result = $this->find($model)->delete();

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return $this->model->with([
            'quoteDetails',
            'quoteDetails.item',
            'quoteDetails.itemVariant',
        ])->where('id', $id)->first();
    }

    /**
     * @return mixed
     */
    public function getLastQuote(): mixed
    {
        return $this->model->all()->last();
    }

    /**
     * @param $id
     * @param $price
     * @return mixed
     */
    public function deleteAfterOutOfCart($id, $price)
    {
        $quote = $this->find($id);

        $data = [
            'total_price' => $quote->total_price - $price,
            'total' => $quote->total - $price
        ];

        $this->update($quote, $data);
    }

    /**
     * @return mixed
     */
    public function getAvailableQuote()
    {
        return $this->model
            ->whereHas('quoteDetails', function ($q) {
                $q->whereNotNull('items');
            })
            ->whereNotIn('status', [$this->model::STT_ORDER, $this->model::STT_DELETE])
            ->get();
    }

    /**
     * @param $quoteId
     * @param $data
     * @return mixed
     */
    public function updateComment($quoteId, $data)
    {
        return $this->model->find($quoteId)->update($data);
    }


    /**
     * @param $model
     * @return bool|null
     */
    public function softDelete($model)
    {
        return $model->delete();
    }

    public function updatePriceAfterDelete($quote)
    {
        $totalPrice = 0;

        foreach ($quote->quoteDetails as $item) {
            $totalPrice += ($item->price * $item->quantity);
        }

        $data = [
            'total_price' => $totalPrice,
            'total' => $totalPrice - $quote->total_discount
        ];

        $this->update($quote, $data);
    }

    /**
     * @return false
     */
    public function createQuote()
    {
        try {
            DB::beginTransaction();

            $fillData = [
                'ip' => request()->ip(),
                'forwarded_ip' => request()->getClientIp(),
                'status' => $this->model::STT_DRAFT,
                'user_agent' => request()->header('User-Agent'),
            ];

            if (auth()->check()) {
                $fillData['created_by'] = auth()->user()->id;
                $fillData['updated_by'] = auth()->user()->id;

                if (!empty(auth()->user()->userProfile->branch_id)) {
                    $fillData['branch_id'] = auth()->user()->userProfile->branch_id;
                }
            } else {
                $fillData['created_by'] = User::role(Acl::ROLE_SUPER_ADMIN)->first()->id;
            }

            $fillData['staff_id'] = auth()->user()->id;


            $result = $this->model->create($fillData);

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getQuoteByUser($userId)
    {
        return $this->model
            ->with([
                'quoteDetails',
                'quoteDetails.item',
                'quoteDetails.itemVariant',
                'quoteDetails.itemVariant.size',
                'quoteDetails.itemVariant.color'
            ])
            ->where('customer_id', $userId)
            ->latest()
            ->first();
    }

    /**
     * @param $id
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function getQuoteWithRelation($id)
    {
        return $this->model->with([
            'quoteDetails',
            'quoteDetails.item',
            'quoteDetails.itemVariant',
            'user',
            'customer',
            'staff',
            'shippingCity',
            'shippingDistrict',
            'shippingWard',
            'paymentMethod',
            'createdBy',
            'updatedBy'
        ])->find($id);
    }
}
