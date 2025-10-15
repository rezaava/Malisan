<?php

namespace App\Http\Controllers\Dashboard;

use App\Course;
use App\Http\Controllers\Controller;
use App\Role;
use App\Score;
use App\Angizesh;
use App\Scoring;
use App\Session;
use App\Setting;
use App\Shop;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //

    /*
     * GET /
     * get list of shops
     */
    public function view() {
        $shopsList = Shop::where('active' , 1)->get();

        return view('management.shop.shops_list',compact('shopsList'));
    }

    /*
     * GET /buy
     * go to buy page (shop_id parameter in request is optional)
     */
    public function buy(Request $request) {
        $user = Auth::user();
        $wallet = $user->wallet;

        $shopId = '';
        if ($request->has("id")){
            $shopId = $request->id;
        }

        $shopsList = Shop::select('id', 'name', 'phone')->where('active' , 1)->get();

        return view('management.shop.shop_buy', compact('shopId' , 'shopsList' , 'wallet'));
    }

    /*
     * GET /shop-details/{id}
     * response JSON of a shop details for AJAX in buy page
     */
    public function getShopDetails($id) {
        $shop = Shop::find($id);

        if (!$shop) {
            return response()->json([
                'status' => '0',
                'message' => 'خطا در شناسه فروشگاه!'
            ]);
        }

        if (!$shop->active) {
            return response()->json([
                'status' => '0',
                'message' => 'فروشگاه مورد نظر فعال نمی باشد!'
            ]);
        }

        return response()->json([
            'status' => '1',
            'message' => '',
            'shop' => $shop,
        ]);
    }




}
