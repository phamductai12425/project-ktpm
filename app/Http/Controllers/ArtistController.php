<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::where('user_id', Auth::id())->get();
        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        return view('artists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:artists,name',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artist = new Artist($validated);
        $artist->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $artist->image_path = $request->file('image')->store('artists', 'public');
        }

        $artist->save();

        return redirect()->route('artists.index')->with('success', 'Artist created successfully.');
    }

    public function edit(Artist $artist)
    {
        $this->authorize('update', $artist);
        return view('artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $this->authorize('update', $artist);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:artists,name,' . $artist->id,
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artist->fill($validated);

        if ($request->hasFile('image')) {
            if ($artist->image_path) {
                Storage::disk('public')->delete($artist->image_path);
            }
            $artist->image_path = $request->file('image')->store('artists', 'public');
        }

        $artist->save();

        return redirect()->route('artists.index')->with('success', 'Artist updated successfully.');
    }

    public function destroy(Artist $artist)
    {
        $this->authorize('delete', $artist);
        if ($artist->image_path) {
            Storage::disk('public')->delete($artist->image_path);
        }
        $artist->delete();
        return redirect()->route('artists.index')->with('success', 'Artist deleted successfully.');
    }
}
