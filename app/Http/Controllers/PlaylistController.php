<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::where('user_id', Auth::id())->withCount('songs')->get();
        return view('playlists.index', compact('playlists'));
    }

    public function create()
    {
        return view('playlists.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required|string|max:255']);
        $pl = Playlist::create(['name'=>$request->name,'user_id'=>Auth::id()]);
        return redirect()->route('playlists.index')->with('success','Playlist created.');
    }

    public function edit(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        return view('playlists.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $request->validate(['name'=>'required|string|max:255']);
        $playlist->update(['name'=>$request->name]);
        return redirect()->route('playlists.index')->with('success','Updated.');
    }

    public function destroy(Playlist $playlist)
    {
        $this->authorize('delete', $playlist);
        $playlist->delete();
        return redirect()->route('playlists.index')->with('success','Deleted.');
    }

    public function addSong(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $request->validate(['song_id'=>'required|exists:songs,id']);
        $playlist->songs()->attach($request->song_id);
        return back()->with('success','Added to playlist.');
    }

    public function removeSong(Playlist $playlist, Song $song)
    {
        $this->authorize('update', $playlist);
        $playlist->songs()->detach($song->id);
        return back()->with('success','Removed.');
    }
}
