@extends('admin.master');

@section('page-title')
    Inventory | Update StockIn Form
@endsection

@section('content-heading')
    View Details
@endsection

@section('main-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-disabled">
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
                                    <select class="form-control" name="supname" required disabled>
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
                                           required disabled> 
                                </div>

                                <div class="form-group">
                                    <label>Uniq Tag</label>
                                    <input type="number" class="form-control" name="uniqtag" id="uniqtag" value="{{ $stcInData->uniqtag }}" placeholder="Enter no of coil" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Building</label>
                                        <select class="form-control" name="buildingname" required disabled>
                                            <option value="">-- Select --</option>
                                            @foreach($buildingData as $building)
                                                <option value="{{ $building->id }}" {{ ($building->id == $stcInData->buildingname)?  'selected= "selected"': '' }}>{{ $building->buildingsname }}</option>
                                            @endforeach
                                        </select>
                                 </div>
                                 <div class="form-group">
                            <label>Category</label>
                                        <select class="form-control" name="categoryid" required disabled>
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
                                        <select class="form-control" name="subcategoryid" required disabled>
                                            <option value="">-- Select --</option>
                                            @foreach($subcategoryData as $subcategory)
                                                <option value="{{ $subcategory->id }}" {{ ($subcategory->id == $stcInData->subcategoryid)?  'selected= "selected"': '' }} >{{ $subcategory->subcategoryname }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                <label>Images</label>
                                        
                                    <?php $images = explode(',',$stcInData->image); ?>
                                            @foreach($images as $image)
                                               <img src="/uploads/{{$stcInData->uniqtag}}/{{$image}}" width="280">
                                            @endforeach
                                       
                                </div>

                                <div class="form-group">
                                <div class="input-group control-group increment" >
                                    <!-- <input type="file" class="form-control" name="files[]" disabled="treu" multiple>
                                    <div class="input-group-btn"> 
                                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                    </div> -->
                                </div>
                                  

                                </div>
                                <div class="form-group">
                                    <label>Approval Date</label>
                                    <input type="date" class="form-control" name="approvaldate" id="approvaldate"  value="{{ $stcInData->approvaldate }}" placeholder="select date" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Approved By</label>
                                    <input type="text" class="form-control" name="approvedby" id="approvedby" value="{{ $stcInData->approvedby }}" placeholder="approved by" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Additional Comments</label>
                                    <textarea class="form-control" name="notes" id="notes"  placeholder="Additional Comments" disabled>{{ $stcInData->note }}</textarea>
                                </div>
                                
                                <a href="/stockin" class="btn btn-primary"> Back to list</a>
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