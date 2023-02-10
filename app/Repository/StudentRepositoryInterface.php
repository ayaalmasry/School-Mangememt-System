<?php

namespace App\Repository;

interface StudentRepositoryInterface{


    
    // Get Add Form Student
    public function Create_Student();
    public function Get_classrooms($id);
    public function Get_Sections($id);
    //Get Students
    public function Get_Students();
    //EditStudent
    public function edit_Students($id);
  //Update Students
     public function update_Students($request);
  //Delte Students
    public function delete_Students($request);
    //Shoe Attachment
     public function show_Students($id);
   public function  Upload_attachment($request);

}
