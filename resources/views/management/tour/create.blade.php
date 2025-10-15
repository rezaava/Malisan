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
                            <form class="col s12" action=" /dashboard/tour/create " method="post">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="title" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            title
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="title_hint" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            title-hint
                                        </label>
                                    </div>
                                    
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="abs_hint" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            abs-hint
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="keyword_hint" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            keyword-hint
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="file_hint" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            file-hint
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="sponsor_hint" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            sponsor-hint
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="donate" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            donate
                                        </label>
                                    </div>
                                    
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="title_min" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            title_min
                                        </label>
                                    </div>
                                    
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="title_max" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            title_max
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="abs_min" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            abs_min
                                        </label>
                                    </div>
                                    
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="abs_max" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            abs_max
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="key_min" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            key_min
                                        </label>
                                    </div>
                                    
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="key_max" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            key_max
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="keyword_min" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            keyword_min
                                        </label>
                                    </div>
                                    
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="keyword_max" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            keyword_max
                                        </label>
                                    </div>
                                    
                                      <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="file_max" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            file_max
                                        </label>
                                    </div>
                                </div>
                                <input type="submit" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 float-right" value="ثبت اطلاعات">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
