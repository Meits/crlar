<!-- Page header -->
<form class="form-validate-jquery" enctype="multipart/form-data" method="post"
      action="{{route('emails.update',['email'=>$email->id])  }}">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                    class="icon-pin-alt"></i></b>{{__('admin.emails_form_submit_label')}}</button>
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

                @method('PUT')

                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.email_form_common_info')}}</legend>

                    <ul class="nav nav-tabs nav-justified">
                        @foreach($languages as $key => $language)
                            <li class="nav-item">
                                <a href="#basic-justified-tab{{$key}}"
                                   class="nav-link @if($key == 0) active @endif"
                                   data-toggle="tab">{!! $language->name !!}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($languages as $key => $language)
                            <div id="basic-justified-tab{{$key}}"
                                 class="tab-pane fade show @if($key == 0) active @endif">
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('admin.emails_form_title_label')}}<span
                                                class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input type="text" name="title" required class="form-control"
                                                   value="{{$email->title ?? ""}}"
                                                   placeholder="{{__('admin.emails_form_title_label')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('admin.emails_form_type_label')}}<span
                                                class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input type="text" name="type" required class="form-control"
                                                   value="{{$email->type ?? ""}}"
                                                   placeholder="{{__('admin.emails_form_type_label')}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3">
                        <textarea rows="5" cols="5" name="localization[{{$language->id}}][template]" id="text"
                                  class="editor" required
                                  placeholder="{{__('admin.emails_form_template_label')}}">
                            {!! $email->localizations->where('language_id',$language->id)->first() ? $email->localizations->where('language_id',$language->id)->first()->template : ""   !!}
                        </textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </fieldset>

                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                class="icon-pin-alt"></i></b>{{__('admin.emails_form_submit_label')}}</button>

            </div>
        </div>

    </div>
</form>
