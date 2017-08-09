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

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="addProjectModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Add customer</h4>
                    </div>
                    <form action="" method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="modal-content">
                            <div class="form-group">
                                <label for="modalAddCustomerName" class="col-sm-3 control-label">Project name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="project_name" id="modalAddCustomerName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddCustomerFullName" class="col-sm-3 control-label">Company Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control">
                                        <option>a</option>
                                        <option>b</option>
                                        <option>c</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddCustomerFullName" class="col-sm-3 control-label">Member</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="project_member_name" id="modalAddCustomerPIC">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddCustomerFullName" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control">
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddCustomerFullName" class="col-sm-3 control-label">Money</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="project_money" id="modalAddCustomerPIC">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddCustomerFullName" class="col-sm-3 control-label">Memo</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Edit customer modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editCustomerModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Add customer</h4>
                    </div>
                    <form action="/customer/update" method="POST" id="formEditCustomer" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="modal-content">
                            <div class="form-group">
                                <label for="modalEditCustomerName" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_name" id="modalEditCustomerName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalEditCustomerFullName" class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_full_name" id="modalEditCustomerFullName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddCustomerMail" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_mail" id="modalEditCustomerMail">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="text-right">
                                    <input type="hidden" class="form-control" name="customer_id" id="modalEditCustomerId">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
@endsection