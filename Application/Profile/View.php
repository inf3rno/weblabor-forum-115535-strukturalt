<?php

namespace Application\Profile;

use Application\Core\View\AbstractView;

class View extends AbstractView
{
    protected $title = 'Profil oldal';

    protected $logoutUrl = '/logout.php';
    protected $logoutLinkLabel = 'kijelentkezés';

    protected $updateUrl = '/profile.php';
    protected $updateFormHeader = 'Jelszó módosító űrlap';
    protected $updateFormButton = 'Módosítás';

    public function build()
    {
        $this->html->link($this->logoutUrl, $this->logoutLinkLabel);
        $this->html->form($this->updateUrl, $this->updateFormHeader, $this->updateFormButton);
    }

}

