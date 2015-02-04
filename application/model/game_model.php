<?php
class GameModel
{
    //هنا تعطي ايعاز الى الداتا بيست ويطلب الكويري من المعلومات التي سوف تؤخذ من الداتا 
    public function getAllPhotos()
    {
        $sql = "SELECT id, filename ,longitude, latitude, userid FROM photo";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}