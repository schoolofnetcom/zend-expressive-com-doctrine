<?php

namespace App\Action;

use App\Entity\Product;
use App\Forms\Products\Create as ProductCreateForm;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Hydrator\ClassMethods;

class ProductsCreateAction implements MiddlewareInterface
{
    private $template;
    private $router;
    private $entityManager;

    public function __construct(RouterInterface $router, TemplateRendererInterface $template, EntityManager $entityManager)
    {
        $this->router = $router;
        $this->template = $template;
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $form = new ProductCreateForm;
        $form->setHydrator(new ClassMethods());
        $form->bind(new Product);

        $data = $request->getParsedBody();
        $form->setData($data);

        if ($form->isValid()) {
            $entity = $form->getData();
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        }

        $uri = $this->router->generateUri('admin.products');
        return new RedirectResponse($uri);
    }
}