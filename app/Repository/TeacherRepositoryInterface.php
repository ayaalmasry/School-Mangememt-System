<?php
namespace App\Repository;
interface TeacherRepositoryInterface{
     public function getAllTeacher();
         
     public function storeTeachers($request);
     public function editTeachers($id);
     public function updateTeachers($request);
    public function deleteTeachers($request);
}