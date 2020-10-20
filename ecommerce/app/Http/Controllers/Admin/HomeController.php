<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Events\MyEvent;
use App\Events\Order;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::paginate(10);

        for ($i = 0; $i <= 12; $i++) {
            $usersG[$i] = DB::table('Users')
                ->whereMonth('created_at', '=', $i)
                ->count();
            $ordersG[$i] = DB::table('orders')
                ->whereMonth('created_at', '=', $i)
                ->count();
        }

        return view('admin.home', compact(['users', 'usersG', 'ordersG']));
    }

    public function lang($lang)
    {
        App::setLocale($lang);

        return Redirect::route('admin.home');
    }
}
