<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::when(request()->category, function ($query) {
            return $query->where('category', request()->category);
        })->latest()->paginate(15);

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file->getClientOriginalName());
            $file->move(public_path('images/menus'), $name);
            $data['image'] = $name;
        }

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image == 1) {
            if ($menu->image && file_exists(public_path('images/menus/' . $menu->image))) {
                @unlink(public_path('images/menus/' . $menu->image));
            }
            $data['image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menu->image && file_exists(public_path('images/menus/' . $menu->image))) {
                @unlink(public_path('images/menus/' . $menu->image));
            }

            $file = $request->file('image');
            $name = time() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file->getClientOriginalName());
            $file->move(public_path('images/menus'), $name);
            $data['image'] = $name;
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Delete image file if exists
        if ($menu->image && file_exists(public_path('images/menus/' . $menu->image))) {
            @unlink(public_path('images/menus/' . $menu->image));
        }

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus.');
    }
}
