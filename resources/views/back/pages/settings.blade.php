@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Settings')
@section('content')

<div class="row align-items-center">
    <div class="col">
        <h2 class="page-title">
            Settings
        </h2>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <li class="nav-item" role="presentation">
            <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">General Settings</a>
            </li>
            <li class="nav-item" role="presentation">
            <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Logo & Favicon</a>
            </li>
            <li class="nav-item" role="presentation">
            <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Social Media</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade active show" id="tabs-home-8" role="tabpanel">
                <div>
                    @livewire('author-general-settings')
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">

                <div class="row">
                    <div class="col-md-6">
                        <h3>Set blog logo</h3>
                        <div class="mb-2" style="max-width: 200px">
                            <img src="" alt="" class="img-thumbnail" id="logo-img-preview" data-ijabo-default-img="{{ \App\Models\Setting::find(1)->blog_logo }}" >
                        </div>
                        <form action="{{ route('author.change-blog-logo') }}" method="POST" id="changeBlogLogoForm" >
                            @csrf
                            <div class="mb-2" >
                                <input type="file" name="blog_logo" class="form-control">
                            </div>
                            <button class="btn btn-primary">Change logo</button>
                        </form>
                    </div>
                    <div class="col-md-6" >
                        <h3>Set blog favicon</h3>
                        <div clas="mb-2" style="max-width: 100px" >
                            <img src="" class="img-thumbnail" id="favicon-image-preview"  data-ijabo-default-img="{{ \App\Models\Setting::find(1)->blog_favicon }}" >
                        </div>
                        <form action="{{ route('author.change-blog-favicon') }}" method="POST" id="changeBlogFaviconForm" >
                            @csrf
                            <div class="mb-2" >
                                <input type="file" name="blog_favicon" class="form-control">
                            </div>
                            <button class="btn btn-primary">Change favicon</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
  <script>
    $('input[name="blog_logo"]').ijaboViewer({
        preview     : '#logo-img-preview',
        imageShape :  'rectangular',
        allowedExtensions : ['jpg', 'jpeg', 'png'],
        onErrorShape : function(message, element) {
            alert(message+'=> width should be greater than height');  // \u{2260} is html symbol ≠	&#8800;	&#x2260; &ne; NOT EQUAL TO
        },
        onInvalidType : function(message, element) {
            alert(message);
        },
        onSuccess : function(message, element) {
            // alert(message);
        }
    });

    $('input[name="blog_favicon"]').ijaboViewer( {
        preview         : '#favicon-image-preview',
        imageShape      : 'square',
        allowedExtensions : ['ico'],
        onErrorShape : function(message, element) {
            alert(message+'=> width should be equal to height');  // \u{2260} is html symbol ≠	&#8800;	&#x2260; &ne; NOT EQUAL TO
        },
        onInvalidType : function(message, element) {
            alert(message);
        },
        onSuccess : function(message, element) {
            // alert(message);
        }
    } );

    $("#changeBlogLogoForm").submit( function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url         : $(form).attr('action'),
            method      : $(form).attr('method'),
            data        : new FormData(form),
            processData : false,
            dataType    : 'json',
            contentType : false,
            beforeSend  : function() {},
            success     : function(data){
                toastr.remove();
                if (data.status == 1) {
                    toastr.success(data.msg);
                    $(form)[0].reset();
                    Livewire.dispatch('updateTopHeader');
                } else {
                    toastr.error(data.msg);
                }
            }
        });
    } );
    
    $("#changeBlogFaviconForm").submit( function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url         : $(form).attr('action'),
            method      : $(form).attr('method'),
            data        : new FormData(form),
            processData : false,
            dataType    : 'json',
            contentType : false,
            beforeSend  : function() {},
            success     : function(data){
                toastr.remove();
                if (data.status == 1) {
                    toastr.success(data.msg);
                    $(form)[0].reset();
                    Livewire.dispatch('updateTopHeader');
                } else {
                    toastr.error(data.msg);
                }
            }
        });
    } );

  </script>

@endpush

