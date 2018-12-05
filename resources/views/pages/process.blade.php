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
                <table class="table table-bordered table-hover" style="background-color:#fff;">
                    <thead class="thead-blue" style="background-color: #3c8dbc; color:#fff;">
                    <tr>
                      <th>Process</th>
                      <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($processDetails)
                        @foreach ($processDetails as $processDetail)
                            <tr>
                                <td><a class="" data-toggle="modal" data-target="#{{$processDetail['name']}}" style="cursor:pointer;">{{ $processDetail['name'] }}</a></td>
                                <td>{{ $processDetail['description'] }}</td>
                            </tr>
                            <div class="modal fade" id="{{$processDetail['name']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3c8dbc; color:#fff;">
                                            <h3 class="modal-title" id="exampleModalLabel">Action List</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php $i=1; ?>
                                            @foreach ($processDetail->getActions as $action)
                                                <div class="col-md-12">{{ $i }}. {{ $action->name }}</div>
                                                <div style="clear:both;"></div>
                                            <?php $i++; ?>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </tbody>
                </table>
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

