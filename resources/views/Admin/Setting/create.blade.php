<!-- Page header -->
<form class="form-validate-jquery" enctype="multipart/form-data" method="post"
      action="{{ route('settings.store') }}">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                    class="icon-pin-alt"></i></b>{{__('admin.settings_form_submit_label')}}</button>
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
                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.settings_form_common_info')}}</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.settings_form_title_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="title" required class="form-control"
                                       value=""
                                       placeholder="{{__('admin.settings_form_title_label')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.settings_form_field_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="field" required class="form-control"
                                       value=""
                                       placeholder="{{__('admin.settings_form_field_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.settings_form_value_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="value" required class="form-control"
                                       value=""
                                       placeholder="{{__('admin.settings_form_value_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.settings_form_type_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="form-control multiselect" name="type" id="" data-fouc>
                                <option selected value="text">Text</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="file">File</option>
                            </select>
                        </div>
                    </div>


                </fieldset>


                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                class="icon-pin-alt"></i></b>{{__('admin.settings_form_submit_label')}}</button>

            </div>
        </div>

    </div>
</form>
