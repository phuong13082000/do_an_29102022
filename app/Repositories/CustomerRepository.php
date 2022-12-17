<?php

namespace App\Repositories;


use App\Models\Customer;

class CustomerRepository
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getAll()
    {
        return Customer::all();
    }

    public function findID($id)
    {
        return Customer::find($id);
    }

    public function findEmail($email)
    {
        return Customer::where('email', $email)->first();
    }

    public function countCustomer()
    {
        return Customer::count();
    }
}
