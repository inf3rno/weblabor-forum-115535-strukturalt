<?php

namespace Application\Profile;

use Application\Auth\AuthException;
use Application\Auth\AuthInput;
use Application\Auth\AuthRedirect;
use Application\Container;
use Application\Core\Controller\InputException;
use Application\Core\Model\Store\StoreException;

class ProfileController
{
    protected $authModel;
    protected $input;
    protected $container;

    public function __construct(Container $container)
    {
        $this->authModel = $container->authModel();
        $this->container = $container;
        $this->input = new AuthInput();
    }

    public function profile()
    {
        try {
            if (!$this->authModel->authorized())
                throw new AuthException('No permission.');
            $this->authModel->update($this->input->password());
            $view = new UpdatedProfileView($this->container);
        } catch (InputException $e) {
            $view = new ProfileView($this->container);
        } catch (StoreException $e) {
            $view = new NoStoreProfileView($this->container);
        } catch (AuthException $e) {
            $view = new AuthRedirect($this->container);
        }
        $view->display();
    }
}

