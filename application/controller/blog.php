<?php

class Blog extends Controller
{
    
    public function index()
    {
        $this->blog_model = $this->loadModel('blog');
        // getting all songs and amount of songs
        $this->view->blog = $this->blog_model->getAllBlog();
        $this->view->amount_of_blog = $this->blog_model->getAmountOfBlog();

        $this->view->render('blog/index');
    }
    

   public function addBlog()
    {
         $this->blog_model = $this->loadModel('blog');
       
        if (isset($_POST["submit_add_blog"])) {
            
            $this->blog_model->addBlog($_POST["auteur"], $_POST["content"],  $_POST["titel"]);
        }
        header('location: ' . URL . 'blog/index');
    }

    public function deleteBlog($blog_id)
    {
        $this->blog_model = $this->loadModel('blog');
        
        if (isset($blog_id)) {
           
        $this->blog_model->deleteBlog($blog_id);
        }
        
        header('location: ' . URL . 'blog/index');
    }

    
    public function editBlog($blog_id)
    {
        $this->blog_model = $this->loadModel('blog');
       
        if (isset($blog_id)) {
           
            $this->view->blog = $this->blog_model->getBlog($blog_id);

            
             $this->view->render('blog/edit');
        } else {
           
            header('location: ' . URL . 'blog/index');
        }
    }
    
    public function updateBlog()
    {
        $this->blog_model = $this->loadModel('blog');
        
        if (isset($_POST["submit_update_blog"])) {
           
            $this->blog_model->updateBlog($_POST["auteur"], $_POST["content"],  $_POST["titel"], $_POST['blog_id']);
        }

       
        header('location: ' . URL . 'blog/index');
    }

 
    public function ajaxGetStats()
    {
        $this->songs_model = $this->loadModel('songs');
        $this->amount_of_songs = $this->songs_model->getAmountOfSongs();

        echo $this->amount_of_songs;
    }

}


   
 