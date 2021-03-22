<?php
class FormBackend {
    public static function select($name, $options, $keySelected, $class, $id = '', $style = '', $attributes = '') {
        $xhtml = sprintf('<select id="%s" name="%s" class="%s" style="%s" %s>', $id, $name, $class, $style, $attributes);

        foreach ($options as $key => $value) {
            $selected = $key == $keySelected ? 'selected' : '';
            $xhtml .= sprintf('<option value="%s" %s>%s</option>', $key, $selected, $value);
        }

        $xhtml .= '</select>';

        return $xhtml;
    }

    public static function selectIsNumeric($name, $options, $keySelected, $class, $id = '', $style = '') {
        $xhtml = sprintf('<select id="%s" name="%s" class="%s" style="%s">', $id, $name, $class, $style);

        foreach ($options as $key => $value) {
            $selected = ($key == $keySelected && is_numeric($keySelected)) ? 'selected' : '';
            $xhtml .= sprintf('<option value="%s" %s>%s</option>', $key, $selected, $value);
        }

        $xhtml .= '</select>';

        return $xhtml;
    }
}
?>