@extends("layouts.layout")

@section("content")
<div class="row" id="team-info-body">
    <div class="col-4" id="team-players-holder">
        @foreach($players as $player)
        @if($player->statistics[0]->games->appearences > 0)
        <div class="row">
            <div class="col-8 offset-2 player-card" player_id="{{ $player->player->id }}">
                <div class="player-title text-center">
                    {{ $player->player->name }}
                </div>
                <div class="player-picture text-center">
                    <img src="{{ $player->player->photo }}" alt="">
                </div>
                <div class="player-title text-center">
                    {{ $player->statistics[0]->games->position }} - {{ $player->statistics[0]->games->appearences }} Games
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <div class="col-8">
        <div class="row season-select-holder">
            <div class="col-2 offset-4 text-right" style="font-size: 20px; font-weight: bold;">
                <p>Season</p>
            </div>
            <div class="col-2 select-col">
                <select name="season" id="season-select" style="width: 100%;" onchange="handleSeasonChange()">
                    <option value="2021" <?php if ($season == 2021) echo 'selected'; ?>>2021</option>
                    <option value="2020" <?php if ($season == 2020) echo 'selected'; ?>>2020</option>
                    <option value="2019" <?php if ($season == 2019) echo 'selected'; ?>>2019</option>
                    <option value="2018" <?php if ($season == 2018) echo 'selected'; ?>>2018</option>
                    <option value="2017" <?php if ($season == 2017) echo 'selected'; ?>>2017</option>
                    <option value="2016" <?php if ($season == 2016) echo 'selected'; ?>>2016</option>
                    <option value="2015" <?php if ($season == 2015) echo 'selected'; ?>>2015</option>
                    <option value="2014" <?php if ($season == 2014) echo 'selected'; ?>>2014</option>
                    <option value="2013" <?php if ($season == 2013) echo 'selected'; ?>>2013</option>
                    <option value="2012" <?php if ($season == 2012) echo 'selected'; ?>>2012</option>
                    <option value="2011" <?php if ($season == 2011) echo 'selected'; ?>>2011</option>
                    <option value="2010" <?php if ($season == 2010) echo 'selected'; ?>>2010</option>
                </select>
            </div>
        </div>
        <div id="team-stats">
            <div class="row">
                <div class="team-title text-center">
                    {{ $statistics->team->name }} - Season {{ $season }}
                </div>
            </div>
            <div class="col-10 offset-1" id="team-stats-body" style="font-weight: bold;">
                <div class="text-center">
                    Game scores
                </div>
                <div class="row">
                    <div class="col-4 text-center" style="color: green;">
                        <div>
                            Wins
                        </div>
                        <div>
                            {{ $statistics->fixtures->wins->total }}
                        </div>
                    </div>
                    <div class="col-4 text-center" style="color: orange;">
                        <div>
                            Draws
                        </div>
                        <div>
                            {{ $statistics->fixtures->draws->total }}
                        </div>
                    </div>
                    <div class="col-4 text-center" style="color: red;">
                        <div>
                            Loses
                        </div>
                        <div>
                            {{ $statistics->fixtures->loses->total }}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    Goals
                </div>
                <div class="row">
                    <div class="col-4 text-center" style="color: green;">
                        For
                    </div>
                    <div class="col-2 text-center" style="color: green; border-right: 1px solid black">
                        {{ $statistics->goals->for->total->total }}
                    </div>
                    <div class="col-2 text-center" style="color: red;">
                        Against
                    </div>
                    <div class="col-4 text-center" style="color: red;">
                        {{ $statistics->goals->against->total->total }}
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    Cards
                </div>
                <div class="row">
                    <div class="col-4 text-center" style="color: orange;">
                        Yellow
                    </div>
                    <div class="col-2 text-center" style="color: orange; border-right: 1px solid black">
                        <?php
                        $total = 0;
                        $total += $statistics->cards->yellow->{"0-15"}->total;
                        $total += $statistics->cards->yellow->{"16-30"}->total;
                        $total += $statistics->cards->yellow->{"31-45"}->total;
                        $total += $statistics->cards->yellow->{"46-60"}->total;
                        $total += $statistics->cards->yellow->{"61-75"}->total;
                        $total += $statistics->cards->yellow->{"76-90"}->total;
                        $total += $statistics->cards->yellow->{"91-105"}->total;
                        $total += $statistics->cards->yellow->{"106-120"}->total;
                        echo $total;
                        ?>
                    </div>
                    <div class="col-2 text-center" style="color: red;">
                        Red
                    </div>
                    <div class="col-4 text-center" style="color: red;">
                        <?php
                        $total = 0;
                        $total += $statistics->cards->red->{"0-15"}->total;
                        $total += $statistics->cards->red->{"16-30"}->total;
                        $total += $statistics->cards->red->{"31-45"}->total;
                        $total += $statistics->cards->red->{"46-60"}->total;
                        $total += $statistics->cards->red->{"61-75"}->total;
                        $total += $statistics->cards->red->{"76-90"}->total;
                        $total += $statistics->cards->red->{"91-105"}->total;
                        $total += $statistics->cards->red->{"106-120"}->total;
                        echo $total;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        @foreach($players as $player)
        @if($player->statistics[0]->games->appearences > 0)
        <div class="player-stats" id="player-{{ $player->player->id }}-stats">
            <div class="row">
                <div class="player-title text-center">
                    {{ $player->player->name }} - Season {{ $season }} - {{ $player->statistics[0]->games->appearences }} Games
                </div>
            </div>

            <div class="col-10 offset-1 player-stats-body" style="font-weight: bold;">
                <div class="text-center">
                    Shots
                </div>
                <div class="row">
                    <div class="col-4 text-center" style="color: green;">
                        <div>
                            Total
                        </div>
                        <div>
                            {{ $player->statistics[0]->shots->total ?? 0 }}
                        </div>
                    </div>
                    <div class="col-4 text-center" style="color: orange;">
                        <div>
                            On target
                        </div>
                        <div>
                            {{ $player->statistics[0]->shots->on ?? 0 }}
                        </div>
                    </div>
                    <div class="col-4 text-center" style="color: red;">
                        <div>
                            Missed
                        </div>
                        <div>
                            {{ $player->statistics[0]->shots->total ? $player->statistics[0]->shots->total - $player->statistics[0]->shots->on : 0 }}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2 offset-4 text-center">
                        Goals
                    </div>
                    <div class="col-2 text-center">
                        {{ $player->statistics[0]->goals->total ?? 0 }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2 offset-4 text-center">
                        Assists
                    </div>
                    <div class="col-2 text-center">
                        {{ $player->statistics[0]->goals->assists ?? 0 }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2 offset-4 text-center">
                        Passes
                    </div>
                    <div class="col-2 text-center">
                        {{ $player->statistics[0]->passes->total ?? 0 }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2 offset-4 text-center">
                        Tackles
                    </div>
                    <div class="col-2 text-center">
                        {{ $player->statistics[0]->tackles->total ?? 0 }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-2 offset-4 text-center">
                        Fouls
                    </div>
                    <div class="col-2 text-center">
                        {{ $player->statistics[0]->fouls->drawn ?? 0 }}
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    Cards
                </div>
                <div class="row">
                    <div class="col-4 text-center" style="color: orange;">
                        Yellow
                    </div>
                    <div class="col-2 text-center" style="color: orange; border-right: 1px solid black">
                        {{ $player->statistics[0]->cards->yellow ?? 0 }}
                    </div>
                    <div class="col-2 text-center" style="color: red;">
                        Red
                    </div>
                    <div class="col-4 text-center" style="color: red;">
                        {{ $player->statistics[0]->cards->red ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.player-stats').each(function() {
            $(this).hide();
        });
        $('.player-card').each(function() {
            $(this).hover(function() {
                $("#team-stats").hide();
                $('#player-' + $(this).attr('player_id') + '-stats').show();
            }, function() {
                $('#player-' + $(this).attr('player_id') + '-stats').hide();
                $("#team-stats").show();
            })
        })
    });

    function handleSeasonChange() {
        $("#season-select option:selected").val()
        window.location.href = "/team?team_id={{ $teamId }}&league_id={{ $leagueId }}&season=" + $("#season-select option:selected").val();
    }
</script>
@endsection