@extends('admin.layout.main')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Image Gallery <small> Manage gallery</small> </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <a class="btn btn-success" href="{{url('create-gallery').'/'.$type}}">
                    <i class="fa fa-plus"></i> New
                  </a>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
      
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                  @if($gallery->count() > 0)
                    @foreach ($gallery as $image)
                    <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="{{asset('storage/'.$image->image)}}" alt="image" />
                            <div class="mask">
                              <p>Gallery Image</p>
                              <div class="tools tools-bottom">                              
                                <a href="{{url('drop-gallery/'.$image->id)}}"><i class="fa fa-times"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p></p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                   
                  @endif
               
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
       
<!-- /page content -->
@endsection