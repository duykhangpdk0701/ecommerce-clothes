<?php

namespace Database\Seeders;

use App\Models\SysCity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SysCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return null | boolean
     */

    public function run(): null|bool
    {
        if (SysCity::count() > 0) {
            return false;
        }

        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                1,
                'SG',
                'Hồ Chí Minh',
                'ho-chi-minh',
                null,
                '[10.757247,106.688083]',
                '#FF0000',
                '{\"tl\":[10.376389,106.356438],\"br\":[11.159539,107.025276]}',
                1,
                'Thành Phố'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                2,
                'HN',
                'Hà Nội',
                'ha-noi',
                null,
                '[20.984664,105.694534]',
                '#FF0000',
                '{\"tl\":[20.564646,105.286415],\"br\":[21.38542,106.019333]}',
                1,
                'Thành Phố'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                3,
                'BD',
                'Bình Dương',
                'binh-duong',
                null,
                '[11.216343,106.65744]',
                '#FF0000',
                '{\"tl\":[10.863709,106.326019],\"br\":[11.50093,106.966377]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                4,
                'DDN',
                'Đà Nẵng',
                'da-nang',
                null,
                '[16.06868,108.06079]',
                '#FF0000',
                '{\"tl\":[15.918026,107.818306],\"br\":[16.225834,108.338333]}',
                1,
                'Thành Phố'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                5,
                'HP',
                'Hải Phòng',
                'hai-phong',
                null,
                '[20.797081,106.680731]',
                '#FF0000',
                '{\"tl\":[20.125416,106.399834],\"br\":[21.021355,107.741531]}',
                1,
                'Thành Phố'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                6,
                'LA',
                'Long An',
                'long-an',
                null,
                '[10.729866,106.170748]',
                '#FF0000',
                '{\"tl\":[10.395407,105.498062],\"br\":[11.032491,106.748184]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                7,
                'VT',
                'Bà Rịa Vũng Tàu',
                'ba-ria-vung-tau',
                null,
                '[10.505614,107.257545]',
                '#FF0000',
                '{\"tl\":[8.605942,106.141502],\"br\":[10.803907,107.582169]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                8,
                'AG',
                'An Giang',
                'an-giang',
                null,
                '[10.511902,105.182456]',
                '#FF0000',
                '{\"tl\":[10.183516,104.777702],\"br\":[10.961942,105.575272]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                9,
                'BG',
                'Bắc Giang',
                'bac-giang',
                null,
                '[21.357592,106.480077]',
                '#FF0000',
                '{\"tl\":[21.122089,105.879807],\"br\":[21.626417,107.033302]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                10,
                'BK',
                'Bắc Kạn',
                'bac-kan',
                null,
                '[22.261402,105.825962]',
                '#FF0000',
                '{\"tl\":[21.80448,105.430305],\"br\":[22.739758,106.246216]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                11,
                'BL',
                'Bạc Liêu',
                'bac-lieu',
                null,
                '[9.312847,105.490629]',
                '#FF0000',
                '{\"tl\":[9.018334,105.23217],\"br\":[9.637437,105.859848]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                12,
                'BN',
                'Bắc Ninh',
                'bac-ninh',
                null,
                '[21.109244,106.105552]',
                '#FF0000',
                '{\"tl\":[20.969255,105.903397],\"br\":[21.264437,106.311195]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                13,
                'BTR',
                'Bến Tre',
                'ben-tre',
                null,
                '[10.123362,106.463537]',
                '#FF0000',
                '{\"tl\":[9.8025,106.027908],\"br\":[10.340414,106.791946]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                14,
                'BDD',
                'Bình Định',
                'binh-dinh',
                null,
                '[14.123471,108.948353]',
                '#FF0000',
                '{\"tl\":[13.515251,108.600868],\"br\":[14.703255,109.363579]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                15,
                'BP',
                'Bình Phước',
                'binh-phuoc',
                null,
                '[11.753991,106.908488]',
                '#FF0000',
                '{\"tl\":[11.300597,106.411568],\"br\":[12.297761,107.428574]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                16,
                'BTH',
                'Bình Thuận  ',
                'binh-thuan',
                null,
                '[11.117985,108.048481]',
                '#FF0000',
                '{\"tl\":[9.970021,107.393898],\"br\":[11.555672,109.085228]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                17,
                'CM',
                'Cà Mau',
                'ca-mau',
                null,
                '[9.052314,105.041091]',
                '#FF0000',
                '{\"tl\":[8.563332,104.71228],\"br\":[9.562001,105.418854]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                18,
                'CT',
                'Cần Thơ',
                'can-tho',
                null,
                '[10.114459,105.530314]',
                '#FF0000',
                '{\"tl\":[9.919375,105.225952],\"br\":[10.325283,105.844528]}',
                1,
                'Thành Phố'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                19,
                'CB',
                'Cao Bằng',
                'cao-bang',
                null,
                '[22.744814,106.086098]',
                '#FF0000',
                '{\"tl\":[22.357077,105.270691],\"br\":[23.118378,106.839462]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                20,
                'DDL',
                'Đắk Lắk',
                'dak-lak',
                null,
                '[12.822864,108.212195]',
                '#FF0000',
                '{\"tl\":[12.160808,107.484589],\"br\":[13.416621,108.994995]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                21,
                'DNO',
                'Đắk Nông',
                'dak-nong',
                null,
                '[12.228169,107.688114]',
                '#FF0000',
                '{\"tl\":[11.748837,107.205612],\"br\":[12.812443,108.116074]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                22,
                'DDB',
                'Điện Biên',
                'dien-bien',
                null,
                '[21.711865,103.024127]',
                '#FF0000',
                '{\"tl\":[20.893721,102.144997],\"br\":[22.558617,103.598755]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                23,
                'DNA',
                'Đồng Nai',
                'dong-nai',
                null,
                '[11.05912,107.185551]',
                '#FF0000',
                '{\"tl\":[10.5825,106.750854],\"br\":[11.582002,107.577003]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                24,
                'DDT',
                'Đồng Tháp',
                'dong-thap',
                null,
                '[10.564178,105.607849]',
                '#FF0000',
                '{\"tl\":[10.13411,105.186996],\"br\":[10.974042,105.941788]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                25,
                'GL',
                'Gia Lai',
                'gia-lai',
                null,
                '[13.836168,108.176693]',
                '#FF0000',
                '{\"tl\":[12.995756,107.332596],\"br\":[14.603214,108.872993]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                26,
                'HG',
                'Hà Giang',
                'ha-giang',
                null,
                '[22.768131,104.978648]',
                '#FF0000',
                '{\"tl\":[22.165707,104.334457],\"br\":[23.392731,105.591957]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                27,
                'HNA',
                'Hà Nam',
                'ha-nam',
                null,
                '[20.540466,105.966171]',
                '#FF0000',
                '{\"tl\":[20.363047,105.767967],\"br\":[20.704515,106.182594]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                28,
                'HT',
                'Hà Tĩnh',
                'ha-tinh',
                null,
                '[18.289829,105.735791]',
                '#FF0000',
                '{\"tl\":[17.914446,105.102798],\"br\":[18.763668,106.510956]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                29,
                'HD',
                'Hải Dương',
                'hai-duong',
                null,
                '[20.930437,106.360545]',
                '#FF0000',
                '{\"tl\":[20.684511,106.123634],\"br\":[21.237133,106.610718]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                30,
                'HGI',
                'Hậu Giang',
                'hau-giang',
                null,
                '[9.78422,105.624155]',
                '#FF0000',
                '{\"tl\":[9.582134,105.328201],\"br\":[9.994104,105.896492]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                31,
                'HB',
                'Hòa Bình',
                'hoa-binh',
                null,
                '[20.68115,105.333461]',
                '#FF0000',
                '{\"tl\":[20.305492,104.835709],\"br\":[21.112904,105.86142]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                32,
                'HY',
                'Hưng Yên',
                'hung-yen',
                null,
                '[20.814655,106.059667]',
                '#FF0000',
                '{\"tl\":[20.603228,105.894585],\"br\":[21.007345,106.268806]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                33,
                'KH',
                'Khánh Hòa',
                'khanh-hoa',
                null,
                '[12.330741,109.037494]',
                '#FF0000',
                '{\"tl\":[11.804438,108.670708],\"br\":[12.868547,109.469429]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                34,
                'KG',
                'Kiên Giang',
                'kien-giang',
                null,
                '[9.995757,104.942883]',
                '#FF0000',
                '{\"tl\":[9.253889,103.458206],\"br\":[10.5395,105.538979]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                35,
                'KT',
                'Kon Tum',
                'kon-tum',
                null,
                '[14.729829,107.941858]',
                '#FF0000',
                '{\"tl\":[14.202184,107.466225],\"br\":[15.417597,108.546501]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                36,
                'LCH',
                'Lai Châu',
                'lai-chau',
                null,
                '[22.317125,103.188826]',
                '#FF0000',
                '{\"tl\":[21.684601,102.324944],\"br\":[22.81735,103.984665]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                37,
                'LDD',
                'Lâm Đồng',
                'lam-dong',
                null,
                '[11.750981,108.095559]',
                '#FF0000',
                '{\"tl\":[11.215216,107.265427],\"br\":[12.317454,108.731659]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                38,
                'LS',
                'Lạng Sơn',
                'lang-son',
                null,
                '[21.839172,106.620767]',
                '#FF0000',
                '{\"tl\":[21.325293,106.094604],\"br\":[22.46162,107.363777]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                39,
                'LCA',
                'Lào Cai',
                'lao-cai',
                null,
                '[22.364795,104.113051]',
                '#FF0000',
                '{\"tl\":[21.875256,103.531601],\"br\":[22.84444,104.627815]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                40,
                'NDD',
                'Nam Định',
                'nam-dinh',
                null,
                '[20.261889,106.212518]',
                '#FF0000',
                '{\"tl\":[19.909447,105.923332],\"br\":[20.499325,106.587219]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                41,
                'NA',
                'Nghệ An',
                'nghe-an',
                null,
                '[19.23701,104.944252]',
                '#FF0000',
                '{\"tl\":[18.552223,103.871849],\"br\":[19.998468,105.806389]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                42,
                'NB',
                'Ninh Bình',
                'ninh-binh',
                null,
                '[20.220043,105.903042]',
                '#FF0000',
                '{\"tl\":[19.911539,105.54203],\"br\":[20.454838,106.167496]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                43,
                'NT',
                'Ninh Thuận',
                'ninh-thuan',
                null,
                '[11.705857,108.869399]',
                '#FF0000',
                '{\"tl\":[11.30691,108.551384],\"br\":[12.164548,109.233086]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                44,
                'PT',
                'Phú Thọ',
                'phu-tho',
                null,
                '[21.319065,105.115366]',
                '#FF0000',
                '{\"tl\":[20.917162,104.814606],\"br\":[21.719788,105.456047]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                45,
                'PY',
                'Phú Yên',
                'phu-yen',
                null,
                '[13.169248,109.057957]',
                '#FF0000',
                '{\"tl\":[12.7065,108.672783],\"br\":[13.695185,109.459076]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                46,
                'QB',
                'Quảng Bình',
                'quang-binh',
                null,
                '[17.531495,106.293709]',
                '#FF0000',
                '{\"tl\":[16.921461,105.607048],\"br\":[18.089975,106.994858]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                47,
                'QNA',
                'Quảng Nam',
                'quang-nam',
                null,
                '[15.590249,107.955331]',
                '#FF0000',
                '{\"tl\":[14.951411,107.210426],\"br\":[16.067146,108.738052]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                48,
                'QNG',
                'Quảng Ngãi',
                'quang-ngai',
                null,
                '[14.991953,108.649429]',
                '#FF0000',
                '{\"tl\":[14.53278,108.235069],\"br\":[15.433891,109.144165]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                49,
                'QNI',
                'Quảng Ninh',
                'quang-ninh',
                null,
                '[21.241828,107.277517]',
                '#FF0000',
                '{\"tl\":[20.715969,106.438423],\"br\":[21.664671,108.078751]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                50,
                'QT',
                'Quảng Trị',
                'quang-tri',
                null,
                '[16.745621,106.929312]',
                '#FF0000',
                '{\"tl\":[16.301567,106.513741],\"br\":[17.168009,107.38707]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                51,
                'ST',
                'Sóc Trăng',
                'soc-trang',
                null,
                '[9.558321,105.924201]',
                '#FF0000',
                '{\"tl\":[9.24361,105.543335],\"br\":[9.938053,106.29361]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                52,
                'SL',
                'Sơn La',
                'son-la',
                null,
                '[21.192572,104.070959]',
                '#FF0000',
                '{\"tl\":[20.573133,103.213745],\"br\":[22.028542,105.024544]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                53,
                'TNI',
                'Tây Ninh',
                'tay-ninh',
                null,
                '[11.403808,106.161312]',
                '#FF0000',
                '{\"tl\":[10.962522,105.809471],\"br\":[11.78229,106.492058]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                54,
                'TB',
                'Thái Bình',
                'thai-binh',
                null,
                '[20.505329,106.391967]',
                '#FF0000',
                '{\"tl\":[20.25139,106.108948],\"br\":[20.729122,106.648888]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                55,
                'TN',
                'Thái Nguyên',
                'thai-nguyen',
                null,
                '[21.692793,105.823101]',
                '#FF0000',
                '{\"tl\":[21.325483,105.476715],\"br\":[22.048016,106.237228]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                56,
                'TH',
                'Thanh Hóa',
                'thanh-hoa',
                null,
                '[20.04564,105.319113]',
                '#FF0000',
                '{\"tl\":[19.286894,104.375175],\"br\":[20.670799,106.075165]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                57,
                'TTH',
                'Thừa Thiên Huế',
                'thua-thien-hue',
                null,
                '[16.327114,107.499866]',
                '#FF0000',
                '{\"tl\":[15.994475,107.015701],\"br\":[16.742371,108.194328]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                58,
                'TG',
                'Tiền Giang',
                'tien-giang',
                null,
                '[10.397279,106.304772]',
                '#FF0000',
                '{\"tl\":[10.198738,105.815399],\"br\":[10.587139,106.787163]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                59,
                'TV',
                'Trà Vinh',
                'tra-vinh',
                null,
                '[9.79611,106.30693]',
                '#FF0000',
                '{\"tl\":[9.52889,105.954414],\"br\":[10.081751,106.579514]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                60,
                'TQ',
                'Tuyên Quang',
                'tuyen-quang',
                null,
                '[22.113017,105.26727]',
                '#FF0000',
                '{\"tl\":[21.49773,104.847763],\"br\":[22.696123,105.597488]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                61,
                'VL',
                'Vĩnh Long',
                'vinh-long',
                null,
                '[10.101617,105.990724]',
                '#FF0000',
                '{\"tl\":[9.882843,105.682487],\"br\":[10.330639,106.289337]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                62,
                'VP',
                'Vĩnh Phúc',
                'vinh-phuc',
                null,
                '[21.352881,105.564836]',
                '#FF0000',
                '{\"tl\":[21.121784,105.321693],\"br\":[21.573984,105.785797]}',
                1,
                'Tỉnh'
            )
        );
        DB::insert(
            "INSERT INTO `sys_cities` (id, code, name, slug, geometry, center, color, bounding_box,status, pre) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
            array(
                63,
                'YB',
                'Yên Bái',
                'yen-bai',
                null,
                '[21.776779,104.567928]',
                '#FF0000',
                '{\"tl\":[21.326056,103.885384],\"br\":[22.292011,105.099525]}',
                1,
                'Tỉnh'
            )
        );
        return true;
    }
}
