<?php
class GroupModel extends Model
{
    private $_columns = ['id', 'name', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering'];

    public function __construct()
    {
        parent::__construct();
        $this->setTable(TBL_GROUP);
    }

    public function listItem($arrParam, $options = null)
    {
        $query[] = "SELECT `id`, `name`, `group_acp`, `status`, `ordering`, `created`, `created_by`, `modified`, `modified_by`";
        $query[] = "FROM `$this->table`";
        $query[] = "WHERE `id` > 0";

        if (isset($arrParam['search_value']) && trim($arrParam['search_value']) != '') {
            $searchValue = trim($arrParam['search_value']);
            $query[] = "AND `name` LIKE '%$searchValue%'";
        }

        if (isset($arrParam['filter_groupacp']) && $arrParam['filter_groupacp'] != 'default') {
            $query[] = "AND `group_acp` = {$arrParam['filter_groupacp']}";
        }

        if (isset($arrParam['filter_status']) && $arrParam['filter_status'] != 'all') {
            $query[] = "AND `status` = '{$arrParam['filter_status']}'";
        }

        $query = implode(" ", $query);
        $result = $this->fetchAll($query);
        return $result;
    }

    public function changeStatus($arrParam, $options = [])
    {
        $status = $arrParam['status'] == 'active' ? 'inactive' : 'active';
        $query = "UPDATE `$this->table` SET `status` = '$status' WHERE `id` = {$arrParam['id']}";
        $this->query($query);

        if ($this->affectedRows() > 0) {
            HelperBackend::setNotify('success', SUCCESS_UPDATE_STATUS);
        } else {
            HelperBackend::setNotify('error', ERROR_NOTICE);
        }
    }

    public function changeGroupACP($arrParam, $options = null)
    {
        $groupACP = $arrParam['group_acp'] == 1 ? 0 : 1;
        $query = "UPDATE `$this->table` SET `group_acp` = '$groupACP' WHERE `id` = {$arrParam['id']}";
        $this->query($query);

        if ($options == null) {
            if ($this->affectedRows() > 0) {
                HelperBackend::setNotify('success', SUCCESS_UPDATE_GROUPACP);
            } else {
                HelperBackend::setNotify('error', ERROR_NOTICE);
            }
        }

        if ($options['task'] == 'ajax') {
            return [
                'message' => SUCCESS_UPDATE_GROUPACP,
                'group_acp' => $groupACP,
                'link' => URL::createLink($arrParam['module'], $arrParam['controller'], 'ajaxChangeGroupACP', ['id' => $arrParam['id'], 'group_acp' => $groupACP])
            ];
        }
    }

    public function deleteItems($arrParam, $options = [])
    {
        $ids = $arrParam['checkbox'] ?? [$arrParam['id']];
        $affectedRows = $this->delete($ids);

        if ($affectedRows > 0) {
            HelperBackend::setNotify('success', SUCCESS_DELETE);
        } else {
            HelperBackend::setNotify('error', ERROR_NOTICE);
        }
    }

    public function countItems($arrParam, $options = [])
    {
        if ($options['task'] == 'count-active') {
            $query = "SELECT count(`id`) as `total` FROM `$this->table` WHERE `status` = 'active'";
            $result = $this->fetchRow($query);
            return $result['total'];
        }

        if ($options['task'] == 'count-inactive') {
            $query = "SELECT count(`id`) as `total` FROM `$this->table` WHERE `status` = 'inactive'";
            $result = $this->fetchRow($query);
            return $result['total'];
        }
    }

    public function multiChangeStatus($arrParam, $options = [])
    {
        $ids = $arrParam['checkbox'];
        $action = $arrParam['action'];
        $ids = implode(', ', $ids);
        $query = "UPDATE `$this->table` SET `status` = '$action' WHERE `id` IN ($ids)";
        $this->query($query);
        HelperBackend::setNotify('success', SUCCESS_UPDATE_STATUS);
    }
}
