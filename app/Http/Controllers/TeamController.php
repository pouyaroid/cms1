<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    
    public function index()
    {
        $teamMembers = TeamMember::latest()->get();
        return view('sections.team', compact('teamMembers'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('team', 'public');
        }

        TeamMember::create([
            'name'  => $request->name,
            'role'  => $request->role,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'عضو جدید با موفقیت اضافه شد.');
    }

 
    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($teamMember->image && Storage::disk('public')->exists($teamMember->image)) {
                Storage::disk('public')->delete($teamMember->image);
            }
            $teamMember->image = $request->file('image')->store('team', 'public');
        }

        $teamMember->update([
            'name'  => $request->name,
            'role'  => $request->role,
            'image' => $teamMember->image,
        ]);

        return redirect()->back()->with('success', 'اطلاعات عضو تیم با موفقیت ویرایش شد.');
    }

    
    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->image && Storage::disk('public')->exists($teamMember->image)) {
            Storage::disk('public')->delete($teamMember->image);
        }

        $teamMember->delete();

        return redirect()->back()->with('success', 'عضو تیم با موفقیت حذف شد.');
    }
    public function create()
{
    
    $teamMembers = TeamMember::latest()->get();
    return view('admin.team.create', compact('teamMembers'));
}

}
