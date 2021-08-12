@extends('admin.layout.main')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Add/Edit Package</h3>
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
						<ul class="nav navbar-right panel_toolbox">

						</ul>
						<div class="clearfix"></div>
					</div>
					<div id="status-notification">
				
					</div>
					<div class="x_content">
						<br />
						<form id="create-service-package-form" data-parsley-validate class="form-horizontal form-label-left">
							@csrf
							<input type="hidden" name="sid" value="{{isset($sid)? $sid : ''}}">
							<input type="hidden" name="package_id" value="{{isset($package->id)? $package->id : ''}}">

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Title <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="" value="{{isset($package->title)?$package->title:''}}" name="title" required="required" class="form-control ">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Plan <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="" value="{{isset($package->plan)?$package->plan:''}}" name="plan"  class="form-control ">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Price <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="" value="{{isset($package->price)?$package->price:''}}" name="price"  class="form-control ">
								</div>
							</div>
					
							<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Features</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="tags_1" type="text" name="features" value="{{isset($package->features) ? $package->features : ''}}"   class="tags form-control"  />
												<div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
											</div>
										</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Detail Description <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<label>
										<input type="checkbox" name="status" class="js-switch" @if(isset($package->status)) {{$package->status ? 'checked' : ''}} @endif /> Active
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