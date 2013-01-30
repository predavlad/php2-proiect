<?php

class Form {

    protected $data;
    protected $submit = array(
        'label' => 'Submit',
        'id' => '',
        'class' => ''
    );

    public function __construct() {

    }

    public function setSubmit($submit) {
        $this->submit = $submit;
    }

    /**
     * @param $input
     */
    public function addInput($input, $label, $order = 0) {
        if ($input instanceof Form_Input_Abstract_Main) {
            $this->data[] = array(
                'input' => $input,
                'label' => $label,
                'order' => $order
            );
        } else {
            throw new Exception('Something went wrong adding an input');
        }
    }

    /**
     * @TODO: sort $this->data
     * @param bool $echo
     * @return string
     */
    public function render($echo = true) {
        ob_start(); ?>
            <form method="POST" action="">
                <?php foreach ($this->data as $input) {
                echo "<label>{$input['label']}</label>";
                echo $input['input'];
            }?>
                <input type="submit" name="<?php echo $this->submit['name']; ?>" value="<?php echo $this->submit['label'] ?>" />
            </form>
        <?php $return = ob_get_clean();
        if ($echo) {
            echo $return;
        } else {
            return $return;
        }
    }

}