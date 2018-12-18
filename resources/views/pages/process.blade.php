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
        <li><a href="/api/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Process</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                    <div id="custom-search-input">
                        <div class="input-group col-md-3">
                                {{-- <input type="text" id="search" list="order-ids" placeholder="Order Id"> --}}

                            <input type="search" class="form-control" list="process-names"  v-model="processName" v-on:keyup="searchProcess"  placeholder="Search for process name"
                            value=""
                            autocomplete="off"
                            autofocus
                            spellcheck="false"
                            tabindex="0"
                            height="auto"
                            style = "height:40px;" />
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="submit" v-on:click="searchProcessOnClick">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                            <datalist id="process-names"></datalist>
                        </div>
                    </div>
                </div>
            <div class="col-xs-12 col-md-12" style="margin-top:20px;">
                <div id="process-list">
                    <table class="table table-striped" >
                        <thead class="thead-blue" >
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
                                            <div class="modal-body">
                                                <?php $i=1; ?>
                                                <div id="circle"></div>
                                                @foreach ($processDetail->getActions as $action)
                                                    <hr id="circle-line"></hr>
                                                    <div id="action-step"><span style="padding:5px 10px; margin:5px 0px; font-weight:bold;">STEP {{ $i }}</span><br> {{ $action->name }}</div>
                                                <?php $i++; ?>
                                                @endforeach
                                                <hr id="circle-line"></hr>
                                                <div id="circle"></div>
                                                <div style="clear:both;"></div>
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
            </div>
            <!-- /.col -->
        </div>
        <div class="row">

        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @section('style')
    <style>
        #circle {
            width: 50px;
            height: 50px;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            border: 2px solid #000;
            float:left;
            position: relative;
            top:25px;
        }
        #circle-line {
            border: 1px solid#000;
            float:left;
            width:20px;
            position: relative;
            top:30px;
        }
        #action-step {
            border: 1px solid#000;
            float:left;
            /* display:inline-block; */
            padding: 30px;
            text-align: center;
            width:auto;
        }
        .modal-dialog {
            width:auto !important;
            padding:10% 0px;
            text-align:center;
        }
        .modal-content {
            padding: 40px 0 0;
            display: inline-block;
            margin: 0 auto;
        }
        .modal-footer {
            border:0px;
        }
        .btn-group-lg>.btn, .btn-lg {
             padding: 7px 15px;
        }
        .main-header, .main-footer, .go-up {
            display:none;
        }
    </style>
  @endsection
@endsection