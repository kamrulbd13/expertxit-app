<div class="row">
    @if($courses->count())
        @foreach($courses as $item)
            <div class="col-md-6 col-lg-6 col-sm-6 m-b30">
                <div class="cours-bx">
                    <div class="action-box">
                        <img src="{{ asset($item->image_path ?? '') }}" class="img-thumbnail rounded" style="height: 250px;" alt=""/>
                        <a href="{{ route('our.courses.details', $item->id) }}" class="btn">Read More</a>
                    </div>
                    <div class="info-bx text-center" style="height: 100px;">
                        <h5>
                            <a href="{{ route('our.courses.details', $item->id) }}">
                                {{ $item->training_name ?? 'Not found data' }}
                            </a>
                        </h5>
                        <span>{{ $item->trainingCategory->training_category ?? '' }}</span>
                    </div>
                    <div class="cours-more-info">
                        <div class="review">
                            <span>Teacher Type</span>
                            <ul class="cours-star">
                                <li class="active">{{ $item->trainerType->trainer_type ?? '' }}</li>
                            </ul>
                        </div>
                        <div class="price">
                            <del>Tk.{{ $item->regular_fees ?? '' }}</del>
                            <h5>Tk.{{ $item->current_fees ?? '' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <span class="text-center d-flex justify-content-center">
                <b class="text-danger">Oops! </b> &nbsp
                No courses matched your search.Please refine your search.
            </span>
        </div>
    @endif
</div>
