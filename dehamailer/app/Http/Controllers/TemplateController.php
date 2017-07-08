<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Flash;

class TemplateController extends Controller
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of templates.
     *
     * @return Response
     */
    public function index() {
        $templates = Template::getList();
        return view('templates.index', array('templates' => $templates));
    }
    
    /**
     * Store a new template
     *
     * @return Response
     */
    public function store() {
        $data = $this->request->toArray();
        $filePath = $this->uploadFileAttachment();
        $data['template_attachment'] = $filePath;
        Template::addNewRecord($data);
        flash('Add template success!');
        return redirect()->route('template.index');
    }
    
    /**
     * edit template
     * 
     * @return Response
     */
    public function update() {
        $data = $this->request->toArray();
        $filePath = $this->uploadFileAttachment();
        if ( !empty($filePath) ) {
            $data['template_attachment'] = $filePath;   
        }
        Template::editRecord($data);
        flash('Edit template success!');
        return redirect()->route('template.index');
    }

    /**
     * Destroy template
     *
     * @param int template_id
     */
    public function destroy($template_id) {
        Template::deleteTemplate($template_id);
    }

    /**
	 * Get Template Detail
	 *
	 * @param int template_id
	 * @return json template detail
	 */
    public function show($template_id) {
        $templateDetail = Template::fetchOne($template_id);
        return json_encode($templateDetail);
    }

    /**
     * Store a file upload
     * 
     * @return string path
     */
    private function uploadFileAttachment() {
        if (!$this->isValidFileUpload()) {
            return '';
        }
        $extension = $this->request->file('template_attachment')->extension();
        $path = $this->request->file('template_attachment')->storeAs(
            'templates', date('YmdHis').".$extension"
        );
        return $path;
    }

    /**
     * Validate file upload
     *
     * @return boolean
     */
    private function isValidFileUpload() {
        if ( !$this->request->hasFile('template_attachment') ) {
            return false;
        }
        if ( !$this->request->file('template_attachment')->isValid() ) {
            return false;
        }
        return true;
    }
}
