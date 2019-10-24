<!-- Page header -->
<form class="form-validate-jquery" enctype="multipart/form-data" method="post"
      action="{{ route('users.store') }}">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                    class="icon-pin-alt"></i></b>{{__('admin.users_form_submit_label')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <!-- Input group addons -->
        <div class="card">

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.users_form_common_info')}}</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.users_form_firstname_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="firstname" required class="form-control"
                                       value="{{old('firstname')}}"
                                       placeholder="{{__('admin.users_form_firstname_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.users_form_lastname_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="lastname" required class="form-control"
                                       value="{{old('lastname')}}"
                                       placeholder="{{__('admin.users_form_lastname_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.users_form_email_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="email" required class="form-control"
                                       value="{{old('email')}}"
                                       placeholder="{{__('admin.users_form_email_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.users_form_password_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="password" name="password"  class="form-control" required  placeholder="{{__('admin.users_form_password_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.users_form_password_confirmation_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="password" name="password_confirmation" required  class="form-control"  placeholder="{{__('admin.users_form_password_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.users_form_phone_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="phone" required class="form-control"
                                       value="{{old('phone')}}"
                                       placeholder="{{__('admin.users_form_phone_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.users_form_status_label')}}</label>
                        <div  class="col-lg-10">
                            <select name="status" class="form-control multiselect" data-fouc>
                                <option value="1">{{__('admin.users_form_status_active')}}</option>
                                <option value="2">{{__('admin.users_form_status_inactive')}}</option>
                                <option value="3">{{__('admin.users_form_status_deleted')}}</option>
                            </select>
                        </div>
                    </div>

                    @if($roles)
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('admin.users_form_role_label')}}</label>
                            <div  class="col-lg-10">
                                <select name="role_id[]" class="form-control multiselect" multiple="true" data-fouc>
                                    @foreach($roles as $key => $role)
                                        <option value="{{ $role->id }}">{{$role->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif


                </fieldset>
                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                class="icon-pin-alt"></i></b>{{__('admin.users_form_submit_label')}}</button>


            </div>
        </div>
        <!-- /input group addons -->

    </div>
</form>
<!-- /content area -->
