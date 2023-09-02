<section id="wsus__large_banner">
    <div class="container">
        <div class="row">
            <div class="cl-xl-12">
                @if ($homepage_secion_banner_four->banner_one->status == 1)

                <a href="{{$homepage_secion_banner_four->banner_one->banner_url}}">
                    <img class="img-gluid" src="{{asset($homepage_secion_banner_four->banner_one->banner_image)}}" alt="">
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
