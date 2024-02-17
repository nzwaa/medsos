<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\Feed;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = Feed::orderBy('created_at', 'desc')->paginate(2); 
        return view('feed.index', compact('feeds'));
    }

    public function create()
    {
        return view('feed.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/mpeg,video/quicktime', 'max:10240'],
            'caption' => ['nullable', 'string', 'max:100'], 
        ], [
            'caption.max' => 'Caption tidak boleh lebih dari 100 karakter.'
        ]);

        $feed = new Feed();
        $feed->created_by = auth()->id(); 
        $feed->video = $request->file('video')->store('feeds'); 
        $feed->caption = $request->caption;
        $feed->save();

        return redirect()->route('feed.index')->with('success', 'Feed berhasil disimpan!');
    }

    public function destroy($id)
    {
        $feed = Feed::findOrFail($id);

        if ($feed->video) {
            Storage::delete($feed->video);
        }

        if ($feed->delete()) {
            return redirect()->route('feed.index')->with('success', 'Feed berhasil dihapus!');
        }

        return redirect()->route('feed.index')->with('error', 'Gagal menghapus feed.');
    }
}