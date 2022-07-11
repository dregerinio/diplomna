<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiHelper
{
    private const apiUrl = "https://v3.football.api-sports.io/";

    public static function getTeams($leagueId, $season)
    {
        $response = Http::withoutVerifying()
            ->withHeaders([
                'x-rapidapi-key' => env("FOOTBAL_API_KEY")
            ])
            ->get(self::apiUrl . 'teams/?league=' . $leagueId . '&season=' . $season);

        return json_decode($response->body());
    }

    public static function getTeamInfo($teamId, $leagueId, $season)
    {
        $response = Http::withoutVerifying()
            ->withHeaders([
                'x-rapidapi-key' => env("FOOTBAL_API_KEY")
            ])
            ->get(self::apiUrl . 'teams/statistics/?team=' . $teamId . '&league=' . $leagueId . '&season=' . $season);

        return json_decode($response->body());
    }

    public static function getPlayers($teamId, $leagueId, $season, $page = 1)
    {
        $response = Http::withoutVerifying()
            ->withHeaders([
                'x-rapidapi-key' => env("FOOTBAL_API_KEY")
            ])
            ->get(self::apiUrl . 'players/?team=' . $teamId . '&league=' . $leagueId . '&season=' . $season . '&page=' . $page);

        return json_decode($response->body());
    }
}
