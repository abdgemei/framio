<header>
    <section class="container" id="header">
        <div class="span4">
            <h1><?php echo $this->Html->link('Framio' , 'http://framio.dev'); ?></h1>
        </div>
        <div class="span3 offset4">
            <div id="accountActions">
                <?php $user = $this->Session->read('Auth.User'); ?>
                <?php if(isset($user)) { echo $user['email'] ."</em><br />";
                      echo '&nbsp;';
                      echo $this->Html->link('Account Settings', array('controller' => 'users', 'action' => 'edit'));
                      echo '&nbsp;';
                      echo $this->Html->link('Sign out', array('controller'=>'users', 'action'=>'logout'));
                } else { ?>
                    
                <?php echo $this->Html->link('Sign in', array('controller'=>'users', 'action'=>'login')); }  ?>
            </div>
        </div>
    </section>
</header>
