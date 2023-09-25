<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorListController extends Controller
{
    public function index(VendorListDataTable $dataTable)
    {
        return $dataTable->render('admin.vendor-list.index');
    }

    public function changeStatus(Request $request)
    {
        $customer = User::findOrFail($request->id);
        $customer->status = $request->status == 'true' ? 'active' : 'inactive';
        $customer->save();

        return response(['message' => 'Status has been updated!']);
    }
}
