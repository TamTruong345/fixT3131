<?php

namespace App\Models;

class Member extends Main
{
    /**
     * The table associated with the extends.
     *
     * @var string
     */
    protected $table = 'members';
    protected $primaryKey = 'member_id';

    /**
     * Add one record into members table
     *
     */
    protected function addNewRecord($data) {
        unset($data['_token']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['member_deleted'] = 0;
        return $this->insertGetId($data);
    }

    protected function fetchAll() {
        return $this->where('member_deleted', 0)->get()->toArray();
    }
}
?>