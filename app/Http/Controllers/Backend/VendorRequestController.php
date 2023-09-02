<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorRequestController extends Controller
{
    public function index(VendorRequestDataTable $dataTable)
    {
        return $dataTable->render('admin.vendor-request.index');
    }

    public function show(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor-request.show', compact('vendor'));
    }

    public function changeStatus(Request $request, string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        $user = User::findOrFail($vendor->user_id);
        $user->role = 'vendor';
        $user->save();

        toastr('Updated successfully!', 'success', 'success');
        return redirect()->route('admin.vendor-requests.index');
    }
}
