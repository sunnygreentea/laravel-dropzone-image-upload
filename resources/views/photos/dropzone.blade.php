@extends('layouts.front')
@section('content')
<div class="container-fluid">
      <br />
    <h1 class="text-center">Upload Images Using Dropzone</h1>
    <br />
        
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">Select Image</h2>
		</div>
		<div class="panel-body">
			<form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
			@csrf
			</form>
			<div class="text-center my-2">
				<button type="button" class="btn btn-info" id="submit-all">Upload</button>
			</div>
		</div>
	</div>
  	
  	<div class="panel panel-default  mt-5">
        <div class="panel-heading">
          <h2 class="panel-title">Uploaded Image</h2>
        </div>
        <div class="panel-body" id="uploaded_image">
        </div>
  	</div>
</div>


<script type="text/javascript">

  	Dropzone.options.dropzoneForm = {
	    autoProcessQueue : false,
	    acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
	    timeout: 60000,

	    init:function(){
			var submitButton = $("#submit-all");
			myDropzone = this;

			submitButton.click(function(){
				myDropzone.processQueue();
			});

			this.on("complete", function(){
			if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
				{
				  var _this = this;
				  _this.removeAllFiles();
				}
				load_images();
			});
	    },
	    success: function (file, response) {
	        console.log(response);
	    },
    

  	};

  	load_images();

	function load_images()
	{
		$.ajax({
			url:"{{ route('dropzone.fetch') }}",
			success:function(data)
			{
				$('#uploaded_image').html(data);
			}
		})
	}

	$(document).on('click', '.remove_image', function(){
		var name = $(this).attr('id');
		$.ajax({
			url:"{{ route('dropzone.delete') }}",
			data:{name : name},
			success:function(data){
				load_images();
			}
		})
  	});

  

</script>
@endsection