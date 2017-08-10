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
    protected $fillable = ['project_name', 'project_customer_name', 'project_member_name', 'project_status', 'project_money', 'project_last_memo', 'created_at', 'updated_at'];
    protected $primaryKey = 'project_id';
    /**
     * Get a listing of customer with condition
     *
     * @return array Response
     */
    protected function getList($condition) {
        $condition = $this->removeItemIsEmpty($condition);
        $condition = $this->makeConditionSearchForProject($condition);
        return $query = $this->where($condition)
            ->orderBy('project_id', 'desc')
            ->paginate(20);
    }
    private function makeConditionSearchForProject($condition) {
        $predicates = [];
        $predicates[] = ['project_deleted', '=', '0'];
        if ($this->has($condition, 'project_name')) {
            $predicates[] = ['project_name', 'LIKE', '%'.$condition['project_name'].'%'];
        }
        if ($this->has($condition, 'project_customer_name')) {
            $predicates[] = ['project_customer_name', 'LIKE', '%'.$condition['project_customer_name'].'%'];
        }
        if ($this->has($condition, 'project_member_name')) {
            $predicates[] = ['project_member_name', 'LIKE', '%'.$condition['project_member_name'].'%'];
        }
        if ($this->has($condition, 'project_status')) {
            $predicates[] = ['project_status', 'LIKE', '%'.$condition['project_status'].'%'];
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
}
