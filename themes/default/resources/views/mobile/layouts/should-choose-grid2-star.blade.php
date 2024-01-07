@if(isset($setting_home['should_choose_grid2_star']['title']) && count($setting_home['should_choose_grid2_star']['title']) > 0)
<section id="should-choose" class="should_choose_grid2_star">
    <div class="container">
        <h2 class="section-title should-choose-title">{{ isset($setting_home['should_choose_grid2_star_title']) ? $setting_home['should_choose_grid2_star_title'] : 'Vì sao nên chọn du học lê ánh' }}</h2>
        <div class="should-choose-list col-gird-6 w-100">
            @foreach($setting_home['should_choose_grid2_star']['title'] as $key => $title)
                @include('Default::web.layouts.should-choose_item_grid2-star')
            @endforeach
        </div>
    </div>
</section>
@endif
