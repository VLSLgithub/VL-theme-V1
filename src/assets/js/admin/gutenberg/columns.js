import { times } from 'lodash';
import classnames from 'classnames';
import memoize from 'memize';

const ALLOWED_BLOCKS = [ 'vibrant-life/column' ];

/**
 * Returns the layouts configuration for a given number of columns.
 *
 * @param {number} columns Number of columns.
 *
 * @return {Object[]} Columns layout configuration.
 */
const getColumnsTemplate = memoize( ( columns, attributes ) => {
	return times( columns, () => [ 'vibrant-life/column', attributes ] );
} );

( function( blocks, editor, i18n, element, components, compose, _ ) {

	var registerBlockType = blocks.registerBlockType,
		unregisterBlockType = blocks.unregisterBlockType,
		PanelBody = components.PanelBody,
		SelectControl = components.SelectControl,
		G = components.G,
		SVG = components.SVG,
		Path = components.Path,
		Fragment = element.Fragment,
		InspectorControls = editor.InspectorControls,
		InnerBlocks = editor.InnerBlocks;

	registerBlockType( 'vibrant-life/columns', {
		
		title: 'Columns',

		icon: <SVG viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><Path fill="none" d="M0 0h24v24H0V0z" /><G><Path d="M21 4H3L2 5v14l1 1h18l1-1V5l-1-1zM8 18H4V6h4v12zm6 0h-4V6h4v12zm6 0h-4V6h4v12z" /></G></SVG>,

		category: 'layout',
		
		attributes: {
			smallColumns: {
				type: 'number',
				default: 1,
			},
			mediumColumns: {
				type: 'number',
				default: 2,
			},
			largeColumns: {
				type: 'number',
				default: 2,
			},
			xlargeColumns: {
				type: 'number',
				default: 2,
			},
		},
		
		description: 'Add a block that displays content in multiple columns, then add whatever content blocks you’d like.',

		
		supports: {
			align: [ 'wide', 'full' ],
		},

		// Shows in Gutenberg Editor
		edit: function( { attributes, setAttributes, className } ) {
			
			const { smallColumns, mediumColumns, largeColumns, xlargeColumns } = attributes;
			const classes = classnames( className, 'row' );
			const columns = Math.max( smallColumns, mediumColumns, largeColumns, xlargeColumns );
			
			return (
				<Fragment>
					<InspectorControls>
						<PanelBody>
							<SelectControl
								label={ 'Small Screen Columns' }
								value={ smallColumns }
								options={ [
									{ label: '1 Column', value: 1 },
									{ label: '2 Columns', value: 2 },
									{ label: '3 Columns', value: 3 },
									{ label: '4 Columns', value: 4 },
									{ label: '6 Columns', value: 6 },
								] }
								onChange={ ( nextColumns ) => { 
									setAttributes( { 
										smallColumns: nextColumns,
									} ) 
								} }
							/>
							<SelectControl
								label={ 'Medium Screen Columns' }
								value={ mediumColumns }
								options={ [
									{ label: '1 Column', value: 1 },
									{ label: '2 Columns', value: 2 },
									{ label: '3 Columns', value: 3 },
									{ label: '4 Columns', value: 4 },
									{ label: '6 Columns', value: 6 },
								] }
								onChange={ ( nextColumns ) => { 
									setAttributes( { 
										mediumColumns: nextColumns,
									} ) 
								} }
							/>
 							<SelectControl
								label={ 'Large Screen Columns' }
								value={ largeColumns }
								options={ [
									{ label: '1 Column', value: 1 },
									{ label: '2 Columns', value: 2 },
									{ label: '3 Columns', value: 3 },
									{ label: '4 Columns', value: 4 },
									{ label: '6 Columns', value: 6 },
								] }
								onChange={ ( nextColumns ) => { 
									setAttributes( { 
										largeColumns: nextColumns,
									} ) 
								} }
							/>
							<SelectControl
								label={ 'Extra Large Screen Columns' }
								value={ xlargeColumns }
								options={ [
									{ label: '1 Column', value: 1 },
									{ label: '2 Columns', value: 2 },
									{ label: '3 Columns', value: 3 },
									{ label: '4 Columns', value: 4 },
									{ label: '6 Columns', value: 6 },
								] }
								onChange={ ( nextColumns ) => { 
									setAttributes( { 
										xlargeColumns: nextColumns,
									} ) 
								} }
							/>
						</PanelBody>
					</InspectorControls>
					<div className={ classes }>
						<InnerBlocks
							template={ getColumnsTemplate( columns, attributes ) }
							templateLock="all"
							allowedBlocks={ ALLOWED_BLOCKS } />
					</div>
				</Fragment>
			);
			
		},

		// Shows on the rendered Post
		save: function( { attributes } ) {
			
			const { smallColumns, mediumColumns, largeColumns, xlargeColumns } = attributes;

			return (
				<div className={'row'}>
					<InnerBlocks.Content />
				</div>
			);
			
		},
	} );
	
	// Use only our own
	// Script must require wp-edit-post
	// https://github.com/WordPress/gutenberg/issues/4848#issuecomment-388174948
	window._wpLoadGutenbergEditor.then( function() {
		unregisterBlockType( 'core/columns' );	
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