<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooController extends Controller
{
    public function foo(Request $request)
    {
        return view('management.users.profile')
            ->with([
                'pageTitle' => 'صفحه داوری دروس',
                'pageName' => 'داوری درس',
                'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
            ]);
    }
    public function fooPost(Request $request)
    {
        dd($request->all());
    }
}
