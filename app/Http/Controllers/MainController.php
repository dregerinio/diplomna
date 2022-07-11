<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use Auth;

class MainController extends Controller
{
  public function getLeagues()
  {
    return view('main.leagues');
  }

  public function getTeams(Request $request)
  {
    $leagueId = $request->get('league_id');
    $season = $request->get('season');
    $favorites = Auth::user() ? Auth::user()->favorites()->get() : [];
    $response = ApiHelper::getTeams($leagueId, 2021);

    $response = $response->response;

    return view('main.teams', ['teams' => $response, 'leagueId' => $leagueId, 'season' => $season, 'favorites' => $favorites]);
  }

  public function favorites(Request $request)
  {
    $favorites = Auth::user() ? Auth::user()->favorites()->get() : [];
    return view('main.favorites', compact('favorites'));
  }

  public function handleFavorites(Request $request)
  {
    $teamId = $request->post("team_id");
    $leagueId = $request->post("league_id");

    $name = $request->post("name");
    $img = $request->post("img");
    $code = $request->post("code");
    $temp = Auth::user()->favorites()
      ->where('team_id', '=', $teamId)
      ->where('league_id', '=', $leagueId)
      ->first();

    if (!$temp) {
      $favorite = new Favorite();

      $favorite->team_id = $teamId;
      $favorite->name = $name;
      $favorite->image = $img;
      $favorite->code = $code;
      $favorite->league_id = $leagueId;
      $favorite->user_id = Auth::user()->id;

      $favorite->save();

      return response()->json(['message' => 'saved'], 200);
    } else {
      $temp->delete();
      return response()->json(['message' => 'deleted'], 200);
    }
  }

  public function getTeamInfo(Request $request)
  {
    $teamId = $request->get('team_id');
    $season = $request->get('season');
    $leagueId = $request->get('league_id');
    $statistics = ApiHelper::getTeamInfo($teamId, $leagueId, $season);
    $statistics = $statistics->response;
    $players = ApiHelper::getPlayers($teamId, $leagueId, $season);
    $totalPages = $players->paging->total;
    $players = $players->response;

    for ($page = 1; $page <= $totalPages; $page++) {
      $temp =  ApiHelper::getPlayers($teamId, $leagueId, $season, $page);
      foreach ($temp->response as $result) {
        $players[] = $result;
      }
    }

    return view('main.teamInfo', compact('statistics', 'players', 'season', 'teamId', 'leagueId'));
  }
}
