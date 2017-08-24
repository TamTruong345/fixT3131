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
    protected function getList($params) {
        $params = $this->removeItemIsEmpty($params);
        $condition = $this->makeConditionSearchForProject($params);

        $query = $this->orderBy('project_id', 'desc');
        if (!empty($params['project_status'])) {
            $query->whereIn("project_status", $params['project_status']);
        }
        $query->where($condition);
        return $query->paginate(20);
    }

    private function makeConditionSearchForProject($condition) {
        $predicates = [];
        $predicates[] = ['project_deleted', '=', '0'];
        if ($this->has($condition, 'project_name')) {
            $predicates[] = ['project_name', 'LIKE', '%'.$condition['project_name'].'%'];
        }
        if ($this->has($condition, 'project_customer_name')) {
            $predicates[] = ['project_customer_id', 'LIKE', '%'.$condition['project_customer_name'].'%'];
        }
        if ($this->has($condition, 'project_member_name')) {
            $predicates[] = ['project_member_id', 'LIKE', '%'.$condition['project_member_name'].'%'];
        }
        if ($this->has($condition, 'created_at_from')) {
            $predicates[] = ['created_at', '>=', $this->date_format($condition['created_at_from']).' 00:00:00'];
        }
        if ($this->has($condition, 'created_at_to')) {
            $predicates[] = ['created_at', '<=', $this->date_format($condition['created_at_to']).' 23:59:59'];
        }
        if ($this->has($condition, 'update_at_from')) {
            $predicates[] = ['updated_at', '>=', $this->date_format($condition['update_at_from']).' 00:00:00'];
        }
        if ($this->has($condition, 'update_at_to')) {
            $predicates[] = ['updated_at', '<=', $this->date_format($condition['update_at_to']).' 23:59:59'];
        }
        return $predicates;
    }

    /**
     * Delete item of Project table
     *
     * @param int project_id
     */
    protected function deleteProject($project_id) {
        $this->where('project_id', $project_id)->update(['project_deleted' => 1]);
    }

    /**
     * Search project by id
     *
     * @param int project_id
     * @return array project detail
     */
    protected function fetchOne($project_id) {
        return $this->where('project_id', $project_id)->first();
    }

    /**
     * Edit record of customers tables
     *
     * @param array data update
     */
    protected function editRecord($data) {
        unset($data['_token']);
        unset($data['customer_name']);
        unset($data['member_name']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->where('project_id', $data['project_id'])
            ->update($data);

    }


    /**
     * Add one record into project table
     *
     * @param array Data import
     * @return int project_id
     */
    protected function addNewRecord($data) {
        unset($data['_token']);
        unset($data['customer_name']);
        unset($data['member_name']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['project_deleted'] = 0;
        return $this->insertGetId($data);
    }


}
