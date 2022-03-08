<?php

namespace Novaway\Bundle\OpenGraphBundle\Twig;

use Novaway\Component\OpenGraph\OpenGraphInterface;
use Novaway\Component\OpenGraph\OpenGraphTagInterface;
use Novaway\Component\OpenGraph\View\OpenGraphRendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class OpenGraphExtension extends AbstractExtension
{
    /** @var OpenGraphRendererInterface */
    private $renderer;


    /**
     * Constructor
     *
     * @param OpenGraphRendererInterface $renderer
     */
    public function __construct(OpenGraphRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('renderNamespace', [$this, 'renderNamespaceFunction'], ['is_safe' => ['html']]),
            new TwigFunction('renderGraph', [$this, 'renderGraphFunction'], ['is_safe' => ['html']]),
            new TwigFunction('renderTag', [$this, 'renderTagFunction'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Render namespaces
     *
     * @param OpenGraphInterface $graph
     * @param bool               $withTag
     * @return string
     */
    public function renderNamespaceFunction(OpenGraphInterface $graph, $withTag = true)
    {
        return $this->renderer->renderNamespaceAttributes($graph, $withTag);
    }

    /**
     * Render graph
     *
     * @param OpenGraphInterface $graph
     * @param string             $separator
     * @return string
     */
    public function renderGraphFunction(OpenGraphInterface $graph, $separator = PHP_EOL)
    {
        return $this->renderer->render($graph, $separator);
    }

    /**
     * Render graph tag
     *
     * @param OpenGraphTagInterface $tag
     * @return string
     */
    public function renderTagFunction(OpenGraphTagInterface $tag)
    {
        return $this->renderer->renderTag($tag);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'novaway_open_graph_extension';
    }
}
