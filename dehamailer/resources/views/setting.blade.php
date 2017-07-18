@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="loader" style="display: none"></div>
    <div class="container-fluid">
        <h4>Setting</h4>
        <ol class="breadcrumb no-bg m-b-1">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Setting</li>
        </ol>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="panel-title">Common setting</h4>
                        <form action="/setting/update" method="POST" class="form-horizontal" id="common-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="commonTime" class="form-label col-sm-3">Driver</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="setting_driver" id="setting_driver" value="{{ $data['settings']['setting_driver'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="commonTime" class="form-label col-sm-3">Host</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="setting_host" id="setting_host" value="{{ $data['settings']['setting_host'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="commonTime" class="form-label col-sm-3">Port</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="setting_port" id="setting_port" value="{{ $data['settings']['setting_port'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="commonTime" class="form-label col-sm-3">Encryption</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="setting_encryption" id="setting_encryption" value="{{ $data['settings']['setting_encryption'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="commonMailPerDay" class="col-sm-3 form-label">Mail per day</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="setting_mail_per_day" id="setting_mail_per_day" value="{{ $data['settings']['setting_mail_per_day'] }}">
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="setting_id" value="{{ $data['settings']['setting_id'] }}">
                            <input type="submit" value="Save" onclick="loading()" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="panel-title">Sender</h4>
                        <div class="m-b-1 pull-left">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addSenderModal">Add</a>
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Mail</th>
                                <th class="text-center">Full Name</th>
                                <th style="width: 150px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['senders'] as $sender)
                                <tr>
                                    <td>{{ $sender->sender_username }}</td>
                                    <td>{{ $sender->sender_from_name }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-info" onclick="openModalEditSender({{ $sender->sender_id }})"><i class="fa fa-pencil-square-o visible-xs"></i><span class="hidden-xs">Edit</span></a>
                                        <a href="#" class="btn btn-danger" onclick="deleteSender({{ $sender->sender_id }})"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">Delete</span></a>
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="addSenderModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Add sender</h4>
                </div>
                <form action="/sender" method="POST" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-content">
                        <div class="form-group">
                            <label for="modalAddCustomerName" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sender_from_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddCustomerFullName" class="col-sm-3 control-label">Mail</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sender_username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddCustomerMail" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sender_password">
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
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editSenderModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Add sender</h4>
                </div>
                <form action="/sender/update" method="POST" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-content">
                        <div class="form-group">
                            <label for="modalAddCustomerName" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sender_from_name" id="modalEditSenderName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddCustomerFullName" class="col-sm-3 control-label">Mail</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sender_username" id="modalEditSenderMail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddCustomerMail" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sender_password" id="modalEditSenderPassword">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="text-right">
                                <input type="hidden" class="form-control" name="sender_id" id="modalEditSenderId">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script type="text/javascript" src="{{ URL::asset('js/setting.js') }}"></script>
@endsection