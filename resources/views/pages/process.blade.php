@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Process
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Process</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Process</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($processDetails)
                        @foreach ($processDetails as $processDetail)
                            </tr>
                                <td>{{ $processDetail['name'] }}</td>
                                <td>{{ $processDetail['description'] }}</td>
                                <td>
                                @foreach ($processDetail->getActions as $action)
                                    {{ $action->name }} <br>
                                @endforeach
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                    @if($processDetails->isEmpty())
                        <div class="well text-center">No record found.</div>
                    @else
                        @include('commen.paginate', ['paginator' => $processDetails])
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

