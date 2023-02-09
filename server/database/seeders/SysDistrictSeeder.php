<?php

namespace Database\Seeders;

use App\Models\SysCity;
use App\Models\SysDistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SysDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return null | boolean
     */
    public function run(): null|bool
    {
        if (SysDistrict::count() > 0) {
            return false;
        }

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(1, 1, 'Bình Chánh', 'ho-chi-minh-binh-chanh', NULL, '[10.733825,106.575482]', '#FF0000', '{\"tl\":[10.624608,106.463242],\"br\":[10.873805,106.694687]}', 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(2, 1, 'Bình Tân', 'ho-chi-minh-binh-tan', NULL, '[10.764593,106.597109]', '#FF0000', '{\"tl\":[10.710826,106.55822],\"br\":[10.829794,106.62574]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(3, 1, 'Bình Thạnh', 'ho-chi-minh-binh-thanh', NULL, '[10.811998,106.715931]', '#FF0000', '{\"tl\":[10.784935,106.683586],\"br\":[10.839021,106.751221]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(4, 1, 'Cần Giờ', 'ho-chi-minh-can-gio', NULL, '[10.524055,106.864725]', '#FF0000', '{\"tl\":[10.376389,106.734718],\"br\":[10.67518,107.025276]}', 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(5, 1, 'Củ Chi', 'ho-chi-minh-cu-chi', NULL, '[11.009558,106.51062]', '#FF0000', '{\"tl\":[10.914284,106.356438],\"br\":[11.159539,106.65712]}', 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(6, 1, 'Gò Vấp', 'ho-chi-minh-go-vap', NULL, '[10.83838,106.667003]', '#FF0000', '{\"tl\":[10.810496,106.631691],\"br\":[10.861025,106.70034]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(7, 1, 'Hóc Môn', 'ho-chi-minh-hoc-mon', NULL, '[10.885853,106.589565]', '#FF0000', '{\"tl\":[10.825839,106.495918],\"br\":[10.929369,106.692642]}', 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(8, 1, 'Nhà Bè', 'ho-chi-minh-nha-be', NULL, '[10.654192,106.729918]', '#FF0000', '{\"tl\":[10.576117,106.672806],\"br\":[10.725589,106.783058]}', 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(9, 1, 'Phú Nhuận', 'ho-chi-minh-phu-nhuan', NULL, '[10.800299,106.677731]', '#FF0000', '{\"tl\":[10.787835,106.665657],\"br\":[10.81356,106.69239]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(10, 1, '1', 'ho-chi-minh-quan-1', NULL, '[10.77618,106.696537]', '#FF0000', '{\"tl\":[10.75323,106.680908],\"br\":[10.797178,106.714035]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(11, 1, '10', 'ho-chi-minh-quan-10', NULL, '[10.772334,106.667731]', '#FF0000', '{\"tl\":[10.758314,106.655663],\"br\":[10.786969,106.68203]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(12, 1, '11', 'ho-chi-minh-quan-11', NULL, '[10.764174,106.647198]', '#FF0000', '{\"tl\":[10.753526,106.633881],\"br\":[10.778454,106.660316]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(13, 1, '12', 'ho-chi-minh-quan-12', NULL, '[10.864548,106.656472]', '#FF0000', '{\"tl\":[10.818353,106.602936],\"br\":[10.90395,106.717613]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(14, 1, '2', 'ho-chi-minh-quan-2', NULL, '[10.779075,106.755841]', '#FF0000', '{\"tl\":[10.740447,106.707634],\"br\":[10.819511,106.809296]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(15, 1, '3', 'ho-chi-minh-quan-3', NULL, '[10.781344,106.682311]', '#FF0000', '{\"tl\":[10.765435,106.664314],\"br\":[10.792583,106.697655]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(16, 1, '4', 'ho-chi-minh-quan-4', NULL, '[10.758512,106.705266]', '#FF0000', '{\"tl\":[10.751807,106.686058],\"br\":[10.769852,106.722046]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(17, 1, '5', 'ho-chi-minh-quan-5', NULL, '[10.754924,106.668817]', '#FF0000', '{\"tl\":[10.746239,106.649788],\"br\":[10.765161,106.686516]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(18, 1, '6', 'ho-chi-minh-quan-6', NULL, '[10.745899,106.634876]', '#FF0000', '{\"tl\":[10.730059,106.620743],\"br\":[10.76053,106.654579]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(19, 1, '7', 'ho-chi-minh-quan-7', NULL, '[10.736387,106.729152]', '#FF0000', '{\"tl\":[10.697793,106.689758],\"br\":[10.777405,106.76635]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(20, 1, '8', 'ho-chi-minh-quan-8', NULL, '[10.725637,106.64166]', '#FF0000', '{\"tl\":[10.692482,106.597679],\"br\":[10.752272,106.692749]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(21, 1, '9', 'ho-chi-minh-quan-9', NULL, '[10.823533,106.82218]', '#FF0000', '{\"tl\":[10.759445,106.756599],\"br\":[10.899025,106.881447]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(22, 1, 'Tân Bình', 'ho-chi-minh-tan-binh', NULL, '[10.808737,106.651833]', '#FF0000', '{\"tl\":[10.768609,106.627174],\"br\":[10.836819,106.677704]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(23, 1, 'Tân Phú', 'ho-chi-minh-tan-phu', NULL, '[10.792519,106.626314]', '#FF0000', '{\"tl\":[10.758362,106.606674],\"br\":[10.824248,106.647346]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(24, 1, 'Thủ Đức', 'ho-chi-minh-thu-duc', NULL, '[10.855921,106.744659]', '#FF0000', '{\"tl\":[10.812974,106.69738],\"br\":[10.896416,106.808861]}', 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(25, 2, 'Ba Đình', 'ha-noi-ba-dinh', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(26, 2, 'Ba Vì', 'ha-noi-ba-vi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(27, 2, 'Bắc Từ Liêm', 'ha-noi-bac-tu-liem', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(28, 2, 'Cầu Giấy', 'ha-noi-cau-giay', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(29, 2, 'Chương Mỹ', 'ha-noi-chuong-my', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(30, 2, 'Đan Phượng', 'ha-noi-dan-phuong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(31, 2, 'Đông Anh', 'ha-noi-dong-anh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(32, 2, 'Đống Đa', 'ha-noi-dong-da', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(33, 2, 'Gia Lâm', 'ha-noi-gia-lam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(34, 2, 'Hà Đông', 'ha-noi-ha-dong', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(35, 2, 'Hai Bà Trưng', 'ha-noi-hai-ba-trung', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(36, 2, 'Hoài Đức', 'ha-noi-hoai-duc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(37, 2, 'Hoàn Kiếm', 'ha-noi-hoan-kiem', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(38, 2, 'Hoàng Mai', 'ha-noi-hoang-mai', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(39, 2, 'Long Biên', 'ha-noi-long-bien', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(40, 2, 'Mê Linh', 'ha-noi-me-linh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(41, 2, 'Mỹ Đức', 'ha-noi-my-duc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(42, 2, 'Nam Từ Liêm', 'ha-noi-nam-tu-liem', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(43, 2, 'Phú Xuyên', 'ha-noi-phu-xuyen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(44, 2, 'Phúc Thọ', 'ha-noi-phuc-tho', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(45, 2, 'Quốc Oai', 'ha-noi-quoc-oai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(46, 2, 'Sóc Sơn', 'ha-noi-soc-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(47, 2, 'Sơn Tây', 'ha-noi-son-tay', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(48, 2, 'Tây Hồ', 'ha-noi-tay-ho', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(49, 2, 'Thạch Thất', 'ha-noi-thach-that', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(50, 2, 'Thanh Oai', 'ha-noi-thanh-oai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(51, 2, 'Thanh Trì', 'ha-noi-thanh-tri', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(52, 2, 'Thanh Xuân', 'ha-noi-thanh-xuan', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(53, 2, 'Thường Tín', 'ha-noi-thuong-tin', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(54, 2, 'Ứng Hòa', 'ha-noi-ung-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(55, 3, 'Bàu Bàng', 'binh-duong-bau-bang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(56, 3, 'Bến Cát', 'binh-duong-ben-cat', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(57, 3, 'Dầu Tiếng', 'binh-duong-dau-tieng', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(58, 3, 'Dĩ An', 'binh-duong-di-an', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(59, 3, 'Phú Giáo', 'binh-duong-phu-giao', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(60, 3, 'Tân Uyên', 'binh-duong-tan-uyen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(61, 3, 'Thủ Dầu Một', 'binh-duong-thu-dau-mot', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(62, 3, 'Thuận An', 'binh-duong-thuan-an', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(63, 4, 'Cẩm Lệ', 'da-nang-cam-le', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(64, 4, 'Hải Châu', 'da-nang-hai-chau', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(65, 4, 'Hòa Vang', 'da-nang-hoa-vang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(66, 4, 'Hoàng Sa', 'da-nang-hoang-sa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(67, 4, 'Liên Chiểu', 'da-nang-lien-chieu', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(68, 4, 'Ngũ Hành Sơn', 'da-nang-ngu-hanh-son', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(69, 4, 'Sơn Trà', 'da-nang-son-tra', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(70, 4, 'Thanh Khê', 'da-nang-thanh-khe', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(71, 5, 'An Dương', 'hai-phong-an-duong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(72, 5, 'An Lão', 'hai-phong-an-lao', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(73, 5, 'Bạch Long Vĩ', 'hai-phong-bach-long-vi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(74, 5, 'Cát Hải', 'hai-phong-cat-hai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(75, 5, 'Đồ Sơn', 'hai-phong-do-son', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(76, 5, 'Dương Kinh', 'hai-phong-duong-kinh', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(77, 5, 'Hải An', 'hai-phong-hai-an', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(78, 5, 'Hồng Bàng', 'hai-phong-hong-bang', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(79, 5, 'Kiến An', 'hai-phong-kien-an', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(80, 5, 'Kiến Thụy', 'hai-phong-kien-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(81, 5, 'Lê Chân', 'hai-phong-le-chan', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(82, 5, 'Ngô Quyền', 'hai-phong-ngo-quyen', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(83, 5, 'Thủy Nguyên', 'hai-phong-thuy-nguyen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(84, 5, 'Tiên Lãng', 'hai-phong-tien-lang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(85, 5, 'Vĩnh Bảo', 'hai-phong-vinh-bao', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(86, 6, 'Bến Lức', 'long-an-ben-luc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(87, 6, 'Cần Đước', 'long-an-can-duoc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(88, 6, 'Cần Giuộc', 'long-an-can-giuoc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(89, 6, 'Châu Thành', 'long-an-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(90, 6, 'Đức Hòa', 'long-an-duc-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(91, 6, 'Đức Huệ', 'long-an-duc-hue', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(92, 6, 'Kiến Tường', 'long-an-kien-tuong', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(93, 6, 'Mộc Hóa', 'long-an-moc-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(94, 6, 'Tân An', 'long-an-tan-an', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(95, 6, 'Tân Hưng', 'long-an-tan-hung', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(96, 6, 'Tân Thạnh', 'long-an-tan-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(97, 6, 'Tân Trụ', 'long-an-tan-tru', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(98, 6, 'Thạnh Hóa', 'long-an-thanh-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(99, 6, 'Thủ Thừa', 'long-an-thu-thua', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(100, 6, 'Vĩnh Hưng', 'long-an-vinh-hung', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(101, 7, 'Bà Rịa', 'ba-ria-vung-tau-ba-ria', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(102, 7, 'Châu Đức', 'ba-ria-vung-tau-chau-duc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(103, 7, 'Côn Đảo', 'ba-ria-vung-tau-con-dao', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(104, 7, 'Đất Đỏ', 'ba-ria-vung-tau-dat-do', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(105, 7, 'Long Điền', 'ba-ria-vung-tau-long-dien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(106, 7, 'Tân Thành', 'ba-ria-vung-tau-tan-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(107, 7, 'Vũng Tàu', 'ba-ria-vung-tau-vung-tau', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(108, 7, 'Xuyên Mộc', 'ba-ria-vung-tau-xuyen-moc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(109, 8, 'An Phú', 'an-giang-an-phu', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(110, 8, 'Châu Đốc', 'an-giang-chau-doc', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(111, 8, 'Châu Phú', 'an-giang-chau-phu', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(112, 8, 'Châu Thành', 'an-giang-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(113, 8, 'Chợ Mới', 'an-giang-cho-moi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(114, 8, 'Long Xuyên', 'an-giang-long-xuyen', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(115, 8, 'Phú Tân', 'an-giang-phu-tan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(116, 8, 'Tân Châu', 'an-giang-tan-chau', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(117, 8, 'Thoại Sơn', 'an-giang-thoai-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(118, 8, 'Tịnh Biên', 'an-giang-tinh-bien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(119, 8, 'Tri Tôn', 'an-giang-tri-ton', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(120, 9, 'Bắc Giang', 'bac-giang-bac-giang', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(121, 9, 'Hiệp Hòa', 'bac-giang-hiep-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(122, 9, 'Lạng Giang', 'bac-giang-lang-giang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(123, 9, 'Lục Nam', 'bac-giang-luc-nam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(124, 9, 'Lục Ngạn', 'bac-giang-luc-ngan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(125, 9, 'Sơn Động', 'bac-giang-son-dong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(126, 9, 'Tân Yên', 'bac-giang-tan-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(127, 9, 'Việt Yên', 'bac-giang-viet-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(128, 9, 'Yên Dũng', 'bac-giang-yen-dung', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(129, 9, 'Yên Thế', 'bac-giang-yen-the', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(130, 10, 'Ba Bể', 'bac-kan-ba-be', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(131, 10, 'Bắc Kạn', 'bac-kan-bac-kan', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(132, 10, 'Bạch Thông', 'bac-kan-bach-thong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(133, 10, 'Chợ Đồn', 'bac-kan-cho-don', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(134, 10, 'Chợ Mới', 'bac-kan-cho-moi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(135, 10, 'Na Rì', 'bac-kan-na-ri', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(136, 10, 'Ngân Sơn', 'bac-kan-ngan-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(137, 10, 'Pác Nặm', 'bac-kan-pac-nam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(138, 11, 'Bạc Liêu', 'bac-lieu-bac-lieu', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(139, 11, 'Đông Hải', 'bac-lieu-dong-hai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(140, 11, 'Giá Rai', 'bac-lieu-gia-rai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(141, 11, 'Hòa Bình', 'bac-lieu-hoa-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(142, 11, 'Hồng Dân', 'bac-lieu-hong-dan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(143, 11, 'Phước Long', 'bac-lieu-phuoc-long', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(144, 11, 'Vĩnh Lợi', 'bac-lieu-vinh-loi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(145, 12, 'Bắc Ninh', 'bac-ninh-bac-ninh', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(146, 12, 'Gia Bình', 'bac-ninh-gia-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(147, 12, 'Lương Tài', 'bac-ninh-luong-tai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(148, 12, 'Quế Võ', 'bac-ninh-que-vo', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(149, 12, 'Thuận Thành', 'bac-ninh-thuan-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(150, 12, 'Tiên Du', 'bac-ninh-tien-du', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(151, 12, 'Từ Sơn', 'bac-ninh-tu-son', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(152, 12, 'Yên Phong', 'bac-ninh-yen-phong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(153, 13, 'Ba Tri', 'ben-tre-ba-tri', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(154, 13, 'Bến Tre', 'ben-tre-ben-tre', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(155, 13, 'Bình Đại', 'ben-tre-binh-dai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(156, 13, 'Châu Thành', 'ben-tre-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(157, 13, 'Chợ Lách', 'ben-tre-cho-lach', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(158, 13, 'Giồng Trôm', 'ben-tre-giong-trom', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(159, 13, 'Mỏ Cày Bắc', 'ben-tre-mo-cay-bac', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(160, 13, 'Mỏ Cày Nam', 'ben-tre-mo-cay-nam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(161, 13, 'Thạnh Phú', 'ben-tre-thanh-phu', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(162, 14, 'An Lão', 'binh-dinh-an-lao', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(163, 14, 'An Nhơn', 'binh-dinh-an-nhon', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(164, 14, 'Hoài Ân', 'binh-dinh-hoai-an', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(165, 14, 'Hoài Nhơn', 'binh-dinh-hoai-nhon', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(166, 14, 'Phù Cát', 'binh-dinh-phu-cat', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(167, 14, 'Phù Mỹ', 'binh-dinh-phu-my', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(168, 14, 'Quy Nhơn', 'binh-dinh-quy-nhon', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(169, 14, 'Tây Sơn', 'binh-dinh-tay-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(170, 14, 'Tuy Phước', 'binh-dinh-tuy-phuoc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(171, 14, 'Vân Canh', 'binh-dinh-van-canh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(172, 14, 'Vĩnh Thạnh', 'binh-dinh-vinh-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(173, 15, 'Bình Long', 'binh-phuoc-binh-long', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(174, 15, 'Bù Đăng', 'binh-phuoc-bu-dang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(175, 15, 'Bù Đốp', 'binh-phuoc-bu-dop', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(176, 15, 'Bù Gia Mập', 'binh-phuoc-bu-gia-map', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(177, 15, 'Chơn Thành', 'binh-phuoc-chon-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(178, 15, 'Đồng Phú', 'binh-phuoc-dong-phu', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(179, 15, 'Đồng Xoài', 'binh-phuoc-dong-xoai', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(180, 15, 'Hớn Quản', 'binh-phuoc-hon-quan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(181, 15, 'Lộc Ninh', 'binh-phuoc-loc-ninh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(182, 15, 'Phú Riềng', 'binh-phuoc-phu-rieng', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(183, 15, 'Phước Long', 'binh-phuoc-phuoc-long', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(184, 16, 'Bắc Bình', 'binh-thuan-bac-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(185, 16, 'Đảo Phú Quý', 'binh-thuan-dao-phu-quy', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(186, 16, 'Đức Linh', 'binh-thuan-duc-linh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(187, 16, 'Hàm Tân', 'binh-thuan-ham-tan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(188, 16, 'Hàm Thuận Bắc', 'binh-thuan-ham-thuan-bac', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(189, 16, 'Hàm Thuận Nam', 'binh-thuan-ham-thuan-nam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(190, 16, 'La Gi', 'binh-thuan-la-gi', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(191, 16, 'Phan Thiết', 'binh-thuan-phan-thiet', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(192, 16, 'Tánh Linh', 'binh-thuan-tanh-linh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(193, 16, 'Tuy Phong', 'binh-thuan-tuy-phong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(194, 17, 'Cà Mau', 'ca-mau-ca-mau', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(195, 17, 'Cái Nước', 'ca-mau-cai-nuoc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(196, 17, 'Đầm Dơi', 'ca-mau-dam-doi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(197, 17, 'Năm Căn', 'ca-mau-nam-can', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(198, 17, 'Ngọc Hiển', 'ca-mau-ngoc-hien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(199, 17, 'Phú Tân', 'ca-mau-phu-tan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(200, 17, 'Thới Bình', 'ca-mau-thoi-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(201, 17, 'Trần Văn Thời', 'ca-mau-tran-van-thoi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(202, 17, 'U Minh', 'ca-mau-u-minh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(203, 18, ' Thới Lai', 'can-tho-thoi-lai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(204, 18, 'Bình Thủy', 'can-tho-binh-thuy', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(205, 18, 'Cái Răng', 'can-tho-cai-rang', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(206, 18, 'Cờ Đỏ', 'can-tho-co-do', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(207, 18, 'Ninh Kiều', 'can-tho-ninh-kieu', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(208, 18, 'Ô Môn', 'can-tho-o-mon', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(209, 18, 'Phong Điền', 'can-tho-phong-dien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(210, 18, 'Thốt Nốt', 'can-tho-thot-not', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(211, 18, 'Vĩnh Thạnh', 'can-tho-vinh-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(212, 19, 'Bảo Lạc', 'cao-bang-bao-lac', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(213, 19, 'Bảo Lâm', 'cao-bang-bao-lam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(214, 19, 'Cao Bằng', 'cao-bang-cao-bang', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(215, 19, 'Hạ Lang', 'cao-bang-ha-lang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(216, 19, 'Hà Quảng', 'cao-bang-ha-quang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(217, 19, 'Hòa An', 'cao-bang-hoa-an', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(218, 19, 'Nguyên Bình', 'cao-bang-nguyen-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(219, 19, 'Phục Hòa', 'cao-bang-phuc-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(220, 19, 'Quảng Uyên', 'cao-bang-quang-uyen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(221, 19, 'Thạch An', 'cao-bang-thach-an', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(222, 19, 'Thông Nông', 'cao-bang-thong-nong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(223, 19, 'Trà Lĩnh', 'cao-bang-tra-linh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(224, 19, 'Trùng Khánh', 'cao-bang-trung-khanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(225, 20, 'Buôn Đôn', 'dak-lak-buon-don', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(226, 20, 'Buôn Hồ', 'dak-lak-buon-ho', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(227, 20, 'Buôn Ma Thuột', 'dak-lak-buon-ma-thuot', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(228, 20, 'Cư Kuin', 'dak-lak-cu-kuin', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(229, 20, 'Cư M\'gar', 'dak-lak-cu-m-gar', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(230, 20, 'Ea H\'Leo', 'dak-lak-ea-h-leo', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(231, 20, 'Ea Kar', 'dak-lak-ea-kar', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(232, 20, 'Ea Súp', 'dak-lak-ea-sup', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(233, 20, 'Krông Ana', 'dak-lak-krong-ana', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(234, 20, 'Krông Bông', 'dak-lak-krong-bong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(235, 20, 'Krông Buk', 'dak-lak-krong-buk', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(236, 20, 'Krông Năng', 'dak-lak-krong-nang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(237, 20, 'Krông Pắc', 'dak-lak-krong-pac', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(238, 20, 'Lăk', 'dak-lak-lak', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(239, 20, 'M\'Đrăk', 'dak-lak-m-drak', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(240, 21, 'Cư Jút', 'dak-nong-cu-jut', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(241, 21, 'Dăk GLong', 'dak-nong-dak-glong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(242, 21, 'Dăk Mil', 'dak-nong-dak-mil', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(243, 21, 'Dăk R\'Lấp', 'dak-nong-dak-r-lap', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(244, 21, 'Dăk Song', 'dak-nong-dak-song', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(245, 21, 'Gia Nghĩa', 'dak-nong-gia-nghia', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(246, 21, 'Krông Nô', 'dak-nong-krong-no', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(247, 21, 'Tuy Đức', 'dak-nong-tuy-duc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(248, 22, 'Điện Biên', 'dien-bien-dien-bien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(249, 22, 'Điện Biên Đông', 'dien-bien-dien-bien-dong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(250, 22, 'Điện Biên Phủ', 'dien-bien-dien-bien-phu', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(251, 22, 'Mường Ảng', 'dien-bien-muong-ang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(252, 22, 'Mường Chà', 'dien-bien-muong-cha', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(253, 22, 'Mường Lay', 'dien-bien-muong-lay', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(254, 22, 'Mường Nhé', 'dien-bien-muong-nhe', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(255, 22, 'Nậm Pồ', 'dien-bien-nam-po', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(256, 22, 'Tủa Chùa', 'dien-bien-tua-chua', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(257, 22, 'Tuần Giáo', 'dien-bien-tuan-giao', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(258, 23, 'Biên Hòa', 'dong-nai-bien-hoa', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(259, 23, 'Cẩm Mỹ', 'dong-nai-cam-my', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(260, 23, 'Định Quán', 'dong-nai-dinh-quan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(261, 23, 'Long Khánh', 'dong-nai-long-khanh', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(262, 23, 'Long Thành', 'dong-nai-long-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(263, 23, 'Nhơn Trạch', 'dong-nai-nhon-trach', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(264, 23, 'Tân Phú', 'dong-nai-tan-phu', NULL, NULL, NULL, NULL, 'Quận', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(265, 23, 'Thống Nhất', 'dong-nai-thong-nhat', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(266, 23, 'Trảng Bom', 'dong-nai-trang-bom', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(267, 23, 'Vĩnh Cửu', 'dong-nai-vinh-cuu', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(268, 23, 'Xuân Lộc', 'dong-nai-xuan-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(269, 24, 'Châu Thành', 'dong-thap-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(270, 24, 'Huyện Cao Lãnh', 'dong-thap-huyen-cao-lanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(271, 24, 'Huyện Hồng Ngự', 'dong-thap-huyen-hong-ngu', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(272, 24, 'Lai Vung', 'dong-thap-lai-vung', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(273, 24, 'Lấp Vò', 'dong-thap-lap-vo', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(274, 24, 'Sa Đéc', 'dong-thap-sa-dec', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(275, 24, 'Tam Nông', 'dong-thap-tam-nong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(276, 24, 'Tân Hồng', 'dong-thap-tan-hong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(277, 24, 'Thanh Bình', 'dong-thap-thanh-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(278, 24, 'Tháp Mười', 'dong-thap-thap-muoi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(279, 24, 'Thị xã Hồng Ngự', 'dong-thap-thi-xa-hong-ngu', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(280, 24, 'Tp. Cao Lãnh', 'dong-thap-tp-cao-lanh', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(281, 25, 'An Khê', 'gia-lai-an-khe', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(282, 25, 'AYun Pa', 'gia-lai-ayun-pa', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(283, 25, 'Chư Păh', 'gia-lai-chu-pah', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(284, 25, 'Chư Pưh', 'gia-lai-chu-puh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(285, 25, 'Chư Sê', 'gia-lai-chu-se', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(286, 25, 'ChưPRông', 'gia-lai-chuprong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(287, 25, 'Đăk Đoa', 'gia-lai-dak-doa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(288, 25, 'Đăk Pơ', 'gia-lai-dak-po', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(289, 25, 'Đức Cơ', 'gia-lai-duc-co', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(290, 25, 'Ia Grai', 'gia-lai-ia-grai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(291, 25, 'Ia Pa', 'gia-lai-ia-pa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(292, 25, 'KBang', 'gia-lai-kbang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(293, 25, 'Kông Chro', 'gia-lai-kong-chro', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(294, 25, 'Krông Pa', 'gia-lai-krong-pa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(295, 25, 'Mang Yang', 'gia-lai-mang-yang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(296, 25, 'Phú Thiện', 'gia-lai-phu-thien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(297, 25, 'Plei Ku', 'gia-lai-plei-ku', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(298, 26, 'Bắc Mê', 'ha-giang-bac-me', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(299, 26, 'Bắc Quang', 'ha-giang-bac-quang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(300, 26, 'Đồng Văn', 'ha-giang-dong-van', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(301, 26, 'Hà Giang', 'ha-giang-ha-giang', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(302, 26, 'Hoàng Su Phì', 'ha-giang-hoang-su-phi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(303, 26, 'Mèo Vạc', 'ha-giang-meo-vac', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(304, 26, 'Quản Bạ', 'ha-giang-quan-ba', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(305, 26, 'Quang Bình', 'ha-giang-quang-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(306, 26, 'Vị Xuyên', 'ha-giang-vi-xuyen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(307, 26, 'Xín Mần', 'ha-giang-xin-man', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(308, 26, 'Yên Minh', 'ha-giang-yen-minh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(309, 27, 'Bình Lục', 'ha-nam-binh-luc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(310, 27, 'Duy Tiên', 'ha-nam-duy-tien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(311, 27, 'Kim Bảng', 'ha-nam-kim-bang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(312, 27, 'Lý Nhân', 'ha-nam-ly-nhan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(313, 27, 'Phủ Lý', 'ha-nam-phu-ly', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(314, 27, 'Thanh Liêm', 'ha-nam-thanh-liem', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(315, 28, 'Cẩm Xuyên', 'ha-tinh-cam-xuyen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(316, 28, 'Can Lộc', 'ha-tinh-can-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(317, 28, 'Đức Thọ', 'ha-tinh-duc-tho', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(318, 28, 'Hà Tĩnh', 'ha-tinh-ha-tinh', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(319, 28, 'Hồng Lĩnh', 'ha-tinh-hong-linh', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(320, 28, 'Hương Khê', 'ha-tinh-huong-khe', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(321, 28, 'Hương Sơn', 'ha-tinh-huong-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(322, 28, 'Kỳ Anh', 'ha-tinh-ky-anh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(323, 28, 'Lộc Hà', 'ha-tinh-loc-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(324, 28, 'Nghi Xuân', 'ha-tinh-nghi-xuan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(325, 28, 'Thạch Hà', 'ha-tinh-thach-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(326, 28, 'Vũ Quang', 'ha-tinh-vu-quang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(327, 29, 'Bình Giang', 'hai-duong-binh-giang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(328, 29, 'Cẩm Giàng', 'hai-duong-cam-giang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(329, 29, 'Chí Linh', 'hai-duong-chi-linh', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(330, 29, 'Gia Lộc', 'hai-duong-gia-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(331, 29, 'Hải Dương', 'hai-duong-hai-duong', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(332, 29, 'Kim Thành', 'hai-duong-kim-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(333, 29, 'Kinh Môn', 'hai-duong-kinh-mon', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(334, 29, 'Nam Sách', 'hai-duong-nam-sach', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(335, 29, 'Ninh Giang', 'hai-duong-ninh-giang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(336, 29, 'Thanh Hà', 'hai-duong-thanh-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(337, 29, 'Thanh Miện', 'hai-duong-thanh-mien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(338, 29, 'Tứ Kỳ', 'hai-duong-tu-ky', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(339, 30, 'Châu Thành', 'hau-giang-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(340, 30, 'Châu Thành A', 'hau-giang-chau-thanh-a', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(341, 30, 'Long Mỹ', 'hau-giang-long-my', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(342, 30, 'Ngã Bảy', 'hau-giang-nga-bay', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(343, 30, 'Phụng Hiệp', 'hau-giang-phung-hiep', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(344, 30, 'Vị Thanh', 'hau-giang-vi-thanh', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(345, 30, 'Vị Thủy', 'hau-giang-vi-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(346, 31, 'Cao Phong', 'hoa-binh-cao-phong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(347, 31, 'Đà Bắc', 'hoa-binh-da-bac', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(348, 31, 'Hòa Bình', 'hoa-binh-hoa-binh', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(349, 31, 'Kim Bôi', 'hoa-binh-kim-boi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(350, 31, 'Kỳ Sơn', 'hoa-binh-ky-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(351, 31, 'Lạc Sơn', 'hoa-binh-lac-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(352, 31, 'Lạc Thủy', 'hoa-binh-lac-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(353, 31, 'Lương Sơn', 'hoa-binh-luong-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(354, 31, 'Mai Châu', 'hoa-binh-mai-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(355, 31, 'Tân Lạc', 'hoa-binh-tan-lac', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(356, 31, 'Yên Thủy', 'hoa-binh-yen-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(357, 32, 'Ân Thi', 'hung-yen-an-thi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(358, 32, 'Hưng Yên', 'hung-yen-hung-yen', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(359, 32, 'Khoái Châu', 'hung-yen-khoai-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(360, 32, 'Kim Động', 'hung-yen-kim-dong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(361, 32, 'Mỹ Hào', 'hung-yen-my-hao', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(362, 32, 'Phù Cừ', 'hung-yen-phu-cu', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(363, 32, 'Tiên Lữ', 'hung-yen-tien-lu', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(364, 32, 'Văn Giang', 'hung-yen-van-giang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(365, 32, 'Văn Lâm', 'hung-yen-van-lam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(366, 32, 'Yên Mỹ', 'hung-yen-yen-my', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(367, 33, 'Cam Lâm', 'khanh-hoa-cam-lam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(368, 33, 'Cam Ranh', 'khanh-hoa-cam-ranh', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(369, 33, 'Diên Khánh', 'khanh-hoa-dien-khanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(370, 33, 'Khánh Sơn', 'khanh-hoa-khanh-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(371, 33, 'Khánh Vĩnh', 'khanh-hoa-khanh-vinh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(372, 33, 'Nha Trang', 'khanh-hoa-nha-trang', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(373, 33, 'Ninh Hòa', 'khanh-hoa-ninh-hoa', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(374, 33, 'Trường Sa', 'khanh-hoa-truong-sa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(375, 33, 'Vạn Ninh', 'khanh-hoa-van-ninh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(376, 34, 'An Biên', 'kien-giang-an-bien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(377, 34, 'An Minh', 'kien-giang-an-minh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(378, 34, 'Châu Thành', 'kien-giang-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(379, 34, 'Giang Thành', 'kien-giang-giang-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(380, 34, 'Giồng Riềng', 'kien-giang-giong-rieng', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(381, 34, 'Gò Quao', 'kien-giang-go-quao', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(382, 34, 'Hà Tiên', 'kien-giang-ha-tien', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(383, 34, 'Hòn Đất', 'kien-giang-hon-dat', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(384, 34, 'Kiên Hải', 'kien-giang-kien-hai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(385, 34, 'Kiên Lương', 'kien-giang-kien-luong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(386, 34, 'Phú Quốc', 'kien-giang-phu-quoc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(387, 34, 'Rạch Giá', 'kien-giang-rach-gia', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(388, 34, 'Tân Hiệp', 'kien-giang-tan-hiep', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(389, 34, 'U minh Thượng', 'kien-giang-u-minh-thuong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(390, 34, 'Vĩnh Thuận', 'kien-giang-vinh-thuan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(391, 35, 'Đăk Glei', 'kon-tum-dak-glei', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(392, 35, 'Đăk Hà', 'kon-tum-dak-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(393, 35, 'Đăk Tô', 'kon-tum-dak-to', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(394, 35, 'Kon Plông', 'kon-tum-kon-plong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(395, 35, 'Kon Rẫy', 'kon-tum-kon-ray', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(396, 35, 'KonTum', 'kon-tum-kontum', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(397, 35, 'Ngọc Hồi', 'kon-tum-ngoc-hoi', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(398, 35, 'Sa Thầy', 'kon-tum-sa-thay', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(399, 35, 'Tu Mơ Rông', 'kon-tum-tu-mo-rong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(400, 36, 'Lai Châu', 'lai-chau-lai-chau', NULL, NULL, NULL, NULL, 'Thị xã', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(401, 36, 'Mường Tè', 'lai-chau-muong-te', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(402, 36, 'Nậm Nhùn', 'lai-chau-nam-nhun', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(403, 36, 'Phong Thổ', 'lai-chau-phong-tho', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(404, 36, 'Sìn Hồ', 'lai-chau-sin-ho', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(405, 36, 'Tam Đường', 'lai-chau-tam-duong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(406, 36, 'Tân Uyên', 'lai-chau-tan-uyen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(407, 36, 'Than Uyên', 'lai-chau-than-uyen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(408, 37, 'Bảo Lâm', 'lam-dong-bao-lam', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(409, 37, 'Bảo Lộc', 'lam-dong-bao-loc', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(410, 37, 'Cát Tiên', 'lam-dong-cat-tien', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(411, 37, 'Đạ Huoai', 'lam-dong-da-huoai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(412, 37, 'Đà Lạt', 'lam-dong-da-lat', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(413, 37, 'Đạ Tẻh', 'lam-dong-da-teh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(414, 37, 'Đam Rông', 'lam-dong-dam-rong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(415, 37, 'Di Linh', 'lam-dong-di-linh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(416, 37, 'Đơn Dương', 'lam-dong-don-duong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(417, 37, 'Đức Trọng', 'lam-dong-duc-trong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(418, 37, 'Lạc Dương', 'lam-dong-lac-duong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(419, 37, 'Lâm Hà', 'lam-dong-lam-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(420, 38, 'Bắc Sơn', 'lang-son-bac-son', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(421, 38, 'Bình Gia', 'lang-son-binh-gia', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(422, 38, 'Cao Lộc', 'lang-son-cao-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(423, 38, 'Chi Lăng', 'lang-son-chi-lang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(424, 38, 'Đình Lập', 'lang-son-dinh-lap', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(425, 38, 'Hữu Lũng', 'lang-son-huu-lung', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(426, 38, 'Lạng Sơn', 'lang-son-lang-son', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(427, 38, 'Lộc Bình', 'lang-son-loc-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(428, 38, 'Tràng Định', 'lang-son-trang-dinh', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(429, 38, 'Văn Lãng', 'lang-son-van-lang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(430, 38, 'Văn Quan', 'lang-son-van-quan', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(431, 39, 'Bắc Hà', 'lao-cai-bac-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(432, 39, 'Bảo Thắng', 'lao-cai-bao-thang', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(433, 39, 'Bảo Yên', 'lao-cai-bao-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(434, 39, 'Bát Xát', 'lao-cai-bat-xat', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(435, 39, 'Lào Cai', 'lao-cai-lao-cai', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(436, 39, 'Mường Khương', 'lao-cai-muong-khuong', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(437, 39, 'Sa Pa', 'lao-cai-sa-pa', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(438, 39, 'Văn Bàn', 'lao-cai-van-ban', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(439, 39, 'Xi Ma Cai', 'lao-cai-xi-ma-cai', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(440, 40, 'Giao Thủy', 'nam-dinh-giao-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(441, 40, 'Hải Hậu', 'nam-dinh-hai-hau', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(442, 40, 'Mỹ Lộc', 'nam-dinh-my-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(443, 40, 'Nam Định', 'nam-dinh-nam-dinh', NULL, NULL, NULL, NULL, 'Thành phố', 1));

        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(444, 40, 'Nam Trực', 'nam-dinh-nam-truc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(445, 40, 'Nghĩa Hưng', 'nam-dinh-nghia-hung', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(446, 40, 'Trực Ninh', 'nam-dinh-truc-ninh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(447, 40, 'Vụ Bản', 'nam-dinh-vu-ban', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(448, 40, 'Xuân Trường', 'nam-dinh-xuan-truong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(449, 40, 'Ý Yên', 'nam-dinh-y-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(450, 41, 'Anh Sơn', 'nghe-an-anh-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(451, 41, 'Con Cuông', 'nghe-an-con-cuong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(452, 41, 'Cửa Lò', 'nghe-an-cua-lo', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(453, 41, 'Diễn Châu', 'nghe-an-dien-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(454, 41, 'Đô Lương', 'nghe-an-do-luong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(455, 41, 'Hoàng Mai', 'nghe-an-hoang-mai', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(456, 41, 'Hưng Nguyên', 'nghe-an-hung-nguyen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(457, 41, 'Kỳ Sơn', 'nghe-an-ky-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(458, 41, 'Nam Đàn', 'nghe-an-nam-dan', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(459, 41, 'Nghi Lộc', 'nghe-an-nghi-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(460, 41, 'Nghĩa Đàn', 'nghe-an-nghia-dan', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(461, 41, 'Quế Phong', 'nghe-an-que-phong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(462, 41, 'Quỳ Châu', 'nghe-an-quy-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(463, 41, 'Quỳ Hợp', 'nghe-an-quy-hop', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(464, 41, 'Quỳnh Lưu', 'nghe-an-quynh-luu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(465, 41, 'Tân Kỳ', 'nghe-an-tan-ky', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(466, 41, 'Thái Hòa', 'nghe-an-thai-hoa', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(467, 41, 'Thanh Chương', 'nghe-an-thanh-chuong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(468, 41, 'Tương Dương', 'nghe-an-tuong-duong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(469, 41, 'Vinh', 'nghe-an-vinh', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(470, 41, 'Yên Thành', 'nghe-an-yen-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(471, 42, 'Gia Viễn', 'ninh-binh-gia-vien', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(472, 42, 'Hoa Lư', 'ninh-binh-hoa-lu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(473, 42, 'Kim Sơn', 'ninh-binh-kim-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(474, 42, 'Nho Quan', 'ninh-binh-nho-quan', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(475, 42, 'Ninh Bình', 'ninh-binh-ninh-binh', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(476, 42, 'Tam Điệp', 'ninh-binh-tam-diep', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(477, 42, 'Yên Khánh', 'ninh-binh-yen-khanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(478, 42, 'Yên Mô', 'ninh-binh-yen-mo', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(479, 43, 'Bác Ái', 'ninh-thuan-bac-ai', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(480, 43, 'Ninh Hải', 'ninh-thuan-ninh-hai', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(481, 43, 'Ninh Phước', 'ninh-thuan-ninh-phuoc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(482, 43, 'Ninh Sơn', 'ninh-thuan-ninh-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(483, 43, 'Phan Rang - Tháp Chàm', 'ninh-thuan-phan-rang-thap-cham', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(484, 43, 'Thuận Bắc', 'ninh-thuan-thuan-bac', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(485, 43, 'Thuận Nam', 'ninh-thuan-thuan-nam', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(486, 44, 'Cẩm Khê', 'phu-tho-cam-khe', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(487, 44, 'Đoan Hùng', 'phu-tho-doan-hung', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(488, 44, 'Hạ Hòa', 'phu-tho-ha-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(489, 44, 'Lâm Thao', 'phu-tho-lam-thao', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(490, 44, 'Phù Ninh', 'phu-tho-phu-ninh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(491, 44, 'Phú Thọ', 'phu-tho-phu-tho', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(492, 44, 'Tam Nông', 'phu-tho-tam-nong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(493, 44, 'Tân Sơn', 'phu-tho-tan-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(494, 44, 'Thanh Ba', 'phu-tho-thanh-ba', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(495, 44, 'Thanh Sơn', 'phu-tho-thanh-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(496, 44, 'Thanh Thủy', 'phu-tho-thanh-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(497, 44, 'Việt Trì', 'phu-tho-viet-tri', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(498, 44, 'Yên Lập', 'phu-tho-yen-lap', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(499, 45, 'Đông Hòa', 'phu-yen-dong-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(500, 45, 'Đồng Xuân', 'phu-yen-dong-xuan', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(501, 45, 'Phú Hòa', 'phu-yen-phu-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(502, 45, 'Sơn Hòa', 'phu-yen-son-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(503, 45, 'Sông Cầu', 'phu-yen-song-cau', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(504, 45, 'Sông Hinh', 'phu-yen-song-hinh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(505, 45, 'Tây Hòa', 'phu-yen-tay-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(506, 45, 'Tuy An', 'phu-yen-tuy-an', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(507, 45, 'Tuy Hòa', 'phu-yen-tuy-hoa', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(508, 46, 'Ba Đồn', 'quang-binh-ba-don', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(509, 46, 'Bố Trạch', 'quang-binh-bo-trach', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(510, 46, 'Đồng Hới', 'quang-binh-dong-hoi', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(511, 46, 'Lệ Thủy', 'quang-binh-le-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(512, 46, 'Minh Hóa', 'quang-binh-minh-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(513, 46, 'Quảng Ninh', 'quang-binh-quang-ninh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(514, 46, 'Quảng Trạch', 'quang-binh-quang-trach', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(515, 46, 'Tuyên Hóa', 'quang-binh-tuyen-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(516, 47, 'Bắc Trà My', 'quang-nam-bac-tra-my', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(517, 47, 'Đại Lộc', 'quang-nam-dai-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(518, 47, 'Điện Bàn', 'quang-nam-dien-ban', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(519, 47, 'Đông Giang', 'quang-nam-dong-giang', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(520, 47, 'Duy Xuyên', 'quang-nam-duy-xuyen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(521, 47, 'Hiệp Đức', 'quang-nam-hiep-duc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(522, 47, 'Hội An', 'quang-nam-hoi-an', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(523, 47, 'Nam Giang', 'quang-nam-nam-giang', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(524, 47, 'Nam Trà My', 'quang-nam-nam-tra-my', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(525, 47, 'Nông Sơn', 'quang-nam-nong-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(526, 47, 'Núi Thành', 'quang-nam-nui-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(527, 47, 'Phú Ninh', 'quang-nam-phu-ninh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(528, 47, 'Phước Sơn', 'quang-nam-phuoc-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(529, 47, 'Quế Sơn', 'quang-nam-que-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(530, 47, 'Tam Kỳ', 'quang-nam-tam-ky', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(531, 47, 'Tây Giang', 'quang-nam-tay-giang', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(532, 47, 'Thăng Bình', 'quang-nam-thang-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(533, 47, 'Tiên Phước', 'quang-nam-tien-phuoc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(534, 48, 'Ba Tơ', 'quang-ngai-ba-to', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(535, 48, 'Bình Sơn', 'quang-ngai-binh-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(536, 48, 'Đức Phổ', 'quang-ngai-duc-pho', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(537, 48, 'Lý Sơn', 'quang-ngai-ly-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(538, 48, 'Minh Long', 'quang-ngai-minh-long', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(539, 48, 'Mộ Đức', 'quang-ngai-mo-duc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(540, 48, 'Nghĩa Hành', 'quang-ngai-nghia-hanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(541, 48, 'Quảng Ngãi', 'quang-ngai-quang-ngai', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(542, 48, 'Sơn Hà', 'quang-ngai-son-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(543, 48, 'Sơn Tây', 'quang-ngai-son-tay', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(544, 48, 'Sơn Tịnh', 'quang-ngai-son-tinh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(545, 48, 'Tây Trà', 'quang-ngai-tay-tra', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(546, 48, 'Trà Bồng', 'quang-ngai-tra-bong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(547, 48, 'Tư Nghĩa', 'quang-ngai-tu-nghia', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(548, 49, 'Ba Chẽ', 'quang-ninh-ba-che', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(549, 49, 'Bình Liêu', 'quang-ninh-binh-lieu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(550, 49, 'Cẩm Phả', 'quang-ninh-cam-pha', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(551, 49, 'Cô Tô', 'quang-ninh-co-to', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(552, 49, 'Đầm Hà', 'quang-ninh-dam-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(553, 49, 'Đông Triều', 'quang-ninh-dong-trieu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(554, 49, 'Hạ Long', 'quang-ninh-ha-long', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(555, 49, 'Hải Hà', 'quang-ninh-hai-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(556, 49, 'Hoành Bồ', 'quang-ninh-hoanh-bo', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(557, 49, 'Móng Cái', 'quang-ninh-mong-cai', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(558, 49, 'Quảng Yên', 'quang-ninh-quang-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(559, 49, 'Tiên Yên', 'quang-ninh-tien-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(560, 49, 'Uông Bí', 'quang-ninh-uong-bi', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(561, 49, 'Vân Đồn', 'quang-ninh-van-don', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(562, 50, 'Cam Lộ', 'quang-tri-cam-lo', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(563, 50, 'Đăk Rông', 'quang-tri-dak-rong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(564, 50, 'Đảo Cồn cỏ', 'quang-tri-dao-con-co', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(565, 50, 'Đông Hà', 'quang-tri-dong-ha', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(566, 50, 'Gio Linh', 'quang-tri-gio-linh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(567, 50, 'Hải Lăng', 'quang-tri-hai-lang', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(568, 50, 'Hướng Hóa', 'quang-tri-huong-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(569, 50, 'Quảng Trị', 'quang-tri-quang-tri', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(570, 50, 'Triệu Phong', 'quang-tri-trieu-phong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(571, 50, 'Vĩnh Linh', 'quang-tri-vinh-linh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(572, 51, 'Châu Thành', 'soc-trang-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(573, 51, 'Cù Lao Dung', 'soc-trang-cu-lao-dung', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(574, 51, 'Kế Sách', 'soc-trang-ke-sach', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(575, 51, 'Long Phú', 'soc-trang-long-phu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(576, 51, 'Mỹ Tú', 'soc-trang-my-tu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(577, 51, 'Mỹ Xuyên', 'soc-trang-my-xuyen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(578, 51, 'Ngã Năm', 'soc-trang-nga-nam', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(579, 51, 'Sóc Trăng', 'soc-trang-soc-trang', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(580, 51, 'Thạnh Trị', 'soc-trang-thanh-tri', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(581, 51, 'Trần Đề', 'soc-trang-tran-de', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(582, 51, 'Vĩnh Châu', 'soc-trang-vinh-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(583, 52, 'Bắc Yên', 'son-la-bac-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(584, 52, 'Mai Sơn', 'son-la-mai-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(585, 52, 'Mộc Châu', 'son-la-moc-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(586, 52, 'Mường La', 'son-la-muong-la', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(587, 52, 'Phù Yên', 'son-la-phu-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(588, 52, 'Quỳnh Nhai', 'son-la-quynh-nhai', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(589, 52, 'Sơn La', 'son-la-son-la', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(590, 52, 'Sông Mã', 'son-la-song-ma', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(591, 52, 'Sốp Cộp', 'son-la-sop-cop', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(592, 52, 'Thuận Châu', 'son-la-thuan-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(593, 52, 'Vân Hồ', 'son-la-van-ho', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(594, 52, 'Yên Châu', 'son-la-yen-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(595, 53, 'Bến Cầu', 'tay-ninh-ben-cau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(596, 53, 'Châu Thành', 'tay-ninh-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(597, 53, 'Dương Minh Châu', 'tay-ninh-duong-minh-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(598, 53, 'Gò Dầu', 'tay-ninh-go-dau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(599, 53, 'Hòa Thành', 'tay-ninh-hoa-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(600, 53, 'Tân Biên', 'tay-ninh-tan-bien', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(601, 53, 'Tân Châu', 'tay-ninh-tan-chau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(602, 53, 'Tây Ninh', 'tay-ninh-tay-ninh', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(603, 53, 'Trảng Bàng', 'tay-ninh-trang-bang', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(604, 54, 'Đông Hưng', 'thai-binh-dong-hung', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(605, 54, 'Hưng Hà', 'thai-binh-hung-ha', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(606, 54, 'Kiến Xương', 'thai-binh-kien-xuong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(607, 54, 'Quỳnh Phụ', 'thai-binh-quynh-phu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(608, 54, 'Thái Bình', 'thai-binh-thai-binh', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(609, 54, 'Thái Thuỵ', 'thai-binh-thai-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(610, 54, 'Tiền Hải', 'thai-binh-tien-hai', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(611, 54, 'Vũ Thư', 'thai-binh-vu-thu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(612, 55, 'Đại Từ', 'thai-nguyen-dai-tu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(613, 55, 'Định Hóa', 'thai-nguyen-dinh-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(614, 55, 'Đồng Hỷ', 'thai-nguyen-dong-hy', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(615, 55, 'Phổ Yên', 'thai-nguyen-pho-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(616, 55, 'Phú Bình', 'thai-nguyen-phu-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(617, 55, 'Phú Lương', 'thai-nguyen-phu-luong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(618, 55, 'Sông Công', 'thai-nguyen-song-cong', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(619, 55, 'Thái Nguyên', 'thai-nguyen-thai-nguyen', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(620, 55, 'Võ Nhai', 'thai-nguyen-vo-nhai', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(621, 56, 'Bá Thước', 'thanh-hoa-ba-thuoc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(622, 56, 'Bỉm Sơn', 'thanh-hoa-bim-son', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(623, 56, 'Cẩm Thủy', 'thanh-hoa-cam-thuy', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(624, 56, 'Đông Sơn', 'thanh-hoa-dong-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(625, 56, 'Hà Trung', 'thanh-hoa-ha-trung', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(626, 56, 'Hậu Lộc', 'thanh-hoa-hau-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(627, 56, 'Hoằng Hóa', 'thanh-hoa-hoang-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(628, 56, 'Lang Chánh', 'thanh-hoa-lang-chanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(629, 56, 'Mường Lát', 'thanh-hoa-muong-lat', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(630, 56, 'Nga Sơn', 'thanh-hoa-nga-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(631, 56, 'Ngọc Lặc', 'thanh-hoa-ngoc-lac', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(632, 56, 'Như Thanh', 'thanh-hoa-nhu-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(633, 56, 'Như Xuân', 'thanh-hoa-nhu-xuan', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(634, 56, 'Nông Cống', 'thanh-hoa-nong-cong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(635, 56, 'Quan Hóa', 'thanh-hoa-quan-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(636, 56, 'Quan Sơn', 'thanh-hoa-quan-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(637, 56, 'Quảng Xương', 'thanh-hoa-quang-xuong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(638, 56, 'Sầm Sơn', 'thanh-hoa-sam-son', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(639, 56, 'Thạch Thành', 'thanh-hoa-thach-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(640, 56, 'Thanh Hóa', 'thanh-hoa-thanh-hoa', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(641, 56, 'Thiệu Hóa', 'thanh-hoa-thieu-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(642, 56, 'Thọ Xuân', 'thanh-hoa-tho-xuan', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(643, 56, 'Thường Xuân', 'thanh-hoa-thuong-xuan', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(644, 56, 'Tĩnh Gia', 'thanh-hoa-tinh-gia', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(645, 56, 'Triệu Sơn', 'thanh-hoa-trieu-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(646, 56, 'Vĩnh Lộc', 'thanh-hoa-vinh-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(647, 56, 'Yên Định', 'thanh-hoa-yen-dinh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(648, 57, 'A Lưới', 'thua-thien-hue-a-luoi', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(649, 57, 'Huế', 'thua-thien-hue-hue', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(650, 57, 'Hương Thủy', 'thua-thien-hue-huong-thuy', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(651, 57, 'Hương Trà', 'thua-thien-hue-huong-tra', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(652, 57, 'Nam Đông', 'thua-thien-hue-nam-dong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(653, 57, 'Phong Điền', 'thua-thien-hue-phong-dien', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(654, 57, 'Phú Lộc', 'thua-thien-hue-phu-loc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(655, 57, 'Phú Vang', 'thua-thien-hue-phu-vang', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(656, 57, 'Quảng Điền', 'thua-thien-hue-quang-dien', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(657, 58, 'Cái Bè', 'tien-giang-cai-be', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(658, 58, 'Châu Thành', 'tien-giang-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(659, 58, 'Chợ Gạo', 'tien-giang-cho-gao', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(660, 58, 'Gò Công', 'tien-giang-go-cong', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(661, 58, 'Gò Công Đông', 'tien-giang-go-cong-dong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(662, 58, 'Gò Công Tây', 'tien-giang-go-cong-tay', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(663, 58, 'Huyện Cai Lậy', 'tien-giang-huyen-cai-lay', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(664, 58, 'Mỹ Tho', 'tien-giang-my-tho', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(665, 58, 'Tân Phú Đông', 'tien-giang-tan-phu-dong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(666, 58, 'Tân Phước', 'tien-giang-tan-phuoc', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(667, 58, 'Thị Xã Cai Lậy', 'tien-giang-thi-xa-cai-lay', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(668, 59, 'Càng Long', 'tra-vinh-cang-long', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(669, 59, 'Cầu Kè', 'tra-vinh-cau-ke', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(670, 59, 'Cầu Ngang', 'tra-vinh-cau-ngang', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(671, 59, 'Châu Thành', 'tra-vinh-chau-thanh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(672, 59, 'Duyên Hải', 'tra-vinh-duyen-hai', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(673, 59, 'Tiểu Cần', 'tra-vinh-tieu-can', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(674, 59, 'Trà Cú', 'tra-vinh-tra-cu', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(675, 59, 'Trà Vinh', 'tra-vinh-tra-vinh', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(676, 60, 'Chiêm Hóa', 'tuyen-quang-chiem-hoa', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(677, 60, 'Hàm Yên', 'tuyen-quang-ham-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(678, 60, 'Lâm Bình', 'tuyen-quang-lam-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(679, 60, 'Na Hang', 'tuyen-quang-na-hang', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(680, 60, 'Sơn Dương', 'tuyen-quang-son-duong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(681, 60, 'Tuyên Quang', 'tuyen-quang-tuyen-quang', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(682, 60, 'Yên Sơn', 'tuyen-quang-yen-son', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(683, 61, 'Bình Minh', 'vinh-long-binh-minh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(684, 61, 'Bình Tân', 'vinh-long-binh-tan', NULL, NULL, NULL, NULL, 'Quận', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(685, 61, 'Long Hồ', 'vinh-long-long-ho', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(686, 61, 'Mang Thít', 'vinh-long-mang-thit', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(687, 61, 'Tam Bình', 'vinh-long-tam-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(688, 61, 'Trà Ôn', 'vinh-long-tra-on', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(689, 61, 'Vĩnh Long', 'vinh-long-vinh-long', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(690, 61, 'Vũng Liêm', 'vinh-long-vung-liem', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(691, 62, 'Bình Xuyên', 'vinh-phuc-binh-xuyen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(692, 62, 'Lập Thạch', 'vinh-phuc-lap-thach', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(693, 62, 'Phúc Yên', 'vinh-phuc-phuc-yen', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(694, 62, 'Sông Lô', 'vinh-phuc-song-lo', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(695, 62, 'Tam Đảo', 'vinh-phuc-tam-dao', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(696, 62, 'Tam Dương', 'vinh-phuc-tam-duong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(697, 62, 'Vĩnh Tường', 'vinh-phuc-vinh-tuong', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(698, 62, 'Vĩnh Yên', 'vinh-phuc-vinh-yen', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(699, 62, 'Yên Lạc', 'vinh-phuc-yen-lac', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(700, 63, 'Lục Yên', 'yen-bai-luc-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(701, 63, 'Mù Cang Chải', 'yen-bai-mu-cang-chai', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(702, 63, 'Nghĩa Lộ', 'yen-bai-nghia-lo', NULL, NULL, NULL, NULL, 'Thị xã', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(703, 63, 'Trạm Tấu', 'yen-bai-tram-tau', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(704, 63, 'Trấn Yên', 'yen-bai-tran-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(705, 63, 'Văn Chấn', 'yen-bai-van-chan', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(706, 63, 'Văn Yên', 'yen-bai-van-yen', NULL, NULL, NULL, NULL, 'Huyện', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(707, 63, 'Yên Bái', 'yen-bai-yen-bai', NULL, NULL, NULL, NULL, 'Thành phố', 1));
        DB::insert("INSERT INTO `sys_districts`(id, city_id, name, slug, geometry,center, color, bounding_box, pre, status) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?)", array(708, 63, 'Yên Bình', 'yen-bai-yen-binh', NULL, NULL, NULL, NULL, 'Huyện', 1));
        return true;
    }
}
