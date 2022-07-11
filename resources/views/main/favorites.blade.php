@extends("layouts.layout")

@section("content")
<div class="row">
    @foreach ($favorites as $team)
    <div class="col-4">
        <div class="team-card" id="team-{{ $team->team_id }}">
            <a href="/team?team_id={{ $team->team_id }}&league_id={{ $team->league_id }}&season=2021">
                <div class="team-title text-center">
                    {{ $team->name }}
                </div>
                <div class="team-logo text-center">
                    <img src="{{ $team->image }}" alt="">
                </div>
                <div class="team-footer text-center">
                    <div class="row">
                        <div class="col-4 offset-4">
                            <span>{{ $team->code }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection