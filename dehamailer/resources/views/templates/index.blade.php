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
        <h4>Template</h4>
        <ol class="breadcrumb no-bg m-b-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Template</li>
        </ol>
        <!-- End panel -->
        <div class="m-b-1 pull-right">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#importTemplateModal">Import</a>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addTemplateModal">Add</a>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">Subject</th>
                            <!--<th class="text-center">Content</th>-->
                            <th class="text-center" style="width: 110px">Attachment</th>
                            <th class="text-center" style="width: 300px">Mail CC</th>
                            <th class="text-center" style="width: 110px">Active</th>
                            <th style="width: 150px"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates as $tpl)
                                <tr>
                                    <td>{{ $tpl->template_subject }}</td>
                                    <!--<td>{{ $tpl->template_content }}</td>-->
                                    <td class="text-center"><input type="checkbox" name="templates_attachment" <?php echo ( empty($tpl->template_attachment) )? '' : 'checked' ?>></td>
                                    <td>{{ $tpl->template_mail_cc }}</td>
                                    <td class="text-center"><input type="checkbox" name="templates_status" <?php echo ( $tpl->template_status == 'active' )? 'checked' : '' ?>></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-info" onclick="openModalEditTemplate({{ $tpl->template_id }})"><i class="fa fa-pencil-square-o visible-xs"></i><span class="hidden-xs">Edit</span></a>
                                        <a href="#" class="btn btn-danger" onclick="deleteTemplate({{ $tpl->template_id }})"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">Delete</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">
            {!! $templates->render() !!}
        </div>
    </div>
    <!-- Add template modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="addTemplateModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Add template</h4>
                </div>
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-content">
                        <div class="form-group">
                            <label for="modalAddTemplateSubject" class="col-sm-3 control-label">Subject</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="template_subject" id="modalAddTemplateSubject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddTemplateContent" class="col-sm-3 control-label">Content</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="template_content" id="modalAddTemplateContent" rows="10">Dear [FULLNAME]</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddTemplateAttachment" class="col-sm-3 control-label">Attachment</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="template_attachment" id="modalAddTemplateAttachment">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddTemplateMailCC" class="col-sm-3 control-label">Mail CC</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="template_mail_cc" id="modalAddTemplateMailCC">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalAddTemplateStatus" class="col-sm-3 control-label">Active</label>
                            <div class="col-sm-9">
                                <input type="radio" name="template_status" value="active" checked="true"> Yes
                                <input type="radio" name="template_status" value="unactive"> No
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

    <!-- Edit template modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editTemplateModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Edit template</h4>
                </div>
                <form class="form-horizontal" action="/template/update" id="formEdit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-content">
                        <div class="form-group">
                            <label for="modalEditTemplateSubject" class="col-sm-3 control-label">Subject</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="template_subject" id="modalEditTemplateSubject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalEditTemplateContent" class="col-sm-3 control-label">Content</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="template_content" id="modalEditTemplateContent" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalEditTemplateAttachment" class="col-sm-3 control-label">Attachment</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="template_attachment" id="modalEditTemplateAttachment">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalEditTemplateAttachment" class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control" id="modalEditTemplateAttachmentOld">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalEditTemplateMailCC" class="col-sm-3 control-label">Mail CC</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="template_mail_cc" id="modalEditTemplateMailCC">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modalEditTemplateStatus" class="col-sm-3 control-label">Active</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="template_id" id="modalEditTemplateId">
                                <input type="radio" name="template_status" id="modalEditTemplateStatus1" value="active"> Yes
                                <input type="radio" name="template_status" id="modalEditTemplateStatus2" value="unactive"> No
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

    <!-- Import template modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="importTemplateModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Import template</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-content">
                        <div class="form-group">
                            <label for="modalEditTemplateAttachment" class="col-sm-3 control-label">File</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="modalEditTemplateAttachment">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="text-right">
                                <button type="button" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript" src="{{ URL::asset('js/template.js') }}"></script>
@endsection