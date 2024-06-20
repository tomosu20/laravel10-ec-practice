<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use App\Models\Image;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('image');
            if (!is_null($id)) {
                $imagesOwnerId = Image::findOrFail($id)->owner->id;
                $imageId = (int)$imagesOwnerId;
                if ($imageId !== Auth::id()) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        $images = Image::where('owner_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->paginate(20);
        return Inertia::render('Owner/Image/Index', [
            'images' => $images,
        ]);
    }

    public function create()
    {
        return Inertia::render('Owner/Image/Create');
    }

    public function store(UploadImageRequest $request)
    {
        $imageFiles = $request->file('files');
        if (!is_null($imageFiles)) {
            foreach ($imageFiles as $index => $imageFile) {
                $fileNameToStore = ImageService::upload($imageFile, 'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore,
                    'title' => $request->titles[$index]
                ]);
            }
        }
        return to_route('owner.images.index')
            ->with([
                'message' => '画像登録を実施しました。',
                'status' => 'info',
            ]);
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return Inertia::render('Owner/Image/Edit', [
            'image' => $image,
        ]);
    }

    public function update(UploadImageRequest $request, $id)
    {
        $request->validate([
            'title' => 'string|max:50',
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->title;

        $image->save();

        return to_route('owner.images.index')
            ->with([
                'message' => '画像情報を更新しました。',
                'status' => 'info',
            ]);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        $imageInProducts = Product::where('image1', $image->id)
            ->orWhere('image2', $image->id)
            ->orWhere('image3', $image->id)
            ->orWhere('image4', $image->id)
            ->get();

        if ($imageInProducts) {
            $imageInProducts->each(function ($product) use ($image) {
                if ($product->image1 === $image->id) {
                    $product->image1 = null;
                    $product->save();
                }
                if ($product->image2 === $image->id) {
                    $product->image2 = null;
                    $product->save();
                }
                if ($product->image3 === $image->id) {
                    $product->image3 = null;
                    $product->save();
                }
                if ($product->image4 === $image->id) {
                    $product->image4 = null;
                    $product->save();
                }
            });
        }

        $filePath = 'public/products/' . $image->filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }


        $image->delete();

        return to_route('owner.images.index')
            ->with([
                'message' => '画像を削除しました。',
                'status' => 'alert',
            ]);
    }
}
