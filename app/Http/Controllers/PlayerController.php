<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::with('team')->get();
        return view('players.index', ['players' => $players]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        return view('players.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $playerAttributes = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'birth_date' => ['date_format:Y-m-d', 'before:today'],
            'team_id' => ['required', 'exists:teams,id'],
        ]);

        Player::create([
            'first_name' => $playerAttributes['first_name'],
            'last_name' => $playerAttributes['last_name'],
            'birth_date' => $playerAttributes['birth_date'],
            'team_id' => $playerAttributes['team_id'],
        ]);

        return redirect()->route('players.index')->with('success', 'Player created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $player = Player::with('team.matchesAsTeamHome', 'team.matchesAsTeamAway')->find($id);

        return view('players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $player = Player::find($id);
        $teams = Team::all();
        return view('players.edit', compact('player', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        $playerAttributes = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'birth_date' => ['date_format:Y-m-d', 'before:today'],
            'team_id' => ['required', 'exists:teams,id'],
        ]);


        $player->update([
            'first_name' => $playerAttributes['first_name'],
            'last_name' => $playerAttributes['last_name'],
            'birth_date' => $playerAttributes['birth_date'],
            'team_id' => $playerAttributes['team_id'],
        ]);

        return redirect()->route('players.index')->with('success','Player edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted successfully.');
    }
}
