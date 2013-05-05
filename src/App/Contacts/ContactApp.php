<?php
namespace App\Contacts;

use Demo\Classes\AppModuleLogger as AppLoader;
use WScore\DiContainer\ContainerInterface;

class ContactApp extends AppLoader
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

        $this->em->getModel( '\App\Contacts\Entity\Friend' );
        $this->em->getModel( '\App\Contacts\Entity\Contact' );
        $this->em->getModel( '\App\Contacts\Entity\Tag' );
        $this->em->getModel( '\App\Contacts\Entity\Fr2tg' );
    }

    /**
     * @param string $pathInfo
     * @return null|string
     */
    public function load( $pathInfo )
    {
        $this->template->addParent( $this->viewRoot . '/contacts.php' );
        return parent::load( $pathInfo );
    }
}