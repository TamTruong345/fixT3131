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
                <form action="/customer/search" method="POST" class="form-group form-horizontal" id="mailSearch-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formSearchCustomerName" class="col-sm-3 control-label form-label">Project Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label form-label">Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_mail" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label form-label">Member</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_mail" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label form-label">Created date</label>
                                <div class="col-sm-9">
                                    <div class="input-daterange input-group">
                                        <input type="text" class="input-sm form-control daterange" name="created_at_from" value=""/>
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control daterange" name="created_at_to" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label form-label">Latest mail time</label>
                                <div class="col-sm-9">
                                    <div class="input-daterange input-group">
                                        <input type="text" class="input-sm form-control daterange" name="customer_last_sent_mail_from" value=""/>
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control daterange" name="customer_last_sent_mail_to" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label form-label">Status</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control " name="project-status">
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
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
                            <th class="text-center">Customer</th>
                            <th class="text-center">Member</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Money</th>
                            <th class="text-center">Lost memo</th>
                            <th class="text-center">Created date</th>
                            <th class="text-center">Update date</th>
                            <th class="text-center" style="width: 150px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="" method="POST" class="form-group form-horizontal" id="formCreateMail">
                                <tr>
                                    <td class="text-center"> <input type="checkbox" class="checkbox-item" name=""> </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><a href="#" class="btn btn-info" onclick=""><i class="fa fa-pencil-square-o visible-xs"></i><span class="hidden-xs">Edit</span></a>
                                        <a href="#" class="btn btn-danger" onclick=""><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">Delete</span></a></td>
                                </tr>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="template_id" id="template_id" value=""/>
                            <input type="hidden" name="sender_id" id="sender_id" value=""/>
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>




@endsection