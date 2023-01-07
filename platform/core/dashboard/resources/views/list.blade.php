@extends(BaseHelper::getAdminMasterLayoutTemplate())
@section('content')
<div id="dashboard-alerts">
    <verify-license-component verify-url="{{ route('settings.license.verify') }}" setting-url="{{ route('settings.options') }}"></verify-license-component>
    @if (config('core.base.general.enable_system_updater') && Auth::user()->isSuperUser())
    <check-update-component check-update-url="{{ route('system.check-update') }}" setting-url="{{ route('system.updater') }}"></check-update-component>
    @endif
</div>
{!! apply_filters(DASHBOARD_FILTER_ADMIN_NOTIFICATIONS, null) !!}
<div class="row">
    {!! apply_filters(DASHBOARD_FILTER_TOP_BLOCKS, null) !!}
</div>
<div class="row">
    @foreach ($statWidgets as $widget)
    {!! $widget !!}
    @endforeach
</div>
<div id="list_widgets" class="row">
    @foreach ($userWidgets as $widget)
    {!! $widget !!}
    @endforeach


    <div class="col-md-6 col-sm-6 col-12 widget_item" id="widget_top_agents">
        <div class="portlet light bordered portlet-no-padding ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fas fa-user-friends font-dark fw-bold" data-bs-toggle="tooltip" title="" data-bs-original-title="Top Agents" aria-label="Top Agents"></i>
                    <span class="caption-subject font-dark d-none d-xl-inline">Top Agents</span>

                </div>

            </div>
            <div class="portlet-body  widget-content scroll-table expand">
                <div class="scroller mCustomScrollbar _mCS_6" style="padding: 0px;">
                    <div id="_mCS_6" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">
                        <div id="_mCS_6_container" class="mCSB_container" style="margin-right:10px!important; position:relative; top:0; left:0;" dir="ltr">
                            <table class="table table-striped">

                                <thead class="tableFloatingHeader">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Property Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1
                                    @endphp

                                    @foreach ($topAgent as $topAgents)


                                    <tr>

                                        <td class="text-center">{{$i++ }}</td>
                                        <td class="text-center">{{$topAgents->Name}}</td>
                                        <td class="text-center">{{$topAgents->email}}</td>
                                        <td class="text-center">{{$topAgents->Property}}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="col-md-6 col-sm-6 col-12 widget_item" id="widget_top_search_keywords">
        <div class="portlet light bordered portlet-no-padding ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="far fa-newspaper font-dark fw-bold" data-bs-toggle="tooltip" title="" data-bs-original-title="Top Keywords" aria-label="Top Keywords"></i>
                    <span class="caption-subject font-dark d-none d-xl-inline">Most Search keywords</span>
                </div>

            </div>
            <div class="portlet-body  widget-content scroll-table expand" style="">
                <div class="scroller mCustomScrollbar _mCS_3" style="padding: 0px;">
                    <div id="mCSB_3001" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">
                        <div id="mCSB_3001_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                            <table class="table table-striped">
                                <thead class="tableFloatingHeaderOriginal" style="position: absolute; margin-top: 0px; z-index: 1; width: 469.5px;">
                                    <tr>
                                        <th class="text-center" style="min-width: 97.9062px; max-width: 97.9062px;">#</th>
                                        <th class="text-center" style="min-width: 97.9062px; max-width: 97.9062px;">Keywords</th>


                                    </tr>
                                </thead>
                                <thead class="tableFloatingHeader">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Keywords</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $i = 1
                                    @endphp

                                    @foreach ($topkeyword as $topkeywords)


                                    <tr>
                                        <td class="text-center">{{$i++ }}</td>

                                        <td>{{$topkeywords->total}}</td>

                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- <div id="mCSB_3001_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: block;">
                            <div class="mCSB_draggerContainer">
                                <div id="mCSB_3001_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 65px; max-height: 54.7031px;">
                                    <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                </div>
                                <div class="mCSB_draggerRail"></div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


</div>





@if (count($widgets) > 0)
<a href="#" class="manage-widget">
    <i class="fa fa-plus"></i>
    {{ trans('core/dashboard::dashboard.manage_widgets') }}
</a>

@include('core/dashboard::partials.modals', compact('widgets'))
@endif
@stop