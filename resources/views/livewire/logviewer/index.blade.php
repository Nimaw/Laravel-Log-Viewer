@section('content')
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Logs</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Level </th>
                                    <th> Date </th>
                                    <th> Message </th>
                                    <th> status </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <span class="ps-2">{{ $item['level'] }}</span>
                                        </td>
                                        <td> {{ $item['date'] }} </td>
                                        <td style="line-break: strict;">
                                            {{ $item['content'] }}
                                        </td>
                                        <td>
                                            <div class="badge badge-outline-success">Approved</div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
