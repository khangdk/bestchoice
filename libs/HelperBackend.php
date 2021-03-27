<?php
class HelperBackend
{
    public static function showItemStatus($controller, $statusValue, $id)
    {
        $icon = 'check';
        $color = 'success';

        if ($statusValue == 'inactive') {
            $icon = 'minus';
            $color = 'danger';
        }

        $link = URL::createLink('backend', $controller, 'changeStatus', ['id' => $id, 'status' => $statusValue]);
        $xhtml = sprintf('<a href="%s" class="my-btn-state rounded-circle btn btn-sm btn-%s"><i class="fas fa-%s"></i></a>', $link, $color, $icon);

        return $xhtml;
    }

    public static function showItemGroupACP($groupACP, $id)
    {
        $icon = 'check';
        $color = 'success';

        if ($groupACP == 0) {
            $icon = 'minus';
            $color = 'danger';
        }

        $link = URL::createLink('backend', 'group', 'ajaxChangeGroupACP', ['id' => $id, 'group_acp' => $groupACP]);
        $xhtml = sprintf('<a href="%s" class="btn-group-acp my-btn-state rounded-circle btn btn-sm btn-%s"><i class="fas fa-%s"></i></a>', $link, $color, $icon);

        return $xhtml;
    }

    public static function showItemHistory($by, $time)
    {
        $xhtml = sprintf('
        <p class="mb-0 history-by"><i class="far fa-user"></i> %s</p>
        <p class="mb-0 history-time"><i class="far fa-clock"></i> %s</p>
        ', $by, $time);

        return $xhtml;
    }

    public static function showItemOrdering($controller, $id, $value)
    {
        $xhtml = sprintf('<input type="number" class="form-control form-control-sm text-center mx-auto input-ordering" value="%s" style="width: 80px" data-url="%s">', $value, URL::createLink('backend', $controller, 'ajaxOrdering', ['id' => $id, 'ordering' => 'value_new']));
        return $xhtml;
    }

    public static function showItemCheckbox($id)
    {
        $xhtml = '
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="checkbox-' . $id . '" name="checkbox[]" value="' . $id . '">
            <label for="checkbox-' . $id . '" class="custom-control-label"></label>
        </div>
        ';
        return $xhtml;
    }

    public static function highlight($search, $value)
    {
        if ($search != '') {
            return preg_replace('/' . preg_quote($search, '/') . '/ui', '<mark>$0</mark>', $value);
        }

        return $value;
    }

    public static function showActionButtons($controller, $id)
    {
        $linkDelete = URL::createLink('backend', $controller, 'delete', ['id' => $id]);

        $xhtml = '
        <a href="#" class="rounded-circle btn btn-sm btn-info" title="Edit">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <a href="' . $linkDelete . '" class="rounded-circle btn btn-sm btn-danger btn-delete" title="Delete">
            <i class="fas fa-trash-alt"></i>
        </a>
        ';

        return $xhtml;
    }

    public static function showFilterStatus($values, $controller, $currentStatus)
    {
        $xhtml = '';

        foreach ($values as $key => $value) {
            $link = URL::createLink('backend', $controller, 'index', ['filter_status' => $key]);
            $classActive = $currentStatus == $key ? 'btn-info' : 'btn-secondary';
            $name = '';
            switch ($key) {
                case 'all':
                    $name = 'Tất cả';
                    break;
                case 'active':
                    $name = 'Kích hoạt';
                    break;
                case 'inactive':
                    $name = 'Chưa kích hoạt';
                    break;
            }

            $xhtml .= sprintf('<a href="%s" class="mr-1 btn btn-sm %s">%s <span class="badge badge-pill badge-light">%s</span></a>', $link, $classActive, $name, $value);
        }

        return $xhtml;
    }

    public static function showNotify()
    {
        $notify = Session::get('notify');

        $xhtml = '';

        if (!empty($notify)) {
            $color = $notify['type'] == 'success' ? 'success' : 'danger';
            $xhtml = sprintf('
            <div class="alert alert-%s alert-dismissible" id="notify-message">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p class="mb-0">%s</p>
            </div>
            ', $color, $notify['message']);
        }

        Session::delete('notify');

        return $xhtml;
    }

    public static function setNotify($type, $message)
    {
        Session::set('notify', ['type' => $type, 'message' => $message]);
    }
}
