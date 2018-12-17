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

