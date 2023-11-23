<?php
namespace App\Contracts;

interface Transaction
{
    /**
    * Validate Inputs
    */
    public function validate();

    /**
    * Return total amount
    */
    public function amount();

    /**
    * Return Inputs
    */
    public function inputs();

    /**
     * Return type of transaction
     */
    public function getType();
}
