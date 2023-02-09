<?php

namespace App\Repositories\CouponCode;

use App\Models\CouponCode;
use App\Repositories\BaseRepository;
use App\Repositories\CouponCodeEvent\CouponCodeEventRepositoryInterface;
use App\Repositories\CouponCodeHistory\CouponCodeHistoryRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Session;
use Throwable;

/**
 * The repository for Coupon Code Model
 */
class CouponCodeRepository extends BaseRepository implements CouponCodeRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;
    private $orderRepository, $couponCodeHistoryRepository;

    /**
     * @inheritdoc
     */
    public function __construct(
        CouponCode                           $model,
        CouponCodeHistoryRepositoryInterface $couponCodeHistoryRepository,
        OrderRepositoryInterface             $orderRepository
    )
    {
        $this->model = $model;
        $this->couponCodeHistoryRepository = $couponCodeHistoryRepository;
        $this->orderRepository = $orderRepository;
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function create($data): mixed
    {
        try {
            DB::beginTransaction();

            $result = $this->model->create($data);
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }

    }

    /**
     * Create random coupon code
     * @param $post
     * @return bool
     * @throws Throwable
     */
    public function saveRandomCode($post)
    {
        if (count($post) > 0 && isset($post['length'])) {
            $no_of_coupons = intval($post['no_of_coupons']);
            $length = $post['length'];
            $prefix = $post['prefix'];
            $suffix = $post['suffix'];
            $numbers = $post['numbers'];
            $letters = $post['letters'];
            $symbols = $post['symbols'];
            $random_register = $post['random_register'] == 'false' ? false : true;
            $mask = $post['mask'] == '' ? false : $post['mask'];
            for ($i = 0; $i < $no_of_coupons; $i++) {
                $coupon_code = $this->generate($length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);
                $code = $this->generateCodeExists($coupon_code, $length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);
                if (!empty($code)) {
                    $event_id = (isset($post["coupon_code_events_id"])) ? intval($post["coupon_code_events_id"]) : 0;
                    $limit = (isset($post["limit"])) ? intval($post["limit"]) : 2;
                    $amount = (isset($post["amount"])) ? intval($post["amount"]) : 0;
                    $amount_type = (isset($post["CouponCode"]["amount_type"])) ? intval($post["CouponCode"]["amount_type"]) : 1;
                    $model = new CouponCode();
                    $model->code = $code;
                    $model->coupon_code_events_id = $event_id;
                    $model->limit = $limit;
                    $model->amount = $amount;
                    $model->amount_type = $amount_type;
                    $model->created_at = $model->updated_at = Carbon::now();
                    $model->saveOrFail();
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Update coupon
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        try {
            DB::beginTransaction();

            $result = tap($model)->update($data);;

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }

    }


    /**
     * get all Coupons
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->with('couponCodeEvents')->whereNotNull('coupon_code_events_id')
            ->orderByDesc('created_at')->get();
    }

    /**
     * get a Coupon by Id.
     * @param $id
     * @return mixed
     */
    public
    function getCoupon($id)
    {
        return $this->model->where('id', $id)->with('couponCodeEvents')->get();
    }

    /**
     * Get coupon code.
     * @param array $params
     * @return Builder[]|Collection|mixed
     */
    public function getCouponCode(array $params = []): mixed
    {
        $qb = (new CouponCode())->newQuery();
        foreach ($params as $k => $v) {
            $qb->where($k, $v);
        }
        return $qb->get();
    }

    /**
     * Random code generator
     * @param int $length
     * @param string $prefix
     * @param string $suffix
     * @param bool $numbers
     * @param bool $letters
     * @param false $symbols
     * @param false $random_register
     * @param false $mask
     * @return string
     */
    public
    static function generate($length = 6, $prefix = '', $suffix = '', $numbers = true, $letters = true, $symbols = false, $random_register = false, $mask = false)
    {
        $numbers = $numbers == 'false' ? false : true;
        $letters = $letters == 'false' ? false : true;
        $symbols = $symbols == 'true' ? true : false;
        $random_register = $random_register == 'true' ? true : false;
        $mask = $mask == 'false' ? false : $mask;

        $numbers_a = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $lowercase = array('q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm');
        $uppercase = array('Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M');
        $symbols_a = array('`', '~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '\\', '|', '/', '[', ']', '{', '}', '"', "'", ';', ':', '<', '>', ',', '.', '?');

        $string = array();
        $coupon = '';
        if ($letters) {
            if ($random_register) {
                $string = array_merge($string, $lowercase, $uppercase);
            } else {
                $string = array_merge($string, $uppercase);
            }
        }

        if ($numbers) {
            $string = array_merge($string, $numbers_a);
        }

        if ($symbols) {
            $string = array_merge($string, $symbols_a);
        }

        if ($mask) {
            for ($i = 0; $i < strlen($mask); $i++) {
                if ($mask[$i] === 'X') {
                    $coupon .= $string[rand(0, count($string) - 1)];
                } else {
                    $coupon .= $mask[$i];
                }
            }
        } else {
            for ($i = 0; $i < $length; $i++) {
                $coupon .= $string[rand(0, count($string) - 1)];
            }
        }

        return $prefix . $coupon . $suffix;
    }


    /**
     * To create multiple random code
     * @param $code
     * @param $length
     * @param $prefix
     * @param $suffix
     * @param $numbers
     * @param $letters
     * @param $symbols
     * @param $random_register
     * @param $mask
     * @return null
     */
    public
    static function generateCodeExists($code, $length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask)
    {
        $couponcode = new CouponCode();
        if (!empty($code)) {
            $coupon = $couponcode->where('code', $code)->get()->first();
            if (!empty($coupon->id)) {
                $code = $couponcode->generate($length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);
                return $couponcode->generateCodeExists($code, $length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);
            } else {
                return $code;
            }
        }
        return null;
    }

    /**
     * @param $code
     * @return mixed
     */
    public function findCouponByCode($code): mixed
    {
        return $this->model->where('code', $code)->first();
    }


    public function getModel(): string
    {
        return CouponCode::class;
    }
}
