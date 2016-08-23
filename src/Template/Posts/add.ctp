<td>
    <?= $this->Html->link('Deconnexion', ['action' => 'logout', 'controller' => 'users']) ?>
</td>
<fieldset>
    <legend><?= __('Ajouter un article') ?></legend>
</fieldset>
<?php
    echo $this->Form->create($newpost);
    echo $this->Form->input('body', ['row' => '2']);
    echo $this->Form->button(__('Exprimez-vous !'));
    echo $this->Form->end();
?>