@extends("layouts.layout")

@section("content")
<div class="row">
    <div class="col-4 offset-4">
        <div class="row season-select-holder" style="margin: 0px 70px;">
            <div class="col-6 text-right" style="font-size: 20px; font-weight: bold;">
                <p>Season</p>
            </div>
            <div class="col-6 select-col" style="padding-left: 0px;">
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
    </div>
</div>
<div class="row">
    @foreach ($teams as $team)
    <div class="col-4">
        <div class="team-card" id="team-{{ $team->team->id }}">
            <a href="/team?team_id={{ $team->team->id }}&league_id={{ $leagueId }}&season=2021">
                <div class="team-title text-center">
                    {{ $team->team->name }}
                </div>
                <div class="team-logo text-center">
                    <img src="{{ $team->team->logo }}" alt="">
                </div>
                <div class="team-footer text-center">
                    <div class="row">
                        <div class="col-4 offset-4">
                            <span>{{ $team->team->code }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @auth
            <div class="row text-center favorite-marker">
                <?php
                    $marked = false;
                    foreach($favorites as $favorite){
                        if($favorite->league_id == $leagueId && $favorite->team_id == $team->team->id){
                            $marked = true;
                            break;
                        }
                    }
                ?>
                <a href="#" onclick="handleFavorite({{ $team->team->id }})">Favorite: <?php if($marked) echo '<span style="color: Green; font-weight: bold;">Yes</span>'; else echo '<span style="color: red; font-weight: bold;">No</span>';?></a>
            </div>
            @endauth
        </div>
    </div>
    @endforeach
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function handleSeasonChange() {
        $("#season-select option:selected").val()
        window.location.href = "/teams?league_id={{ $leagueId }}&season=" + $("#season-select option:selected").val();
    }

    function handleFavorite(team_id) {
        name = $("#team-" + team_id + " .team-title").html().trim();
        img = $("#team-" + team_id + " img").attr('src');
        code = $("#team-" + team_id + " .team-footer span").html().trim();
        league_id = {{ $leagueId }};
        
        $.ajax({
            url: "/handleFavorites",
            method: "POST",
            data: {
                "team_id": team_id,
                "name": name,
                "img": img,
                "code": code,
                "league_id": league_id,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data){
                console.log(data.message);
                if(data.message == 'saved'){
                    $("#team-" + team_id + " .favorite-marker").html(`<a href="#" onclick="handleFavorite(`+ team_id +`)">Favorite: <span style="color: green; font-weight: bold;">Yes</span></a>`);
                } else if(data.message == 'deleted'){
                    $("#team-" + team_id + " .favorite-marker").html(`<a href="#" onclick="handleFavorite(`+ team_id +`)">Favorite: <span style="color: red; font-weight: bold;">No</span></a>`);
                }
            }
        });
    }
</script>
@endsection