<!-- Page header -->
<form class="form-validate-jquery" enctype="multipart/form-data" method="post"
      action="{{ route('roles.store') }}">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                    class="icon-pin-alt"></i></b>{{__('admin.roles_form_submit_label')}}</button>
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
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.roles_form_common_info')}}</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.roles_form_title_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="title" required class="form-control"
                                       value="{{old('title')}}"
                                       placeholder="{{__('admin.roles_form_title_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.roles_form_alias_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input  type="text" name="alias" class="form-control"
                                        value="{{old('alias')}}"
                                        placeholder="{{__('admin.roles_form_alias_label')}}">
                            </div>
                        </div>
                    </div>


                </fieldset>
                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                class="icon-pin-alt"></i></b>{{__('admin.roles_form_submit_label')}}</button>


            </div>
        </div>
        <!-- /input group addons -->

    </div>
</form>
<!-- /content area -->
