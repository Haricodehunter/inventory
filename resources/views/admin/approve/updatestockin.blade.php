@extends('admin.master');

@section('page-title')
    Inventory | Update StockIn Form
@endsection

@section('content-heading')
    Update StockIn Form
@endsection

@section('main-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    StockIn Information
                </div>
                @if(Session::get('errUpdateStockInMsg'))
                    <div class="alert alert-danger">
                        {{ Session::get('errUpdateStockInMsg') }}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="row">
                        <form role="form" action="{{ url('updatestockin/'.$stcInData->id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Supplier Name</label>
                                    <select class="form-control" name="supname" required>
                                        <option value="" required>-- Select --</option>
                                        @foreach($suppData as $suppdata)
                                            <option value="{{ $suppdata->id }}" {{ ($suppdata->id == $stcInData->supid)?  'selected= "selected"': '' }}>{{ $suppdata->name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <a href="{{ url('registration') }}" class="btn btn-primary">+ Add New</a>
                                </div>
                                <div class="form-group">
                                    <label>Lot Name</label>
                                    <input type="text" class="form-control" name="lotname"
                                           value="{{ $stcInData->lotname }}"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>Uniq Tag</label>
                                    <input type="number" class="form-control" name="uniqtag" id="uniqtag" value="{{ $stcInData->uniqtag }}" placeholder="Enter no of coil" default>
                                </div>

                                <div class="form-group">
                                    <label>Building</label>
                                        <select class="form-control" name="buildingname" required>
                                            <option value="">-- Select --</option>
                                            @foreach($buildingData as $building)
                                                <option value="{{ $building->id }}" {{ ($building->id == $stcInData->buildingname)?  'selected= "selected"': '' }}>{{ $building->buildingsname }}</option>
                                            @endforeach
                                        </select>
                                 </div>
                                 <div class="form-group">
                            <label>Category</label>
                                        <select class="form-control" name="categoryid" required>
                                            <option value="">-- Select --</option>
                                            @foreach($categoryData as $category)
                                                <option value="{{  $category->id }}" {{ ($category->id == $stcInData->categoryid)?  'selected= "selected"': '' }} >{{ $category->categoryname }}</option>
                                            @endforeach
                                        </select>
                                </div>

                            </div>
                            <div class="col-lg-6">
                         

                            
                                <div class="form-group">
                                <label>Sub Category</label>
                                        <select class="form-control" name="subcategoryid" required>
                                            <option value="">-- Select --</option>
                                            @foreach($subcategoryData as $subcategory)
                                                <option value="{{ $subcategory->id }}" {{ ($subcategory->id == $stcInData->subcategoryid)?  'selected= "selected"': '' }} >{{ $subcategory->subcategoryname }}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="form-group">
                                <div class="input-group control-group increment" >
                                    <input type="file" class="form-control" name="files[]" multiple>
                                    <div class="input-group-btn"> 
                                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                </div>
                                  

                                </div>
                                <div class="form-group">
                                    <label>Approval Date</label>
                                    <input type="date" class="form-control" name="approvaldate" id="approvaldate"  value="{{ $stcInData->approvaldate }}" placeholder="select date" default>
                                </div>
                                <div class="form-group">
                                    <label>Approved By</label>
                                    <input type="text" class="form-control" name="approvedby" id="approvedby" value="{{ $stcInData->approvedby }}" placeholder="approved by" default>
                                </div>
                                <div class="form-group">
                                    <label>Additional Comments</label>
                                    <textarea class="form-control" name="notes" id="notes" value="{{ $stcInData->note }}" placeholder="Additional Comments"></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary"> Update StockIn</button>
                            </div>
                        </form>
                        <!-- /.col-lg-6 (nested) -->

                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection