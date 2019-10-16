<!-- Page header -->
<form class="form-validate-jquery" enctype="multipart/form-data" method="post"
      action="{{ route('pages.update',['page'=>$page->id]) }}">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                    class="icon-pin-alt"></i></b>{{__('admin.pages_form_submit_label')}}</button>
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
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.pages_form_common_info')}}</legend>



                    <ul class="nav nav-tabs nav-justified">
                        @foreach($languages as $key => $language)
                            <li class="nav-item"><a href="#basic-justified-tab{{$key}}" class="nav-link @if($key == 0) active @endif" data-toggle="tab">{!! $language->name !!}</a></li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach($languages as $key => $language)
                            <div id="basic-justified-tab{{$key}}" class="tab-pane fade show @if($key == 0) active @endif">
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('admin.pages_form_title_label')}}<span
                                                class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input type="text" name="localization[{{$language->id}}][title]" required class="form-control"
                                                   value="{{ $page->localizations->where('language_id',$language->id)->first() ? $page->localizations->where('language_id',$language->id)->first()->title : "" }}"
                                                   placeholder="{{__('admin.pages_form_title_label')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('admin.pages_form_titleH1_label')}}<span
                                                class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input type="text" name="localization[{{$language->id}}][titleH1]" required class="form-control"
                                                   value="{{ $page->localizations->where('language_id',$language->id)->first() ? $page->localizations->where('language_id',$language->id)->first()->titleH1 : "" }}"
                                                   placeholder="{{__('admin.pages_form_titleH1_label')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('admin.pages_form_description_label')}} <span
                                                class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                <textarea rows="5" cols="5" name="localization[{{$language->id}}][description]" class="form-control" required
                                          placeholder="{{__('admin.pages_form_description_label')}}">{{ $page->localizations->where('language_id',$language->id)->first() ? $page->localizations->where('language_id',$language->id)->first()->description : "" }}</textarea>
                                    </div>
                                </div>

                                <div class="card-header header-elements-inline">
                                    <h5 class="card-title">{{__('admin.pages_form_text_label')}}</h5>
                                </div>
                                <div class="mb-3">
                            <textarea rows="5" cols="5" name="localization[{{$language->id}}][text]" id="text" class="editor" required
                                      placeholder="{{__('admin.pages_form_text_label')}}">{!!  $page->localizations->where('language_id',$language->id)->first() ? $page->localizations->where('language_id',$language->id)->first()->text : "" !!}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </fieldset>


                <fieldset>
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.pages_form_system_info')}}</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.pages_form_alias_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="alias" class="form-control" value="{{$page->alias ?? ""}}"
                                       placeholder="{{__('admin.pages_form_alias_label')}}">
                            </div>
                        </div>
                    </div>
                </fieldset>


                <fieldset class="mb-3">
                    @if(isset($page) && $page->datas->where('field_id', '<>', '9') && !$page->datas->where('field_id', '<>', '9')->isEmpty())
                        <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.pages_form_fields_info')}}</legend>
                        @foreach($page->datas->where('field_id', '<>', '9') as $data)
                            @if($data->field)
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{ $data->title }}<span
                                                class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input @if ($data->field->alias !='file') required
                                                   @endif type="{{ $data->field->alias }}"
                                                   name="fields[{{ $data->alias }}]" class="form-control"
                                                   value="{{ $data->value }}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if($data->field->alias == 'file' && $data->value && $data->alias != 'audio_file')
                                        <label class="col-form-label col-lg-2">{{__('admin.pages_form_fields_uploaded_image')}}</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <img style="height: 100px;"
                                                     src="{{ asset('storage/images/pages/'.$data->value) }}">
                                                <a data-page-id="{{ $page->id }}" class="js-remove-pict" href="#">Удалить</a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($data->field->alias == 'file' && $data->value && $data->alias == 'audio_file')
                                        <label class="col-form-label col-lg-2">Uploaded audio</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input required type="text" name="" readonly class="form-control"
                                                       value="{{ $data->value }}" placeholder="Uploaded audio">
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @endif
                        @endforeach
                    @endif
                </fieldset>

                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                class="icon-pin-alt"></i></b>{{__('admin.pages_form_submit_label')}}</button>

            </div>
        </div>

    </div>
</form>
