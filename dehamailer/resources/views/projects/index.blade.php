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
                                    <select id="combobox_project_customer_name" type="text"  class="form-control combobox" name="project_customer_name" style="width: 100%;">
                                        <option value=""></option>
                                        @foreach($data['customers'] as $cus)
                                            <option value="{{ $cus['customer_id'] }}"{{ isset($data['conditions']['project_customer_name'])&& ($data['conditions']['project_customer_name'] == $cus['customer_id']) ? 'selected' : '' }}>{{ $cus['customer_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label form-label">Member</label>
                                <div class="col-sm-9">
                                    <select id="combobox_project_member_name" type="text" class="form-control combobox" name="project_member_name" style="width: 100%;">
                                        <option value=""></option>
                                        @foreach ($data['members'] as $mem)
                                            <option value="{{ $mem['member_id'] }}" {{ isset($data['conditions']['project_member_name'])&& ($data['conditions']['project_member_name'] == $mem['member_id']) ? 'selected' : '' }}>{{ $mem['member_name'] }} </option>
                                        @endforeach
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
                                    <select data-placeholder="Select Status" name="project_status[]" class="chosen-select-no-results form-control" multiple>
                                            <option value="新受付" @foreach($data['list_status_selected'] as $con)
                                                                        {{ (strcmp($con, '新受付') == 0) ? 'selected' : '' }}
                                                                @endforeach >新受付</option>
                                            <option value="見積作成中" @foreach($data['list_status_selected'] as $con)
                                                                        {{ (strcmp($con, '見積作成中') == 0) ? 'selected' : '' }}
                                                                    @endforeach >見積作成中</option>
                                            <option value="見積提出済" @foreach($data['list_status_selected'] as $con)
                                                                        {{ (strcmp($con, '見積提出済') == 0) ? 'selected' : '' }}
                                                                     @endforeach>見積提出済</option>
                                            <option value="受注" @foreach($data['list_status_selected'] as $con)
                                                                    {{ (strcmp($con, '受注') == 0) ? 'selected' : '' }}
                                                                @endforeach>受注</option>
                                            <option value="開発中" @foreach($data['list_status_selected'] as $con)
                                                                     {{ (strcmp($con, '開発中') == 0) ? 'selected' : '' }}
                                                                  @endforeach >開発中</option>
                                            <option value="支払待ち" @foreach($data['list_status_selected'] as $con)
                                                                        {{ (strcmp($con, '支払待ち') == 0) ? 'selected' : '' }}
                                                                     @endforeach >支払待ち</option>
                                            <option value="終了" @foreach($data['list_status_selected'] as $con)
                                                                    {{ (strcmp($con, '終了') == 0) ? 'selected' : '' }}
                                                                @endforeach >終了</option>
                                            <option value="キャンセル" @foreach($data['list_status_selected'] as $con)
                                                                        {{ (strcmp($con, 'キャンセル') == 0) ? 'selected' : '' }}
                                                                    @endforeach >キャンセル</option>
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
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="" method="POST" class="form-group form-horizontal" id="formCreateMail">
                            @foreach ($data['projects'] as $pro)
                                <tr>
                                    <td class="text-center"> <input type="checkbox" class="checkbox-item" name=""> </td>
                                    <td style="width: 12%;">{{ $pro->project_name }}</td>
                                    <td style="width: 12%;">
                                        @foreach ($data['customers'] as $cus)
                                            {{ ( isset($pro['project_customer_id']) && $pro['project_customer_id'] == $cus['customer_id'] ? $cus['customer_name'] : '' )}}
                                        @endforeach
                                    </td>
                                    <td style="width: 5%;">
                                        @foreach ($data['members'] as $mem)
                                            {{ ( isset($pro['project_member_id']) && $pro['project_member_id'] == $mem['member_id'] ? $mem['member_name'] : '' )}}
                                        @endforeach
                                    </td>
                                    <td style="width: 7%;">{{ $pro->project_status }}</td>
                                    <td class="text-right" style="width: 7%;">{{ number_format($pro->project_money) }}</td>
                                    <td style="white-space: pre-line"  data-id="{{ $pro->project_id }}" class="editProjectLastMemo" contenteditable="true">{{ $pro->project_last_memo }}</td>
                                    <td style="width: 11%;">{{ $pro->created_at }}</td>
                                    <td style="width: 11%;">{{ $pro->updated_at }}</td>
                                    <td class="text-center" style="width: 158px;">
                                        <a href="#" class="btn btn-info" onclick="openModalEditProject({{ $pro->project_id}})" ><i class="fa fa-pencil-square-o visible-xs"></i><span class="hidden-xs">Edit</span></a>
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
        <!-- Add project modal -->
        <div class="modal fade"  role="dialog" aria-labelledby="gridSystemModalLabel" id="addProjectModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Add project</h4>
                    </div>
                    <form action="" method="POST" class="form-add form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="modal-content">
                            <div class="form-group">
                                <label for="modalAddProjectName" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="project_name" id="modalAddProjectName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formSearchCustomerMail" class="col-sm-3 control-label">Company Name</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control combobox" id="combobox_add_project_customer_name" name="project_customer_id"   >
                                        <option></option>
                                        @foreach($data['customers'] as $cus)
                                            <option value="{{ $cus['customer_id'] }}">{{ $cus['customer_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="customer_name" id="project_customer_name_new" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddProjectMember" class="col-sm-3 control-label">Member</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control combobox" id="combobox_add_project_member_name" name="project_member_id"  style="width: 100%" >
                                        <option></option>
                                        @foreach($data['members'] as $mem)
                                            <option value="{{ $mem['member_id'] }}">{{ $mem['member_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="member_name" class="form-control" id="project_member_name_new">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddProjectStatus" class="col-sm-3 control-label">Status</label>
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
                            <div class="form-group">
                                <label for="modalAddProjectMoney" class="col-sm-3 control-label">Money</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="project_money" id="modalAddProjectMoney">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modalAddProjectMemo" class="col-sm-3 control-label">Memo</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name= "project_last_memo" id="modalAddProjectMemo" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="text-right">
                                    <button type="submit" id="addSubmit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Edit project modal -->
        <div id="editProjectModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">Edit Project</h4>
                        </div>
                        <form action="/project/update" method="POST" id="formEditProject" class="form-add form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="modalEditProjectName" class="col-sm-3 control-label">Project Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="project_name" id="modalEditProjectName">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="modalEditProjectMember" class="col-sm-3 control-label">Company Name</label>
                                    <div class="col-sm-9">
                                        <select type="text" class="form-control combobox" style="width: 100%" name="project_customer_id" id="modalEditProjectCustomerId">
                                            <option></option>
                                            @foreach($data['customers'] as $cus)
                                                <option value="{{ $cus['customer_id'] }}">{{ $cus['customer_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="customer_name" id="edit_project_customer_name_new" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="modalEditProjectMember" class="col-sm-3 control-label">Member</label>
                                    <div class="col-sm-9">
                                        <select type="text" class="form-control combobox" style="width: 100%" name="project_member_id" id="modalEditProjectMemberId">
                                            <option></option>
                                            @foreach ($data['members'] as $mem)
                                                <option value="{{ $mem['member_id'] }}" >{{ $mem['member_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="member_name" class="form-control" id="edit_project_member_name_new">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="modalEditProjectStatus" class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-9">
                                        <select type="text" class="form-control" name="project_status" id="modalEditProjectStatus">
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

                                <div class="form-group">
                                    <label for="modalEditProjectMoney" class="col-sm-3 control-label">Money</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="project_money" id="modalEditProjectMoney">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="modalEditLastMemo" class="col-sm-3 control-label">Last Memo</label>
                                    <div class="col-sm-9">
                                        <textarea name="project_last_memo" id="modalEditLastMemo" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="text-right">
                                        <input type="hidden" class="form-control" name="project_id" id="modalEditProjectId">
                                        <button type="submit" class="btn btn-primary" id="editSubmit">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <!-- Modal content-->
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/project.js') }}"></script>
@endsection



