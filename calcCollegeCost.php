<?php

require 'Form.php';

use DWA\Form;

# Instantiate object(s)
$form = new Form($_GET);

$submitted = $form->isSubmitted();

if ($submitted) {
    $errorList = $form->validate(
        [
            'childName' => 'required|alpha|minLength:2|maxLength:50|name:your child',
            'collegeCostNow' => 'required|digit',
            'yrsUntilStart' => 'required|digit|min:1|max:100',
            'collegeInflation' => 'required',
        ]
    );
    $hasErrors = $form->hasErrors;
};

#check if there are errors, if not, get the values and set relevant defaults - I had trouble getting the default to set for $collegeInflation here. I wanted to set it to 6 once the form had been submitted.
if (!isset($errorList) || count($errorList) == 0) {
    # Get data from form request
    $childName = $form->get('childName');
    $collegeCostNow = $form->get('collegeCostNow');
    $yrsUntilStart = $form->get('yrsUntilStart');
    $collegeInflation = $form->get('collegeInflation');
};

