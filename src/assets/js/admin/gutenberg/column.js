( function( blocks, editor, i18n, element, components, compose, _ ) {

	var registerBlockType = blocks.registerBlockType,
		G = components.G,
		SVG = components.SVG,
		Path = components.Path,
		InnerBlocks = editor.InnerBlocks;

	registerBlockType( 'vibrant-life/column', {
		
		title: 'Column',

		parent: [ 'vibrant-life/columns' ],

		icon: <SVG xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><Path fill="none" d="M0 0h24v24H0V0z" /><Path d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z" /></SVG>,

		description: 'A single column within a columns block.',

		category: 'common',

		supports: {
			inserter: true,
		},

		edit( { attributes, setAttributes, className } ) {
		
			return (
				<div className={ `column column-block` }>
					<InnerBlocks templateLock={ false } />
				</div>
			);
		},

		save( {attributes} ) {

			return (
				<div className={ `column column-block` }>
					<InnerBlocks.Content />
				</div>
			);

		},
			
	} );
			
} )(
	window.wp.blocks,
	window.wp.editor,
	window.wp.i18n,
	window.wp.element,
	window.wp.components,
	window.wp.compose,
	window._
);