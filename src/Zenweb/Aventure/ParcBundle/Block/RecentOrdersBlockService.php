<?php

namespace Zenweb\Aventure\ParcBundle\Block;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrderRepository;

/**
 * Class RecentOrdersBlockService
 * http://stackoverflow.com/questions/12223176/how-to-inject-a-repository-into-a-service-in-symfony2
 *
 * @package Zenweb\Aventure\ParcBundle\Block
 */
class RecentOrdersBlockService extends BaseBlockService
{
    /**
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @var SalesFlatOrderRepository
     */
    protected $orderManager;

    public function __construct($name, EngineInterface $templating, SecurityContextInterface $securityContext, SalesFlatOrderRepository $orderManager)
    {
        $this->securityContext = $securityContext;
        $this->orderManager    = $orderManager;

        parent::__construct($name, $templating);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $criteria = array();
        if ('admin' !== $blockContext->getSetting('mode')) {
            $criteria['customer'] = $this->customerManager->findOneBy(array('user' => $this->securityContext->getToken()->getUser()));
        }

        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'context'  => $blockContext,
            'settings' => $blockContext->getSettings(),
            'block'    => $blockContext->getBlock(),
            'orders'   => $this->orderManager->findBy($criteria, array('createdAt' => 'DESC'), $blockContext->getSetting('number'))
        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('number', 'integer', array('required' => true)),
                array('title', 'text', array('required' => false)),
                array('mode', 'choice', array(
                    'choices' => array(
                        'public' => 'public',
                        'admin'  => 'admin'
                    )
                ))
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Commandes récentes';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'number'   => 5,
            //public by default
            'mode'     => 'admin',
            'title'    => 'Commandes récentes',
            'template' => 'ZenwebAventureParcBundle:Block:recent_orders.html.twig'
        ));
    }

} 