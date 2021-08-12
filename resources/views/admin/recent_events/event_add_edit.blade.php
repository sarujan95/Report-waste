@extends('admin.layout.main')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Create/Edit Recent Events</h3>
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
						<form id="create-recent-event-form" data-parsley-validate class="form-horizontal form-label-left">
							@csrf

							<input type="hidden" name="old_image" value="{{isset($event->image)?$event->image:''}}">
							<input type="hidden" name="eventid" value="{{isset($event->id)?$event->id:''}}">

					

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Featured Image <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="file" id="" name="image"  class="form-control ">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Title <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="" value="{{isset($event->title)?$event->title:''}}" name="title" required="required" class="form-control ">
								</div>
							</div>

							<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Event Date <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="date" name="date" value="{{isset($event->date)?$event->date:''}}" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
												<script>
													function timeFunctionLong(input) {
														setTimeout(function() {
															input.type = 'text';
														}, 60000);
													}
												</script>
											</div>
										</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Short Description <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<textarea id="message" name="short_description" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10">{{isset($event->short_description)?$event->short_description:''}}</textarea>
								</div>
							</div>

							<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Services</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="tags_1" type="text" name="services" value="{{isset($event->services) ? $event->services : ''}}"   class="tags form-control"  />
												<div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
											</div>
										</div>
					
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Status<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<label>
										<input type="checkbox" name="status" class="js-switch" @if(isset($event->status)) {{$event->status ? 'checked' : ''}} @endif /> Active
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