@extends('melisan.layout.master')
@section('title' , 'عضویت در کلاس')
@section('main-content')
    <!-- <div class="row">
        <div class=""> -->
            <div id="" class="card-tabs mt-5" style="width: 45%;
    margin: auto;
    border-radius: 15px;">
                <div class="card-content">
                    <div id="view-icon-prefixes" class="active">
                            <form class="" action="/dashboard/courses/joinPost" method="post">
                                @csrf  
                                    <div class="input-field ">
                                        <i class="material-icons dp48 prefix">link</i>
                                        <input id="code" name="code" type="text" class="validate">
                                        <label class="contact-input" for="code">کد درس</label>
                                    </div>
                                <button type="submit"  class="btn btn-view-list" style="width:100%">   عضویت در کلاس   </button>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- </div>
        </div> -->
    </div>
@endsection

