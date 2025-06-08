<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use getID3\getID3;

class SongController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $songs = Song::where('user_id', Auth::id())->with('artist', 'genre')->get();
        return view('songs.index', compact('songs'));
    }

    public function create()
    {
        $artists = \App\Models\Artist::where('user_id', Auth::id())->get();
        $genres = \App\Models\Genre::where('user_id', Auth::id())->get();
        return view('songs.create', compact('artists', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'genre_name' => 'required|string|max:255',
            'file' => 'required|mimes:mp3,wav|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Lưu hoặc lấy nghệ sĩ
        $artist = \App\Models\Artist::firstOrCreate([
            'name' => $request->artist_name,
            'user_id' => Auth::id(),
        ]);
        // Lưu hoặc lấy thể loại
        $genre = \App\Models\Genre::firstOrCreate([
            'name' => $request->genre_name,
            'user_id' => Auth::id(),
        ]);

        $filePath = $request->file('file')->store('songs', 'public');
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

        // Lấy thời lượng file MP3
        $getID3 = new \getID3();
        $file = $request->file('file');
        $fileInfo = $getID3->analyze($file->getPathname());
        $duration = $fileInfo['playtime_seconds'] ?? 0;

        \App\Models\Song::create([
            'title' => $request->title,
            'artist_id' => $artist->id,
            'genre_id' => $genre->id,
            'file_path' => $filePath,
            'image_path' => $imagePath,
            'user_id' => Auth::id(),
            'duration' => $duration,
        ]);

        return redirect()->route('songs.index')->with('success', 'Bài hát đã được thêm thành công.');
    }

    public function edit(Song $song)
    {
        $this->authorize('update', $song);
        return view('songs.edit', compact('song'));
    }

    public function update(Request $request, Song $song)
    {
        $this->authorize('update', $song);

        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'artist_id' => $request->artist_id,
            'genre_id' => $request->genre_id,
        ];

        if ($request->hasFile('image')) {
            if ($song->image_path) {
                \Storage::disk('public')->delete($song->image_path);
            }
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        $song->update($data);

        return redirect()->route('songs.index')->with('success', 'Bài hát đã được cập nhật thành công.');
    }

    public function destroy(Song $song)
    {
        $this->authorize('delete', $song);
        if ($song->image_path) {
            \Storage::disk('public')->delete($song->image_path);
        }
        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Bài hát đã được xóa thành công.');
    }
}