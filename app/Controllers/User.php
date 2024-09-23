<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{

    private $model;
    public function __construct(){
        $this->model = new \App\Models\Users();
    }

    private function getUsers(){
        // $db = \Config\Database::connect();

        $start = intval(request()->getPost('start'));
        $length = intval(request()->getPost('length'));
        $searchValue = request()->getPost('search')['value'];

        // $builder = $db->table('users');
        // if ($searchValue != "") {
        //     $builder->like('name', $searchValue);
        //     $builder->orLike('email', $searchValue);
        // }
        // $builder->limit($length, $start);
        // $users = $builder->get()->getResultArray();

        $users = [];

        if ($searchValue == "") {
            $users = $this->model
            ->limit($length, $start)
            ->findAll();
        }else{
            $users = $this->model
            ->like('name', $searchValue)
            ->orLike('email', $searchValue)
            ->limit($length, $start)
            ->findAll();
        }

        // log_message('error', json_encode($users[0]->name));

        return $users; 
    }

    private function countAllUsers(){
        
        $searchValue = request()->getPost('search')['value'];
        $usersCount = 10;

        if ($searchValue == "") {
            $usersCount = $this->model
            ->countAllResults();
        }else{
            $usersCount = $this->model
            ->like('name', $searchValue)
            ->orLike('email', $searchValue)
            ->countAllResults();
        }

        return $usersCount;
    }

    public function index(): ResponseInterface
    {
    
        $draw = intval(request()->getPost('draw'));
        $allUsers = $this->countAllUsers();
        
        // Return array of users with id, name and email 
        $users = $this->getUsers();

        $response = [
            "draw" => $draw,
            "recordsTotal" => $allUsers,
            "recordsFiltered" => $allUsers,
            "data" => $users
        ];

        return response()->setJSON($response);
    }

    function getSingleUser($id){
        $user = $this->model->find($id);
        log_message('error', json_encode($user));
        dd($user);
        // return response()->setJSON($user);
    }

    function createUser(){
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email')
        ];

        // log_message('error', json_encode($data));

        $user = new \App\Entities\User($data);

        $this->model->insert($user );
        return response()->setJSON(['message' => 'User created successfully']);
    }
}
