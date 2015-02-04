<?php

class BlogModel
{
   
    public function getAllBlog()
    {
        $sql = "SELECT id, auteur, content, titel FROM blog";
        $query = $this->db->prepare($sql);
        $query->execute();

       return $query->fetchAll();
    }

   
    public function addBlog($auteur, $content, $titel)
    {
        $sql = "INSERT INTO blog (auteur, content, titel) VALUES (:auteur, :content, :titel)";
        $query = $this->db->prepare($sql);
        $parameters = array(':auteur' => $auteur, ':content' => $content, ':titel' => $titel);
        
        $query->execute($parameters);
    }

   
    public function deleteBlog($blog_id)
    {
        $sql = "DELETE FROM blog WHERE id = :blog_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':blog_id' => $blog_id);
        
        $query->execute($parameters);
    }

   
    public function getBlog($blog_id)
    {
        $sql = "SELECT id, auteur, content, titel FROM blog WHERE id = :blog_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':blog_id' => $blog_id);

        $query->execute($parameters);

        return $query->fetch();
    }

   
    public function updateBlog($auteur, $content, $titel, $blog_id)
    {
        $sql = "UPDATE blog SET auteur = :auteur, content = :content, titel = :titel WHERE id = :blog_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':auteur' => $auteur, ':content' => $content, ':titel' => $titel, ':blog_id' => $blog_id);

        $query->execute($parameters);
    }

   
    public function getAmountOfBlog()
    {
        $sql = "SELECT COUNT(id) AS amount_of_blog FROM blog";
        $query = $this->db->prepare($sql);
        $query->execute();

       
        return $query->fetch()->amount_of_blog;
    }
}
