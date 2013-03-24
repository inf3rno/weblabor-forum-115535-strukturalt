<?php

namespace Application\Profile;

use Application\Core\View\AbstractPage;

class Page extends AbstractPage
{
    protected $title = 'Profil oldal';

    protected $logoutUrl = '/logout.php';
    protected $logoutLinkLabel = 'kijelentkezés';

    protected $updateUrl = '/profile.php';
    protected $updateFormHeader = 'Jelszó módosító űrlap';
    protected $updateFormButton = 'Módosítás';

    protected $messages = array(
        'noStore' => 'Nem sikerült kapcsolatot létesíteni az adattárolóval.',
        'updated' => 'Sikeres jelszó csere.'
    );


    public function build()
    {
        $this->html->link($this->logoutUrl, $this->logoutLinkLabel);
        $this->html->form($this->updateUrl, $this->updateFormHeader, $this->updateFormButton);
        $this->message();
    }

}

