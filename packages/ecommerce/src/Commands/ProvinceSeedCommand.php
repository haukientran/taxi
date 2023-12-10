<?php

namespace Sudo\Ecommerce\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;

class ProvinceSeedCommand extends Command {

    protected $signature = 'sudo/province:seeds';

    protected $description = 'Khởi tạo dữ liệu tỉnh thành cho module shipping';

    public function handle() {
    	DB::table('shippings')->truncate();
        DB::table('shipping_provinces')->truncate();
        DB::table('shipping_rules')->truncate();

    	//Thêm phí ship mặc định
    	$created_at = $updated_at = date('Y-m-d H:i:s');
    	$db_insert_shipping = [
    		'title' 		=> 'Mặc định',
    		'province_id' 	=> -1,
    		'status' 		=> 1,
    		'created_at'	=>$created_at,
    		'updated_at'	=>$updated_at,
    	];
    	$id_insert = DB::table('shippings')->insertGetId($db_insert_shipping);

    	$db_insert_shipping_rules = [
    		'name'			=>'Mặc định',
    		'shipping_id'	=>$id_insert,
    		'type'			=>'default',
    		'from'			=>0,
    		'to'			=>0,
    		'price'			=>0,
    		'created_at'	=>$created_at,
    		'updated_at'	=>$updated_at,
    		'order'			=>0,
    	];
    	DB::table('shipping_rules')->insert($db_insert_shipping_rules);

        $db_insert = [
			'Hà Nội',
			'Hà Giang',
			'Cao Bằng',
			'Bắc Kạn',
			'Tuyên Quang',
			'Lào Cai',
			'Điện Biên',
			'Lai Châu',
			'Sơn La',
			'Yên Bái',
			'Hòa Bình',
			'Thái Nguyên',
			'Lạng Sơn',
			'Quảng Ninh',
			'Bắc Giang',
			'Phú Thọ',
			'Vĩnh Phúc',
			'Bắc Ninh',
			'Hải Dương',
			'Hải Phòng',
			'Hưng Yên',
			'Thái Bình',
			'Hà Nam',
			'Nam Định',
			'Ninh Bình',
			'Thanh Hóa',
			'Nghệ An',
			'Hà Tĩnh',
			'Quảng Bình',
			'Quảng Trị',
			'Thừa Thiên Huế',
			'Đà Nẵng',
			'Quảng Nam',
			'Quảng Ngãi',
			'Bình Định',
			'Phú Yên',
			'Khánh Hòa',
			'Ninh Thuận',
			'Bình Thuận',
			'Kon Tum',
			'Gia Lai',
			'Đắk Lắk',
			'Đắk Nông',
			'Lâm Đồng',
			'Bình Phước',
			'Tây Ninh',
			'Bình Dương',
			'Đồng Nai',
			'Bà Rịa - Vũng Tàu',
			'Hồ Chí Minh',
			'Long An',
			'Tiền Giang',
			'Bến Tre',
			'Trà Vinh',
			'Vĩnh Long',
			'Đồng Tháp',
			'An Giang',
			'Kiên Giang',
			'Cần Thơ',
			'Hậu Giang',
			'Sóc Trăng',
			'Bạc Liêu',
			'Cà Mau',
        ];
        foreach($db_insert as $value){
        	DB::table('shipping_provinces')->insert(['name' => $value]);
        }
        $this->echoLog('Tạo thành công dữ liệu tỉnh thành');

    }

    public function echoLog($string) {
        $this->info($string);
        Log::info($string);
    }

}