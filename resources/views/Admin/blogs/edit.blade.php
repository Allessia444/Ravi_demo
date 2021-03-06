@extends('Admin.layouts.home')
@section('title','Blogs > Edit Blog')
@section('content')
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Form</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{!! route('dashboard.index') !!}">Home</a></li>
									<li class="breadcrumb-item"><a href="{!! route('blogs.index') !!}">Blogs</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue">Edit Blog</h4>
						</div>
						<div class="pull-right">
							<a href="{!! route('blogs.index') !!}" data-toggle="tooltip" title="Back to Blog" class="btn btn-sm btn-primary btn-sm" rel="content-y"  role="button"><i class="fa fa-arrow-left"></i>Back</a>
						</div>
					</div><br>
					<form method="POST" action="{!! route('blogs.update',$blog->id) !!}">
						@csrf
						@method('PATCH')
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Select Blog Category</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="blog_category_id">
									<option selected="" value="">Choose Blog Category</option>
									@foreach($blog_categories as $key => $blog_category )
										<option value="{!! $blog_category!!}" @if($blog->blog_category->id == $blog_category) selected="" @endif>{!! $key !!}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Name</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Johnny Brown" name="name" value="{!! $blog->name !!}">
								@if($errors->has('name'))<span>{!! $errors->first('name') !!}</span>@endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Description</label>
							<div class="col-sm-12 col-md-10">
								<textarea class="form-control" name="description">{!! $blog->description !!}</textarea>
								@if($errors->has('hours'))<span>{!! $errors->first('hours') !!}</span>@endif
							</div>
						</div>
						<div class="form-group">
							<div id="container">
							{{-- <label>Image</label>
							<div id="previewDiv">
								<img id="img" src="{!! asset('/image/default.jpg') !!}">
							</div> --}}
							<a href="javascript:;" class="btn btn-primary" id="uploader">Upload Photo</a>
							@if($errors->has('image'))<p class="help-block">{!! $errors->first('image') !!}</p>@endif
							</div>
							<input type="hidden" name="photo" id="image" value="{!! $blog->photo !!}">
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">status</label>
							<div class="col-sm-12 col-md-10">
								<input type="hidden" name="status" value="0">
								<input  type="checkbox" value="1" name="status" value="{{ old('status') }}" @if($blog->status == '1') checked="" @endif>
								@if($errors->has('status'))<span>{!! $errors->first('status') !!}</span>@endif
							</div>
						</div>
						<div class="form-group row">
							<input type="submit" name="submit" value="Save" class="btn btn-primary ml-3">
						</div>
					</form>
				</div>
				<!-- Default Basic Forms End -->
			</div>
		</div>
	</div>
@endsection
@section('script')
<script type="text/javascript">
	var uploader = new plupload.Uploader({
	    runtimes : 'html5,flash,silverlight,html4',
	     
	    browse_button : 'uploader', // you can pass in id...
	    container: document.getElementById('container'), // ... or DOM Element itself
	     
	    url : "{{ asset('plupload/upload.php') }}",

	    filters : {
	        max_file_size : '10mb',
	        mime_types: [
	            {title : "Image files", extensions : "jpg,gif,png"},
	            {title : "Zip files", extensions : "zip"}
	        ]
	    },
	 
	    // Flash settings
	    flash_swf_url : "{{ asset('plupload/Moxie.swf') }}",
	 
	    // Silverlight settings
	    silverlight_xap_url : "{{ asset('plupload/Moxie.xap') }}",
	     
	 
	    init: {
	        PostInit: function() {
	            document.getElementById('filelist').innerHTML = '';
	        },
	 
	        FilesAdded: function(up, files) {
	            
	            uploader.start();
	        },
	 
	        // UploadProgress: function(up, file) {
	        //     document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
	        // },
	        UploadFile: function(up, file){
	                    var tmp_url = '{!! asset('/tmp/') !!}';
	                    console.log(file);
	                    
	                        $('#image').val(file.name);
	                        

	                        /*$('#preview').val(file.name);
	                        $('#previewDiv >img').remove();
	                        $('#previewDiv').append("<img src='"+tmp_url +"/"+ file.name+"' id='preview' height='100px' width='100px'/>");*/
	                    
	                },
	        UploadComplete: function(up, files){
	        	
	                var tmp_url = '{!! asset('/tmp/') !!}';
	                console.log(files);
	                plupload.each(files, function(file) {
	                    $('#image').val(file.name);
	                    $('#previewDiv > img').remove();
	                    $('#previewDiv').append("<img src='"+"/tmp/"+ file.name+"' id='preview' height='100px' width='100px'/>");
	                });
	                jQuery('.loader').fadeToggle('medium');
	        },
	 
	        Error: function(up, err) {
	            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
	        }
	    }
	});
	 
	uploader.init();
</script>

@endsection