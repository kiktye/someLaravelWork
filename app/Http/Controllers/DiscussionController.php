<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discussions = Discussion::where('approved', true)->get();
        return view('discussions.index', ['discussions' => $discussions]);
    }

    /**
     * Display unapproved by admin.
     */

    public function unapproved()
    {
        $discussions = Discussion::where('approved', false)->get();
        return view('discussions.unapproved', ['discussions' => $discussions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('discussions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $discussionAttributes = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', File::types(['png', 'jpg', 'webp'])],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);


        $photoPath = $request->image->store('discussions', 'public');

        Discussion::create([
            'title' => $discussionAttributes['title'],
            'image' => $photoPath,
            'description' => $discussionAttributes['description'],
            'category_id' => $discussionAttributes['category_id'],
            'user_id' => Auth::user()->id
        ]);


        return redirect()->route('discussions.index')->with('approval', 'Discussion created and awaiting approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {
        $discussion = Discussion::findOrFail($discussion->id);
        return view('discussions.show', ['discussion' => $discussion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion)
    {
        $discussion = Discussion::findOrFail($discussion->id);
        $categories = Category::all();
        return view('discussions.edit', compact('discussion', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion)
    {
        $discussionAttributes = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', File::types(['png', 'jpg', 'webp'])],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        if ($request->hasFile('image')) {
            if ($discussion->image) {
                Storage::disk('public')->delete($discussion->image);
            }

            
            $discussionAttributes['image'] = $request->image->store('discussions', 'public');
        } else {
            // keeping the old image if new image is not uploaded
            $discussionAttributes['image'] = $discussion->image;
        }

        $discussion->update([
            'title' => $discussionAttributes['title'],
            'image' => $discussionAttributes['image'],
            'description' => $discussionAttributes['description'],
            'category_id' => $discussionAttributes['category_id'],
        ]);

        return redirect()->route('discussions.index')->with('status', 'Discussion updated successfully.');
    }


    /**
     * Admin to approve discussions.
     */
    public function approve(Discussion $discussion)
    {

        $discussion = Discussion::findOrFail($discussion->id);

        $discussion->approved = true;
        $discussion->save();

        return redirect()->back()->with('success', 'Discussion approved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        $discussion = Discussion::findOrFail($discussion->id);

        if ($discussion->image) {
            Storage::delete($discussion->image);
        }

        $discussion->delete();

        return redirect()->route('discussions.index')->with('deletion', 'Discussion deleted.');
    }
}
