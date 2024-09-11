<?php

namespace App\Http\Controllers;

use App\Models\Duel;
use App\Models\MatchModel;
use App\Models\Team;
use Illuminate\Http\Request;

class DuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matches = Duel::with('teamHome', 'teamAway')->get();
        return view('matches.index', ['matches' => $matches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        return view('matches.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'is_played' => $request->boolean('is_played', false)
        ]);

        $matchAttributes = $request->validate([
            'team_home_id' => ['required', 'exists:teams,id'],
            'team_away_id' => ['required', 'exists:teams,id'],
            'is_played' => ['boolean'],
            'match_date' => ['required', 'date_format:Y-m-d\TH:i'],
            'team_home_score' => ['nullable', 'integer'],
            'team_away_score' => ['nullable', 'integer'],

        ]);

        Duel::create([
            'team_home_id' => $matchAttributes['team_home_id'],
            'team_away_id' => $matchAttributes['team_away_id'],
            'is_played' => $matchAttributes['is_played'],
            'match_date' => $matchAttributes['match_date'],
            'team_home_score' => $matchAttributes['team_home_score'],
            'team_away_score' => $matchAttributes['team_away_score'],
        ]);

        return redirect()->route('matches.index')->with('success', 'Match created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $match = Duel::with('teamHome', 'teamAway')->find($id);
        return view('matches.show', compact('match'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $match = Duel::findOrFail($id);
        $teams = Team::all();
        return view('matches.edit', compact('match', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Duel $match)
    {
        $request->merge([
            'is_played' => $request->boolean('is_played', false)
        ]);

        $matchAttributes = $request->validate([
            'team_home_id' => ['required', 'exists:teams,id'],
            'team_away_id' => ['required', 'exists:teams,id'],
            'is_played' => ['boolean'],
            'match_date' => ['required', 'date_format:Y-m-d\TH:i'],
        ]);

        $match->update([
            'team_home_id' => $matchAttributes['team_home_id'],
            'team_away_id' => $matchAttributes['team_away_id'],
            'is_played' => $matchAttributes['is_played'],
            'match_date' => $matchAttributes['match_date'],
            'team_home_score' => $request->input('team_home_score'),
            'team_away_score' => $request->input('team_away_score'),
        ]);

        return redirect()->route('matches.index')->with('success', 'Match updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $match = Duel::find($id);
        $match->delete();

        return redirect()->route('matches.index')->with('success', 'Match deleted successfully.');
    }
}
