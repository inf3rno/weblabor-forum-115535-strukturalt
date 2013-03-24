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

    protected function build()
    {
        $html = $this->html;
        $linkParams = array($this->logoutUrl, $this->logoutLinkLabel);
        $formParams = array($this->updateUrl, $this->updateFormHeader, $this->updateFormButton);
        $this->content = function () use ($html, $linkParams, $formParams) {
            $html->link($linkParams[0], $linkParams[1]);
            $html->form($formParams[0], $formParams[1], $formParams[2]);
        };
    }


}
