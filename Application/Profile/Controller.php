<?php

namespace Application\Profile;

use Application\Auth\AuthException;
use Application\Auth\Input;
use Application\Auth\Redirect;
use Application\Container;
use Application\Core\Controller\InputException;
use Application\Core\Model\Store\StoreException;

class Controller
{
    protected $authModel;
    protected $profileModel;
    protected $input;
    protected $container;

    public function __construct(Container $container)
    {
        $this->authModel = $container->authModel();
        $this->profileModel = $container->profileModel();
        $this->container = $container;
        $this->input = new Input();
    }

    public function profile()
    {
        try {
            if (!$this->authModel->authorized())
                throw new AuthException('No permission.');
            $this->profileModel->update($this->input->password());
            $view = new UpdatedView($this->container);
        } catch (InputException $e) {
            $view = new View($this->container);
        } catch (StoreException $e) {
            $view = new NoStoreView($this->container);
        } catch (AuthException $e) {
            $view = new Redirect($this->container);
        }
        $view->display();
    }
}

