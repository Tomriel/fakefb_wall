<fieldset>
    Bonjour bonjour !
</fieldset>
<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __("Merci de rentrer vos nom d'utilisateur et mot de passe") ?></legend>
        <?= $this->Form->input('email') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Se Connecter')); ?>
<?= $this->Form->end() ?>
</div>
<p>
    <legend>
            <?= __("Vous n'avez pas encore de compte ? ") ?>
            <?= $this->Html->link("Inscrivez-vous", ['action' => 'add']) ?>
             !
    </legend>
</p>