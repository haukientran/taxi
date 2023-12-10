@if(isset($personnels) && count($personnels) > 0)
<section class="team">
    <div class="container">
        <h2 class="introduce-title fs-38 lh-40 f-w-b mt-20 {{ $class ?? ''}}">{!! $title !!}</h2>
        <div class="team-content mt-30 s-wrap" id="team_world">
            <div class="team-content__list s-content">
                @foreach($personnels as $key => $personnel)
                    @include('Default::web.layouts.member_item')
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
