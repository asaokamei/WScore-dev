<?php
namespace App\Contacts;

use WScore\Web\Loader\AppLoader;
use WScore\DiContainer\ContainerInterface;

class ContactApp extends AppLoader
{
    /**
     * @Inject
     * @var \WScore\DataMapper\EntityManager
     */
    protected $em;

    /**
     * @Inject
     * @var \WScore\Cena\CenaManager
     */
    protected $cm;

    /**
     * @Inject
     * @var \WScore\DataMapper\RoleManager
     */
    protected $role;

    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    public function __construct()
    {
        $routes = array(
            'setup'  => array(),
            'create' => array(),
            'tags'   => array(),
            ':id'    => array( 'render' => 'edit' ),
            '/'      => array( 'render' => 'index' ),
        );
        $this->setRoute( $routes );

        $this->templateRoot = __DIR__ . '/View/';

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
        $this->template->set( 'baseUrl', $this->front->baseUrl );
        $this->template->addParent( $this->templateRoot . 'contacts.php' );
        return parent::load( $pathInfo );
    }
}