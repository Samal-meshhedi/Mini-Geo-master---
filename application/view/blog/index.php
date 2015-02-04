<div class="container">
    <h2>You are in the View: application/view/blog/index.php (everything in this box comes from that file)</h2>
    <!-- add song form -->
    <div class="box">
        <h3>Add a post</h3>
        <form action="<?php echo URL; ?>blog/addblog" method="POST">
            <label>Auteur</label>
            <input type="text" name="auteur" value="" required />
            <label>Content</label>
            <input type="text" name="content" value="" required />
            <label>Titel</label>
            <input type="text" name="titel" value="" />
            <input type="submit" name="submit_add_blog" value="Submit" />
        </form>
    </div>

     <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Auteur</td>
                <td>Content</td>
                <td>Titel</td>
                <td>DELETE</td>
                <td>EDIT</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->blog as $blog) { ?>
                <tr>
                    <td><?php if (isset($blog->id)) echo htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($blog->auteur)) echo htmlspecialchars($blog->auteur, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($blog->content)) echo htmlspecialchars($blog->content, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php if (isset($blog->titel)) { ?>
                            <a href="<?php echo htmlspecialchars($blog->titel, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($blog->titel, ENT_QUOTES, 'UTF-8'); ?></a>
                        <?php } ?>
                    </td>
                    <td><a href="<?php echo URL . 'blog/deleteblog/' . htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
                    <td><a href="<?php echo URL . 'blog/editblog/' . htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
   