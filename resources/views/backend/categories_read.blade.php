@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{url('admin/categories/create')}}" class="btn btn-primary">Add category</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List Category</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <th style="width: 150px;">Hiển thị trang chủ</th>
                    <th style="width:120px;"></th>
                </tr>
                <?php foreach($data as $rows): ?>
                <tr>
                    <td><?php echo $rows->name ?></td>
                    <td style="text-align: center;"><?php if($rows->displayhomepage==1): ?><span class="fa fa-check"></span><?php endif; ?></td>
                    <td style="text-align:center;">
                        <a href="{{ url('admin/categories/update/'.$rows->id) }}">Update</a>&nbsp;
                        <a href="{{ url('admin/categories/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <input type="hidden" value="{{ $rows->id }}" name="id">
                        <!-- cap con -->
                        <?php 
                            $dataSub =  DB::select("select * from categories where parent_id=$rows->id order by id desc");
                         ?>
                        <?php foreach($dataSub as $rowsSub): ?>
                        <tr>
                            <td style="padding-left: 30px;"><?php echo $rowsSub->name ?></td>
                            <td style="text-align: center;"><?php if($rowsSub->displayhomepage==1): ?><span class="fa fa-check"></span><?php endif; ?></td>
                            <td style="text-align:center;">
                                <a href="{{ url('admin/categories/update/'.$rowsSub->id) }}">Update</a>&nbsp;
                                <a href="{{ url('admin/categories/delete/'.$rowsSub->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
            	<?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
        </div>
    </div>
</div>
@endsection