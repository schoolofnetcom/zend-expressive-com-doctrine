<?php

namespace App\Action;

use App\Entity\Product;
use App\Forms\Products\Create as ProductCreateForm;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Hydrator\ClassMethods;

class ProductsListAction implements MiddlewareInterface
{
    private $template;
    private $entityManager;

    public function __construct(TemplateRendererInterface $template, EntityManager $entityManager)
    {
        $this->template = $template;
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $form = new ProductCreateForm;
        $form->setHydrator(new ClassMethods());
        $form->bind(new Product);

        $repository = $this->entityManager->getRepository(Product::class);
        $products = $repository->findAll();

        return new HtmlResponse($this->template->render('app::products/list', ['form'=>$form, 'products'=>$products]));
    }
}