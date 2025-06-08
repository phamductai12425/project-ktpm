<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::where('user_id', auth()->id())->with('songs')->get();
        return view('playlists.index', compact('playlists'));
    }

    public function create()
    {
        $songs = Song::where('user_id', auth()->id())->get();
        return view('playlists.create', compact('songs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'song_ids' => 'required|array',
        ]);

        $playlist = Playlist::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        $playlist->songs()->attach($request->song_ids);

        return redirect()->route('playlists.index')->with('success', 'Playlist created successfully!');
    }

    public function show(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) abort(403);
        return view('playlists.show', compact('playlist'));
    }

    public function edit(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) abort(403);
        $songs = Song::where('user_id', auth()->id())->get();
        return view('playlists.edit', compact('playlist', 'songs'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) abort(403);
        $request->validate([
            'name' => 'required|string|max:255',
            'song_ids' => 'required|array',
        ]);

        $playlist->update(['name' => $request->name]);
        $playlist->songs()->sync($request->song_ids);

        return redirect()->route('playlists.index')->with('success', 'Playlist updated successfully!');
    }

    public function destroy(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) abort(403);
        $playlist->delete();
        return redirect()->route('playlists.index')->with('success', 'Playlist deleted successfully!');
    }
}