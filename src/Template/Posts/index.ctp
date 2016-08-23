<td>
    <?= $this->Html->link('Deconnexion', ['action' => 'logout', 'controller' => 'users']) ?>
</td>
<fieldset>
    <legend><?= __('Ajouter un post') ?></legend>
</fieldset>
<?php
    echo $this->Form->create(false, array(
        'url' => array('controller' => 'posts', 'action' => 'add')
    ));
    echo $this->Form->textarea('body', array('row' => '2'));
    echo $this->Form->button('Exprimez-vous !', array('type' => 'submit'));
    echo $this->Form->end();
?>
<fieldset>
    <legend><?= __('Tous les posts de votre mur') ?></learraygend>
</fieldset>
<table>
    <!-- Ici se trouve l'itération sur l'objet query de nos $articles, l'affichage des infos des posts -->
    <?php 
    foreach ($posts as $post): ?>
    <tr>
        <td>
            <p><h5><?= h($post->user_name . ' a posté ceci :') ?></h5></p>
            <p><?= h($post->body) ?></p>
            <?= $post->created->format(DATE_RFC850) ?>
        <?php echo '</br>';
                foreach ($comments as $comment):
                if ($comment->post_id == $post->id)
                {
                    echo ("</br>" . $comment->user_nickname . " a dit : " . $comment->body . '  (' . $comment->created->format('d/m/Y H:m:s') . ')');
                }
            endforeach;
            ?>
            <p>
            <?php
                echo $this->Form->create(true, array('url' => array('controller' => 'comments', 'action' => 'add')));
                echo $this->Form->text('body');
                echo $this->Form->input('post_id', array('type' => 'hidden', 'value' => $post->id));
                echo $this->Form->button(__('Envoyer commentaire'));
                echo $this->Form->end();
            ?>
            </p>
        </td>
    </tr>
    <?php endforeach; ?>
</table>