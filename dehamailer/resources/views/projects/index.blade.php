@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- Content -->
    @include('flash::message')
    <div class="loader" style="display: none"></div>
    <div class="container-fluid">
        <h4>Projects</h4>
        <ol class="breadcrumb no-bg m-b-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Project</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 class="panel-title">Search</h4>
                <form action="/project/search" method="POST" class="form-group form-horizontal" id="mailSearch-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formSearchCustomerName" class="col-sm-3 control-label form-label">Project Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="project_name" value="<?php echo ( isset($data['conditions']['project_name']) ) ? $data['conditions']['project_name'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label form-label">Company Name</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control" id="select2search" name="project_customer_name">
                                        <option></option>
                                        @foreach($data['customers'] as $cus)
                                            <option value="{{ $cus['customer_id'] }}"
                                                    {{ ( isset($data['conditions']['project_customer_id'])
                                                            &&  $data['conditions']['project_customer_id'] == $cus['customer_id'] )
                                                            ? 'selected' : '' }}>{{ $cus['customer_name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label form-label">Member</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="select2_member_search" name="project_member_name">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label form-label">Created date</label>
                                <div class="col-sm-9">
                                    <div class="input-daterange input-group">
                                        <input type="text" class="input-sm form-control daterange" name="created_at_from" value="<?php echo ( isset($data['conditions']['created_at_from']) ) ? $data['conditions']['created_at_from'] : ''; ?>"/>
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control daterange" name="created_at_to" value="<?php echo ( isset($data['conditions']['created_at_to']) ) ? $data['conditions']['created_at_to'] : ''; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label form-label">Update date</label>
                                <div class="col-sm-9">
                                    <div class="input-daterange input-group">
                                        <input type="text" class="input-sm form-control daterange" name="update_at_from" value="<?php echo ( isset($data['conditions']['update_at_from']) ) ? $data['conditions']['update_at_from'] : ''; ?>"/>
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control daterange" name="update_at_to" value="<?php echo ( isset($data['conditions']['update_at_to']) ) ? $data['conditions']['update_at_to'] : ''; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label form-label">Status</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control" name="project_status">
                                        <option></option>
                                        <option>新受付</option>
                                        <option>見積作成中</option>
                                        <option>見積提出済</option>
                                        <option>受注</option>
                                        <option>開発中</option>
                                        <option>支払待ち</option>
                                        <option>終了</option>
                                        <option>キャンセル</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <input type="submit" class="btn btn-success" onclick="loading()" value="Search">
                                    <input type="button" class="btn btn-warning btn-reset" onclick="resetSearch()" value="Reset" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End panel -->
        <div class="m-b-1 pull-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addProjectModal">Add</a>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="checkAllCustomer" name=""></th>
                            <th class="text-center">Project Name</th>
                            <th class="text-center">Company Name</th>
                            <th class="text-center">Member</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Money</th>
                            <th class="text-center">Last Memo</th>
                            <th class="text-center">Created Date</th>
                            <th class="text-center">Updated Date</th>
                            <th class="text-center" style="width: 150px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="" method="POST" class="form-group form-horizontal" id="formCreateMail">
                            @foreach ($data['projects'] as $pro)
                                <tr>
                                    <td class="text-center"> <input type="checkbox" class="checkbox-item" name=""> </td>
                                    <td>{{ $pro->project_name }}</td>
                                    <td>{{ $pro->project_customer_name }}</td>
                                    <td>{{ $pro->project_member_name }}</td>
                                    <td>{{ $pro->project_status }}</td>
                                    <td>{{ $pro->project_money }}</td>
                                    <td>{{ $pro->project_last_memo }}</td>
                                    <td>{{ $pro->created_at }}</td>
                                    <td>{{ $pro->updated_at }}</td>
                                    <td class="text-center"><a href="#" class="btn btn-info" onclick=""><i class="fa fa-pencil-square-o visible-xs"></i><span class="hidden-xs">Edit</span></a>
                                        <a href="#" class="btn btn-danger" onclick="deleteItem({{ $pro->project_id }})"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">Delete</span></a></td>
                                </tr>
                            @endforeach
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="template_id" id="template_id" value=""/>
                            <input type="hidden" name="sender_id" id="sender_id" value=""/>
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">
            {!! $data['projects']->render() !!}
        </div>



<script type="text/javascript" src="{{ URL::asset('js/project.js') }}"></script>
@endsection