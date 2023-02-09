<?php

namespace App\Services;

use App\Models\CouponCode;
use App\Repositories\CouponCode\CouponCodeRepositoryInterface;
use App\Repositories\CouponCodeHistory\CouponCodeHistoryRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Quote\QuoteRepositoryInterface;
use App\Repositories\QuoteDetail\QuoteDetailRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;

/**
 * Class CouponCodeService
 * @package App\Services
 */
class CouponCodeService
{
  private $couponCodeRepository, $couponCodeHistoryRepository, $userRepository, $orderRepository, $quoteRepository, $quoteDetailRepository;

    /**
     * @param CouponCodeRepositoryInterface $couponCodeRepository
     * @param CouponCodeHistoryRepositoryInterface $couponCodeHistoryRepository
     */
    public function __construct(
        CouponCodeRepositoryInterface $couponCodeRepository,
        CouponCodeHistoryRepositoryInterface $couponCodeHistoryRepository,
        UserRepositoryInterface $userRepository,
        OrderRepositoryInterface $orderRepository,
        QuoteRepositoryInterface $quoteRepository,
        QuoteDetailRepositoryInterface $quoteDetailRepository,
    )
    {
        $this->couponCodeRepository = $couponCodeRepository;
        $this->couponCodeHistoryRepository = $couponCodeHistoryRepository;
        $this->userRepository = $userRepository;
        $this->quoteRepository = $quoteRepository;
        $this->quoteDetailRepository = $quoteDetailRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * [CouponCodeHistory] Create new coupon code history.
     * @param $data
     * @return bool
     */
    public function createCouponHistory($data, $userId)
    {
        if (empty($userId)){
            return false;
        }

        $coupon = $this->couponCodeRepository->getCouponCode(['code' => $data['code'], 'status' => CONST_ENABLE ])->first();

        if(!empty($coupon->id)){
            $data['coupon_code_id'] = $coupon->id;
            $data['coupon_code_event_id'] = $coupon->couponCodeEvents->id;
        }

        $data['user_id'] = $userId;
        $result = $this->couponCodeHistoryRepository->create($data);

        if ($result) {
            $coupon->count = $coupon->count + 1;
            $this->couponCodeRepository->update($coupon, ['count'=> $coupon->count] );
        }
        return true;
    }

    /**
     * [CouponCode] Get coupon code.
     * @param array $params
     * @return mixed
     */
    public function getCouponCode(array $params = [])
    {
        return $this->couponCodeRepository->getCouponCode($params);
    }


    /* Utils */
    /**
     * Get total discount per item.
     * @param $coupon_code
     * @param $total_amount
     * @param $ship_amount
     * @param $user_id
     * @return mixed
     */
    public function getTotalDiscount(array $params = [])
    {
        $total_discount = 0;
        $cpCodes = $params['coupon_codes'];
        if (!empty($cpCodes)) {
            foreach ($cpCodes as $cpCode) {
                if (strtolower($cpCode) === strtolower( CouponCode::CODE_FREESHIP)) {
                    $total_discount += $params['ship_amount'];
                    continue;
                }

                if (!empty($cpCode['id'])) {
                    switch ($cpCode['amount_type']) {
                        case CouponCode::AMOUNT_TYPE_PERCENT:
                            $total_discount += $params['price'] * $cpCode->amount / 100;
                            break;
                        case CouponCode::AMOUNT_TYPE_PRICE:
                            $total_discount += $cpCode->amount;
                            break;
                    }
                }
            }
        }

        return $total_discount;
    }


    /**
     * @param array $params
     * @return array
     */
    public function getAndValidateCode(array $params = [])
    {
        //Check if exist and enable
        $coupon = $this->couponCodeRepository->getCouponCode(['code' => $params['code'], 'status'=> CouponCode::STATUS_ENABLE])->first();


        if (empty($coupon->id)) {
            return ['error_message' => __('error.coupon.not_exist')];
        }
        $coupon_event = $coupon->couponCodeEvents()->first();
        $time = Carbon::now();

        //Check if expire
        if ($coupon_event->start_date <= $time && $coupon_event->end_date >= $time) {
            $coupon_id = $coupon->id;

            //Check history use
            if (!empty($params['user_id'])) {
                $history = $this->couponCodeHistoryRepository->getCouponCodeHistory(['coupon_code_id' => $coupon_id, 'user_id' => $params['user_id']])->first();

                if ($coupon->use_repeat == 0 && !empty($history)) {
                    return [ 'error' => true,'error_message' => __('error.coupon.used')];
                }
            }
            if (!$this->check($coupon)) {
                return ['error' => true, 'error_message' => __('error.coupon.invalid')];
            }
            return $coupon;
        }
        return ['error' => true, 'error_message' => __('error.coupon_code_events.expired')];
    }

    /**
     * @return bool
     */
    public function check($coupon)
    {
        if (($coupon->limit == 1 && $coupon->count < 1) || ($coupon->limit > 1 && $coupon->limit > $coupon->count) || $coupon->limit == 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $coupon_id
     * @return false
     */
    public function isUsed($coupon_id)
    {
        $countIsUse = $this->orderRepository->getOrder(['coupon_id' => $coupon_id])->count();
        if (!empty($countIsUse)) {
            return $countIsUse;
        }
        return false;
    }

    /**
     * @param $detail
     * @return float|int
     *
     */
    public function getDiscount($detail)
    {
        $discount = 0;
        if (empty($detail->coupon_code)) {
            return $discount;
        }

        $coupon = $this->couponCodeRepository->findCouponByCode($detail->coupon_code);

        switch ($coupon->amount_type) {
            case CouponCode::AMOUNT_TYPE_PERCENT:
                $discount += $detail->price * $coupon->amount / 100;
                break;
            case CouponCode::AMOUNT_TYPE_PRICE:
                $discount += $coupon->amount;
                break;
        }

        return $discount;
    }

    /**
     * @param $data
     * @param $quoteDetail
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function handleApplyCoupon($data, $quoteDetail){
        $discountFromCoupon = 0;
        if (!empty($data['coupon_codes'])){
            $quoteDetail = $this->checkWhenApplyCoupon($data, $quoteDetail);
            if(isset($quoteDetail['error_message'])){
                return ['error_message' => __($quoteDetail['error_message'])];
            }
            $discountFromCoupon  = $this->getDiscount($quoteDetail);
        }

        $this->quoteDetailRepository->update($quoteDetail,
            ['coupon_code' => $data['coupon_codes'] ,'discount' => $discountFromCoupon ]);


        $quote = $this->quoteRepository->find($quoteDetail->quote->id);

        $priceAfterApply = $this->applyPriceFromCoupon($quote);
        $this->quoteRepository->update($quote, $priceAfterApply);

        $priceAfterApply['discount'] = $discountFromCoupon;

        return $priceAfterApply;
    }

    /**
     * calculate price before apply coupon
     * @param $previousDiscount
     * @param $total_discount
     * @param $total
     * @return array
     */
    public function calculatePriceBeforeApplyCoupon ($previousDiscount, $total_discount, $total){
        $total_discount = $total_discount - $previousDiscount;
        $total += $previousDiscount;

        return ['total_discount' => $total_discount, 'total' => $total];
    }

    /**
     * calculate price after apply coupon
     * @param $discount
     * @param $total_discount
     * @param $total
     * @return array
     */
    public function calculatePriceAfterApplyCoupon($quote, $total_price, $total_discount){
        $total = 0;
        $total = $total_price + $quote->total_shipping + $quote->total_payment_fee;
        $total = $this->checkDiscountOverTotal($total, $total_discount);

        return ['total_discount' => $total_discount, 'total' => $total];
    }

    /**
     * @param $quote
     * @param $checkCoupon
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|void|null
     */
    public function checkExistCouponInCart($quote, $checkCoupon){
        foreach ($quote->quoteDetails as $quoteDetail){
            if(!empty($quoteDetail->coupon_code)){
                if( $quoteDetail->coupon_code == $checkCoupon ){
                    return ['error_message' => __('error.coupon.is_exist_in_cart', [ 'coupon' => $checkCoupon])];
                }
            }
        }
        return $quote;
    }



    /**
     * @param $data
     * @param $quoteDetail
     * @return array|string[]|void
     */
    public function checkWhenApplyCoupon($data, $quoteDetail){
        $priceBeforeApply = ['total_price' => 0, 'total_discount' => 0, 'total' => 0];
        if (!empty($data['coupon_codes'])){
            $customer  = $this->userRepository->checkExistUserByEmail(auth()->user()->email);
            if (empty($customer)) {
                return ['error_message' => 'Can not find user with input email'];
            }

            $coupon = $this->getAndValidateCode(['code' => $data['coupon_codes'], 'user_id' => $customer->id ?? '']);

            if (isset($coupon['error_message'])) {
                return ['error_message' => __($coupon['error_message'])];
            }

            $quoteDetail->coupon_code = $coupon->code;

            $checkExist = $this->checkExistCouponInCart($quoteDetail->quote, $coupon->code);

            if(isset($checkExist['error_message'])){
                return $checkExist;
            }
        }
        return $quoteDetail;
    }

    /**
     * Check discount vs total
     * @param $total
     * @param $discount
     * @return int|mixed
     */
    public static function checkDiscountOverTotal($total, $discount){
        $totalPrice = 0;
        //If coupon ( discount by amount) larger than item price => total order = 0
        if ($total - $discount < 0){
            $totalPrice = 0;
        }
        else{
            $totalPrice = $total - $discount ;
        }
        return $totalPrice;
    }

    /**
     * @param $quote
     * @return array
     */
    public function applyPriceFromCoupon($quote){
        $priceBeforeApply = ['total_price' => 0, 'total_discount' => 0, 'total' => 0];
        foreach($quote->quoteDetails as $tmpQuoteDetail){
            $totalPriceFromQuoteDetail = $tmpQuoteDetail->price * $tmpQuoteDetail->quantity;
            $priceBeforeApply['total_price'] += $totalPriceFromQuoteDetail;
            $priceBeforeApply['total_discount'] += $tmpQuoteDetail->discount;

        }

        $priceAfterApply = $this->calculatePriceAfterApplyCoupon(
            $quote,
            $priceBeforeApply['total_price'],
            $priceBeforeApply['total_discount']);

        return $priceAfterApply;
    }
}
