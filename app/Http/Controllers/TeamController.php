<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Team::where('visible', 1)
                        ->orderBy('position', 'asc')
                        ->get();
        return view('panel.company.team', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.company.team.create');
    }

    /**
     * Checking for assets
     */
    public function assetsChecker($entry, $request)
    {
        // Checking for sample
        if($request->hasFile('image')){

            // Deleting existing image
            Storage::delete($entry->image);
            Storage::delete($entry->image_medium);
            Storage::delete($entry->image_small);

            // Thumbnail Maker
            $dimension = [
                'medium' => [
                    'width' => 320,
                    'height' => 180,
                ],
                'small' => [
                    'width' => 240,
                    'height' => 135,
                ]
            ];
            $path = "team";
            $thumbnail = Thumbnail::make($request->image, $dimension, $path);

            // Updating Image Paths
            $entry->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        $request->validate([
            "visible" => 'required',
            "name" => 'required',
            "designation" => 'required',
            "facebook" => '',
            "twitter" => '',
            "linkedin" => '',
            "image" => 'required',
            "support_text" => '',
          ]);
    
          $team = Team::create([
            "visible" => $request->visible,
            "expert" => $request->expert,
            "expert_in" => $request->expert_in,
            "name" => $request->name,
            "designation" => $request->designation,
            "overview" => $request->overview,
            "email" => $request->email,
            "phone" => $request->phone,
            "facebook" => $request->facebook,
            "twitter" => $request->twitter,
            "linkedin" => $request->linkedin,
            "support" => $request->support,
            "contact" => $request->contact,
            "contact_url" => $request->contact_url,
            "support_text" => $request->support_text,
            "button_text" => $request->button_text,
            "created_by" => auth()->id(),
            "created_at" => now()
          ]);

          // Assets checker
          $this->assetsChecker($team, $request);
    
          return back()->with('success', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('dashboard.company.team.show', ['team' => $team]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('dashboard.company.team.edit', ['team' => $team]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamRequest  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update([
            "visible" => $request->visible,
            "expert" => $request->expert,
            "expert_in" => $request->expert_in,
            "name" => $request->name,
            "designation" => $request->designation,
            "overview" => $request->overview,
            "email" => $request->email,
            "phone" => $request->phone,
            "facebook" => $request->facebook,
            "twitter" => $request->twitter,
            "linkedin" => $request->linkedin,
            "support" => $request->support,
            "contact" => $request->contact,
            "contact_url" => $request->contact_url,
            "support_text" => $request->support_text,
            "button_text" => $request->button_text,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($team, $request);

        return back()->with('success', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        Storage::delete($team->image);
        Storage::delete($team->image_medium);
        Storage::delete($team->image_small);

        $team->delete();

        return back()->with('success', 'Deleted!');
    }
}
