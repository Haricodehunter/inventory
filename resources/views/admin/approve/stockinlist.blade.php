@extends('admin.master');

@section('page-title')
    Inventory | StockIn List
@endsection

@section('content-heading')
    StockIn List
@endsection

@section('main-content')
    {{--{{Session::get('roleMsg')}}--}}
    @if (Session::get('updateStockInMsg'))
        <div class="alert alert-success">
            {{ Session::get('updateStockInMsg') }}
        </div>
    @endif

    @if (Session::get('deleteStockMsg'))
        <div class="alert alert-success">
            {{ Session::get('deleteStockMsg') }}
        </div>
    @endif

    @if (Session::get('errDeleteStockInMsg'))
        <div class="alert alert-danger">
            {{ Session::get('errDeleteStockInMsg') }}
        </div>
    @endif
    @if (Session::get('admin_name''))
                {{ Session::get('admin_name'); }}

                @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading role-list-info-header">
                    <p>StockIn Information <?php
        $name = Session::get('admin_name');

        $roleid =Session::get('admin_roleid');
                echo $name;

                echo $roleid;
		// var_dump($name);
		?></p>
                    <a href="{{ url('/stockin') }}" class="btn btn-success">+ Add StockIn</a>
                </div>


                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>S/L</th>
                            <th>Supplier Name</th>
                            <th>Name</th>
                            <th>Uniqe tag</th>
                            <th>Buildings</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Approved By</th>
                            <th>Approval Date</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Qrcode</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach($result as $data)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->lotname }}</td>
                                <td>{{ $data->uniqtag }}</td>
                                <td>{{ $data->buildingname }}</td>
                                <td>{{ $data->categoryname }}</td>
                                <td>{{ $data->subcategoryname }}</td>
                                <td>{{ $data->approvedby }}</td>
                                <td>{{ $data->approvaldate }}</td>
                                <td>{{ $data->note }}</td>
                                <?php if($data->Approved != 0):?>
                                    <td>Not Approved</td>
                                <?php else: ?>
                                    <td>Approved</td>
                                <?php endif; ?>

                                </td>
                                <td>
                                {!! QrCode::size(100)->generate($data->uniqtag); !!}
                                <!-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('https://www.w3adda.com/wp-content/uploads/2019/07/laravel.png', 0.3, true)
                        ->size(200)->errorCorrection('H')
                        ->generate('$data->uniqtag')) !!} "> --></td>
                                <td class="text-center"><a href="{{ url('viewstock/'.$data->id) }}" class="btn btn-primary">View</a><a href="{{ url('updatestockin/'.$data->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('deletestockin/'.$data->id) }}" class="btn btn-danger" onclick="if (!confirm('Are you sure to delete this item?')) { return false }">Delete</a>

                                <?php if($data->Approved != 0):?>
                                    <a href="{{ url('approve/'.$data->id) }}" class="btn btn-primary"> Approve</a>
                                    <?php else: ?>

                                    <?php endif; ?>
                                </td>
                                <?php $count += 1; ?>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });


    </script>
@endsection
