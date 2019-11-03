<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="{{route('faqs.create')}}" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i class="icon-pin-alt"></i></b>{{ __('admin.faq_create_button_label') }}
                </a>
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
            @if($faqs)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('admin.pages_th1') }}</th>
                        <th>{{ __('admin.pages_th2') }}</th>
                        <th>Text</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($faqs as $faq)
                        <tr>
                            <td>{{$faq->id}}</td>
                            <td>{{$faq->localization->title ?? ""}}</td>
                            <td>{!! $faq->localization->text ?? "" !!}</td>

                            <td>
                                <a href="{{route('faqs.edit',['faq'=>$faq->id])}}"
                                   class="btn btn-primary btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('admin.pages_edit_button_label') }}
                                </a>
                                <a data-app-id="{{$faq->id}}" href="{{route('faqs.delete',['faq'=>$faq->id])}}"
                                   class="btn btn-danger btn-labeled btn-labeled-left btn-lg legitRipple" data-toggle="modal" data-target="#confirm_delete_contacts"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('admin.faq_delete_button_label') }}
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    <div style="display:none">
                        <form method="post" id="contact-applications-delete" action="">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    </tbody>
                </table>
                {{ $faqs->links() }}
            @endif
        </div>
    </div>
    <!-- /hover rows -->

</div>
<!-- /content area -->
