@if(isset($setting_home['should_choose']['title']) && count($setting_home['should_choose']['title']) > 0)
<section id="should-choose">
    <div class="container">
        <h2 class="section-title should-choose-title">{{ isset($setting_home['should_choose_title']) ? $setting_home['should_choose_title'] : 'Vì sao nên chọn du học lê ánh' }}</h2>
        <div class="should-choose-list w-100">
            @foreach($setting_home['should_choose']['title'] as $key => $title)
                @include('Default::mobile.layouts.should-choose_item_home')
            @endforeach
        </div>
    </div>
</section>
@endif
