<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageFeature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomepageFeatureController extends Controller
{
    public function index(): View
    {
        return view('admin.good-stuff.index', [
            'features' => HomepageFeature::query()->orderBy('id')->get(),
        ]);
    }

    public function update(Request $request, HomepageFeature $feature): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'image.uploaded' => 'The picture could not be uploaded. Please choose a JPG, PNG, or WebP file smaller than 5 MB.',
        ]);

        $oldImage = $feature->image_path;
        $newImage = $validated['image']->store('good-stuff', 'public');

        $feature->update(['image_path' => $newImage]);

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return back()->with('status', "{$feature->title} picture updated.");
    }

    public function reset(HomepageFeature $feature): RedirectResponse
    {
        if ($feature->image_path) {
            Storage::disk('public')->delete($feature->image_path);
        }

        $feature->update(['image_path' => null]);

        return back()->with('status', "{$feature->title} restored to its original picture.");
    }
}
