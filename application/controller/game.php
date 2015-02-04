<?php
class Game extends Controller
{
    //هنا نضيف التلعليمات التي تطرحها الكيم 
    public function index()
    {
        $this->game_model = $this->loadModel('game');
        $this->view->photo = $this->game_model->getAllPhotos();
        $this->view->render('game/index');
    }
    // هنا نقوم بجمجم الحلان واخذها من الرفع 
    public function score(){
        $this->game_model = $this->loadModel('game');
        $this->game_model->inputScore($_POST['distance'], $_POST['photo_id']);
        $this->view->render('game/score');
    }
    //هنا ناخذ الكيم مودل ويقوم الذس بالاشاره الى العناوين المحدد
    public function ajaxGetStats($id)
    {
        $this->game_model = $this->loadModel('game');
        $lngLat = $this->game_model->getLngLat($id);
        echo $lngLat->latitude . "," . $lngLat->longitude;
    }
}