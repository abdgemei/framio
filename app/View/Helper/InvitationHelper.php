<?php

App::uses('AppHelper', 'View/Helper');
App::uses('Invitation', 'Model');

class InvitationHelper extends AppHelper {
  
    public function isPending($id) {
        $invitation = new Invitation;
        $conditions = array(
            'Invitation.id' => $id,
            'Invitation.status' => 'pending'
        );
        if ($invitation->hasAny($conditions)) {
            return true;
        } else {
            return false;
        }
    }
}
