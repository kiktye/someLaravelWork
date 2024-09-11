<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $players = Player::all();
        return view("teams.create", compact("players"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teamAttributes = $request->validate([
            'name' => ['required', 'max:255'],
            'year_founded' => ['required', 'digits:4']
        ]);

        Team::create([
            'name' => $teamAttributes['name'],
            'year_founded' => $teamAttributes['year_founded'],
        ]);

        return redirect()->route('teams.index')->with('success', 'Team Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Team::with('players', 'matchesAsTeamHome', 'matchesAsTeamAway')->find($id);

        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = Team::find($id);
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $teamAttributes = $request->validate([
            'name' => ['required', 'max:255'],
            'year_founded' => ['required', 'digits:4']
        ]);

        $team->update([
            'name' => $teamAttributes['name'],
            'year_founded' => $teamAttributes['year_founded'],
        ]);

        return redirect()->route('teams.index')->with('success', 'Team Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::find($id);
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}
