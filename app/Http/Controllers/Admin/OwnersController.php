<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Throwable;

class OwnersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $owners = Owner::select('id', 'name', 'email', 'created_at')->paginate(5);
        return Inertia::render('Admin/Owner/Index', [
            'owners' => $owners,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Owner/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            DB::transaction(function () use ($request) {
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                Shop::create([
                    'owner_id' => $owner->id,
                    'name' => '店名を入力してください',
                    'information' => '',
                    'filename' => '',
                    'is_selling' => true,
                ]);
            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return to_route('admin.owners.index')
            ->with([
                'message' => 'オーナー登録を実施しました。',
                'status' => 'info'
            ]);
    }

    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        return Inertia::render('Admin/Owner/Edit', [
            'owner' => $owner,
        ]);
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password = Hash::make($request->password);
        $owner->save();

        return to_route('admin.owners.index')
            ->with([
                'message' => 'オーナー情報を更新しました。',
                'status' => 'info'
            ]);
    }

    public function destroy($id)
    {
        Owner::findOrFail($id)->delete();

        return to_route('admin.owners.index')
            ->with([
                'message' => 'オーナー情報を削除しました。',
                'status' => 'alert',
            ]);
    }

    public function expiredOwnerIndex()
    {
        $expiredOwners = Owner::onlyTrashed()->paginate(5);
        return Inertia::render('Admin/ExpiredOwners', [
            'expiredOwners' => $expiredOwners,
        ]);
    }

    public function expiredOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
        return to_route('admin.expired-owners.index');
    }
}
