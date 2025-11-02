<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserBlacklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BlacklistController extends Controller
{
    /**
     * Display a listing of blacklisted users.
     */
    public function index()
    {
        // Auto deactivate expired blacklists
        UserBlacklist::deactivateExpired();

        $blacklists = UserBlacklist::with(['user', 'blacklistedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.blacklist.index', compact('blacklists'));
    }

    /**
     * Show the form for creating a new blacklist.
     */
    public function create()
    {
        $users = User::where('role', '!=', 'admin')
            ->whereDoesntHave('activeBlacklist')
            ->orderBy('name')
            ->get();

        return view('admin.blacklist.create', compact('users'));
    }

    /**
     * Store a newly created blacklist in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'reason' => 'required|string|max:1000',
            'duration_days' => 'required|integer|min:1|max:365',
        ]);

        // Check if user already blacklisted
        $user = User::findOrFail($validated['user_id']);
        if ($user->isBlacklisted()) {
            return back()->withErrors(['user_id' => 'User ini sudah dalam daftar blacklist.']);
        }

        // Check if trying to blacklist admin
        if ($user->role === 'admin') {
            return back()->withErrors(['user_id' => 'Tidak dapat mem-blacklist admin.']);
        }

        $now = Carbon::now();
        $expiresAt = $now->copy()->addDays((int) $validated['duration_days']);

        UserBlacklist::create([
            'user_id' => $validated['user_id'],
            'reason' => $validated['reason'],
            'blacklisted_at' => $now,
            'expires_at' => $expiresAt,
            'is_active' => true,
            'blacklisted_by' => Auth::id(),
        ]);

        return redirect()->route('admin.blacklist.index')
            ->with('success', 'User berhasil di-blacklist untuk ' . $validated['duration_days'] . ' hari.');
    }

    /**
     * Show the form for editing the specified blacklist.
     */
    public function edit(UserBlacklist $blacklist)
    {
        return view('admin.blacklist.edit', compact('blacklist'));
    }

    /**
     * Update the specified blacklist in storage.
     */
    public function update(Request $request, UserBlacklist $blacklist)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:1000',
            'duration_days' => 'required|integer|min:1|max:365',
        ]);

        $now = Carbon::now();
        $expiresAt = $now->copy()->addDays((int) $validated['duration_days']);

        $blacklist->update([
            'reason' => $validated['reason'],
            'expires_at' => $expiresAt,
        ]);

        return redirect()->route('admin.blacklist.index')
            ->with('success', 'Blacklist berhasil diperbarui.');
    }

    /**
     * Remove the specified blacklist from storage (Deactivate).
     */
    public function destroy(UserBlacklist $blacklist)
    {
        $blacklist->update(['is_active' => false]);

        return redirect()->route('admin.blacklist.index')
            ->with('success', 'Blacklist berhasil dihapus.');
    }

    /**
     * Reactivate blacklist
     */
    public function reactivate(UserBlacklist $blacklist)
    {
        if ($blacklist->isExpired()) {
            return back()->withErrors(['error' => 'Tidak dapat mengaktifkan blacklist yang sudah expired.']);
        }

        $blacklist->update(['is_active' => true]);

        return redirect()->route('admin.blacklist.index')
            ->with('success', 'Blacklist berhasil diaktifkan kembali.');
    }
}