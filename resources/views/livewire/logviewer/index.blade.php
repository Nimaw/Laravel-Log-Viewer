<div>
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Logs</h4>
                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search ">
                        <input type="text" class="form-control" placeholder="Search between Level, Content, Date"
                            wire:model.debounce.500ms="keyword" style="width:50rem">
                        <select wire:model="type" class="form-control pl-3 pl-3" style="width: 21%; margin-left: 1rem">
                            <option value="">Select a type</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level }}">{{ $level }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Level </th>
                                    <th> Date </th>
                                    <th> Message </th>
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
                                            {!! $item['content'] !!}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
