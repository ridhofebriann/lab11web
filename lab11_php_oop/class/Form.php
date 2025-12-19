<?php
class Form
{
    private $fields = array();
    private $action;
    private $submit = "Submit Form";
    private $jumField = 0;

    public function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function displayForm()
    {
        echo "<form action='" . $this->action . "' method='POST'>";
        echo '<table class="table table-borderless">';
        foreach ($this->fields as $field) {
            echo "<tr><td align='right' width='200'>" . $field['label'] . "</td>";
            echo "<td>";
            
            if ($field['type'] == 'textarea') {
                echo "<textarea name='" . $field['name'] . "' class='form-control' rows='3'></textarea>";
            } elseif ($field['type'] == 'select') {
                echo "<select name='" . $field['name'] . "' class='form-control'>";
                foreach ($field['options'] as $val => $label) {
                    echo "<option value='" . $val . "'>" . $label . "</option>";
                }
                echo "</select>";
            } else {
                echo "<input type='" . $field['type'] . "' name='" . $field['name'] . "' class='form-control' value='" . $field['value'] . "'>";
            }
            
            echo "</td></tr>";
        }
        echo "<tr><td></td><td><input type='submit' class='btn btn-primary' value='" . $this->submit . "'></td></tr>";
        echo "</table>";
        echo "</form>";
    }

    public function addField($name, $label, $type = "text", $value = "", $options = array())
    {
        $this->fields[$this->jumField]['name'] = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->fields[$this->jumField]['type'] = $type;
        $this->fields[$this->jumField]['value'] = $value;
        $this->fields[$this->jumField]['options'] = $options;
        $this->jumField++;
    }
}
?>