<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridThreeDataTable;
use App\DataTables\FooterGridTwoDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridThree;
use App\Models\FooterGridTwo;
use App\Models\FooterTitle;
use Illuminate\Http\Request;

class FooterGridThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridThreeDataTable $dataTable)
    {
        $footerTitle = FooterTitle::first();
        return $dataTable->render('admin.footer.footer-grid-three.index', compact('footerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-grid-three.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'url' => ['required', 'url'],
            'status' => ['required']
        ]);

        $footer = new FooterGridThree();
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();
        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.footer-grid-three.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footer = FooterGridThree::findOrFail($id);
        return view('admin.footer.footer-grid-three.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'url' => ['required', 'url'],
            'status' => ['required']
        ]);

        $footer = FooterGridThree::findOrFail($id);
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();
        toastr('Update Successfully!', 'success', 'success');

        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterGridThree::findOrFail($id);
        $footer->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $footer = FooterGridThree::findOrFail($request->id);
        $footer->status = $request->status == 'true' ? 1 : 0;
        $footer->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function changeTitle(Request $request)
    {
       $request->validate([
        'title' => ['required', 'max:200']
       ]);

       FooterTitle::updateOrCreate(
        ['id' => 1],
        ['footer_grid_three_title' => $request->title]
       );

       toastr('Updated Successfully', 'success', 'success');

       return redirect()->back();
    }
}
