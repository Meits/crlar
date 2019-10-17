<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <!-- Hover rows -->
    <div class="card">
        <div class="table-responsive">
            @if($emails)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('admin.emails_th1') }}</th>
                        <th>{{ __('admin.emails_th2') }}</th>
                        <th>{{ __('admin.emails_th3') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emails as $email)
                        <tr>
                            <td>{{$email->id}}</td>
                            <td>{{$email->title}}</td>
                            <td>{{$email->type}}</td>
                            <td>
                                <a href="{{route('emails.edit',['email'=>$email->id])}}"
                                   class="btn btn-primary btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('admin.emails_edit_button_label') }}
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
