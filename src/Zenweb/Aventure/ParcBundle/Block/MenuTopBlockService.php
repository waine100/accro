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

use Zenweb\Aventure\ParcBundle\Entity\ParcRepository;

/**
 * Class MenuTopBlockService
 * http://stackoverflow.com/questions/12223176/how-to-inject-a-repository-into-a-service-in-symfony2
 *
 * @package Zenweb\Aventure\ParcBundle\Block
 */
class MenuTopBlockService extends BaseBlockService
{
    /**
     * @var SalesFlatOrderRepository
     */
    protected $parcManager;

    public function __construct($name, EngineInterface $templating, ParcRepository $parcManager)
    {
        $this->parcManager    = $parcManager;

        parent::__construct($name, $templating);
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'ZenwebAventureParcBundle:Front:menu_top.html.twig',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'block'    => $blockContext->getBlock(),
            'parcs'   => $this->parcManager->findByEnabled(true)
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
            'keys' => array()
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'zenweb_aventure_parc.menu.top';
    }
} 