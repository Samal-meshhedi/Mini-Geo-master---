<?php
class Photo extends Controller
{
    
    public function index()
    {
        $this->photo_model = $this->loadModel('photo');
       
        $this->view->photos = $this->photo_model->getAllPhotos();
        
        $this->view->render('photo/index');
        
    }

    public function addPhoto()
    {
        $this->photo_model = $this->loadModel('photo');

        if (isset($_POST["submit_add_photo"])) {
        
        $this->photo_model->addPhoto($_FILES["filename"]);
       
        
        header('location: ' . URL . 'photo/index');
        }   
    }
}