@extends('management.layout.master')
@section('styles')
@endsection
@section('title' , 'عضویت در کلاس')
@section('main-content')
    <div class="row">
        <div class="col s12">
            <div id="icon-prefixes" class="card card-tabs">
                <div class="card-content">
                    <div id="view-icon-prefixes" class="active">
                        <div class="row">
                            <form class="col s12" action="/dashboard/courses/join" method="post">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons dp48 prefix">link</i>
                                        <input id="code" name="code" type="text" class="validate">
                                        <label class="contact-input" for="code">کد درس</label>
                                    </div>
                                </div>
                                <button
                                            type="submit"
                                            class="btn waves-effect waves-light    gradient-45deg-light-blue-cyan  col s12"
                                            > 
                                            عضویت در کلاس
                                            </button>
                              <!--<button type="submit" style="border:none">-->
                                <!--<input type="submit" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan   mr-1 mb-2 float-right" value="عضویت در کلاس">-->
                                <!--</button>-->
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

