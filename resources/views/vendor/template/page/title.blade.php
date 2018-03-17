@section('page-title')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{{ isset($title) ? $title : '' }}</h4>
            <ol class="breadcrumb">
                @if(isset($section))
                    <li>
                        {{ isset($section) ? $section : '' }}
                    </li>
                @endif
                @if(isset($category))
                    <li class="active">
                        {{ isset($category) ? $category : '' }}
                    </li>
                @endif
                @if(isset($page))
                    <li class="active">
                        {{ isset($page) ? $page : '' }}
                    </li>
                @endif
            </ol>
        </div>
    </div>

@endsection