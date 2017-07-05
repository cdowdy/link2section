<?php

namespace Bolt\Extension\cdowdy\Link2Section;



use Bolt\Extension\SimpleExtension;



/**
 * Link2SectionExtension extension class.
 *
 * @author Cory Dowdy <cory@corydowdy.com>
 */
class Link2SectionExtension extends SimpleExtension
{

    /**
     * {@inheritdoc}
     */
    protected function registerTwigPaths()
    {
        return ['templates'];
    }

    /**
     * {@inheritdoc}
     */
    protected function registerTwigFilters()
    {
        return [
            'l2s' => 'link2section',
        ];
    }

    /**
     * The callback function when {{ my_twig_function() }} is used in a template.
     *
     * @return string
     */
    public function link2section()
    {
        $context = [
            'something' => mt_rand(),
        ];

        return $this->renderTemplate('link2section.html.twig', $context);
    }

}
