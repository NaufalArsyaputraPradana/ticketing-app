<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $payload = $request->validate([
                'nama' => 'required|string|min:3|max:255|unique:categories,nama',
            ], [
                'nama.required' => 'Nama kategori wajib diisi!',
                'nama.min' => 'Nama kategori minimal 3 karakter!',
                'nama.max' => 'Nama kategori maksimal 255 karakter!',
                'nama.unique' => 'Nama kategori sudah digunakan!',
            ]);

            if (!isset($payload['nama'])) {
                return redirect()->route('admin.categories.index')->with('error', 'Nama kategori wajib diisi.');
            }

            Category::create([
                'nama' => $payload['nama'],
            ]);

            return redirect()->route('admin.categories.index')->with('success', 'Kategori "' . $payload['nama'] . '" berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $payload = $request->validate([
                'nama' => "required|string|min:3|max:255|unique:categories,nama,{$id}",
            ], [
                'nama.required' => 'Nama kategori wajib diisi!',
                'nama.min' => 'Nama kategori minimal 3 karakter!',
                'nama.max' => 'Nama kategori maksimal 255 karakter!',
                'nama.unique' => 'Nama kategori sudah digunakan!',
            ]);

            if (!isset($payload['nama'])) {
                return redirect()->route('categories.index')->with('error', 'Nama kategori wajib diisi.');
            }

            $category = Category::findOrFail($id);
            $category->update([
                'nama' => $payload['nama'],
            ]);

            return redirect()->route('admin.categories.index')->with('success', '✅ Kategori berhasil diperbarui menjadi "' . $payload['nama'] . '"!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $nama = $category->getAttribute('nama');

            // Check if category is used by events
            if ($category->events()->count() > 0) {
                return redirect()->route('admin.categories.index')->with('error', "❌ Kategori \"{$nama}\" tidak dapat dihapus karena masih digunakan oleh {$category->events()->count()} event!");
            }

            $category->delete();

            return redirect()->route('admin.categories.index')->with('success', "✅ Kategori \"{$nama}\" berhasil dihapus!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}