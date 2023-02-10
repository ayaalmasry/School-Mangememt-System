<?php

namespace App\Repository;

interface StudentGraduateRepositoryInterface{
    
    public function index();
    public function create();
    public function store($request);
    public function update($request);
    public function destroy($request);

    
    

}
