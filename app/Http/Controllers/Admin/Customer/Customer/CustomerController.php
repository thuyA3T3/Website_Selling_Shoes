<?php

namespace App\Http\Controllers\Admin\Customer\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.list', [
            'title' => 'List Customers',
            'customers' => $customers,
        ]);
    }
    public function lock(Customer $customer)
    {
        try {
            if ($customer->activation) {
                $customer->activation = false;
            } else {
                $customer->activation = true;
            }
            $customer->save();

            return response()->json([
                'error' => false,
                'message' => 'Thay đổi thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Có lỗi xảy ra khi khóa: ' . $e->getMessage()

            ]);
        }
    }
    public function listconfirm()
    {
        $customers = Customer::all();
        return view('admin.customers.confirm_seler', [
            'title' => 'Confirm Seller',
            'customers' => $customers,
        ]);
    }
    public function confirm(Customer $customer, Request $request)
    {
        $conf = $request->input('confirm');
        try {
            if ($conf === '1') {
                $customer->role = 'seller';
            } else {
                $customer->role = 'customer';
            }
            $customer->save();

            return response()->json([
                'error' => false,
                'message' => 'Thay đổi thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Có lỗi xảy ra khi xác nhận: ' . $e->getMessage()
            ]);
        }
    }
}
