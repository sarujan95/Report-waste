@extends('admin.layout.main')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Form Elements</h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5  form-group pull-right top_search">

				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Add service</h2>
						<ul class="nav navbar-right panel_toolbox">

						</ul>
						<div class="clearfix"></div>
					</div>
					<div id="status-notification">
				
					</div>
					<div class="x_content">
						<br />
						<form id="create-service-selection-form" data-parsley-validate class="form-horizontal form-label-left">
							@csrf

							<input type="hidden" name="old_image" value="{{isset($selection->photo)?$selection->photo:''}}">
							<input type="hidden" name="sid" value="{{isset($sid)? $sid : ''}}">
							<input type="hidden" name="selection_id" value="{{isset($selection->id)? $selection->id : ''}}">

					
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Image <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="file" id="" name="image"  class="form-control ">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Title <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="" value="{{isset($selection->title)?$selection->title:''}}" name="title" required="required" class="form-control ">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Price <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="" value="{{isset($selection->price)?$selection->price:''}}" name="price"  class="form-control ">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Short Description <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<textarea id="message" name="short_description" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10">{{isset($selection->short_description)?$selection->short_description:''}}</textarea>
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Detail Description <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<label>
										<input type="checkbox" name="status" class="js-switch" @if(isset($selection->status)) {{$selection->status ? 'checked' : ''}} @endif /> Active
									</label>
								</div>
							</div>






							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-6 col-sm-6 offset-md-3">

									<button type="submit" class="btn btn-success">Submit</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->
@endsection