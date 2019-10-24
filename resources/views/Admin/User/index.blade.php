<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="{{route('users.create')}}"
                   class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                class="icon-pin-alt"></i></b>{{ __('admin.users_create_button_label') }}</a>
            </div>

            {{--<div style="margin-left: 10px" class="d-flex justify-content-center">
                <a href="{{route('admin-export',['model'=>'User'])}}"
                   class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                class="icon-pin-alt"></i></b>{{ __('admin.export_button_label') }}</a>
            </div>--}}
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <!-- Hover rows -->
    <div class="card">

        <div class="card-body">
            <form action="{{route('users.index')}}">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <div class="input-group">
                            <input type="text" name="search"  class="form-control"
                                   value="{{$search ?? old('firstname')}}"
                                   placeholder="{{__('admin.users_form_fullname_label')}}">
                        </div>
                    </div>

                    @if($roles)
                        <div class="col-lg-2">
                            <div class="input-group">
                                <select name="role_id" class="form-control multiselect"  data-fouc>
                                    <option  value="">{{__('admin.not_selected')}}</option>
                                    @foreach($roles as $key => $role)
                                        <option
                                                @if($roleId == $role->id)
                                                selected
                                                @endif
                                                value="{{ $role->id }}">{{$role->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-2">
                        <div class="input-group">
                            <select name="is_moderate" class="form-control multiselect" data-fouc>
                                <option  value="">{{__('admin.not_selected')}}</option>
                                <option @if($isModerate == '1') selected @endif value="1">{{__('admin.users_form_moderate')}}</option>
                                <option @if($isModerate == '0') selected @endif value="0">{{__('admin.users_form_not_moderate')}}</option>
                            </select>
                        </div>
                    </div>
                    @if($statuses)
                        <div class="col-lg-2">
                            <div class="input-group">
                                <select name="status" class="form-control multiselect" data-fouc>
                                    <option value="">{{__('admin.not_selected')}}</option>
                                    @foreach($statuses as $key => $status)
                                        <option @if($key == $isStatus) selected
                                                @endif value="{{$key}}">{{__('admin.users_form_'.$status)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif


                    <div class="col-lg-2">
                        <div class="input-group">
                            <button type="submit"
                                    class="btn bg-transparent border-teal text-teal border-2 btn-icon mr-3"><b><i
                                            class="icon-search4"></i></b></button>
                            <button data-url="{{route('users.index')}}" id="users_page_search_clear"
                                    class="btn  bg-transparent border-teal text-teal border-2 btn-icon mr-3 "><b><i
                                            class="icon-zoomout3"></i></b></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            @if($users)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('admin.users_th1') }}</th>
                        <th>{{ __('admin.users_th2') }}</th>
                        <th>{{ __('admin.users_th3') }}</th>
                        <th>{{ __('admin.users_th4') }}</th>
                        <th>{{ __('admin.users_th5') }}</th>
                        <th>{{ __('admin.users_th6') }}</th>
                        <th>{{ __('admin.users_th7') }}</th>
                        <th>{{ __('admin.users_th8') }}</th>
                        <th>{{ __('admin.users_th9') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $k => $user)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$user->firstname}}</td>
                            <td>{{$user->lastname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{ $user->roles->implode('title', ', ') }}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$statuses[$user->status]}}</td>
                            <td>{{$moderate[$user->is_moderate] ?? ""}}</td>
                            <td>
                                <a href="{{route('users.edit',['user'=>$user->id])}}"
                                   class="btn btn-primary btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('admin.users_edit_button_label') }}
                                </a>

                                <a data-app-id="{{$user->id}}" href="{{route('users.delete',['user'=>$user->id])}}"
                                   class="btn btn-danger btn-labeled btn-labeled-left btn-lg legitRipple"
                                   data-toggle="modal" data-target="#confirm_delete_contacts"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('admin.users_delete_button_label') }}
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
            {{ $users->links() }}
            <br/>
        </div>
    </div>
    <!-- /hover rows -->

</div>
<!-- /content area -->
