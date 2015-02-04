<div class="container">
    <h2>You are in the View: application/view/game/index.php (everything in this box comes from that file)</h2>
    <!-- add song form -->
    <div class="box">
        <h3>Add a game</h3>
        <form action="<?php echo URL; ?>game/aadgame" method="POST" enctype="multipart/form-data">
            <label>Bladeren</label>
            <input type="file" name="filename" value="" required /><br>

            <div id="map-canvas"></div><br>
            <input type="submit" name="submit_add_photo" value="Submit" />
        </form>
    </div>
    <!-- main content output -->
    <div class="box">
        
        <h3>List of games (data from first model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Afbeelding</td>
            </tr>
            </thead>
            <body>
            <?php foreach ($this->photo as $photo) { ?>
                <tr>

                    <td><?php if (isset($photo->id)) echo htmlspecialchars($photo->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><img width="100" src="<?php if (isset($photo->filename)) echo URL .'public/img/' . $photo->filename ;?>"</td>
                </tr>
            <?php } ?>
            </body>
        </table>
    </div>
</div>