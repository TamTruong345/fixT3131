<?php

namespace App\Models;

class Project extends Main
{
    /**
     * The table associated with the extends.
     *
     * @var string
     */
    protected $table = 'projects';
    protected $primaryKey = 'project_id';


    /**
     * Add one record into customer table
     *
     * @param array Data import
     * @return int customer_id
     */

    protected function getList($condition) {
        $condition = $this->removeItemIsEmpty($condition);
//        $condition = $this->makeConditionSearchForProject($condition);
        return $query = $this->where($condition)
            ->orderBy('project_id', 'desc')
            ->paginate(20);
    }


    /**
     * Add one record into project table
     *
     * @param array Data import
     * @return int project_id
     */
    protected function addNewRecord($data) {
        unset($data['_token']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['project_deleted'] = 0;
        return $this->insertGetId($data);
    }

    /**
     * Add multi record into project table
     *
     * @param array Data import
     */
    protected function addMultiRecord($data) {
        return $this->insert($data);
    }





}
