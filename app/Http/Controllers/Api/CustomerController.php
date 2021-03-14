<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerController extends Controller
{
    private $customerRepository;
    
    public function __construct(CustomerRepositoryInterface $customerRepository) 
    {
        $this->middleware('auth:sanctum');
        $this->customerRepository = $customerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $filters = request()->only(Customer::ALLOWED_FILTERS);
            return $this->customerRepository->getAll($filters);
        }
        catch(\Exception $e){
            return response()->json(['error' => [$e->getMessage()]], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->only([
            'email',
            'password',
            'name',
            'iso_2',
            'city',
            'state',
            'zip', 
            'address',
            'phone',
            'company_name',
        ]);
        
        $rules = [
            'email'        => 'required|unique:customers|email|max:255',
            'password'     => 'required|min:8|max:255',
            'name'         => 'required|max:255|regex:/^[a-zA-Z0-9 _.-]*$/',
            'iso_2'        => 'required|max:2|regex:/^[a-zA-Z0-9 _.-]*$/',
            'city'         => 'required|max:255|regex:/^[a-zA-Z0-9 _.-]*$/',
            'state'        => 'max:255|regex:/^[a-zA-Z0-9 _.-]*$/',
            'zip'          => 'max:255|regex:/^[a-zA-Z0-9 _.-]*$/',
            'address'      => 'required|max:255|regex:/^[a-zA-Z0-9 _.-]*$/',
            'phone'        => 'numeric|digits_between:0,15',
            'company_name' => 'max:255|regex:/^[a-zA-Z0-9 _.-]*$/',
        ];
        
        $validator = \Validator::make($requestData, $rules);
        
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        
        try{
            $customer = $this->customerRepository->add($requestData);
            return response()->json($customer, 200);
        } catch (\Exception $e){
            return response()->json(['error' => [$e->getMessage()]], 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $customer = $this->customerRepository->get($id);
            
            if(empty($customer)){
                return response()->json(['error' => ['Customer not found']], 404);
            }
            
            return response()->json($customer, 200);
        }
        catch(\Exception $e){
            return response()->json(['error' => [$e->getMessage()]], 500);
        }
    }
}
