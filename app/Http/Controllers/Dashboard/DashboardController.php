<?php

namespace App\Http\Controllers\Dashboard;

use App\Addition;
use App\Category;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inbox;
use App\Order;
use App\Product;
use App\Section;
use App\SubCategory;

class DashboardController extends Controller
{

    public function index()
    {
        $sections = Section::count();
        $categories = Category::count();
        $subCategories = SubCategory::count();
        $products = Product::count();
        $additions = Addition::count();
        $customers = Customer::count();
        $inbox = Inbox::count();
        $orders = Order::count();

        $orders_pending = Order::where('status', 'pendding')->count();
        $orders_total = Order::sum('total');
 
        $customers_list = Customer::latest()->get()->take(20);
        $products_list = Product::latest()->get()->take(20);

        $inbox_read = Inbox::where('status', 'active')->count();
        $inbox_unread = Inbox::where('status', '!=', 'active')->count();



        return view('dashboard.index', compact(
            'sections',
            'categories',
            'subCategories',
            'products',
            'additions',
            'customers',
            'inbox',
            'orders',
            'orders_total',
            'orders_pending',
            'customers_list',
            'products_list',
            'inbox_read',
            'inbox_unread'
        ));
    } //end of index

}//end of controller
