<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="{{route('pages.create')}}"
                   class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                class="icon-pin-alt"></i></b>{{ __('admin.pages_create_button_label') }}</a>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <!-- Hover rows -->
    <div class="card">
        <div class="table-responsive">
            @if($pages)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('admin.pages_th1') }}</th>
                        <th>{{ __('admin.pages_th2') }}</th>
                        <th>{{ __('admin.pages_th3') }}</th>
                        <th>{{ __('admin.pages_th4') }}</th>
                        <th>{{ __('admin.pages_th5') }}</th>
                        <th>{{ __('admin.pages_th6') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->localization->title ?? ""}}</td>
                            <td>{{$page->localization->titleH1 ?? ""}}</td>
                            <td>{{$page->localization->description ?? ""}}</td>
                            <td>{{$page->alias}}</td>
                            <td>
                                <a href="{{route('pages.edit',['page'=>$page->id])}}"
                                   class="btn btn-primary btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('admin.pages_edit_button_label') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- /hover rows -->

</div>
<!-- /content area -->
