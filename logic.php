<?php
#This file's purpose is loading the file that contains data and transforming it into a data structure that can be used


#check for form submission; set values to null if not submitted
if (isset($_GET)) {
    #Text input logic; display name that was entered after form is submitted
    $childName = $_GET['childName'];

    #Number input logic
    $collegeCostNow = $_GET['collegeCostNow'];
    $yrsUntilStart = $_GET['yrsUntilStart'];

    #Radio input logic

    #Dropdown input logic
    $collegeInflation = $_GET['collegeInflation'];
} else {
    #Text
    $childName = '';

    #Number
    $collegeCostNow = '';
    $yrsUntilStart = '';

    #Radio

    #Dropdown
    $collegeInflation = '';
}