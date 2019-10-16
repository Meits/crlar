<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>


        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="{{route('settings.create')}}"
                   class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                class="icon-pin-alt"></i></b>{{ __('admin.pages_create_button_label') }}</a>
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
            <form class="form-validate-jquery" enctype="multipart/form-data" method="post"
                  action="{{route('settings.update',['setting'=>'all'])}}">
                @method('PUT')
                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.pages_form_common_info')}}</legend>

                    @if($settings)
                        @foreach($settings as $setting)
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$setting->title}}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input type="{{$setting->type}}" name="{{$setting->field}}" @if($setting->type != 'file') required @endif class="form-control"
                                               value="{{ $setting->value }}"
                                               placeholder="{{$setting->title}}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </fieldset>


                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                class="icon-pin-alt"></i></b>{{__('admin.pages_form_submit_label')}}</button>


            </form>
        </div>
    </div>
    <!-- /input group addons -->

</div>
<!-- /content area -->