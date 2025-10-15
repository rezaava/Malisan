@extends('management.layout.master')
@section('styles')
@endsection
@section('title' , 'مسابقه')
@section('main-content')
    <div class="row">
        <div class="col s12">
            <div id="icon-prefixes" class="card card-tabs">
                <div class="card-content">
                    <div id="view-icon-prefixes" class="active">
                        <div class="row">
                            <form class="col s12" action=" /dashboard/tour/score/{{$answer->id}} " method="post">
                                @csrf
                                <div class="row">
                                    <div class="col s9">
                                        <h3>{{$answer->title}}</h3>
                                        <h6>{{$tour->title_hint}}</h6>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="score_title" required type="text" class="validate">
                                        <label class="contact-input" for="icon_prefix3">
                                            title
                                        </label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <textarea id="name" name="desc_title" required type="text"
                                                  class="validate"></textarea>
                                        <label class="contact-input" for="icon_prefix3">
                                            title
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s9">
                                        <h4>{{$answer->abstract}}</h4>
                                        <h6>{{$tour->abs_hint}}</h6>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="score_abs" required type="text" class="validate">
                                        <label class="contact-input" for="icon_prefix3">
                                            abs
                                        </label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <textarea id="name" name="desc_abs" required type="text"
                                                  class="validate"></textarea>
                                        <label class="contact-input" for="icon_prefix3">
                                            abs
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s9">
                                        <h4>{{$answer->keywords}}</h4>
                                        <h6>{{$tour->keyword_hint}}</h6>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="score_key" required type="text" class="validate">
                                        <label class="contact-input" for="icon_prefix3">
                                            key
                                        </label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <textarea id="name" name="desc_key" required type="text"
                                                  class="validate"></textarea>
                                        <label class="contact-input" for="icon_prefix3">
                                            key
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s9">
                                        <a href="/files/tour/answer{{ $answer->file }}" class="btn btn-primary" >download</a>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="score_file" required type="text" class="validate">
                                        <label class="contact-input" for="icon_prefix3">
                                            key
                                        </label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <textarea id="name" name="desc_file" required type="text"
                                                  class="validate"></textarea>
                                        <label class="contact-input" for="icon_prefix3">
                                            key
                                        </label>
                                    </div>
                                </div>
                                <input type="submit"
                                       class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 float-right"
                                       value="ثبت اطلاعات">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
