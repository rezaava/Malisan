@extends('dashboard2.layout.app')
@section('start')
    <link href="{{("/style/assets/css/elements/custom-tree_view.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{("/style/plugins/apex/apexcharts.css")}}" rel="stylesheet" type="text/css">
    {{--    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css" />--}}

@endsection
@section('main')

    <div id="content" class="main-content">
        @include('dashboard.layout.message')

        <div class="container">

            <div class="row layout-top-spacing">
                    <div id="treeviewAnimated" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <ul class="file-tree">
                                        <li class="file-tree-folder">
                                            سوال 1.................
                                            <ul>
                                                <li>
                                                    <span style="color: red">
                                                    پاسخ ...................
                                                    </span>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="file-tree-folder">
                                            سوال 2.................
                                            <ul>
                                                <li>
                                                    <span style="color: red">
                                                    پاسخ ...................
                                                    </span>
                                                </li>
                                            </ul>
                                        </li>

                                </ul>


                            </div>
                        </div>
                    </div>
            </div>

        </div>
        @include('dashboard2.layout.footer')

    </div>


@endsection

@section('end')

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>
    <script src="{{("/style/plugins/treeview/custom-jstree.js")}}"></script>

@endsection
