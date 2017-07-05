<?php

namespace Bolt\Extension\cdowdy\Link2Section;


use Bolt\Extension\SimpleExtension;


/**
 * Link2SectionExtension extension class.
 *
 * @author Cory Dowdy <cory@corydowdy.com>
 */
class Link2SectionExtension extends SimpleExtension {

	/**
	 * {@inheritdoc}
	 */
	protected function registerTwigFilters()
	{
		$options = [ 'is_safe' => [ 'html' ], 'safe' => true ];

		return [
			'l2s' => [ 'link2section', $options ]
		];
	}


	/**
	 * @param        $input
	 * @param string $idToLink
	 * @param string $classes
	 * @param string $linkText
	 * @param bool   $wrapping
	 *
	 * @return string
	 */
	public function link2section( $input, $idToLink = '', $classes = '', $linkText = '', $wrapping = true )
	{
		return $this->buildL2SLink( $input, $idToLink, $classes, $linkText, $wrapping );
	}


	/**
	 * @param $inputClasses
	 *
	 * @return null|string
	 */
	protected function checkClasses( $inputClasses )
	{
		if ( empty( $inputClasses ) ) {
			return null;
		} else {
			return "class=\"{$inputClasses}\"";
		}
	}


	/**
	 * @param $inputText
	 *
	 * @return string
	 */
	protected function checkLinkText( $inputText )
	{

		if ( empty( $inputText ) ) {
			return 'Link';
		} else {
			return "$inputText";
		}
	}


	/**
	 * @param $input
	 * @param $id
	 *
	 * @return null|string
	 */
	protected function validatePassedID( $input, $id )
	{
		$app = $this->getContainer();

		if ( empty( $id ) ) {
			$errorMessage = "You Forgot To pass an ID to the Twig Filter. <b>{$input}</b> used in it's place instead of an anchor tag.";


			$app['logger.flash']->error( 'Link2Section Filter Error:: ' . $errorMessage );

			$app['logger.system']->error( 'Link2Section Filter Error:: ' . $errorMessage, [ 'event' => 'extension' ] );

			return null;

		} else {
			return "$id";
		}
	}


	/**
	 * @param $input
	 * @param $idToLink
	 * @param $classes
	 *
	 * @return string
	 */
	protected function wrappedLink( $input, $idToLink, $classes )
	{
		return "<a href=\"#{$idToLink}\" $classes >$input</a>";
	}


	/**
	 * @param        $input
	 * @param        $idToLink
	 * @param string $classes
	 * @param string $linkText
	 * @param bool   $wrapping
	 *
	 * @return string
	 */
	protected function buildL2SLink( $input, $idToLink, $classes = '', $linkText = '', $wrapping = true )
	{
		$hasId       = $this->validatePassedID( $input, $idToLink );
		$hasLinkText = $this->checkLinkText( $linkText );
		$hasClasses  = $this->checkClasses( $classes );

		if ( $hasId && $wrapping ) {
			return $this->wrappedLink( $input, $hasId, $hasClasses );
		}

		if ( ! $hasId ) {
			return $input;
		}

		if ( $hasId ) {
			return "$input <a href=\"#{$hasId}\" aria-label=\"Link To Section '{$input}'\" $hasClasses>$hasLinkText</a>";
		}


	}


}
