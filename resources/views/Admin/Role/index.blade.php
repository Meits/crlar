<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="{{route('roles.create')}}"
                   class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                class="icon-pin-alt"></i></b>{{ __('admin.roles_create_button_label') }}</a>
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
            @if($roles)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('admin.roles_th1') }}</th>
                        <th>{{ __('admin.roles_th2') }}</th>
                        <th>{{ __('admin.roles_th3') }}</th>
                        <th>{{ __('admin.roles_th4') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->title}}</td>
                            <td>{{$role->alias}}</td>
                            <td>
                                <a href="{{route('roles.edit',['role'=>$role->id])}}"
                                   class="btn btn-primary btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('admin.roles_edit_button_label') }}
                                </a>

                                <a data-app-id="{{$role->id}}" href="{{route('roles.delete',['role'=>$role->id])}}"
                                   class="btn btn-danger btn-labeled btn-labeled-left btn-lg legitRipple"
                                   data-toggle="modal" data-target="#confirm_delete_contacts"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('admin.roles_delete_button_label') }}
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
            @endif
        </div>
    </div>
    <!-- /hover rows -->

</div>
<!-- /content area -->
