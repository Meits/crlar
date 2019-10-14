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
    <form class="form-validate-jquery" enctype="multipart/form-data" method="post" action="{{route('permissions.store',['lang' => App::getLocale()])}}">
    @csrf
    <!-- Hover rows -->
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <th>{{__('admin.pages_permissions_title')}}</th>
                    @if(!$roles->isEmpty())
                        @foreach($roles as $item)
                            <th>{{ $item->title}}</th>
                        @endforeach
                    @endif
                    </thead>
                    <tbody>
                    @if(!$priv->isEmpty())
                        @foreach($priv as $val)
                            <tr>
                                <td>{{ $val->title }}</td>
                                @foreach($roles as $role)
                                    <td>
                                        <label class="checkbox-label">
                                            @if($role->hasPermission($val->alias))
                                                <input checked name="{{ $role->id }}[]" type="checkbox"
                                                       class="checkbox-input" value="{{ $val->id }}">
                                            @else
                                                <input class="checkbox-input" name="{{ $role->id }}[]" type="checkbox"
                                                       value="{{ $val->id }}">
                                            @endif
                                            <span></span>
                                        </label>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>

        </div>
        <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                        class="icon-pin-alt"></i></b>{{__('admin.pages_form_submit_label')}}</button>
    </form>
    <!-- /hover rows -->

</div>
<!-- /content area -->
