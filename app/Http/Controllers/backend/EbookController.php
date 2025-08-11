<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\EbookPurchase;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    //index
    public function index()
    {
        $ebooks = Ebook::latest()->paginate(10);
        return view('backend.ebooks.index', compact('ebooks'));
    }
//create
    public function create()
    {
        return view('backend.ebooks.create');
    }

//store
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'download_link' => 'nullable|url|max:1000',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Prepare data
        $data = $request->only(['title', 'author', 'price', 'download_link', 'description']);
        $data['cover_image'] = Ebook::getImageUrl($request); // Save image and return relative path

        // Create Ebook
        $ebook = Ebook::create($data);

        // Optional: Auto-create purchase record
        EbookPurchase::create([
            'ebook_id' => $ebook->id,
            'customer_id' => auth()->guard('customer')->id(),
            'price_paid' => $ebook->price,
            'payment_method' => 'card',
        ]);

        return redirect()->route('backend.ebooks.index')->with('message', 'Ebook created successfully.');
    }



// details
    public function details(Ebook $ebook)
    {
        return view('backend.ebooks.show', compact('ebook'));
    }

// edit
    public function edit($id)
    {
        $ebook = Ebook::find($id);
        return view('backend.ebooks.edit', compact('ebook'));
    }

    // update

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $ebook = Ebook::findOrFail($id);

        $data = $request->all();

        // If new file uploaded, replace it
        if ($request->hasFile('cover_image')) {
            if (file_exists(public_path($ebook->cover_image))) {
                unlink(public_path($ebook->cover_image));
            }
            $data['cover_image'] = Ebook::getImageUrl($request);
        } else {
            $data['cover_image'] = $ebook->cover_image; // Keep old image
        }

        $ebook->update($data);

        return redirect()->route('backend.ebooks.index')->with('message', 'Ebook updated successfully.');
    }

//delete
    public function delete($id)
    {
        $ebook = Ebook::findOrFail($id);

        // Delete cover image if it exists in public path
        if ($ebook->cover_image && file_exists(public_path($ebook->cover_image))) {
            unlink(public_path($ebook->cover_image));
        }

        // Delete the ebook record
        $ebook->delete();

        return redirect()->route('backend.ebooks.index')->with('message', 'Ebook deleted successfully.');
    }



}
