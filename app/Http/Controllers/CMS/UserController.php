<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use App\Notifications\UserActionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('cms.pages.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('cms.pages.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        if ($request->has('roles')) {
            $roles = Role::whereIn('id', $request->roles)->get();
            $user->syncRoles($roles);
        }

        // Logging
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'details' => 'Created user: '.$user->name,
        ]);

        Auth::user()->notify(new UserActionNotification('updated', 'Updated user: '.$user->name));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Logging
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'details' => 'Deleted user: '.$user->name,
        ]);

        Auth::user()->notify(new UserActionNotification('deleted', 'Deleted user: '.$user->name));

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
