<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;

use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Carbon;

class TestController extends Controller
{
	public function index(Request $request) {
		
		dd('Chức năng khóa!');
		
	}
}