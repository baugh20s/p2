<?php

require 'Form.php';

use DWA\Form;

$hasErrors = false;

# check for form submission; set values to null if not submitted
if (count($_GET)) {
    # Text input logic; display name that was entered after form is submitted
    $childName = $_GET['childName'];

    # Number input logic
    $collegeCostNow = $_GET['collegeCostNow'];
    $yrsUntilStart = $_GET['yrsUntilStart'];

    # Dropdown input logic
    $collegeInflation = $_GET['collegeInflation'];
} else {
    # Text
    $childName = '';

    # Number
    $collegeCostNow = '';
    $yrsUntilStart = '';

    # Dropdown
    $collegeInflation = '';
}

# Instantiate object(s)
$form = new Form($_GET);

# Get data from form request or default value
$childName = $form->get('childName', 'your child');
$collegeCostNow = $form->get('collegeCostNow', '50000');
$yrsUntilStart = $form->get('yrsUntilStart', '4');
$collegeInflation = $form->get('collegeInflation', '6');

# Check to see if form is submitted (see if GET is empty)
$submitted = $form->isSubmitted();

# If submitted, validate the form, set the validation rules for each field, and run them
if ($submitted) {
    $errorList = $form->validate(
        [
            'childName' => 'required|alpha|minLength:2|maxLength:50',
            'collegeCostNow' => 'required|digit',
            'yrsUntilStart' => 'required|digit|min:1|max:100',
            'collegeInflation' => 'required|min:0',
        ]
    );

    $hasErrors = $form->hasErrors;

    if ($hasErrors == false) {
        #future value = (cash flow at period 0) * (1 + rate of return) raised to (number of periods)
        #future college cost = collegeCostNow * (1 + collegeInflation) raised to (yrsUntilStart)
        $collegeCostFuture = round($collegeCostNow * pow((1 + ($collegeInflation / 100)), $yrsUntilStart), 2);
    }
};
