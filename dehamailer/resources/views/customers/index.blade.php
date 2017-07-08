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
        <h4>Customer</h4>
        <ol class="breadcrumb no-bg m-b-1">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 class="panel-title">Search</h4>
                <form action="/customer/search" method="POST" class="form-group form-horizontal" id="mailSearch-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formSearchCustomerName" class="col-sm-3 control-label form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_name" value="<?php echo ( isset($data['conditions']['customer_name']) ) ? $data['conditions']['customer_name'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label form-label">Mail</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="customer_mail" value="<?php echo ( isset($data['conditions']['customer_mail']) ) ? $data['conditions']['customer_mail'] : ''; ?>">
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
                                <label for="inputEmail3" class="col-sm-3 control-label form-label">Latest mail time</label>
                                <div class="col-sm-9">
                                    <div class="input-daterange input-group">
                                        <input type="text" class="input-sm form-control daterange" name="customer_last_sent_mail_from" value="<?php echo ( isset($data['conditions']['customer_last_sent_mail_from']) ) ? $data['conditions']['customer_last_sent_mail_from'] : ''; ?>"/>
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control daterange" name="customer_last_sent_mail_to" value="<?php echo ( isset($data['conditions']['customer_last_sent_mail_to']) ) ? $data['conditions']['customer_last_sent_mail_to'] : ''; ?>"/>
                                    </div>
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
        <div class="m-b-1 pull-right">
            <a href="javascript:;" class="btn btn-warning" data-toggle="modal" data-target="#sendMailModal">Send Mail</a>
            <a href="#" class="btn btn-success">Import</a>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">Add</a>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Full name</th>
                            <th>Email</th>
                            <th >Last sent email</th>
                            <th>Created date</th>
                            <th class="text-center" style="width: 150px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['customers'] as $cus)
                            <tr>
                                <td class="text-center"> <input type="checkbox" name=""> </td>
                                <td>{{ $cus->customer_name }}</td>
                                <td>{{ $cus->customer_full_name }}</td>
                                <td>{{ $cus->customer_mail }}</td>
                                <td>{{ $cus->customer_last_sent_mail }}</td>
                                <td>{{ $cus->created_at }}</td>
                                <td class="text-center"><a href="#" class="btn btn-info" onclick="openModalEditTemplate({{ $cus->customer_id }})"><i class="fa fa-pencil-square-o visible-xs"></i><span class="hidden-xs">Edit</span></a>
                                    <a href="#" class="btn btn-danger" onclick="deleteTemplate({{ $cus->customer_id }})"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">Delete</span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center">
            {!! $data['customers']->render() !!}
        </div>
    </div>
    <!-- Send mail modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="sendMailModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Send mail</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sel1" class="col-sm-4 control-label">Template mail:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="sel1">
                                    <option>Template mail 1</option>
                                    <option>Template mail 2</option>
                                    <option>Template mail 3</option>
                                    <option>Template mail 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Add customer modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="addCustomerModal">
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
                            <label for="modalAddCustomerName" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="customer_name" id="modalAddCustomerName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddCustomerFullName" class="col-sm-3 control-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="customer_full_name" id="modalAddCustomerPIC">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddCustomerMail" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="customer_mail" id="modalAddCustomerMail">
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

<script type="text/javascript" src="{{ URL::asset('js/customer.js') }}"></script>