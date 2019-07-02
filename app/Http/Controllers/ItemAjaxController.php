<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;

class ItemAjaxController extends Controller
{
    public function manageItemAjax()
    {
        return view('item.manage-item-ajax');
    }



    public function index(Request $request)
    {
        $items = Items::latest()->paginate(5);
        return response()->json($items);
    }



    public function store(Request $request)
    {
        $create = Items::create($request->all());
        return response()->json($create);
    }



    public function update(Request $request, $id)
    {
        $edit = Items::find($id)->update($request->all());
        return response()->json($edit);
    }



    public function destroy($id)
    {
        Items::find($id)->delete();
        return response()->json(['done']);
    }
}
