@if(isset($schools) && count($schools) > 0)
@foreach ($schools as $school)
<div class="school-list__item flex">
    <div class="thumbnail">
        @include('Default::general.components.image', [
            'src' => resizeWImage($school->image, 'w400'),
            'width' => '380px',
            'height' => '150px',
            'lazy'   => true,
            'title'  =>  getAlt($school->image ?? '')
        ])
        <span class="label text-up color_white">{{ $school->label ?? ''  }}</span>
    </div>
    <div class="content">
        <h3 class="content-title fs-16"> {!! $school->name ?? '' !!}</h3>
        <div class="content-fitler {{ $school->link_detail ? 'mb-40' : '' }}">
            @php
                $usedFilters = [];
            @endphp
            @foreach ($school->filters as $school_filter)
                @if ($school_filter->filterDetail)
                    @php
                        $filter = $school_filter->filterDetail->filter;
                    @endphp
                    @if (!in_array($filter->id, $usedFilters))
                        @php
                            $usedFilters[] = $filter->id;
                        @endphp
                        <br>
                        <span class="color_black">{{ $filter->name }}:</span>
                    @endif
                    <span class="color_blue fw-600">{{ $school_filter->filterDetail->name }}, </span>
                @endif
            @endforeach
        </div>
        @if ($school->link_detail)
        <a href="{{ $school->link_detail ?? '' }}" target="_blank" class="btn btn-primary post-item__see" aria-label="Xem Thông tin" title="Xem thông tin"  rel= "nofollow">
            Xem thông tin
            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" height="12px" viewBox="0 0 320 512"><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
        </a>
        @endif
    </div>
</div>
@endforeach
@else
    <p style="color: red;font-style: italic;padding: 20px 0;">Không tìm thấy trường phù hợp!</p>
@endif
