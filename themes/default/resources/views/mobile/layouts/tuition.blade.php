@if(isset($tuitions->description) && count($tuitions->description) > 0)
<section id="tuition" class="mt-30">
    <div class="container">
        <h2 class="section-title tuition-title">{{  $study_abroad->tuition_title ?? 'Học phí du học' }}</h2>
        <div class="tuition w-100 flex">
            <div class="tuition-thumnail">
                @include('Default::general.components.image', [
                    'src' => resizeWImage($study_abroad->tuition_image, 'w400'),
                    'width' => '400px',
                    'height' => '200px',
                    'lazy'   => true,
                    'title'  =>  getAlt($study_abroad->tuition_image ?? '')
                ])
            </div>
            <div class="tuition-list">
                @foreach($tuitions->description as $key =>$description)
                    <div class="tuition-item flex-center mb-15">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#ff2b80"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                        <p class="fs-14 lh-18 f-w-b"><span>{{ $description ?? '' }}</span></p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
