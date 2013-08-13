<?php
namespace Modules\Contacts;

use WScore\Response\DispatchAbstract;
use WScore\Template\TemplateInterface;

/**
 * Class ContactApp
 *
 * @package Modules\Contacts
 * 
 * @namespace Modules-Contacts
 */
class ContactApp extends DispatchAbstract
{
    /**
     * @Inject
     * @var \WScore\DataMapper\EntityManager
     */
    public $em;

    /**
     * @Inject
     * @var \WScore\Cena\CenaManager
     */
    public $cm;

    /**
     * @Inject
     * @var \WScore\DataMapper\RoleManager
     */
    public $role;

    /**
     * @Inject
     * @var TemplateInterface
     */
    public $template;

    public function __construct()
    {
        parent::__construct( __DIR__ );
        $routes = array(
            'setup'  => array(),
            'create' => array(),
            'tags'   => array(),
            ':id'    => array( 'render' => 'edit' ),
            '/'      => array( 'render' => 'index' ),
        );
        $this->setRoute( $routes );

    }

    /**
     * @param array $match
     * @return null|string
     */
    public function respond( $match=array() )
    {
        $this->template->addParent( $this->viewRoot . '/contacts.php' );
        return parent::respond( $match );
    }

    /**
     * load all possible stuff.
     *
     * @return $this
     */
    public function instantiate()
    {
        $this->em->getModel( '\Modules\Contacts\Entity\Friend' );
        $this->em->getModel( '\Modules\Contacts\Entity\Contact' );
        $this->em->getModel( '\Modules\Contacts\Entity\Tag' );
        $this->em->getModel( '\Modules\Contacts\Entity\Fr2tg' );
        return parent::instantiate();
    }
}