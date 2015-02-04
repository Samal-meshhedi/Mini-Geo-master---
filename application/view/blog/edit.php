<div class="container">
    <h2>You are in the View: application/view/blog/edit.php (everything in this box comes from that file)</h2>
    <div>
        <h3>Edit a blog</h3>
        <form action="<?php echo URL; ?>blog/updateblog" method="POST">
            <label>Auteur</label>
            <input autofocus type="text" name="auteur" value="<?php echo htmlspecialchars($this->blog->auteur, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Content</label>
            <input type="text" name="content" value="<?php echo htmlspecialchars($this->blog->content, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Titel</label>
            <input type="text" name="titel" value="<?php echo htmlspecialchars($this->blog->titel, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($this->blog->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_blog" value="Update" />
        </form>
    </div>
</div>
